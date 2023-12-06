<?php

namespace App\Entities\Enum;

enum StatusTransaksi :string
{
    case BELUM_LUNAS    ="belum_lunas";
    case LUNAS          ="lunas";
}
