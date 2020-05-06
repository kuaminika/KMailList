<?php

namespace  Security_Utilities\Token_Utilities;

require_once dirname(__FILE__)."/interfaces/IKTokenProvider.php";
require_once dirname(__FILE__)."/KToken_JWT.php";
require_once dirname(__FILE__)."/KToken_JWTAnyEncrypt.php";


use  Security_Utilities\Token_Utilities\interfaces\IKTokenProvider;

class KTokenProvider_JWT implements IKTokenProvider
{

    private $tokenToolbox;


    public function __construct(KTokenToolBox $tokenToolbox)
    {
        $this->tokenToolbox =  $tokenToolbox;  
    }
    
    public function createCode($arr)
    {
        $_KToken_JWTAnyEncrypt = new KToken_JWTAnyEncrypt($this->tokenToolbox->secretKey,$arr);
        $result =  $_KToken_JWTAnyEncrypt->getCode();
        return $result;
    }

    public function getTokenFromRequest()
    {
        return KToken_JWT::generateToken($this->tokenToolbox);
    }

}


?>