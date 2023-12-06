<?php

namespace servicesTest;

use App\Entities\GudangEntities;
use App\Models\Gudang;
use App\Services\GudangServices;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class GudangServicesTest extends CIUnitTestCase
{
    /**
     * @test
     */
    public function insertGudang(){
        $gudangServices = new GudangServices(Services::getDatabaseConnection());
        $gudangEntity   = new GudangEntities();

        $gudangEntity->setIdProduk('idproduk001');

        $gudangServices->insertData($gudangEntity);
        echo $gudangEntity;

        $this->expectNotToPerformAssertions();

    }

    /**
     * @test
     */
    public function updateStok(){
        $gudangServices = new GudangServices(Services::getDatabaseConnection());
        $gudangEntities   = new GudangEntities();
        $gudangModel      = new Gudang(Services::getDatabaseConnection());

        $data = $gudangModel->asArray()->findAll(1);

        $gudangEntities->setIdProduk($data[0]['id_produk']);
        // jumlah berkurang stok = 1
        $gudangEntities->setJumlahStokDiKeluarkan(1);
        $gudangEntities->setTanggalTerakhirKeluar('2023-11-22');

        $gudangServices->updateStokGudangDikeluarkan($gudangEntities);
        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function updateStokPenambahan(){
        $gudangServices = new GudangServices(Services::getDatabaseConnection());

        $gudangServices->updateStokGudangPenambahan('idproduk001',10);
        $this->expectNotToPerformAssertions();
    }
}