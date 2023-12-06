<?php

namespace App\Controllers\Person;

use App\Controllers\BaseController;
use App\Controllers\ValidationsRequest;
use Config\Services;

class Persons extends BaseController
{
    protected ValidationsRequest $validationsRequest;
    protected $DatabaseConnection;

    /**
     * @param ValidationsRequest $validationsRequest
     */
    public function __construct()
    {
        $this->DatabaseConnection = Services::getDatabaseConnection();
        $this->validationsRequest = new ValidationsRequest();
    }

}