<?php

namespace App\Libraries;

class MyDateTime
{
    public static function stringDateTime(string $date){

            try {
                $date = new \DateTime($date, new \DateTimeZone('Asia/Jakarta'));
                return $date->format('Y-m-d');

            } catch (\Exception $e) {
                log_message('error',"error when setting date time on setTanggalInput");
                log_message('error',$e->getMessage());
                return null;
            }
        }

}