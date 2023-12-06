<?php

namespace App\Services;

use App\Entities\GudangEntities;
use App\Exception\DatabaseFailedUpdate;
use App\Models\Gudang;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

class GudangServices
{
    private Gudang $gudangModel;

    /**
     * @param Gudang $gudangModel
     */
    public function __construct(ConnectionInterface $DatabaseConnection)
    {
        $this->gudangModel = new Gudang($DatabaseConnection);
    }

    public function insertData(GudangEntities $gudangEntities){
        try {
            $gudangEntities->creatingObjectForModel();

            $this->gudangModel->insert($gudangEntities);
            log_message('info',GudangServices::class.' success insert data '.$gudangEntities);

        } catch (\ReflectionException|DatabaseException $e) {
            log_message('error',GudangServices::class.' failed inserting data',[$gudangEntities]);
            log_message('error',$e->getMessage());
        }
    }

    /**
     * @param string $idProduct
     * @return void
     * @throws DatabaseException
     */
    public function deleteGudangData(string $idProduct){
        try{
            $this->gudangModel->delete($idProduct);
            log_message('info',GudangServices::class.' sukses delete data gudang id produk '.$idProduct);
        }catch (DatabaseException $exception){
            log_message('error',GudangServices::class.' failed delete data gudang id produk '.$idProduct);
            log_message('error',$exception->getMessage());
        }
    }

    /**
     * @param GudangEntities $gudangEntities
     * @return void
     * @throws DatabaseFailedUpdate
     */
    public function updateStokGudangDikeluarkan(GudangEntities $gudangEntities){
        try{
            // mencari data gudang untuk keperluan update
            $dataSebelumDiUpdate = $this->gudangModel->asArray()->find($gudangEntities->getIdProduk());

            $this->gudangModel->where('id_produk',$gudangEntities->getIdProduk())
                              ->set(
                                  'jumlah_stok_dikeluarkan',
                                  $dataSebelumDiUpdate['jumlah_stok_dikeluarkan'] + $gudangEntities->getJumlahStokDiKeluarkan())
                              ->set(
                                  'jumlah_stok_digudang',
                                  $dataSebelumDiUpdate['jumlah_stok_digudang'] - $gudangEntities->getJumlahStokDiKeluarkan())
                              ->set(
                                  'tanggal_terakhir_keluar',
                                  $gudangEntities->getTanggalTerakhirKeluar())
                              ->update();

            log_message('info',GudangServices::class.' success update data stok '.$gudangEntities);

        } catch (\ReflectionException|DatabaseException $e)
        {
            log_message('eror',GudangServices::class.' kesalahan pada update stok gudang dikeluarkan id produk '.$gudangEntities->getIdProduk());
            log_message('error',$e->getMessage());
            throw new DatabaseFailedUpdate("gagal update stok");
        }
    }

    public function updateStokGudangPenambahan(string $idProduct,int $jumlahProdukDitambah){
        try{
            $jumlahProdukSebelumnya = $this->gudangModel->asArray()->find($idProduct);

            $this->gudangModel->where('id_produk',$idProduct)
                ->set(
                    'jumlah_stok_digudang',
                    $jumlahProdukSebelumnya['jumlah_stok_digudang'] + $jumlahProdukDitambah)
                ->update();

            log_message('info',GudangServices::class.' success update stok id produk '.$idProduct);

        } catch (\ReflectionException|DatabaseException $e) {
            log_message('error',GudangServices::class.' gagal update stok produk id produk '.$idProduct);
            log_message('error',$e->getMessage());
            throw new DatabaseFailedUpdate("ada kesalahan saat update stok gudang");
        }
    }
}