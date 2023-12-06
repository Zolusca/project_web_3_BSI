<?php

namespace App\Models;

use App\Entities\GudangEntities;
use App\Entities\GudangEntity;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Gudang extends Model
{
    protected $table            = 'gudang';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = false;
    protected $returnType       = GudangEntities::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id_produk","jumlah_stok_digudang",
            "tanggal_terakhir_masuk","jumlah_stok_dikeluarkan",
            "tanggal_terakhir_keluar"
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
