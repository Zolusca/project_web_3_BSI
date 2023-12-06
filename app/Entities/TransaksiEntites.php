<?php

namespace App\Entities;

use App\Entities\Enum\StatusTransaksi;
use App\Libraries\PdfGenerator;
use App\Libraries\RandomStringGenerator;
use App\Models\Orders;
use CodeIgniter\Entity\Entity;
use Config\Services;

class TransaksiEntites extends Entity
{
    private ?string $idTransaksi=null;
    private ?string $idOrder=null;
    private ?float $nominalTransaksi=0;
    private ?string $noResi =null;
    private ?string $noInvoice=null;
    private StatusTransaksi $statusTransaksi=StatusTransaksi::BELUM_LUNAS;

    public function creatingObjectForModel(){
        $this->attributes["id_transaksi"]      = $this->idTransaksi;
        $this->attributes["id_order"]          = $this->idOrder;
        $this->attributes["nominal_transaksi"] = $this->nominalTransaksi;
        $this->attributes["status_transaksi"]  = $this->statusTransaksi->value;
        $this->attributes["no_invoice"]        = $this->noInvoice;
        $this->attributes["no_resi"]           = $this->noResi;

        return $this;
    }


    /**
     *
     *  this what's the need for param
     *  $dataOrder   = $this->ordersModel->where('id_order',$idOrder)
     *  ->join('produk','orders.id_produk = produk.id_produk')
     *  ->join('penyalur','orders.id_penyalur = penyalur.id_penyalur')
     *  ->find();
     *
     * @param $dataOrder
     * @return string no-invoice
     */
    public function generateInvoiceId($dataOrder): string
    {
        $pdfGenerator = new PdfGenerator();

        // dummy invoice
        $noInvoices = RandomStringGenerator::random_string(15)."-invoice-id";
        $dataParser =
        [
            'data'=>['noInvoice'=>$noInvoices,
            'dataTransaksi'=>$dataOrder[0]]
        ];

        $pdfGenerator->createPdfAndSaveLocal($dataParser,$noInvoices,'laporan/invoice_fake');

        return $noInvoices;
    }
    public function getIdTransaksi(): ?string
    {
        return $this->idTransaksi;
    }

    public function setIdTransaksi(?bool $haveIdTransaction,
                                   ?string $idTransaction): void
    {
        if($haveIdTransaction){
            $this->idTransaksi = $idTransaction;
        }else{
            $this->idTransaksi = RandomStringGenerator::random_string(9);
        }
    }

    public function getIdOrder(): ?string
    {
        return $this->idOrder;
    }

    public function setIdOrder(?string $idOrder): void
    {
        $this->idOrder = $idOrder;
    }

    public function getNominalTransaksi(): ?float
    {
        return $this->nominalTransaksi;
    }

    public function setNominalTransaksi(?float $nominalTransaksi): void
    {
        $this->nominalTransaksi = $nominalTransaksi;
    }

    public function getNoResi(): ?string
    {
        return $this->noResi;
    }

    public function setNoResi(?string $noResi): void
    {
        $this->noResi = $noResi;
    }

    public function getNoInvoice(): ?string
    {
        return $this->noInvoice;
    }

    public function setNoInvoice(?string $noInvoice): void
    {
        $this->noInvoice = $noInvoice;
    }

    public function getStatusTransaksi(): string
    {
        return $this->statusTransaksi->value;
    }

    public function setStatusTransaksi(StatusTransaksi $statusTransaksi): void
    {
        $this->statusTransaksi = $statusTransaksi;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID transaksi: {$this->id_transaksi}
        ID order : {$this->id_order}
        nominal transaksi: {$this->nominal_transaksi}
        status transaksi: {$this->status_transaksi}
        no invoice: {$this->no_invoice}
        EOT;
    }
}