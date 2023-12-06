<?php

namespace App\Services;

use App\Entities\DetailProductEntities;
use App\Exception\DatabaseFailedUpdate;
use App\Models\DetailProduk;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

class DetailProdukServices
{
    private DetailProduk $detailProdukModel;

    /**
     * @param ConnectionInterface $DatabaseConnection
     */
    public function __construct(ConnectionInterface $DatabaseConnection)
    {
        $this->detailProdukModel  = new DetailProduk($DatabaseConnection);
    }

    public function insertDetailProduk(DetailProductEntities $detailProductEntities){
        $detailProductEntities->creatingObjectForModel();

        try {
            $this->detailProdukModel->insert($detailProductEntities);
            log_message('info',DetailProdukServices::class.' success inserting data '.$detailProductEntities);

        } catch (\ReflectionException $e) {
            log_message('error',DetailProdukServices::class.' failed inserting data '.$detailProductEntities);
            log_message('error',$e->getMessage());
        }
    }

    /**
     * @param DetailProductEntities $detailProductEntities
     * @return void
     * @throws DatabaseFailedUpdate kegagalan dari updating data detail produk
     */
    public function updateDetailProduk(DetailProductEntities $detailProductEntities){

        try{
            $this->detailProdukModel
                ->where('id_produk',$detailProductEntities->getIdProduk())
                ->set('jumlah_unit_dalam_box',$detailProductEntities->getJumlahUnitDalamBox())
                ->set('tanggal_order_terakhir',$detailProductEntities->getTanggalOrderTerakhir())
                ->set('id_order',$detailProductEntities->getIdOrderTerakhir())
                ->update();

        } catch (\ReflectionException|DatabaseException $e) {
            log_message('error',DetailProdukServices::class.' failed update detail produk data '.$detailProductEntities);
            log_message('error',$e->getMessage());
            throw new DatabaseFailedUpdate("data detail produk tidak dapat di update");
        }
    }

    public function deleteDetailProductData(string $idProduct){
        try{
            $this->detailProdukModel->delete($idProduct);
            log_message('info',DetailProdukServices::class. ' success delete data id produk '.$idProduct);

        }catch (DatabaseException $exception){
            log_message('error',DetailProdukServices::class.' failed delete detail produk data '.$idProduct);
            log_message('error',$exception->getMessage());
        }
    }
}