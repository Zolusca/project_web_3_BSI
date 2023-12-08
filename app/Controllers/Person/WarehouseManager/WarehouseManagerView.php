<?php

namespace App\Controllers\Person\WarehouseManager;

use App\Controllers\BaseController;
use App\Models\Gudang;
use App\Models\Orders;
use App\Models\Produk;
use App\Models\TemporaryOrder;
use Config\Services;

class WarehouseManagerView extends BaseController
{
    public function mainDashboardView(){
        $gudangModel    = new Gudang(Services::getDatabaseConnection());
        $orderModel     = new Orders(Services::getDatabaseConnection());
        $tempModel      = new TemporaryOrder(Services::getDatabaseConnection());

        return view('DashboardManagerWarehouse/General/beranda_dashboard',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'jumlah_produk'=>$gudangModel->countAllResults(),
                'jumlah_order'=>$orderModel->where('status_order','disetujui')
                                            ->join('transaksi','transaksi.id_order = orders.id_order')
                                            ->where('status_transaksi','lunas')
                                            ->countAllResults(),
                'jumlah_temp'=>$tempModel->countAllResults()
            ]]
        );
    }
    public function listProdukGudangView(){
        $produkModel = new Produk(Services::getDatabaseConnection());

        $dataListProdukGudang = $produkModel->join(
                                                 'gudang',
                                                 ' gudang.id_produk = produk.id_produk',
                                                'left')
                                                ->asArray()
                                                ->findAll(10);

        return view('DashboardManagerWarehouse/List/list_produk',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'list_produk_gudang'=>$dataListProdukGudang
            ]]
        );
    }

    public function takeOutProductView(){
        $gudangModel = new Gudang(Services::getDatabaseConnection());
        $idProduk    = $this->request->getVar('id_produk');

        $dataProduk = $gudangModel->join('produk','produk.id_produk = gudang.id_produk')
                                  ->asArray()
                                  ->find($idProduk);

        return view('DashboardManagerWarehouse/Form/mengeluarkan_produk',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'data_produk'=>$dataProduk
            ]]
        );
    }

    public function listOrderTemporaryView(){
        $temporaryModel = new TemporaryOrder(Services::getDatabaseConnection());

        $listOrderTemp  = $temporaryModel
                                ->orderBy('tanggal_request_order_dibuat','ASC')
                                ->join(
                                    'produk',
                                    'produk.id_produk = temporary_order.id_produk')
                                ->asArray()
                                ->findAll(10);

        return view('DashboardManagerWarehouse/List/list_order_temporary',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'list_order_temp'=>$listOrderTemp
            ]]
        );
    }

    public function listOrderRequestView(){
        $orderModel = new Orders(Services::getDatabaseConnection());
        $listOrder  = $orderModel
                                 ->join('transaksi','transaksi.id_order = orders.id_order')
                                 ->join('produk','produk.id_produk = orders.id_produk')
                                 ->where('transaksi.status_transaksi','lunas')
                                 ->asArray()
                                 ->findAll(10);

        return view('DashboardManagerWarehouse/List/list_order_request',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'list_order'=>$listOrder
            ]]
        );
    }
}