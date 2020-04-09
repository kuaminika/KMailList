<?php

namespace Security_Utilities\Token_Utilities\Creaters;

require_once dirname(__FILE__)."/../KTokenValidator_JWT.php";
require_once dirname(__FILE__)."/../KTokenToolBox.php";
use Security_Utilities\Token_Utilities\KTokenToolBox;

class TokenValidaterCreator
{
 
    private $toolBox;

    public function __construct(KTokenToolBox $toolBox)
    {
        $this->toolBox = $toolBox;
    }

    public function create()
    {
        $providerType = $this->toolBox->tokenType;
        $providerName= "Security_Utilities\\Token_Utilities\\KTokenValidator_".$providerType;
        $provider = new $providerName($this->toolBox);
        return $provider;

    }



}





?>