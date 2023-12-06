<?php

namespace App\Services;

use App\Entities\Enum\StatusOrder;
use App\Entities\OrdersEntities;
use App\Entities\PenerimaanBarangEntities;
use App\Entities\PenerimaanBarangEntity;
use App\Exception\DatabaseFailedUpdate;
use App\Models\Gudang;
use App\Models\PenerimaanBarang;
use CodeIgniter\Database\ConnectionInterface;

class PenerimaanBarangServices
{
    private PenerimaanBarang $penerimaanBarangModel;
    private ConnectionInterface $DatabaseConnection;

    /**
     * @param ConnectionInterface $DatabaseConnection
     */
    public function __construct(ConnectionInterface $DatabaseConnection)
    {
        $this->DatabaseConnection       = $DatabaseConnection;
        $this->penerimaanBarangModel    = new PenerimaanBarang($DatabaseConnection);
    }

    /**
     * method ini digunakan saat shipment produk/ penerimaan barang order
     * method ini melakukan insert data penerimaan barang table, perubahan
     * stok pada produk table dan perubahan stok gudang table
     *
     * @param PenerimaanBarangEntities $penerimaanBarangEntities
     * @param string $idProduct
     * @param int $jumlahOrder
     * @return void
     * @throws DatabaseFailedUpdate
     */
    public function shipmentProductProcess(PenerimaanBarangEntities $penerimaanBarangEntities,
                                           string                   $idProduct, int $jumlahOrder)
    {
        $orderServices = new OrderServices($this->DatabaseConnection);
        $orderEntites  = new OrdersEntities();
        $produkServices = new ProdukServices($this->DatabaseConnection);
        $gudangServices = new GudangServices($this->DatabaseConnection);

        $penerimaanBarangEntities->creatingObjectForModel();
        // setting keperluan update status order
        $orderEntites->setIdOrder($penerimaanBarangEntities->getIdOrder());
        $orderEntites->setStatusOrder(StatusOrder::BARANG_SAMPAI);

        try{
            $this->penerimaanBarangModel->insert($penerimaanBarangEntities);
            $orderServices->updateStatusOrder($orderEntites);
            $produkServices->updateStokProduct($idProduct,$jumlahOrder);
            $gudangServices->updateStokGudangPenambahan($idProduct,$jumlahOrder);

            log_message('info',PenerimaanBarangServices::class.' sukses update stok id produk',
                [
                    'id produk'=>$idProduct,
                    'id order'=>$penerimaanBarangEntities->getIdOrder(),
                    'jumlah barang'=>$jumlahOrder
                ]);

        } catch (\ReflectionException $e) {
            log_message('error',PenerimaanBarangServices::class.' error pada update stok');
            log_message('error',$e->getMessage());
        }
    }
}