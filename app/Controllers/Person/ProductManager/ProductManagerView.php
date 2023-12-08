<?php

namespace App\Controllers\Person\ProductManager;

use App\Controllers\BaseController;
use App\Controllers\Person\Persons;
use App\Models\Orders;
use App\Models\Penyalur;
use App\Models\Person;
use App\Models\Produk;
use App\Models\TemporaryOrder;
use App\Services\ProdukServices;
use Config\Services;
use database\DatabaseConnectionTest;

class ProductManagerView extends BaseController
{
    /**
     * method ini digunakan untuk mengirimkan data id dan nama penyalur ke array
     * @return array
     */
    public static function listNamaIdPenyalur(array $dataPenyalur){
        $listData=[];
        foreach ($dataPenyalur as $index=>$value){
            $listData[$index]=['id'=>$value['id_penyalur'],'nama_penyalur'=>$value['nama']];
        }
        return $listData;
    }

    public function mainDashboardView(){
        $produkModel = new Produk(Services::getDatabaseConnection());
        $orderTempModel = new TemporaryOrder(Services::getDatabaseConnection());
        $orderModel     = new Orders(Services::getDatabaseConnection());

        return view('DashboardManagerProduk/General/beranda_dashboard',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'jumlah_produk'=>$produkModel->countAllResults(),
                'jumlah_new_request_temp'=>$orderTempModel->orderBy('tanggal_request_order_dibuat','asc')->countAllResults(),
                'jumlah_order_disetujui'=>$orderModel->where('status_order','disetujui')->countAllResults()
            ]]
        );
    }

    public function addProductView(){
        $modelPenyalur= new Penyalur(Services::getDatabaseConnection());
        $dataPenyalur = $modelPenyalur->asArray()->findAll();


        return view('DashboardManagerProduk/Form/add_produk',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'penyalur'=>$this->listNamaIdPenyalur($dataPenyalur)
            ]]);
    }

    public function listProductView(){
        // disini produkModel digunakan untuk query sederhana yang tidak ada di services
        $produkServices = new ProdukServices(Services::getDatabaseConnection());
        $produkModel    = new Produk(Services::getDatabaseConnection());

        // pengecekan apabila user belum memiliki list produk
        if($produkModel->countAllResults()<1){
            return view('DashboardManagerProduk/List/list_produk',
                ['data'=>
                    [
                        'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                        'message'=>'belum memiliki produk'
                    ]
                ]
            );
        }

        $produkServices->updateStatusDetailProduk();
        $listProduk = $produkServices->getAllInformationProdukDetail();

        return view('DashboardManagerProduk/List/list_produk',
            ['data'=>
                [
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'list_data'=>$listProduk
                ]
            ]
        );
    }

    public function addPenyalurView(){
        return view('DashboardManagerProduk/Form/add_penyalur',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')]
            ]]);
    }

    public function detailProductView($idProdukrequest){
        $produkModel = new Produk(Services::getDatabaseConnection());

        $dataProduk = $produkModel
                        ->join('penyalur', 'produk.id_penyalur = penyalur.id_penyalur')
                        ->join('gudang', 'gudang.id_produk = produk.id_produk', )
                        ->join('detail_produk', 'detail_produk.id_produk = produk.id_produk' )
                        ->asArray()->find($idProdukrequest);

        return view('DashboardManagerProduk/General/detail_produk',
            ['data'=>
                [
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'data_produk'=>$dataProduk
                ]
            ]
        );
    }

    public function editProductDataView(){
        $produkModel = new Produk(Services::getDatabaseConnection());
        $idProduk    = $this->request->getVar('id_produk');

        $dataProduk = $produkModel->join('penyalur','produk.id_penyalur = penyalur.id_penyalur')
                                    ->asArray()->find($idProduk);

        return view('DashboardManagerProduk/Form/edit_produk',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'data_produk'=>$dataProduk
            ]]);
    }

    public function listOrderTemporaryView(){
        $orderTempModel = new TemporaryOrder(Services::getDatabaseConnection());

        if($orderTempModel->countAllResults()<1){
            return view('DashboardManagerProduk/List/list_order_temporary',
                ['data'=>[
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'message'=>'tidak ada order list'
                ]]);
        }
        $listOrderTemp = $orderTempModel
            ->join('produk','produk.id_produk = temporary_order.id_produk')
            ->join('gudang','gudang.id_produk = temporary_order.id_produk')
            ->asArray()->findAll(10);

        return view('DashboardManagerProduk/List/list_order_temporary',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'data_order_temp'=>$listOrderTemp
            ]]);
    }

    public function formRequestOrderView(){
        $produkModel = new Produk(Services::getDatabaseConnection());
        $idOrderTemp = $this->request->getVar('id_order_temp');
        $idProduk    = $this->request->getVar('id_produk');

        $dataOrderTemp = $produkModel->join('penyalur','penyalur.id_penyalur = produk.id_penyalur')
                        ->join('detail_produk','detail_produk.id_produk = produk.id_produk')
                        ->asArray()->find($idProduk);

        return view('DashboardManagerProduk/Form/request_order',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'data_order_temp'=>$dataOrderTemp,
                'id_order_temp'=>$idOrderTemp
            ]]);
    }

    public function listOrderView(){
        $ordersModel = new Orders(Services::getDatabaseConnection());

        if($ordersModel->countAllResults()<1){
            return view('DashboardManagerProduk/List/list_order_request',
                ['data'=>[
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'message'=>'belum ada order request'
                ]]);
        }

        $dataOrder = $ordersModel->join('produk','orders.id_produk = produk.id_produk')
            ->join('penyalur','orders.id_penyalur = penyalur.id_penyalur')
            ->asArray()->findAll(10);

        return view('DashboardManagerProduk/List/list_order_request',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'data_order'=>$dataOrder
            ]]);
    }

}