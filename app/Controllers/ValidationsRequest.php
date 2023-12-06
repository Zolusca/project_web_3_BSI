<?php

namespace App\Controllers;

use App\Exception\ValidationRequestError;
use CodeIgniter\Validation\Validation;
use Config\Services;

class ValidationsRequest
{
    private Validation $validation;
    public $validationRulesProduk      =
        [
            "nama_produk"=>"alpha_numeric_space|min_length[5]|max_length[100]|required",
            "jumlah_minimum_beli"=>"max_length[100]",
        ];
    protected $validationMessagesProduk   =
        [
            "nama_produk"=>"only alphabet, numeric and space is allowed for name",
            "jumlah_minimum_beli"=>"hanya decimal dengan panjang max 100",
        ];

    /**
     * @param Validation $validation
     */
    public function __construct()
    {
        $this->validation = Services::validation();
    }

    /**
     * @throws ValidationRequestError
     */
    public function validateInsertProduk($dataRequest){
        $this->validation->setRules($this->validationRulesProduk,$this->validationMessagesProduk);

        if(!$this->validation->run($dataRequest)){
            throw new ValidationRequestError($this->validation->getErrors());
        }

    }
}