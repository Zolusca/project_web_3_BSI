<?php

namespace App\Controllers\AccountManagement;

use App\Controllers\BaseController;
use App\Entities\Enum\RolePerson;
use App\Entities\PersonEntity;
use App\Models\Person;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class UserRegister extends BaseController
{
    private PersonEntity $personEntity;
    private Person $personModel;
    private ConnectionInterface $DatabaseConnection;


    public function __construct()
    {
        $this->DatabaseConnection = Services::getDatabaseConnection();
        $this->personEntity = new PersonEntity();
        $this->personModel = new Person($this->DatabaseConnection);
    }


    public function registerView(){
        return view("authentication/register");
    }

    public function postRegister(){
        $key    = $this->request->getVar('key');
        $idKaryawan    = $this->request->getVar('idKaryawan');
        $nama   = $this->request->getVar('nama');
        $email  = $this->request->getVar('email');
        $noHp   = $this->request->getVar('nomorHp');
        $roleUser = $this->request->getVar('roleUser');

        log_message('debug','data request value ('.'key '.$key.',nama '.$nama.',role '.$roleUser.', email '.$email.', no HP '.$noHp.',id Karyawan '.$idKaryawan.')');

        // pengecekan data key request dengan data key yang ada di config/constant
        if (strtoupper($key)==KEY_VALUE){

            $this->personEntity
                 ->createObject($idKaryawan,$nama,$email,$noHp,RolePerson::tryFrom($roleUser));

            try {
                // pengecekan inserting ke model apakah ada error validasi
                if(!$this->personModel->insert($this->personEntity)){

                    // mendapatkan data error
                    $validationErrorMessage = $this->personModel->errors();

                    return view('authentication/register',['data'=>['errorMessage'=>$validationErrorMessage]]);
                }
                else{

                    log_message('info','Success inserting new user '.$this->personEntity);

                    $this->response->setStatusCode(ResponseInterface::HTTP_OK);

                    return view('authentication/register',['data'=>['message'=>'berhasil didaftarkan, silahkan login']]);
                }

            }catch (\ReflectionException|DatabaseException $exception){

                $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);

                log_message('error','Terdapat masalah pada register proses inserting data '.$this->personEntity);
                log_message('error',$exception->getMessage());

                return view('authentication/register');

            }finally {
                \Config\Services::closeDatabaseConnection($this->DatabaseConnection);
            }

        }else{
            return view('authentication/register',['data'=>['message'=>'invalid key input']]);
        }

    }

}