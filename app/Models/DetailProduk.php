<?php

namespace App\Models;

use App\Entities\DetailProductEntities;
use App\Entities\DetailProdukEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DetailProduk extends Model
{
    protected $table            = 'detail_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = false;
    protected $returnType       = DetailProductEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_produk","jumlah_unit_dalam_box",
            "tanggal_order_terakhir","id_order"
        ];

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
