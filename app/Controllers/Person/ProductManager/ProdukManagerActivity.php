<?php
namespace App\Controllers\Person\ProductManager;
use App\Controllers\BaseController;
use App\Controllers\Person\Persons;
use App\Entities\OrdersEntities;
use App\Entities\PenyalurEntities;
use App\Entities\ProductEntities;
use App\Entities\ProdukEntity;
use App\Exception\DatabaseFailedDelete;
use App\Exception\DatabaseFailedInsert;
use App\Exception\ValidationRequestError;
use App\Models\Produk;
use App\Services\OrderServices;
use App\Services\PenyalurServices;
use App\Services\ProdukServices;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Validation\Validation;
use Config\Services;
use ReflectionException;

class ProdukManagerActivity extends Persons
{
    private ProdukServices $produkServices;
    private ProductEntities $produkEntities;
    private PenyalurEntities $penyalurEntities;
    private OrdersEntities $ordersEntities;
    private PenyalurServices $penyalurServices;
    private OrderServices $orderServices;

    public function __construct()
    {
        parent::__construct();
        $this->produkEntities       = new ProductEntities();
        $this->penyalurEntities     = new PenyalurEntities();
        $this->ordersEntities       = new OrdersEntities();
        $this->produkServices       = new ProdukServices($this->DatabaseConnection);
        $this->penyalurServices     = new PenyalurServices($this->DatabaseConnection);
        $this->orderServices        = new OrderServices($this->DatabaseConnection);
    }

