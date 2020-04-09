<?php

namespace  Security_Utilities\Token_Utilities;

require_once dirname(__FILE__)."/../../KConfigSet.php";

class KTokenToolBox
{

    public $secretKey;
    public $lifeSpan_hrs;
    public $requestParamsArr;
    public $tokenType;

    public function __construct($configArr)
    {
        $config =  \KConfigSet::createLocalConfigSet($configArr);

        $this->secretKey = $config->getConfig("secretKey");
        $this->lifeSpan_hrs = $config->getConfig("lifeSpan_hrs");
        $this->tokenType = $config->getConfig("tokenType");
    }


  
}


?>