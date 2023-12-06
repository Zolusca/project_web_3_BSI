<?php

namespace App\Models;

use App\Entities\PenyalurEntities;
use App\Entities\PenyalurEntity;
use App\Entities\PersonEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Penyalur extends Model
{
    protected $table            = 'penyalur';
    protected $primaryKey       = 'id_penyalur';
    protected $useAutoIncrement = false;
    protected $returnType       = PenyalurEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_penyalur","nama",
            "nomor","email"
        ];

    // Validation
    protected $validationRules      =
        [
        ];
    protected $validationMessages   =
        [
        ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
