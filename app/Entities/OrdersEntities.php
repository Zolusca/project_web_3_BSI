<?php

namespace App\Entities;

use App\Entities\Enum\StatusOrder;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class OrdersEntities extends Entity
{
    private $tanggalOrder;
    private ?string $idOrder;
    private ?string $idProduk;
    private ?string $idPenyalur;
    private ?int $jumlahOrderProduk=0;
    private ?float $totalHarga=0;
    private ?float $ppn=0;
    private ?StatusOrder $statusOrder=StatusOrder::MENUNGGU_PERSETUJUAN;

    public function creatingObjectForModel(){
        $this->attributes["id_order"]           = $this->idOrder;
        $this->attributes["id_produk"]          = $this->idProduk;
        $this->attributes["id_penyalur"]        = $this->idPenyalur;
        $this->attributes["tanggal_order"]      = Time::now('Asia/Jakarta')->format('Y-m-d H:i');
        $this->attributes["jumlah_order_produk"]= $this->jumlahOrderProduk;
        $this->attributes["status_order"]       = $this->statusOrder->value;
        $this->attributes["ppn"]                = $this->ppn;
        $this->attributes["total_harga"]        = $this->totalHarga;

        return $this;
    }

    /**
     * @param float $ppn
     * @param float $hargaProduk
     * @param int $jumlahOrderProduk
     * @return float
     */
    public function totalHarga(float $ppn, float $hargaProduk, int $jumlahOrderProduk){
        if (!isset($ppn) || $ppn==0) {
            return $hargaProduk * $jumlahOrderProduk;
        }
        return ($jumlahOrderProduk * $hargaProduk) * $ppn;
    }

    public function getIdOrder(): ?string
    {
        return $this->idOrder;
    }

    public function getTanggalOrder()
    {
        return $this->tanggalOrder;
    }

    /**
     * tidak perlu jika kamu sedang membuat data,
     * tanggal akan otomatis di isi pada hari ini
     * @param string $tanggalOrder
     * @return void
     */
    public function setTanggalOrder( $tanggalOrder): void
    {
        $this->tanggalOrder = $tanggalOrder;
    }

    public function setIdOrder(?string $idOrder): void
    {
        $this->idOrder = $idOrder;
    }

    public function getIdProduk(): ?string
    {
        return $this->idProduk;
    }

    public function setIdProduk(?string $idProduk): void
    {
        $this->idProduk = $idProduk;
    }

    public function getIdPenyalur(): ?string
    {
        return $this->idPenyalur;
    }

    public function setIdPenyalur(?string $idPenyalur): void
    {
        $this->idPenyalur = $idPenyalur;
    }

    public function getJumlahOrderProduk(): ?int
    {
        return $this->jumlahOrderProduk;
    }

    public function setJumlahOrderProduk(?int $jumlahOrderProduk): void
    {
        $this->jumlahOrderProduk = $jumlahOrderProduk;
    }

    public function getTotalHarga(): ?float
    {
        return $this->totalHarga;
    }

    public function setTotalHarga(?float $totalHarga): void
    {
        $this->totalHarga = $totalHarga;
    }

    public function getPpn(): ?float
    {
        return $this->ppn;
    }

    public function setPpn(?float $ppn): void
    {
        $this->ppn = $ppn;
    }

    public function getStatusOrder(): string
    {
        return $this->statusOrder->value;
    }

    public function setStatusOrder(?StatusOrder $statusOrder): void
    {
        $this->statusOrder = $statusOrder;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID order: {$this->id_order}
        id produk : {$this->id_produk}
        id penyalur : {$this->id_penyalur}
        tgl order : {$this->tanggal_order}
        status order : {$this->status_order}
        jumlah order : {$this->jumlah_order_produk}
        total harga : {$this->total_harga}
        ppn : {$this->ppn}
        EOT;
    }
}