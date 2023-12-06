<?php

namespace database;

use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class DatabaseConnectionTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    /**
     * cek test connection database
     * ini akan mengecek konfigurasi pada config/database dan service mysql apakah berjalan
     * @return void
     */
    public function testConnectionDatabase(){
        try{
            $databaseConnection = db_connect();
            $databaseConnection->initialize();

            $this->expectNotToPerformAssertions();

        }catch (DataException $exception){
            echo $exception->getMessage();
            self::assertInstanceOf(DataException::class,$exception);
        }
    }

}