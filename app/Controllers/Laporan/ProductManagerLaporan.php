<?php

namespace App\Controllers\Laporan;

class ProductManagerLaporan extends Laporan
{
    public function laporanDataProduk(){

        $dataParser =  $this->produkModel
                            ->join(
                                'penyalur',
                                'produk.id_penyalur = penyalur.id_penyalur')
                            ->join(
                                'detail_produk',
                                'detail_produk.id_produk = produk.id_produk')
                            ->join(
                                'gudang',
                                'gudang.id_produk = produk.id_produk')
                            ->asArray()
                            ->findAll();

        $this->pdfGenerator
            ->createPdfAndSentToClient
            (
                ['data'=>['dataProduk'=>$dataParser]],
                'datalistproduk',
                'laporan/laporan_data_produk'
            );
    }
}