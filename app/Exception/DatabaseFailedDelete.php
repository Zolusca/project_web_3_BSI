<?php

namespace App\Exception;

use Laminas\Escaper\Exception\RuntimeException;

class DatabaseFailedDelete extends RuntimeException
{
    private string $messageException;
    private object $dataInformation;

    public function __construct(string $messageException, $dataInformation=null)
    {
        parent::__construct($messageException);
        $this->messageException =   $messageException;
        $this->dataInformation  =   $dataInformation;
    }

    public function getMessageException(): string
    {
        return $this->messageException;
    }

    public function getDataInformation(): object
    {
        return $this->dataInformation;
    }


}