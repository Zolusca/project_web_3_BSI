<?php

namespace servicesTest;

use App\Entities\TemporaryOrderEntities;
use App\Services\TemporaryOrderServices;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class TemporaryOrderServicesTest extends CIUnitTestCase
{
    /**
     * @test
     */
    public function insertData(){
        $tempEntitites = new TemporaryOrderEntities();
        $tempServices  = new TemporaryOrderServices(Services::getDatabaseConnection());

        $tempEntitites->setIdProduk('idproduk001');
        $tempEntitites->setTanggalOrderTemp(false,null);
        $tempServices->insertData($tempEntitites);
        $this->expectNotToPerformAssertions();

    }
}