<?php

namespace App\Models;

use App\Entities\TemporaryOrderEntities;
use App\Entities\TemporaryOrderEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class TemporaryOrder extends Model
{
    protected $table            = 'temporary_order';
    protected $primaryKey       = 'id_temp_order';
    protected $useAutoIncrement = false;
    protected $returnType       = TemporaryOrderEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_temp_order",
            "id_produk",
            "tanggal_request_order_dibuat"
        ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
