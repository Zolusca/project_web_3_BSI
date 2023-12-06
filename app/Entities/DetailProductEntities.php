<?php

namespace App\Entities;

use App\Libraries\MyDateTime;
use CodeIgniter\Entity\Entity;

class DetailProductEntities extends Entity
{
    private ?string $idProduk;
    private ?int $jumlahUnitDalamBox=0;
    private ?string $tanggalOrderTerakhir=null;
    private ?string $idOrderTerakhir=null;

    public function creatingObjectForModel(){
        $this->attributes["id_produk"]              = $this->idProduk;
        $this->attributes["jumlah_unit_dalam_box"]  = $this->jumlahUnitDalamBox;
        $this->attributes["tanggal_order_terakhir"] = ($this->tanggalOrderTerakhir==null) ? null:MyDateTime::stringDateTime($this->tanggalOrderTerakhir);
        $this->attributes["id_order"]               = $this->idOrderTerakhir;

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

    public function getJumlahUnitDalamBox(): ?int
    {
        return $this->jumlahUnitDalamBox;
    }

    public function setJumlahUnitDalamBox(?int $jumlahUnitDalamBox): void
    {
        $this->jumlahUnitDalamBox = $jumlahUnitDalamBox;
    }

    public function getTanggalOrderTerakhir(): ?string
    {
        return $this->tanggalOrderTerakhir;
    }

    public function setTanggalOrderTerakhir(?string $tanggalOrderTerakhir): void
    {
        $this->tanggalOrderTerakhir = $tanggalOrderTerakhir;
    }

    public function getIdOrderTerakhir(): ?string
    {
        return $this->idOrderTerakhir;
    }

    public function setIdOrderTerakhir(?string $idOrderTerakhir): void
    {
        $this->idOrderTerakhir = $idOrderTerakhir;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID order: {$this->id_order}
        jumlah unit dalam box : {$this->jumlah_unit_dalam_box}
        id produk : {$this->id_produk}
        tgl order terakhir : {$this->tanggal_order_terakhir}
        EOT;
    }

}