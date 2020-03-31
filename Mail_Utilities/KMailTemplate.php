<?php

namespace Mail_utilities;

require_once dirname(__FILE__)."/interfaces/IKMailTemplate.php";

class KMailTemplate implements IKMailTemplate
{

    private $purpose;
    private $format;

    public function __construct($purpose,$format)
    {
        $this->purpose = $purpose;
        $this->format = $format;
    }

    /**
     * Get the value of purpose
     */ 
    public function getPurpose()
    {
        return $this->purpose;
    }


    /**
     * Get the value of format
     */ 
    public function getFormat()
    {
        return $this->format;
    }
}



?>