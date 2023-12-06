<?php

namespace App\Entities;

use App\Libraries\RandomStringGenerator;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class TemporaryOrderEntities extends Entity
{
    private ?string $idOrderTemp=null;
    private ?string $idProduk=null;
    private ?string $tanggalOrderTemp="";

    public function creatingObjectForModel(){
        $this->attributes["id_temp_order"]  = $this->idOrderTemp;
        $this->attributes["id_produk"]      = $this->idProduk;
        $this->attributes["tanggal_request_order_dibuat"] = $this->tanggalOrderTemp;

        return $this;
    }
    public function getIdOrderTemp(): ?string
    {
        return $this->idOrderTemp;
    }

    public function setIdOrderTemp(?bool $haveIdOrder,?string $idOrderTemp=null): void
    {
        if($haveIdOrder){
            $this->idOrderTemp = $idOrderTemp;
        }else{
            $this->idOrderTemp = RandomStringGenerator::random_string(10);
        }
    }

    public function getIdProduk(): ?string
    {
        return $this->idProduk;
    }

    public function setIdProduk(?string $idProduk): void
    {
        $this->idProduk = $idProduk;
    }

    public function getTanggalOrderTemp(): ?string
    {
        return $this->tanggalOrderTemp;
    }

    public function setTanggalOrderTemp(?bool $haveDate,?string $tanggalOrderTemp=null): void
    {
        if($haveDate==false){
            $tanggalOrderTemp  = Time::now('Asia/Jakarta')->format('Y-m-d H:i');
        }
        $this->tanggalOrderTemp = $tanggalOrderTemp;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID temp order: {$this->id_temp_order}
        ID produk : {$this->id_produk}
        tanggal request dibuat: {$this->tanggal_request_order_dibuat}
        EOT;
    }
}