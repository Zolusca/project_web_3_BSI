<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseDataDummy extends Seeder
{
    public function run()
    {
        $userPengelolaProduk=[
            "id_karyawan"=>"id001",
            "nama"=>"jaka",
            "email"=>"jaka127@gmail.com",
            "nomor_hp"=>"08933127321",
            "role_person"=>"pengelola_produk"
        ];

        $userPengelolaKeuangan=[
            "id_karyawan"=>"id002",
            "nama"=>"dewi",
            "email"=>"dewi127@gmail.com",
            "nomor_hp"=>"08933127322",
            "role_person"=>"pengelola_keuangan"
        ];

        $userPengelolaGudang=[
            "id_karyawan"=>"id003",
            "nama"=>"atma",
            "email"=>"atma127@gmail.com",
            "nomor_hp"=>"08933127324",
            "role_person"=>"pengelola_gudang"
        ];

        $dataPenyalur1=[
            "id_penyalur"=>"idpenyalur01",
            "nama"=>"PT.tobacco persada utama",
            "email"=>"tobaccopersadautama@gmail.com",
            "nomor"=>"0889921",
        ];

        $dataPenyalur2=[
            "id_penyalur"=>"idpenyalur02",
            "nama"=>"PT.inti makmur2",
            "email"=>"intimakmur2@gmail.com",
            "nomor"=>"0887788",
        ];

        $dataPenyalur3=[
            "id_penyalur"=>"idpenyalur03",
            "nama"=>"CV indah tiada dua",
            "email"=>"indahtd@gmail.com",
            "nomor"=>"0887768",
        ];

        $dataProduk1=[
           "id_produk"=>"idproduk001",
           "nama_produk"=>"sabun cuci oney",
           "id_penyalur"=>"idpenyalur01",
            "jumlah_produk"=>20,
            "harga_beli"=>56_000,
            "jumlah_minimum_beli"=>10,
            "unit_pembelian"=>"box"
        ];

        $dataProduk2=[
            "id_produk"=>"idproduk002",
            "nama_produk"=>"beras oke 5kg",
            "id_penyalur"=>"idpenyalur02",
            "jumlah_produk"=>3,
            "harga_beli"=>120_000,
            "jumlah_minimum_beli"=>50,
            "unit_pembelian"=>"pcs"
        ];

        $dataProduk3=[
            "id_produk"=>"idproduk003",
            "nama_produk"=>"detergen putih",
            "id_penyalur"=>"idpenyalur03",
            "jumlah_produk"=> 15,
            "harga_beli"=>2_000,
            "jumlah_minimum_beli"=>10,
            "unit_pembelian"=>"box"
        ];

        $dataGudang1 = [
            "id_produk"=>"idproduk001",
            "jumlah_stok_digudang"=>10,
            "tanggal_terakhir_masuk"=>"2023-10-11",
            "jumlah_stok_dikeluarkan"=>7,
            "tanggal_terakhir_keluar"=>"2023-10-04"
        ];

        $dataGudang2 = [
            "id_produk"=>"idproduk002",
            "jumlah_stok_digudang"=>21,
            "tanggal_terakhir_masuk"=>"2023-09-21",
            "jumlah_stok_dikeluarkan"=>5,
            "tanggal_terakhir_keluar"=>"2023-10-04"
        ];

        $dataGudang3 = [
            "id_produk"=>"idproduk003",
            "jumlah_stok_digudang"=>50,
            "tanggal_terakhir_masuk"=>"2023-11-11",
            "jumlah_stok_dikeluarkan"=>21,
            "tanggal_terakhir_keluar"=>"2023-11-04"
        ];

        $dataTempOrder1 = [
            "id_temp_order"=>"idtemp001",
            "id_produk"=>"idproduk001",
            "tanggal_request_order_dibuat"=>"2023-11-15",
        ];

        $dataTempOrder2 = [
            "id_temp_order"=>"idtemp002",
            "id_produk"=>"idproduk002",
            "tanggal_request_order_dibuat"=>"2023-11-15",
        ];

        $dataDetailProduk1=[
          'id_produk'=>'idproduk001',
          'jumlah_unit_dalam_box'=>20,
          'tanggal_order_terakhir'=>'2023-10-27',
          'id_order'=>'order001'
        ];

        $dataDetailProduk2=[
            'id_produk'=>'idproduk002',
            'jumlah_unit_dalam_box'=>0,
            'tanggal_order_terakhir'=>'2023-10-25',
            'id_order'=>'order002'
        ];

        $dataDetailProduk3=[
            'id_produk'=>'idproduk003',
            'jumlah_unit_dalam_box'=>15,
            'tanggal_order_terakhir'=>'2023-10-11',
            'id_order'=>'order002'
        ];

        $dataOrder1=[
            'id_order'=>'order001',
            'id_produk'=>'idproduk001',
            'id_penyalur'=>'idpenyalur01',
            'tanggal_order'=>'2023-10-27',
            'jumlah_order_produk'=>15,
            'ppn'=>11,
            'total_harga'=>932_400,
            'status_order'=>'disetujui'
        ];

        $dataOrder2=[
            'id_order'=>'order002',
            'id_produk'=>'idproduk002',
            'id_penyalur'=>'idpenyalur02',
            'tanggal_order'=>'2023-10-25',
            'jumlah_order_produk'=>20,
            'ppn'=>0,
            'total_harga'=>2_400_000,
            'status_order'=>'barang_sampai'
        ];

        $dataOrder3=[
            'id_order'=>'order003',
            'id_produk'=>'idproduk003',
            'id_penyalur'=>'idpenyalur03',
            'tanggal_order'=>'2023-10-11',
            'jumlah_order_produk'=>15,
            'ppn'=>11,
            'total_harga'=>532_000,
            'status_order'=>'disetujui'
        ];

        if($this->db->table('person')->emptyTable())
        {
            $this->db->table('person')->insert($userPengelolaKeuangan);
            $this->db->table('person')->insert($userPengelolaProduk);
            $this->db->table('person')->insert($userPengelolaGudang);
        }
        if($this->db->table('penyalur')->emptyTable())
        {
            $this->db->table('penyalur')->insert($dataPenyalur1);
            $this->db->table('penyalur')->insert($dataPenyalur2);
            $this->db->table('penyalur')->insert($dataPenyalur3);
        }

        if($this->db->table('produk')->emptyTable())
        {
            $this->db->table('produk')->insert($dataProduk1);
            $this->db->table('produk')->insert($dataProduk2);
            $this->db->table('produk')->insert($dataProduk3);
        }

        if($this->db->table('gudang')->emptyTable())
        {
            $this->db->table('gudang')->insert($dataGudang1);
            $this->db->table('gudang')->insert($dataGudang2);
            $this->db->table('gudang')->insert($dataGudang3);
        }

        if($this->db->table('temporary_order')->emptyTable()){
            $this->db->table('temporary_order')->insert($dataTempOrder1);
            $this->db->table('temporary_order')->insert($dataTempOrder2);
        }

        if($this->db->table('detail_produk')->emptyTable())
        {
            $this->db->table('detail_produk')->insert($dataDetailProduk1);
            $this->db->table('detail_produk')->insert($dataDetailProduk2);
            $this->db->table('detail_produk')->insert($dataDetailProduk3);
        }

        if($this->db->table('orders')->emptyTable())
        {
            $this->db->table('orders')->insert($dataOrder1);
            $this->db->table('orders')->insert($dataOrder2);
            $this->db->table('orders')->insert($dataOrder3);
        }

    }
}
