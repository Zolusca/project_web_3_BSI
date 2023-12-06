<?php

namespace App\Services;

use App\Entities\TemporaryOrderEntities;
use App\Exception\DatabaseFailedDelete;
use App\Exception\DatabaseFailedInsert;
use App\Models\Produk;
use App\Models\TemporaryOrder;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

class TemporaryOrderServices
{
    private TemporaryOrder $temporaryOrderModel;
    private ConnectionInterface $DatabaseConnection;

    /**
     * @param Produk $produk
     */
    public function __construct($DatabaseConnection)
    {
        $this->DatabaseConnection = $DatabaseConnection;
        $this->temporaryOrderModel     = new TemporaryOrder($this->DatabaseConnection);
    }

    public function insertData(TemporaryOrderEntities $temporaryOrderEntities){
        try{
            $temporaryOrderEntities->setIdOrderTemp(false,null);
            $temporaryOrderEntities->creatingObjectForModel();
            $this->temporaryOrderModel->insert($temporaryOrderEntities);

            log_message('info',TemporaryOrderServices::class.' success insert data temporary order '.$temporaryOrderEntities);

        }catch (\ReflectionException|DatabaseException $exception){
            log_message('error',TemporaryOrderServices::class.' gagal insert data temporary order '.$temporaryOrderEntities);
            log_message('error',$exception->getMessage());
            throw new DatabaseFailedInsert("gagal insert data, ada masalah");
        }
    }

    /**
     * @param string $idOrderTemporary
     * @return void
     * @throws DatabaseFailedDelete
     */
    public function deleteOrderTemporaryData(string $idOrderTemporary){
        try{
            $this->temporaryOrderModel->delete($idOrderTemporary);

        }catch (DatabaseException $exception){
            log_message('error',TemporaryOrderServices::class.' gagal hapus data id order temp '.$idOrderTemporary);
            log_message('error',$exception->getMessage());
            throw new DatabaseFailedDelete("gagal menghapus data");
        }
    }
}