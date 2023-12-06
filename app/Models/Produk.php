<?php

namespace App\Models;

use App\Entities\ProductEntities;
use App\Entities\ProdukEntity;
use App\Exception\DatabaseFailedInsert;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;


class Produk extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = false;
    protected $returnType       = ProductEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    =
        [
            "id_produk","nama_produk",
            "id_penyalur","jumlah_produk",
            "harga_beli","jumlah_minimum_beli",
            "unit_pembelian"
        ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }

}
