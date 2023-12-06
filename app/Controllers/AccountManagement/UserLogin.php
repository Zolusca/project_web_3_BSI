<?php

namespace App\Controllers\AccountManagement;

use App\Controllers\BaseController;
use App\Models\Person;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Config\Services;

class UserLogin extends BaseController
{
    private Person $personModel;
    private ConnectionInterface $DatabaseConnection;

    public function __construct()
    {
        $this->DatabaseConnection = Services::getDatabaseConnection();
        $this->personModel = new Person($this->DatabaseConnection);
    }

    public function loginView(){
        return view("authentication/login");
    }

    public function postLogin(){
        $idKaryawan = $this->request->getVar('idKaryawan');
        $email      = $this->request->getVar('email');

        log_message('info','request param data '.'id karyawan '.$idKaryawan.' email '.$email);

        try {
            $resultQuery = $this->personModel->find($idKaryawan);

            // jika user tidak ditemukan
            if($resultQuery == null){
                log_message('info','data pencarian person id karyawan '.$idKaryawan.' email '.$email. ' TIDAK DITEMUAKAN');

                return view("authentication/login",['data'=>['message'=>'Kombinasi ID Karyawan dan Email tidak valid']]);

            }else{
                // jika id_karyawan dan email sama dengan data di table person
                if($resultQuery->email === $email){
                    log_message('info','data pencarian person id karyawan '.$idKaryawan.' email '.$email. ' DITEMUKAN');

                    // menghapus tanda _ pada role user value
                    $role =  $this->rolePersonTrim($resultQuery->role_person);

                    // setting session
                    session()->set(['is_logged_in'=>true]);
                    session()->set(['role'=>$role]);
                    session()->set(['nama'=>$resultQuery->nama]);

                    return redirect()->to(base_url().$role.'/dashboard');
                }
                // jika email tidak sama dengan apa yang ada di table person
                else{
                    return view("authentication/login",['data'=>['message'=>'Kombinasi ID Karyawan dan Email tidak valid']]);
                }
            }
        }
        catch (DatabaseException $exception){
         log_message('error','kesalahan query pada login method postLogin');
         log_message('error',$exception->getMessage());

        }finally {
            \Config\Services::closeDatabaseConnection($this->DatabaseConnection);
        }

        return view('authentication/login');
    }

    private function rolePersonTrim(string $roleUser){
        return str_replace('_','',$roleUser);
    }
}