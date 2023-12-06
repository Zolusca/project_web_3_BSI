<?php

namespace App\Services;

use App\Entities\OrdersEntities;
use App\Exception\DatabaseFailedInsert;
use App\Exception\DatabaseFailedUpdate;
use App\Models\Orders;
use App\Models\Produk;
use App\Models\TemporaryOrder;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\Exceptions\DataException;
use Config\Services;

class OrderServices
{
    private Orders $orderModel;
    private ConnectionInterface $DatabaseConnection;

    /**
     * @param ConnectionInterface $DatabaseConnection
     */
    public function __construct(ConnectionInterface $DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection;
        $this->orderModel         = new Orders($DatabaseConnection);
    }

    /**
     * @param OrdersEntities $ordersEntities
     * @param float $harga_beli_produk
     * @return OrdersEntities
     * @throws DatabaseFailedInsert
     */
    public function insertOrderData(OrdersEntities $ordersEntities, float $harga_beli_produk)
    {
        $orderTempModel = new TemporaryOrder($this->DatabaseConnection);

        try{
            $totalHarga = $ordersEntities->totalHarga($ordersEntities->getPpn(),$harga_beli_produk,$ordersEntities->getJumlahOrderProduk());
            $ordersEntities->setTotalHarga($totalHarga);

            $ordersEntities->creatingObjectForModel();

            $this->orderModel->insert($ordersEntities);

            log_message('info',OrderServices::class.' berhasil insert order '.$ordersEntities);

            $orderTempModel->delete($ordersEntities->getIdOrder());

            return $ordersEntities;

        } catch (\ReflectionException|DataException $e) {
            log_message('error',OrderServices::class.' kesalahan pada inserting data order '.$ordersEntities);
            log_message('error',$e->getMessage());
            throw new DatabaseFailedInsert("data tidak berhasil ditambah");
        }
    }

    /**
     * @param string $idOrder
     * @return void
     */
    public function deleteOrder(string $idOrder){
        try {
            $this->orderModel->delete($idOrder);
        }catch (DataException $exception){
            log_message('error',OrderServices::class.' kesalahan pada delete data order id order '.$idOrder);
            log_message('error',$exception->getMessage());
        }
    }

    /**
     * the important things to be set variable on entities is id_order and status_order
     * @throws DatabaseFailedUpdate
     */
    public function updateStatusOrder(OrdersEntities $ordersEntities){
        try{
            $isOrderExist = $this->orderModel->find($ordersEntities->getIdOrder());

            // jika order data ditemukan
            if($isOrderExist != null){
                $this->orderModel->where('id_order',$ordersEntities->getIdOrder())
                                ->set('status_order',$ordersEntities->getStatusOrder())
                                ->update();

                log_message('info',OrderServices::class.' success update status order id order '.$ordersEntities->getIdOrder());
            }
            else{
                log_message('info',OrderServices::class.' data gagal di update status order id order '.$ordersEntities->getIdOrder());
                throw new DatabaseFailedUpdate("data tidak ditemukan");
            }

        }   catch (\ReflectionException|DatabaseException $e){
            log_message('error',OrderServices::class.' kesalahan pada update data order id order '.$ordersEntities->getIdOrder());
            log_message('error',$e->getMessage());
        }
    }
}