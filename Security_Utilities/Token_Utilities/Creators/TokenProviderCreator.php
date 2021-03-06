<?php

namespace Security_Utilities\Token_Utilities\Creaters;

require_once dirname(__FILE__)."/../KTokenProvider_JWT.php";
require_once dirname(__FILE__)."/../KTokenToolBox.php";
use Security_Utilities\Token_Utilities;
use Security_Utilities\Token_Utilities\KTokenToolBox;

class TokenProviderCreator
{
 
    private $toolBox;

    public function __construct(KTokenToolBox $toolBox)
    {
        $this->toolBox = $toolBox;
    }

    public function create()
    {
        $providerType = $this->toolBox->tokenType;
        $providerName= "Security_Utilities\\Token_Utilities\\KTokenProvider_".$providerType;
        $provider = new $providerName($this->toolBox);
        return $provider;

    }



}





?>