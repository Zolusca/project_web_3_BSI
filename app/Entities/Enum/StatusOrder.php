<?php

namespace App\Entities\Enum;

enum StatusOrder:string
{
    case MENUNGGU_PERSETUJUAN ="menunggu_persetujuan";
    case DISETUJUI ="disetujui";
    case BARANG_SAMPAI  ="barang_sampai";
    case ORDER_DITOLAK  ="order_ditolak";

}