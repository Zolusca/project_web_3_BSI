<?php

namespace App\Controllers\Person\FinancialManager;

use App\Controllers\Person\Persons;
use App\Entities\Enum\StatusOrder;
use App\Entities\OrdersEntities;
use App\Entities\TransaksiEntites;
use App\Exception\DatabaseFailedUpdate;
use App\Models\Orders;
use App\Services\OrderServices;
use App\Services\TransactionServices;
use Config\Services;

class FinancialManagerActivity extends Persons
{
    private OrdersEntities $ordersEntities ;
    private TransaksiEntites $transaksiEntites;
    private OrderServices $orderServices ;
    private TransactionServices $transactionServices;
    public function __construct()
    {
        parent::__construct();
        $this->ordersEntities       = new OrdersEntities();
        $this->transaksiEntites     = new TransaksiEntites();
        $this->transactionServices  = new TransactionServices(Services::getDatabaseConnection());
        $this->orderServices        = new OrderServices(Services::getDatabaseConnection());
    }

    public function rejectedOrder(){
        return $this->statusOrderUpdate();
    }

    public function acceptedOrder(){
        return $this->statusOrderUpdate();
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function statusOrderUpdate(): \CodeIgniter\HTTP\RedirectResponse
    {
        $idOrder = $this->request->getVar('id_order');
        $statusOrder = $this->request->getVar('status_order');

        try {
            $this->ordersEntities->setIdOrder($idOrder);
            $this->ordersEntities->setStatusOrder(StatusOrder::from($statusOrder));

            $this->orderServices->updateStatusOrder($this->ordersEntities);

            return redirect()->to(base_url() . 'pengelolakeuangan/dashboard/listorder')
                ->with('message', 'status order berhasil di update');

        } catch (DatabaseFailedUpdate $exception) {
            return redirect()->to(base_url() . 'pengelolakeuangan/dashboard/listorder')
                ->with('message', $exception->getMessage());
        }
    }

    public function transactionProcess(){
        $idTransaksi = $this->request->getVar('id_transaksi');
        $nominalTransaksi = $this->request->getVar('nominal_transaksi');

        $this->transaksiEntites->setIdTransaksi(true,$idTransaksi);
        $this->transaksiEntites->setNominalTransaksi($nominalTransaksi);

        $this->transactionServices->transactionPaymentProcess($this->transaksiEntites);

        return redirect()->to(base_url().'pengelolakeuangan/dashboard/listorder');
    }
}