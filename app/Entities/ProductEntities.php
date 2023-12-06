<?php

namespace App\Entities;

use App\Libraries\RandomStringGenerator;
use CodeIgniter\Entity\Entity;

class ProductEntities extends Entity
{
    private ?string $namaProduk=null;
    private ?string $idProduk=null;
    private ?string $unitPembelian=null;
    private ?string $idPenyalur=null;
    private ?float $hargaBeli=0;
    private ?int $jumlahMinimumBeli=0;
    private ?int $jumlah_produk=0;

    public function creatingObjectForModel(){
        $this->attributes["id_produk"]          =   $this->idProduk;
        $this->attributes["nama_produk"]        =   $this->namaProduk;
        $this->attributes["unit_pembelian"]     =   $this->unitPembelian;
        $this->attributes["jumlah_produk"]      =   $this->jumlah_produk;
        $this->attributes["harga_beli"]         =   $this->hargaBeli;
        $this->attributes["jumlah_minimum_beli"]=   $this->jumlahMinimumBeli;
        $this->attributes["id_penyalur"]        =   $this->idPenyalur;

        return $this;
    }

    public function getIdProduk(): ?string
    {
        return $this->idProduk;
    }

    /**
     * jika telah memiliki id product/ data product dari database gunakan
     * param 1 = true dan param 2 = id produk
     * @param bool|null $idTelahAda
     * @param string|null $idProduct
     * @return void
     */
    public function setIdProduk(?bool $idTelahAda=false, ?string $idProduct=null): void
    {
        if(!$idTelahAda){
            $this->idProduk = RandomStringGenerator::random_string(20);
        }else{
            $this->idProduk = $idProduct;
        }
    }

    public function getNamaProduk(): ?string
    {
        return $this->namaProduk;
    }

    public function setNamaProduk(?string $namaProduk): void
    {
        $this->namaProduk = $namaProduk;
    }

    public function getUnitPembelian(): ?string
    {
        return $this->unitPembelian;
    }

    public function setUnitPembelian(?string $unitPembelian): void
    {
        $this->unitPembelian = $unitPembelian;
    }

    public function getIdPenyalur(): ?string
    {
        return $this->idPenyalur;
    }

    public function setIdPenyalur(?string $idPenyalur): void
    {
        $this->idPenyalur = $idPenyalur;
    }

    public function getHargaBeli(): ?float
    {
        return $this->hargaBeli;
    }

    public function setHargaBeli(?float $hargaBeli): void
    {
        $this->hargaBeli = $hargaBeli;
    }

    public function getJumlahMinimumBeli(): ?int
    {
        return $this->jumlahMinimumBeli;
    }

    public function setJumlahMinimumBeli(?int $jumlahMinimumBeli): void
    {
        $this->jumlahMinimumBeli = $jumlahMinimumBeli;
    }

    public function getJumlahProduk(): ?int
    {
        return $this->jumlah_produk;
    }

    public function setJumlahProduk(?int $jumlah_produk): void
    {
        $this->jumlah_produk = $jumlah_produk;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID produk: {$this->id_produk}
        Nama produk: {$this->nama_produk}
        unit pembelian: {$this->unit_pembelian}
        id penyalur: {$this->id_penyalur}
        jumlah produk: {$this->jumlah_produk}
        harga beli: {$this->harga_beli}
        jumlah minimum beli: {$this->jumlah_minimum_beli}
        EOT;
    }
}