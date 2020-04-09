<?php

namespace  Security_Utilities\Token_Utilities;

require_once dirname(__FILE__)."/interfaces/IkTokenValidator.php";
require_once dirname(__FILE__)."/../../VendorUtilities/JWT/src/JWT.php";
require_once dirname(__FILE__)."/../../VendorUtilities/JWT/src/SignatureInvalidException.php";
require_once dirname(__FILE__)."/../../Models/KError.php";
require_once dirname(__FILE__)."/../../K_Utilities/KException.php";
require_once dirname(__FILE__)."/../../K_Utilities/KErrorCodeMap.php";
require_once dirname(__FILE__)."/KToken_JWT.php";

use DateTime;
use Firebase\JWT\JWT;
use  Security_Utilities\Token_Utilities\interfaces\IkTokenValidator;
use models\KError;
use K_Utilities\KException;
use K_Utilities\KErrorCodeMap;

class KTokenValidator_JWT implements IkTokenValidator
{

    private $requestParams;
    private $secretKey;
    public function __construct(KTokenToolBox $tokenToolbox)
    {
        $this->secretKey = $tokenToolbox->secretKey;
        $this->requestParams = $tokenToolbox->requestParamsArr;
       // $this->token = new KToken_JWT($tokenToolbox);  
    }
    
    public function confirmIfTokenActuallyExists()
    {
      if(!array_key_exists("token",$this->requestParams))
        $this->throwKException("tokenNotFound","confirmIfTokenActuallyExists");

        return true;
    }



    protected function throwKException($errorCode,$location,$errorMessage=null)
    {
        $errorMessage = isset($errorMessage)? $errorMessage : KErrorCodeMap::errorCodeDescription($errorCode);
        $error = new KError($errorMessage,$location,$errorCode);
        $exception = new KException($error);

        throw $exception;


    }



    public function validate()
    {    
        
        try
         {
            $this->confirmIfTokenActuallyExists();
    
            $token = $this->requestParams["token"];
            $key = $this->secretKey;
    
            $decoded = JWT::decode($token, $key, array('HS256'));
    
            $result = KToken_JWT::convertArrToToken($decoded);

            $now = new DateTime();
            if($result->endDate< $now)
                 $this->throwKException("tokenExpired","validate");

            return $result;
        } 
        catch (\Throwable $th) 
        {
            throw $th;
        }
    }
}



?>