    public function insertingProduct(){

        // mendapatkan data request
        $namaProduk = $this->request->getVar('nama_produk');
        $idPenyalur = $this->request->getVar('id_penyalur');
        $hargaBeli  = floatval($this->request->getVar('harga_beli'));
        $satuanPembelian  = $this->request->getVar('satuan_pembelian');//pcs, kg, ml dll
        $minimumBeli      = intval($this->request->getVar('minimum_beli'));

        log_message('info',$namaProduk.'==='.$idPenyalur);

        $dataValidation = [
            'nama_produk'=>$namaProduk,
            'jumlah_minimum_beli'=>$minimumBeli
        ];

        try {
            // Validasi data
            $this->validationsRequest->validateInsertProduk($dataValidation);
            // Set Data ke entities
            $this->produkEntities->setNamaProduk($namaProduk);
            $this->produkEntities->setIdPenyalur($idPenyalur);
            $this->produkEntities->setHargaBeli($hargaBeli);
            $this->produkEntities->setUnitPembelian($satuanPembelian);

            $this->produkServices->insertProduct($this->produkEntities);


            return view('DashboardManagerProduk/Form/add_produk',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'penyalur'=>ProductManagerView::listNamaIdPenyalur($this->penyalurServices->getAllPenyalur()),
                        'message'=>"sukses buat data ".$this->produkEntities->getNamaProduk()
                    ]
                ]);

        } catch (ValidationRequestError $e) {
            log_message('error',ProdukManagerActivity::class.' validation exception input');
            return view('DashboardManagerProduk/Form/add_produk',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'penyalur'=>ProductManagerView::listNamaIdPenyalur($this->penyalurServices->getAllPenyalur()),
                        'error_message'=>$e->getMessage()
                    ]
                ]);
        } catch (DatabaseFailedInsert $e) {
            log_message('error',ProdukManagerActivity::class.' Database Failed Insert ');
            log_message('error',ProdukManagerActivity::class.$e);
            return view('DashboardManagerProduk/Form/add_produk',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'penyalur'=>ProductManagerView::listNamaIdPenyalur($this->penyalurServices->getAllPenyalur()),
                        'message'=>$e->getMessage()
                    ]
                ]);
        } finally
        {
            Services::closeDatabaseConnection($this->DatabaseConnection);
        }

    }

    /**
     * @throws ReflectionException
     */
    public function insertingPenyalur(){
        $namaPenyalur = $this->request->getVar('nama');
        $nomor        = $this->request->getVar('nomor');
        $email        = $this->request->getVar('email');

        $this->penyalurEntities->setEmailPenyalur($email);
        $this->penyalurEntities->setNamaPenyalur($namaPenyalur);
        $this->penyalurEntities->setNomorHP($nomor);

        try {
            $this->penyalurServices->insertPenyalur($this->penyalurEntities);

            return view('DashboardManagerProduk/Form/add_penyalur',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'message'=>'sukses tambah data penyalur '.$namaPenyalur
                    ]
                ]);

        } catch (DatabaseFailedInsert $e) {
            log_message('error',ProdukManagerActivity::class.' Database Failed Insert ');
            log_message('error',ProdukManagerActivity::class.$e);
            return view('DashboardManagerProduk/Form/add_penyalur',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'message'=>$e->getMessage()
                    ]
                ]);
        } finally {
            Services::closeDatabaseConnection($this->DatabaseConnection);
        }
    }

    public function editProductData(){
        $produkModel  = new Produk(Services::getDatabaseConnection());

        $idProduk       = $this->request->getVar('id_produk');
        $namaProduk     = $this->request->getVar('nama_produk');
        $idPenyalur     = $this->request->getVar('id_penyalur');
        $jumlahProduk   = intval($this->request->getVar('jumlah_produk'));
        $hargaBeli      = floatval($this->request->getVar('harga_beli'));
        $unitPembelian  = $this->request->getVar('unit_pembelian');
        $minimum_pembelian      = intval($this->request->getVar('minimum_pembelian'));
        $unitDalamBox           = intval($this->request->getVar('unit_dalam_box'));

        $this->produkEntities->setIdProduk(true,$idProduk);
        $this->produkEntities->setNamaProduk($namaProduk);
        $this->produkEntities->setIdPenyalur($idPenyalur);
        $this->produkEntities->setJumlahProduk($jumlahProduk);
        $this->produkEntities->setHargaBeli($hargaBeli);
        $this->produkEntities->setUnitPembelian($unitPembelian);
        $this->produkEntities->setJumlahMinimumBeli($minimum_pembelian);

        $dataProdukView = $produkModel->join('penyalur','produk.id_penyalur = penyalur.id_penyalur')
                                        ->asArray()->find($idProduk);

        try {
            $this->produkServices->editDataProduct($this->produkEntities,$unitDalamBox);

            return view('DashboardManagerProduk/Form/edit_produk',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'message'=>'sukses update data',
                        'data_produk'=>$dataProdukView
                    ]
                ]);

        } catch (ReflectionException $e) {
            return view('DashboardManagerProduk/Form/edit_produk',
                [
                    'data'=>[
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'message'=>'ada kesalahan updating data',
                        'data_produk'=>$dataProdukView
                    ]
                ]);
        } finally {
            Services::closeDatabaseConnection($this->DatabaseConnection);
        }
    }

    public function deleteProductData(){
        $idProduk =$this->request->getVar('id_produk');

        try {
            $this->produkServices->deleteProduct($idProduk);

            return redirect()->to(base_url().'pengelolaproduk/dashboard/listproduk')->with('message','sukses hapus data');

        }catch (DatabaseFailedDelete $exception){
            return redirect()->to(base_url().'pengelolaproduk/dashboard/listproduk')->with('message',$exception->getMessage());
        }
    }

    public function requestOrder(){
        $idProduk    = $this->request->getVar('id_produk');
        $idOrderTemp = $this->request->getVar('id_order_temp');
        $idPenyalur  = $this->request->getVar('id_penyalur');
        $jumlahOrder = intval($this->request->getVar('jumlah_order'));
        $ppn         = floatval($this->request->getVar('ppn'));
        $hargaProduk = floatval($this->request->getVar('harga_produk'));

        try{
            $this->ordersEntities->setIdOrder($idOrderTemp);
            $this->ordersEntities->setIdProduk($idProduk);
            $this->ordersEntities->setPpn($ppn);
            $this->ordersEntities->setIdPenyalur($idPenyalur);
            $this->ordersEntities->setJumlahOrderProduk($jumlahOrder);

            $this->orderServices->insertOrderData($this->ordersEntities,$hargaProduk);

            return redirect()->to(base_url().'pengelolaproduk/dashboard/listorder')->with('message','sukses melakukan order');

        }catch (DatabaseFailedInsert $exception){
            return redirect()->to(base_url().'pengelolaproduk/dashboard/listorder')->with('message',$exception->getMessage());
        } finally {
            Services::closeDatabaseConnection($this->DatabaseConnection);
        }
    }

    public function cancelOrderRequest(){
        $orderServices = new OrderServices(Services::getDatabaseConnection());
        $idOrder = $this->request->getVar('id_order');

        $orderServices->deleteOrder($idOrder);

        return redirect()->to(base_url().'pengelolaproduk/dashboard/listorder')
            ->with('message','berhasil batalkan');
    }
}