<?php 
namespace Controllers;

require_once dirname(__FILE__)."/ControllerToolBox.php";
require_once dirname(__FILE__)."/../Models/KError.php";
require_once dirname(__FILE__)."/../K_Utilities/KErrorCodeMap.php";
use K_Utilities\KErrorCodeMap;
use models\KError;
abstract class AController
{
    protected $service;
    protected $logTool;
    private $requestAction;
    private $params;
    protected $response;
    public function __construct(ControllerToolBox $toolbox)
    {
      $this->service = $toolbox->getService();
      $this->logTool = $toolbox->getLogTool();
      $this->requestAction = $toolbox->getRequestAction();
      $this->requestMethod = $toolbox->getRequestMethod();
      $this->params = $toolbox->getRequestParams();
      $this->response = ["status_code_header"=>"HTTP/1.1 200 OK",
                        "body"=>json_encode([])
                        ];
  
    }


    public function index()
    {
      $result = "index";
      $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
      $this->response['body'] = $result;
    }

    public function findAll()
    {
      $result = $this->service->findAll();
      $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
      $this->response['body'] = $result->_toJson();
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
        $params = $this->params;

      
        call_user_func_array(array($this, $this->requestAction), [$params]);

        header($this->response['status_code_header']);
        if ($this->response['body']) 
        {
            echo $this->response['body'];
        }
    }



}

?>