<?php

namespace servicesTest;

use App\Entities\DetailProductEntities;
use App\Services\DetailProdukServices;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class DetailProdukServiceTest extends CIUnitTestCase
{

    /**
     * @test
     */
    public function insertDetailProduk(){
        $detailProdukService = new DetailProdukServices(Services::getDatabaseConnection());
        $detailProdukEntities   = new DetailProductEntities();

        $detailProdukEntities->setIdProduk('idproduk001');

        $detailProdukService->insertDetailProduk($detailProdukEntities);
        echo $detailProdukEntities;

        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function updateData(){
        $detailProdukService = new DetailProdukServices(Services::getDatabaseConnection());
        $detailProdukEntities   = new DetailProductEntities();

        $detailProdukEntities->setIdProduk('hUuEDM5SzWSaH7EP380D');
        $detailProdukEntities->setJumlahUnitDalamBox(10);

        $detailProdukService->updateDetailProduk($detailProdukEntities);
        $this->expectNotToPerformAssertions();
    }
}