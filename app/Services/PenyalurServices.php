<?php

namespace App\Services;

use App\Entities\PenyalurEntities;
use App\Exception\DatabaseFailedInsert;
use App\Models\Penyalur;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

class PenyalurServices
{
    private Penyalur $penyalurModel;
    private ConnectionInterface $DatabaseConnection;


    public function __construct($databaseConnection)
    {
        $this->DatabaseConnection = $databaseConnection;
        $this->penyalurModel = new Penyalur($this->DatabaseConnection);
    }

    /**
     * @param PenyalurEntities $penyalurEntities
     * @return PenyalurEntities
     * @throws \ReflectionException
     * @throws DatabaseFailedInsert
     */
    public function insertPenyalur(PenyalurEntities $penyalurEntities){

        if($this->penyalurModel
                ->where('email',$penyalurEntities->getEmailPenyalur())
                ->where('nomor',$penyalurEntities->getNomorHP())
                ->countAllResults()>1)
        {
            throw new DatabaseFailedInsert("Data Penyalur sudah ada ".$penyalurEntities->getNamaPenyalur());
        }

        $penyalurEntities->setIdPenyalur();
        // membuat object siap untuk di insert
        $penyalurEntities->creatingObjectForModel();

        try{
            $this->penyalurModel->insert($penyalurEntities);
            log_message('info',PenyalurServices::class.' sukses insert data '.$penyalurEntities);

            return $penyalurEntities;

        } catch (\ReflectionException|DatabaseException $e) {
            log_message('error', PenyalurServices::class.' failed inserting data '.$penyalurEntities);
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
    public function getAllPenyalur(){
        return $this->penyalurModel->findAll();
    }

}