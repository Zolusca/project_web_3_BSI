<?php

namespace App\Entities;

use App\Libraries\RandomStringGenerator;
use CodeIgniter\Entity\Entity;

class PenyalurEntities extends Entity
{
    private ?string $idPenyalur=null;
    private ?string $namaPenyalur=null;
    private ?string $nomorHP=null;
    private ?string $emailPenyalur=null;

    public function creatingObjectForModel(){
        $this->attributes["id_penyalur"]    = $this->idPenyalur;
        $this->attributes["nama"]           = $this->namaPenyalur;
        $this->attributes["nomor"]          = $this->nomorHP;
        $this->attributes["email"]          = $this->emailPenyalur;

        return $this;
    }
    public function getIdPenyalur(): ?string
    {
        return $this->idPenyalur;
    }

    public function setIdPenyalur(): void
    {
        $this->idPenyalur = RandomStringGenerator::random_string(10);
    }

    public function getNamaPenyalur(): ?string
    {
        return $this->namaPenyalur;
    }

    public function setNamaPenyalur(?string $namaPenyalur): void
    {
        $this->namaPenyalur = $namaPenyalur;
    }

    public function getNomorHP(): ?string
    {
        return $this->nomorHP;
    }

    public function setNomorHP(?string $nomorHP): void
    {
        $this->nomorHP = $nomorHP;
    }

    public function getEmailPenyalur(): ?string
    {
        return $this->emailPenyalur;
    }

    public function setEmailPenyalur(?string $emailPenyalur): void
    {
        $this->emailPenyalur = $emailPenyalur;
    }


    public function __toString(): string
    {
        return <<<EOT
        ID Penyalur: {$this->id_penyalur}
        Nama : {$this->nama}
        email: {$this->email}
        no hp: {$this->nomor}
        EOT;
    }
}