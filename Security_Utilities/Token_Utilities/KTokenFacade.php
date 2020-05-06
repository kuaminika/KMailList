<?php

namespace  Security_Utilities\Token_Utilities;

require_once dirname(__FILE__)."/interfaces/IKTokenProvider.php";
require_once dirname(__FILE__)."/interfaces/IkTokenValidator.php";
require_once dirname(__FILE__)."/Creators/TokenProviderCreator.php";
require_once dirname(__FILE__)."/Creators/TokenValidatorCreator.php";
require_once dirname(__FILE__)."/KTokenToolBox.php";

use Security_Utilities\Token_Utilities\Creaters\TokenProviderCreator;
use Security_Utilities\Token_Utilities\Creaters\TokenValidaterCreator;
use  Security_Utilities\Token_Utilities\interfaces\IKTokenProvider;
use  Security_Utilities\Token_Utilities\interfaces\IkTokenValidator;

class KTokenFacade
{

    private $tokenProvider;
    private $tokenValidator;


    public function __construct(IKTokenProvider $tokenProvider,IkTokenValidator $tokenValidator)
    {
        $this->tokenProvider = $tokenProvider;
        $this->tokenValidator = $tokenValidator;

    }


    private static function createToolBox()
    {
        
      $configs =   \KConfigSet::getCurrentConfigs();
      $tokenConfigArr = $configs->getConfig("tokenConfigs");
      $toolbox = new KTokenToolBox($tokenConfigArr);
      return $toolbox;
    }

    public static function create(KTokenToolBox $toolbox = null)
    {
    
      $toolbox = isset($toolbox)?$toolbox:KTokenFacade::createToolBox();
      $providerCreator = new TokenProviderCreator($toolbox);
      $validatorCreator = new TokenValidaterCreator($toolbox);

      $result = new KTokenFacade($providerCreator->create(),$validatorCreator->create());
      return $result;

    }


    public function resolveCode($code)
    {
       $result =  $this->tokenValidator->resolveCode($code);
       return $result;
    }


    public function createCode($model)
    {
        $str = $model->_toJson();
        $arr = (array)json_decode( $str );
        return $this->tokenProvider->createCode($arr);
    }

    public function validateToken()
    {

        try 
        {
            $this->tokenValidator->confirmIfTokenActuallyExists();
            $this->tokenValidator->validate();
        } 
        catch (\Throwable $th) 
        {            
            throw $th;
        }
    }

    public function createToken()
    {
        try 
        {
          $result =   $this->tokenProvider->getTokenFromRequest();
          return $result;
        }
         catch (\Throwable $th) {
            throw $th;
        }

    }



}


?>