<?php

namespace App\Models;

use App\Entities\TransaksiEntites;
use App\Entities\TransaksiEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = false;
    protected $returnType       = TransaksiEntites::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_transaksi",
            "id_order",
            "nominal_transaksi",
            "status_transaksi",
            "no_invoice",
            "no_resi"
        ];

    // Validation
    protected $validationRules      =
        [
        ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
