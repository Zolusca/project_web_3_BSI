<?php

namespace App\Exception;

use Exception;

class ValidationRequestError extends Exception
{
    private array $dataError;

    /**
     * @param array $dataError
     */
    public function __construct(array $dataError)
    {
        parent::__construct();
        $this->dataError = $dataError;
    }

    public function getDataError(): array
    {
        return $this->dataError;
    }

}