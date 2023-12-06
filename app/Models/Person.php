<?php

namespace App\Models;

use App\Entities\PersonEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Person extends Model
{
    protected $table            = 'person';
    protected $primaryKey       = 'id_karyawan';
    protected $useAutoIncrement = false;
    protected $returnType       = PersonEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    =
        [
            "id_karyawan","nama",
            "email","nomor_hp",
            "role_person"
        ];

    // Validation
    protected $validationRules      =
        [
            "nama"=>"alpha_numeric_space|min_length[5]|max_length[100]|required",
            "email"=>"valid_email|max_length[90]",
            "nomor_hp"=>"numeric|min_length[4]|max_length[20]",
        ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
