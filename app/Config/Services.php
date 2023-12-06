<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\Exceptions\DatabaseException;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{


    /**
     * Ini akan membuat object koneksi yang sama setiap anda memanggilnya
     * walau ditempat berbeda
     * @return BaseConnection
     */
    public static function getDatabaseConnection()
    {
            try{
                $databaseConnection = db_connect();

                // cek database apakah terkoneksi atau tidak
                $databaseConnection->initialize();

                log_message('info','Koneksi Database Sukses dibuat ');

                // return baseConnection
                return $databaseConnection;

            }
                // catch ketika database tidak dapat terkoneksi dengan program
            catch (DatabaseException $exception){

                log_message('error','Koneksi Database Sukses Gagal dibuat ');
                log_message('error',$exception->getMessage());

            }
            return  null;
    }

    /**
     * menutup koneksi yang telah digunakan
     * @param BaseConnection $connection
     * @return void
     */
    public static function closeDatabaseConnection(BaseConnection $connection): void
    {
        // Menutup koneksi
        $connection->close();
        log_message('debug','Koneksi Database Berhasil diputus');
    }
}
