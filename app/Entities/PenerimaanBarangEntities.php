<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PenerimaanBarangEntities extends Entity
{
    private ?string $idOrder;
    private ?string $fileBuktiPenerimaan;

    public function creatingObjectForModel(){
        $this->attributes["id_order"]           = $this->idOrder;
        $this->attributes["bukti_penerimaan"]   = $this->fileBuktiPenerimaan;

        return $this;
    }
    public function getIdOrder(): ?string
    {
        return $this->idOrder;
    }

    public function setIdOrder(?string $idOrder): void
    {
        $this->idOrder = $idOrder;
    }

    public function getFileBuktiPenerimaan(): ?string
    {
        return $this->fileBuktiPenerimaan;
    }

    public function setFileBuktiPenerimaan(?string $fileBuktiPenerimaan): void
    {
        $this->fileBuktiPenerimaan = $fileBuktiPenerimaan;
    }

    public function __toString(): string
    {
        return <<<EOT
        \nID order: {$this->id_order}
        bukti penerimaan : {$this->bukti_penerimaan}
        EOT;
    }
}