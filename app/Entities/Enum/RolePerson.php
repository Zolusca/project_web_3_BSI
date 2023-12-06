<?php

namespace App\Entities\Enum;

enum RolePerson:string
{
    case PENGELOLA_GUDANG = "pengelola_gudang";
    case PENGELOLA_KEUANGAN = "pengelola_keuangan";
    case PENGELOLA_PRODUK = "pengelola_produk";
    case SUPERVISOR = "supervisor";
}