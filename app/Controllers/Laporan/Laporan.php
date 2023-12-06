<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Libraries\PdfGenerator;
use App\Models\Gudang;
use App\Models\Orders;
use App\Models\PenerimaanBarang;
use App\Models\Produk;
use App\Models\Transaksi;
use CodeIgniter\Database\ConnectionInterface;
use Config\Services;

class Laporan extends BaseController
{
    protected PdfGenerator $pdfGenerator;
    protected ConnectionInterface $databaseConnection;
    protected PenerimaanBarang $penerimaanBarangModel;
    protected Gudang $gudangModel;
    protected Produk $produkModel;
    protected Transaksi $transaksiModel;
    protected Orders $ordersModel;

    public function __construct()
    {
        $this->pdfGenerator         = new PdfGenerator();
        $this->databaseConnection   = Services::getDatabaseConnection();
        $this->gudangModel          = new Gudang($this->databaseConnection);
        $this->produkModel          = new Produk($this->databaseConnection);
        $this->transaksiModel       = new Transaksi($this->databaseConnection);
        $this->ordersModel          = new Orders($this->databaseConnection);
        $this->penerimaanBarangModel= new PenerimaanBarang($this->databaseConnection);
    }

}