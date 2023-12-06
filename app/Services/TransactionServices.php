<?php

namespace App\Services;

use App\Entities\Enum\StatusTransaksi;
use App\Entities\TransaksiEntites;
use App\Exception\DatabaseFailedInsert;
use App\Libraries\RandomStringGenerator;
use App\Models\Orders;
use App\Models\Transaksi;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use phpseclib3\File\ASN1\Maps\UniqueIdentifier;

class TransactionServices
{
    private Transaksi $transaksiModel;
    private ConnectionInterface $DatabaseConnection;

    public function __construct(ConnectionInterface $databaseConnection)
    {
        $this->DatabaseConnection = $databaseConnection;
        $this->transaksiModel     = new Transaksi($this->DatabaseConnection);
    }

    /**
     * no-invoice akan di handle method ini
     * @param TransaksiEntites $transaksiEntites
     * @throws DatabaseFailedInsert
     * @return void
     */
    public function insertDataTransaksi(TransaksiEntites $transaksiEntites){
        $orders = new Orders($this->DatabaseConnection);

        try{
            // digunakan untuk parameter generated invoice
            $dataOrder = $orders->where('id_order',$transaksiEntites->getIdOrder())
                ->join('produk','orders.id_produk = produk.id_produk')
                ->join('penyalur','orders.id_penyalur = penyalur.id_penyalur')
                ->find();

            // pembuatan dana invoice fake
            $noInvoice = $transaksiEntites->generateInvoiceId($dataOrder);

            // pembuatan object model dan inserting activity
            $transaksiEntites->setNoInvoice($noInvoice);
            $transaksiEntites->creatingObjectForModel();
            $this->transaksiModel->insert($transaksiEntites);

            log_message('info',TransactionServices::class.' success insert data transaksi '.$transaksiEntites);

        }catch (\ReflectionException|DatabaseException $exception){
            log_message('error',TransactionServices::class.' failed inserting data id order '.$transaksiEntites->getIdOrder());
            log_message('error',$exception->getMessage());
            throw new DatabaseFailedInsert("gagal insert data");
        }
    }

    /**
     * @param TransaksiEntites $transaksiEntites
     * @return TransaksiEntites
     */
    public function transactionPaymentProcess(TransaksiEntites $transaksiEntites){
        try{
            $transaksiEntites->setNoResi($this->generateNoResi());
            $transaksiEntites->setStatusTransaksi(StatusTransaksi::LUNAS);

            $this->transaksiModel->where('id_transaksi',$transaksiEntites->getIdTransaksi())
                                ->set('nominal_transaksi',$transaksiEntites->getNominalTransaksi())
                                ->set('status_transaksi',$transaksiEntites->getStatusTransaksi())
                                ->set('no_resi',$transaksiEntites->getNoResi())
                                ->update();

            log_message('info',TransactionServices::class.' success payment transaction '.$transaksiEntites);

        } catch (\ReflectionException|DatabaseException $e) {
            log_message('error',TransactionServices::class.' failed update data id transaksi '.$transaksiEntites->getIdTransaksi());
            log_message('error',$e->getMessage());
        }

        return $transaksiEntites;
    }

    private function generateNoResi(): string
    {
        return 'no-resi'.RandomStringGenerator::random_string(15);
    }

}