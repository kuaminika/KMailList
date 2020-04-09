<?php 

namespace Controllers;
require_once dirname(__FILE__)."/../Log_Utilities/ILogTool.php";
require_once dirname(__FILE__)."/../Security_Utilities/Token_Utilities/KTokenFacade.php";
require_once dirname(__FILE__)."/../Models/KError.php";
require_once dirname(__FILE__)."/../K_Utilities/KErrorCodeMap.php";


use Log_Utilities\ILogTool;
use Security_Utilities\Token_Utilities\KTokenFacade;

use K_Utilities\KErrorCodeMap;
use models\KError;
class TokensController 
{


  
    private $logTool;
    private $requestAction;
    private $params;
    private $response;
    private $kTokenFacade;


    public function __construct($requestAction,$params,KTokenFacade $kTokenFacade,ILogTool $logTool)
    {
        $this->requestAction = $requestAction;
        $this->params = $params;
        $this->kTokenFacade = $kTokenFacade;
        $this->logTool = $logTool;

        $this->logTool->log("Token controller created");
    }


    public function authenticate()
    {
        
    }




    protected function logAndSend($errorCode,$location,$errorMessage=null)
    {
        $location = get_class($this).$location;
        $errorMessage = isset($errorMessage)? $errorMessage : KErrorCodeMap::errorCodeDescription($errorCode);
        $error = new KError($errorMessage,$location,$errorCode);
      
        $this->logTool->log($error->_toJson());

        $this->response['status_code_header'] = 'HTTP/1.1 500 ERROR';
        $this->response['body'] = $error->_toJson();


    }
    
    public function processRequest()
    {
        try 
        {
          $params = $this->params;


          $this->kTokenFacade->validateToken();  
        
          call_user_func_array(array($this, $this->requestAction), [$params]);
  
          header($this->response['status_code_header']);
          if ($this->response['body']) 
          {
              echo $this->response['body'];
          }
        } 
        catch(\K_Utilities\KException $ex)
        {
           $error =  $ex->getErrorModel();  
          
        $this->logTool->log($error->_toJson());
           $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
           $this->response['body'] =  $error->_toJson();
        }
        catch (\Throwable $th) 
        {
          $this->logAndSend("exception","processRequest",$th->getMessage());
          //throw $th;
        }
    }

    
}


?>