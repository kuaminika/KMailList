<?php

namespace K_Utilities;

use Exception;


class KException extends Exception
{
    var $errorModel;

    public function __construct($errorModel)
    {
        $this->errorModel = $errorModel;
    }


    /**
     * Get the value of errorModel
     */ 
    public function getErrorModel()
    {
        return $this->errorModel;
    }
}


?>