<?php

namespace App\Models;

use App\Entities\OrdersEntities;
use App\Entities\OrdersEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Orders extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = false;
    protected $returnType       = OrdersEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_order","id_produk",
            "id_penyalur","tanggal_order",
            "jumlah_order_produk","status_order",
            "ppn","total_harga"
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
