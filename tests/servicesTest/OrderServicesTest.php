<?php

namespace servicesTest;

use App\Entities\Enum\StatusOrder;
use App\Entities\OrdersEntities;
use App\Exception\DatabaseFailedUpdate;
use App\Models\Orders;
use App\Services\OrderServices;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;
use ReflectionException;

class OrderServicesTest extends CIUnitTestCase
{
    /**
     * @test
     */
    public function insertingData(){
        $orderEntities = new OrdersEntities();
        $orderServices = new OrderServices(Services::getDatabaseConnection());

        $orderEntities->setIdOrder('idorder001');
        $orderEntities->setIdProduk('gT6vGzWTGhZSSXN5uJGx');
        $orderEntities->setIdPenyalur('idpenyalur01');
        $orderEntities->setJumlahOrderProduk(10);
        $orderEntities->setPpn(11);

       $orderServices->insertOrderData($orderEntities,1000);
       $this->expectNotToPerformAssertions();
    }

    /**
     * @throws ReflectionException
     * @test
     */
    public function updateStatusOrder(){
        $orderEntities = new OrdersEntities();
        $orderServices = new OrderServices(Services::getDatabaseConnection());
        $orderModel    = new Orders(Services::getDatabaseConnection());

        try{
            $dataOrderTarget = $orderModel->asArray()->findAll(1);

            $orderEntities->setIdOrder($dataOrderTarget[0]['id_order']);
            $orderEntities->setIdProduk($dataOrderTarget[0]['id_produk']);
            $orderEntities->setIdPenyalur($dataOrderTarget[0]['id_penyalur']);
            $orderEntities->setTanggalOrder($dataOrderTarget[0]['tanggal_order']);
            $orderEntities->setJumlahOrderProduk($dataOrderTarget[0]['jumlah_order_produk']);
            $orderEntities->setPpn($dataOrderTarget[0]['ppn']);
            $orderEntities->setTotalHarga($dataOrderTarget[0]['total_harga']);
            // target value status order yang ingin diubah
            $orderEntities->setStatusOrder(StatusOrder::ORDER_DITOLAK);

            $orderServices->updateStatusOrder($orderEntities);

        }catch (ReflectionException $exception){
        }

        $this->expectNotToPerformAssertions();
    }
}