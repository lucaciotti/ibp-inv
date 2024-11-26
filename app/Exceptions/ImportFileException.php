<?php

namespace App\Exceptions;

use Exception;

class ImportFileException extends Exception
{
    public function errorMessage()
    {
        //error message
        $errorMsg = $this->getMessage();
        return $errorMsg;
    }
}
