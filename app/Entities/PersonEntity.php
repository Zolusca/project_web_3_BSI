<?php

namespace App\Entities;

use App\Entities\Enum\RolePerson;
use App\Libraries\RandomStringGenerator;
use CodeIgniter\Entity\Entity;
use Couchbase\Role;

class PersonEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function createObject(string $idKaryawan,string $nama,string $email,string $nomorHp,RolePerson $rolePerson){
        $this->attributes["nama"]        = $nama;
        $this->attributes["id_karyawan"] = $idKaryawan;
        $this->attributes["email"]       = $email ;
        $this->attributes["nomor_hp"]    = $nomorHp;
        $this->attributes["role_person"] = $rolePerson->value;

        return $this;
    }

    public function __toString(): string
    {
        return <<<EOT
        ID karyawan: {$this->id_karyawan}
        Nama : {$this->nama}
        email: {$this->email}
        no hp: {$this->nomor_hp}
        role: {$this->role_person}
        EOT;
    }
}
