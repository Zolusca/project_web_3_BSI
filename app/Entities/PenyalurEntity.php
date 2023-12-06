<?php

namespace App\Entities;

use App\Libraries\RandomStringGenerator;
use CodeIgniter\Entity\Entity;

class PenyalurEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function createObject(string $nama,string $nomor,string $email){
        $this->attributes["id_penyalur"]    = RandomStringGenerator::random_string(9);
        $this->attributes["nama"]           = $nama;
        $this->attributes["nomor"]          = $nomor;
        $this->attributes["email"]          = $email;

        return $this;
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
