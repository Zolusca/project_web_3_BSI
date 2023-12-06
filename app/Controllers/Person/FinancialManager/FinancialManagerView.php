<?php

namespace App\Controllers\Person\FinancialManager;

use App\Controllers\BaseController;
use App\Entities\Enum\StatusOrder;
use App\Entities\Enum\StatusTransaksi;
use App\Entities\OrdersEntities;
use App\Entities\TransaksiEntites;
use App\Exception\DatabaseFailedInsert;
use App\Exception\DatabaseFailedUpdate;
use App\Libraries\PdfGenerator;
use App\Models\Orders;
use App\Models\Transaksi;
use App\Services\OrderServices;
use App\Services\TransactionServices;
use Config\Services;

class FinancialManagerView extends BaseController
{
    public function mainDashboardView(){
        return view('DashboardManagerFinancial/General/beranda_dashboard',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
            ]]
        );
    }

    public function invoiceView(string $noInvoice){
        return redirect()->to(base_url().'fake_invoice/'.$noInvoice.'.pdf');
    }

    public function listOrderView(){
        $orderModel     = new Orders(Services::getDatabaseConnection());
        $transaksiModel = new Transaksi(Services::getDatabaseConnection());

        // pengecekan apakah ada data order di table orders
        if($orderModel->countAllResults()<1){
            return view('DashboardManagerFinancial/List/list_order',
                ['data'=>[
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'message'=>"belum ada order"
                ]]
            );
        }

        $listOrder  = $orderModel->join('produk','orders.id_produk = produk.id_produk')
                                ->join('penyalur','orders.id_penyalur = penyalur.id_penyalur')
                                ->asArray()->findAll(10);

        // foreach disini diperuntukkan untuk inject data field status_transaksi, dimana value
        // status_transaksi digunakan untuk handle button (transaksi pada list_order dan tolak)
        foreach ($listOrder as $index=>$value){

            $transaksi = $transaksiModel->where('id_order', $value['id_order'])->asArray()->find();

            // apabila ada data transaksi
            if(!empty($transaksi)){
                $listOrder[$index]['status_transaksi']=$transaksi[0]['status_transaksi'];
            }
            else{
                $listOrder[$index]['status_transaksi']='';
            }
        }

        return view('DashboardManagerFinancial/List/list_order',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'list_order'=>$listOrder
            ]]
        );
    }

    public function listTransaksiView(){
        $transaksiModel = new Transaksi(Services::getDatabaseConnection());

        // jika belum memiliki data list transaksi
        if($transaksiModel->countAllResults()<1){
            return view('DashboardManagerFinancial/List/list_transaksi',
                ['data'=>[
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'message'=>"belum ada list transaksi"
                ]]
            );
        }

        $dataTransaksi = $transaksiModel->orderBy('status_transaksi','asc')
                                        ->asArray()
                                        ->findAll(10);

        return view('DashboardManagerFinancial/List/list_transaksi',
            ['data'=>[
                'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                'list_transaksi'=>$dataTransaksi
            ]]
        );
    }

    public function formTransaksiView(){
        $transaksiModel     = new Transaksi(Services::getDatabaseConnection());
        $transaksiEntities  = new TransaksiEntites();
        $transaksiServices  = new TransactionServices(Services::getDatabaseConnection());

        $idOrder         = $this->request->getVar('id_order');
        $statusTransaksi = $this->request->getVar('status_transaksi');

        // cek data transaksi apabila transaksi data sudah ada
        if($transaksiModel->where('id_order',$idOrder)->countAllResults()!=0){
            $dataTransaksi =
                $transaksiModel->where('transaksi.id_order',$idOrder)
                               ->join('orders','orders.id_order = transaksi.id_order')
                               ->join('produk','produk.id_produk = orders.id_produk')
                                ->asArray()->find();

            return view('DashboardManagerFinancial/Form/transaction',
                ['data'=>[
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'data_transaksi'=>$dataTransaksi[0]
                ]]
            );
        }

        try{
            // proses inserting transaksi data
            $transaksiEntities->setIdTransaksi(false,null);
            $transaksiEntities->setIdOrder($idOrder);
            $transaksiEntities->setStatusTransaksi(StatusTransaksi::tryFrom($statusTransaksi));
                $transaksiServices->insertDataTransaksi($transaksiEntities);//------ proses inserting

            $dataTransaksi = $transaksiModel->join('orders','orders.id_order = transaksi.id_order')
                                            ->join('produk','produk.id_produk = orders.id_produk')
                                            ->asArray()
                                            ->find($transaksiEntities->getIdTransaksi());

            return view('DashboardManagerFinancial/Form/transaction',
                ['data'=>[
                    'user'=>['nama_user'=>session()->get('nama'),'role'=>session()->get('role')],
                    'data_transaksi'=>$dataTransaksi
                ]]
            );

        }catch (DatabaseFailedUpdate|DatabaseFailedInsert $exception){
            return redirect()->to(base_url().'pengelolakeuangan/dashboard/listorder')
                            ->with('message',$exception->getMessage());
        }

    }
}