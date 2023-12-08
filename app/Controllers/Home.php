<?php

namespace App\Controllers;

use App\Entities\ProdukEntity;
use App\Exception\DatabaseFailedInsert;
use App\Libraries\MyDateTime;
use App\Libraries\PdfGenerator;
use App\Libraries\RandomStringGenerator;
use App\Models\Orders;
use App\Models\Penyalur;
use App\Models\Produk;
use CodeIgniter\Email\Email;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use Config\Mimes;
use Config\Services;
use Google\Client;
use Google\Exception;
use Google\Service\Gmail;

class Home extends BaseController
{
    public function index()
    {
    }

}
