<?php

namespace App\Controllers\Person\WarehouseManager;

use App\Controllers\Person\Persons;
use App\Entities\GudangEntities;
use App\Entities\PenerimaanBarangEntities;
use App\Entities\ProductEntities;
use App\Entities\TemporaryOrderEntities;
use App\Exception\DatabaseFailedDelete;
use App\Exception\DatabaseFailedInsert;
use App\Exception\DatabaseFailedUpdate;
use App\Libraries\RandomStringGenerator;
use App\Models\Gudang;
use App\Services\GudangServices;
use App\Services\PenerimaanBarangServices;
use App\Services\ProdukServices;
use App\Services\TemporaryOrderServices;

class WarehouseManagerActivity extends Persons
{
    private GudangEntities $gudangEntities;
    private ProdukServices $produkServices;
    private PenerimaanBarangEntities $penerimaanBarangEntities;
    private TemporaryOrderEntities $temporaryOrderEntities;
    private GudangServices $gudangServices;
    private TemporaryOrderServices $temporaryOrderServices;
    private PenerimaanBarangServices $penerimaanBarangServices;

    public function __construct()
    {
        parent::__construct();
        $this->gudangServices   = new GudangServices($this->DatabaseConnection);
        $this->gudangEntities   = new GudangEntities();
        $this->temporaryOrderEntities = new TemporaryOrderEntities();
        $this->temporaryOrderServices = new TemporaryOrderServices($this->DatabaseConnection);
        $this->penerimaanBarangEntities = new PenerimaanBarangEntities();
        $this->penerimaanBarangServices = new PenerimaanBarangServices($this->DatabaseConnection);
        $this->produkServices           = new ProdukServices($this->DatabaseConnection);
    }

    public function takeOutProduct(){
        $idProduk           = $this->request->getVar('id_produk');
        $jumlahDikeluarkan  = $this->request->getVar('jumlah_stok_dikeluarkan');
        $tanggalDikeluarkan = $this->request->getVar('tanggal_dikeluarkan');

        $this->gudangEntities->setIdProduk($idProduk);
        $this->gudangEntities->setJumlahStokDiKeluarkan(intval($jumlahDikeluarkan));
        $this->gudangEntities->setTanggalTerakhirKeluar($tanggalDikeluarkan);

        try {
            $this->gudangServices->updateStokGudangDikeluarkan($this->gudangEntities);

            return redirect()->to(base_url().'pengelolagudang/dashboard/listprodukgudang')
                            ->with('message','berhasil mengajukan penambahan');

        }catch (DatabaseFailedUpdate $exception){
            return redirect()->to(base_url().'pengelolagudang/dashboard/listprodukgudang')
                ->with('message',$exception->getMessage());
        }
    }

    public function orderTemporaryRequest(){
        $idProduk = $this->request->getVar('id_produk');

        $this->temporaryOrderEntities->setIdProduk($idProduk);
        $this->temporaryOrderEntities->setTanggalOrderTemp(false,null);

        try{
            $this->temporaryOrderServices->insertData($this->temporaryOrderEntities);

            return redirect()->to(base_url().'pengelolagudang/dashboard/listprodukgudang')
                        ->with('message','sukses kirim permintaan');

        }catch (DatabaseFailedInsert $exception){
            return redirect()->to(base_url().'pengelolagudang/dashboard/listprodukgudang')
                ->with('message',$exception->getMessage());
        }

    }

    public function cancelOrderTemporary(){
        $idOrderTemp = $this->request->getVar('id_temporary_order');
        try{
            $this->temporaryOrderServices->deleteOrderTemporaryData($idOrderTemp);

            return redirect()->to(base_url().'pengelolagudang/dashboard/listordertemporary')
                            ->with('message','sukses batalkan permintaan');

        }catch (DatabaseFailedDelete $exception){
            return redirect()->to(base_url().'pengelolagudang/dashboard/listordertemporary')
                ->with('message',$exception->getMessage());
        }
    }

    public function shipmentProductProcess(){
        $idOrder          = $this->request->getVar('id_order');
        $idProduk         = $this->request->getVar('id_produk');
        $jumlahOrder      = $this->request->getVar('jumlah_order');
        $fileBuktiPenerimaan  = $this->request->getFile('bukti_penerimaan');

        // mengubah nama dari file gambar
        $newNamePicture = RandomStringGenerator::random_string(9).".".$fileBuktiPenerimaan->getClientExtension();

        try{
            $this->penerimaanBarangEntities->setIdOrder($idOrder);
            $this->penerimaanBarangEntities->setFileBuktiPenerimaan($newNamePicture);
            $this->penerimaanBarangServices
                ->shipmentProductProcess($this->penerimaanBarangEntities,$idProduk,$jumlahOrder);

            // memindahkan gambar ke public/bukti_penerimaan dengan nama random
            // FCPATH direktori absolute dari /home/namauser/...
            $fileBuktiPenerimaan->move(FCPATH."/bukti_penerimaan/",$newNamePicture);

            return redirect()->to(base_url().'pengelolagudang/dashboard/listorderrequest')
                ->with('message','sukses upload data');

        }catch (DatabaseFailedUpdate $exception){
            return redirect()->to(base_url().'pengelolagudang/dashboard/listorderrequest')
                ->with('message',$exception->getMessage());
        }

    }
}