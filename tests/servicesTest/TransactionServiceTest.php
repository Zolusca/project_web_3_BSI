<?php

namespace servicesTest;

use App\Entities\Enum\StatusTransaksi;
use App\Entities\OrdersEntities;
use App\Entities\TransaksiEntites;
use App\Models\Orders;
use App\Models\Transaksi;
use App\Services\TransactionServices;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class TransactionServiceTest extends CIUnitTestCase
{
    /**
     * @return void
     * @test
     */
    public function insertDataTransaction(){
        $transactionEntites     = new TransaksiEntites();
        $transactionServices    = new TransactionServices(Services::getDatabaseConnection());
        $orderModel             = new Orders(Services::getDatabaseConnection());

        $dataTarget  = $orderModel->asArray()->findAll(1);

        // persiapan data
        $transactionEntites->setIdOrder($dataTarget[0]['id_order']);
        $transactionEntites->setNominalTransaksi(floatval($dataTarget[0]['total_harga']));
        $transactionEntites->setStatusTransaksi(StatusTransaksi::BELUM_LUNAS);
        $transactionEntites->setIdTransaksi(false,null);

        $transactionServices->insertDataTransaksi($transactionEntites);
        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function transactionProcess(){
        $transactionEntites     = new TransaksiEntites();
        $transactionServices    = new TransactionServices(Services::getDatabaseConnection());
        $transactionModel       = new Transaksi(Services::getDatabaseConnection());

        $dataTransaksi = $transactionModel->asArray()->findAll(1);

        $transactionEntites->setIdTransaksi(true,$dataTransaksi[0]['id_transaksi']);
        $transactionEntites->setIdOrder($dataTransaksi[0]['id_order']);
        $transactionEntites->setStatusTransaksi(StatusTransaksi::tryFrom($dataTransaksi[0]['status_transaksi']));
        $transactionEntites->setNoInvoice($dataTransaksi[0]['no_invoice']);
        $transactionEntites->setNominalTransaksi($dataTransaksi[0]['nominal_transaksi']+6000);

        $dataReturn = $transactionServices->transactionPaymentProcess($transactionEntites);
        echo $dataReturn;
        $this->expectNotToPerformAssertions();
    }
}