<?php

namespace App\Controllers\Laporan;

class WarehouseManagerLaporan extends Laporan
{
    public function laporanWarehouse(){
        $dataParser = $this->gudangModel
                            ->join(
                                'detail_produk',
                                'detail_produk.id_produk = gudang.id_produk')
                            ->join(
                                'produk',
                                'produk.id_produk = gudang.id_produk')
                            ->asArray()
                            ->findAll();

        $this->pdfGenerator
            ->createPdfAndSentToClient(
                                ['data'=>['dataProduk'=>$dataParser]],
                                'dataprodukgudang',
                                'laporan/laporan_gudang_produk');
    }

    public function laporanPenerimaanProduk(){
        $dataParser = $this->penerimaanBarangModel
                            ->join(
                                'orders',
                                'orders.id_order = penerimaan_barang.id_order')
                            ->join(
                                'produk',
                                'produk.id_produk = orders.id_produk')
                            ->asArray()
                            ->findAll();

        $this->pdfGenerator
            ->createPdfAndSentToClient
            (
                    ['data'=>['data'=>$dataParser]],
                    'datapenerimaangudang',
                    'laporan/laporan_penerimaan_gudang'
            );

    }
}