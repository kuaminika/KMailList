<?php

namespace  Security_Utilities\Token_Utilities;

require_once dirname(__FILE__)."/interfaces/IKToken.php";
require_once dirname(__FILE__)."/KTokenToolBox.php";
require_once dirname(__FILE__)."/../../VendorUtilities/JWT/src/JWT.php";

use DateTime;
use  Security_Utilities\Token_Utilities\interfaces\IKToken;
use \Firebase\JWT\JWT;

class KToken_JWT implements IKToken
{

    public $endDate;
    public $startDate;
    public $payload;
    public $secretKey;

   
    public static function convertArrToToken($arr)
    {
        $result = new KToken_JWT();
        $result->payload   = $arr["innerPayLoad"];
        $result->startDate = $arr["startDate"] ;
        $result->endDate   = $arr["endDate"]  ;
        return $result;        
    }

    public static function generateToken(KTokenToolBox $tokenToolbox)
    {

        $result = new KToken_JWT();
        $result->payload = $tokenToolbox->requestParamsArr;
        $result->startDate = new DateTime();
  
        $result->secretKey = $tokenToolbox->secretKey;
        $hrLifeSpan = $tokenToolbox->lifeSpan_hrs;

        $interVal = new \DateInterval("PT".$hrLifeSpan."H");

        $result->endDate = new DateTime();
        $result->endDate->add($interVal);
    }

    public function getCode()
    {
        $finalPayLoad = [];
        $finalPayLoad["innerPayLoad"] = $this->payload;

        $finalPayLoad["startDate"] = $this->startDate;
        $finalPayLoad["endDate"]  = $this->endDate;

        $jwt = JWT::encode($finalPayLoad, $this->secretKey);
        return $jwt;
 
    }
}

?>