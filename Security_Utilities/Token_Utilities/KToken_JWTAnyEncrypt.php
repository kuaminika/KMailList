<?php

namespace  Security_Utilities\Token_Utilities;

require_once dirname(__FILE__)."/interfaces/IKToken.php";
require_once dirname(__FILE__)."/KTokenToolBox.php";
require_once dirname(__FILE__)."/../../VendorUtilities/JWT/src/JWT.php";

use DateTime;
use  Security_Utilities\Token_Utilities\interfaces\IKToken;
use \Firebase\JWT\JWT;

class KToken_JWTAnyEncrypt implements IKToken
{
    private $secretKey;
    private $arr;

    public function __construct($secretKey,$arr=[])
    {
       $this->secretKey =  $secretKey;
       $this->arr = $arr;
   
    }


    public function resolveCode($code)
    {
        $decoded = JWT::decode($code,$this->secretKey, array('HS256'));           
        return $decoded ;

    }


    public function getCode( )
    {
        $finalPayLoad = $this->arr;
        $jwt = JWT::encode($finalPayLoad, $this->secretKey);
        return $jwt;
 
    }

}