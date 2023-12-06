<?php

namespace App\Controllers\Laporan;

class FinancialManagerLaporan extends Laporan
{
    public function laporanTransaksi(){
        $dataParser = $this->transaksiModel->asArray()->findAll();

        $this->pdfGenerator
                ->createPdfAndSentToClient
                (
                    ['data'=>['data'=>$dataParser]],
                    'datatransaksi',
                    'laporan/laporan_transaksi'
                );
    }
}