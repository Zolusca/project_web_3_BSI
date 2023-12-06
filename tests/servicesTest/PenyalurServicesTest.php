<?php

namespace servicesTest;

use App\Entities\PenyalurEntities;
use App\Services\PenyalurServices;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class PenyalurServicesTest extends CIUnitTestCase
{
    /**
     * @throws \ReflectionException
     * @test
     */
    public function insertingData(){
        $penyalurServices = new PenyalurServices(Services::getDatabaseConnection());
        $penyalurEntities = new PenyalurEntities();

        $penyalurEntities->setNamaPenyalur('haslam');
        $penyalurEntities->setEmailPenyalur('haslam@gmail.com');
        $penyalurEntities->setNomorHP('39120831238');

        $response = $penyalurServices->insertPenyalur($penyalurEntities);
        echo $response;

        $this->expectNotToPerformAssertions();
    }
}