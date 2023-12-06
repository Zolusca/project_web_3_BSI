<?php

namespace App\Entities;

use App\Libraries\MyDateTime;
use CodeIgniter\Entity\Entity;

class GudangEntities extends Entity
{
    private ?string $idProduk=null;
    private ?int $jumlahStokDiGudang=null;
    private ?int $jumlahStokDiKeluarkan=null;
    private ?string $tanggalTerakhirMasuk=null;
    private ?string $tanggalTerakhirKeluar=null;

    public function creatingObjectForModel(){
        $this->attributes["id_produk"]              = $this->idProduk;
        $this->attributes["jumlah_stok_digudang"]   = $this->jumlahStokDiGudang;
        $this->attributes["jumlah_stok_dikeluarkan"] = $this->jumlahStokDiKeluarkan;
        $this->attributes["tanggal_terakhir_masuk"]  = ($this->tanggalTerakhirMasuk==null) ? null:MyDateTime::stringDateTime($this->tanggalTerakhirMasuk);
        $this->attributes["tanggal_terakhir_keluar"] = ($this->tanggalTerakhirKeluar==null) ? null:MyDateTime::stringDateTime($this->tanggalTerakhirKeluar);

        return $this;
    }

    public function getIdProduk(): ?string
    {
        return $this->idProduk;
    }

    public function setIdProduk(?string $idProduk): void
    {
        $this->idProduk = $idProduk;
    }

    public function getJumlahStokDiGudang(): ?int
    {
        return $this->jumlahStokDiGudang;
    }

    public function setJumlahStokDiGudang(?int $jumlahStokDiGudang): void
    {
        $this->jumlahStokDiGudang = $jumlahStokDiGudang;
    }

    public function getJumlahStokDiKeluarkan(): ?int
    {
        return $this->jumlahStokDiKeluarkan;
    }

    public function setJumlahStokDiKeluarkan(?int $jumlahStokDiKeluarkan): void
    {
        $this->jumlahStokDiKeluarkan = $jumlahStokDiKeluarkan;
    }

    public function getTanggalTerakhirMasuk(): ?string
    {
        return $this->tanggalTerakhirMasuk;
    }

    public function setTanggalTerakhirMasuk(?string $tanggalTerakhirMasuk): void
    {
        $this->tanggalTerakhirMasuk = $tanggalTerakhirMasuk;
    }

    public function getTanggalTerakhirKeluar(): ?string
    {
        return $this->tanggalTerakhirKeluar;
    }

    public function setTanggalTerakhirKeluar(?string $tanggalTerakhirKeluar): void
    {
        $this->tanggalTerakhirKeluar = $tanggalTerakhirKeluar;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID produk: {$this->id_produk}
        jumalh stok digudang : {$this->jumlah_stok_digudang}
        jumlah stok dikeluarkan : {$this->jumlah_stok_dikeluarkan}
        tgl terakhir masuk : {$this->tanggal_terakhir_masuk}
        tgl terakhir keluar : {$this->tanggal_terakhir_keluar}
        EOT;
    }
}