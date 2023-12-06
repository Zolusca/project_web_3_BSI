<?php
namespace App\Services;

use App\Entities\DetailProductEntities;
use App\Entities\Enum\StatusOrder;
use App\Entities\GudangEntities;
use App\Entities\GudangEntity;
use App\Entities\ProductEntities;
use App\Entities\ProdukEntity;
use App\Exception\DatabaseFailedDelete;
use App\Exception\DatabaseFailedInsert;
use App\Exception\DatabaseFailedUpdate;
use App\Models\DetailProduk;
use App\Models\Gudang;
use App\Models\Orders;
use App\Models\Produk;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ProdukServices
{
    private Produk $produkModel;
    private ConnectionInterface $DatabaseConnection;

    /**
     * @param Produk $produk
     */
    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection;
        $this->produkModel        = new Produk($this->DatabaseConnection);
    }

    /**
     * @throws DatabaseFailedInsert
     * @return ProductEntities
     */
    public function insertProduct(ProductEntities $productEntities){
        $gudangEntities   = new GudangEntities();
        $gudangServices = new GudangServices($this->DatabaseConnection);
        $detailProductEntities   = new DetailProductEntities();
        $detailServices = new DetailProdukServices($this->DatabaseConnection);

        try{
            // mengecek apakah data sudah ada
            if($this->produkModel
                    ->where('nama_produk',$productEntities->getNamaProduk())
                    ->where('id_penyalur',$productEntities->getIdProduk())
                    ->countAllResults()>=1
            ){
                throw new DatabaseFailedInsert("Data Produk sudah ada ".$productEntities->getNamaProduk());
            }

            // melengkapi dan membuat object untuk model
            $productEntities->setIdProduk();
            $gudangEntities->setIdProduk($productEntities->getIdProduk());
            $detailProductEntities->setIdProduk($productEntities->getIdProduk());

            // setiap inserting jangan lupa menggunakan method ini
            $productEntities->creatingObjectForModel();

            log_message('info',$productEntities);

            // inserting data
            $this->produkModel->insert($productEntities);
            $gudangServices->insertData($gudangEntities);
            $detailServices->insertDetailProduk($detailProductEntities);

            return $productEntities;

        }catch (DatabaseException|\ReflectionException $exception) {
            log_message('error', ProdukServices::class.' failed inserting data '.$productEntities);
            log_message('error', $exception->getMessage());
            throw $exception;
        }
    }

    /**
     * method ini digunakan untuk update data pada table detail produk
     * mengganti tanggal_order_terakhir dengan data yang baru
     * @return void
     */
    public function updateStatusDetailProduk(): void
    {
        $ordersModel = new Orders($this->DatabaseConnection);
        $detailProduk = new DetailProduk($this->DatabaseConnection);

        $dataListOrder  = $ordersModel->where('status_order',StatusOrder::DISETUJUI->value)
                                            ->asArray()->findAll();

        try{
            foreach ($dataListOrder as $data){

                $detailProduk->where('id_produk', $data['id_produk'])
                    ->set('tanggal_order_terakhir', $data['tanggal_order'])
                    ->set('id_order',$data['id_order'])
                    ->update();
            }

            log_message('info',ProdukServices::class. ' success update detail produk ');

        }catch (\ReflectionException|DatabaseException $e) {
            log_message('error',ProdukServices::class.' error query pada update detail tanggal produk');
            log_message('error',$e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getAllInformationProdukDetail(): array
    {

        return $this->produkModel
                    ->join('penyalur','penyalur.id_penyalur = produk.id_penyalur')
                    ->join('detail_produk','produk.id_produk = detail_produk.id_produk','left')
                    ->asArray()->findAll(10);

    }

    /**
     * @param ProductEntities $productEntities
     * @param int|null $unitDalamBox dari request param
     * @return ProductEntities
     * @throws \ReflectionException
     */
    public function editDataProduct(ProductEntities $productEntities, ?int $unitDalamBox){
        $detailProductEntities   = new DetailProductEntities();
        $detailServices = new DetailProdukServices($this->DatabaseConnection);

        try{
            $this->produkModel->where('id_produk',$productEntities->getIdProduk())
                ->set('nama_produk',$productEntities->getNamaProduk())
                ->set('jumlah_produk',$productEntities->getJumlahProduk())
                ->set('harga_beli',$productEntities->getHargaBeli())
                ->set('jumlah_minimum_beli',$productEntities->getJumlahMinimumBeli())
                ->set('unit_pembelian',$productEntities->getUnitPembelian())
                ->set('id_penyalur',$productEntities->getIdPenyalur())
                ->update();

            $detailProductEntities->setIdProduk($productEntities->getIdProduk());
            $detailProductEntities->setJumlahUnitDalamBox($unitDalamBox);
            $detailServices->updateDetailProduk($detailProductEntities);

            log_message('info',ProdukServices::class.' success update data '.$productEntities);

            return $productEntities;

        } catch (\ReflectionException|DatabaseException $exception) {
            log_message('error',ProdukServices::class.' error query pada edit data produk '.$productEntities);
            log_message('error',$exception->getMessage());
            throw $exception;
        }catch (DatabaseFailedUpdate $exception){
            log_message('error',ProdukServices::class.' error query pada edit data produk '.$productEntities);
            log_message('error',$exception->getMessage());
            throw $exception;
        }
    }

    /**
     * @param string $idProduct
     * @return void
     * @throws DatabaseFailedDelete
     */
    public function deleteProduct(string $idProduct){
        $gudangServices = new GudangServices($this->DatabaseConnection);
        $detailServices = new DetailProdukServices($this->DatabaseConnection);

        try {
            $this->produkModel->delete($idProduct);
            $gudangServices->deleteGudangData($idProduct);
            $detailServices->deleteDetailProductData($idProduct);

            log_message('info',ProdukServices::class. ' success delete data produk id produk '.$idProduct);

        }catch (DatabaseException $exception){
            log_message('error',ProdukServices::class.' gagal delete produk id produk '.$idProduct);
            log_message('error',$exception->getMessage());
            throw new DatabaseFailedDelete("gagal menghapus data");
        }
    }

    /**
     * @param string $idProduct
     * @param int $jumlahBarangOrder
     * @return void
     * @throws DatabaseFailedUpdate
     */
    public function updateStokProduct(string $idProduct, int $jumlahBarangOrder){

        try {
            $jumlahProdukSebelumnya     = $this->produkModel->asArray()->find($idProduct);

            $this->produkModel->where('id_produk',$idProduct)
                ->set(
                'jumlah_produk',
                $jumlahProdukSebelumnya['jumlah_produk'] + $jumlahBarangOrder)
                ->update();

            log_message('info',ProdukServices::class.' success update stok id produk '.$idProduct);

        } catch (\ReflectionException|DatabaseException $e) {
            log_message('error',ProdukServices::class.' gagal update stok produk id produk '.$idProduct);
            log_message('error',$e->getMessage());
            throw new DatabaseFailedUpdate("ada kesalahan saat update data produk");
        }
    }
}