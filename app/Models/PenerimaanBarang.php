<?php

namespace App\Models;

use App\Entities\PenerimaanBarangEntities;
use App\Entities\PenerimaanBarangEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PenerimaanBarang extends Model
{
    protected $table            = 'penerimaan_barang';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = false;
    protected $returnType       = PenerimaanBarangEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_order",
            "bukti_penerimaan"
        ];

    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
