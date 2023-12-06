<?php

namespace servicesTest;

use App\Entities\ProductEntities;
use App\Services\ProdukServices;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class ProdukServicesTest extends CIUnitTestCase
{
    /**
     * @test
     * @throws \ReflectionException
     */
    public function insertDataProduct()
    {
        $produkRequest = new ProductEntities();
        $productServices = new ProdukServices(Services::getDatabaseConnection());
        $produkRequest->setNamaProduk("baju biru");
        $produkRequest->setUnitPembelian("box");
        $produkRequest->setIdPenyalur("FOyOc1XPTR");

        $response = $productServices->insertProduct($produkRequest);

        echo $response;

        $this->expectNotToPerformAssertions();

    }

    /**
     * @test
     * @throws \ReflectionException
     */
    public function updateDataProduct(){
        $produkEntities = new ProductEntities();
        $productServices = new ProdukServices(Services::getDatabaseConnection());

        $produkEntities->setIdProduk(true,'gT6vGzWTGhZSSXN5uJGx');
        $produkEntities->setNamaProduk('test produk');
        $produkEntities->setIdPenyalur('idpenyalur01');
        $produkEntities->setJumlahProduk(10);
        $produkEntities->setHargaBeli(1000);
        $produkEntities->setUnitPembelian('pcs');
        $produkEntities->setJumlahMinimumBeli(12);

        echo $produkEntities;

        $productServices->editDataProduct($produkEntities,21);
        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function deleteProduct(){
        $productServices = new ProdukServices(Services::getDatabaseConnection());

        $productServices->deleteProduct('mttIkNm4GWTG5ptFAhAK');
        $this->expectNotToPerformAssertions();
    }

    /**
     * @return void
     * @test
     */
    public function updateStokProduct(){
        $productServices = new ProdukServices(Services::getDatabaseConnection());

        $productServices->updateStokProduct('idproduk001',10);
        $this->expectNotToPerformAssertions();
    }
}