<?php 
namespace Controllers;

require_once dirname(__FILE__)."/ControllerToolBox.php";

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
      $this->params = $toolbox->getRequestParams();
      $this->response = ["status_code_header"=>"HTTP/1.1 200 OK",
                        "body"=>json_encode([])
                        ];
  
    }

    public function findAll()
    {
      $result = $this->service->findAll();
      $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
      $this->response['body'] = $result->_toJson();
    }


    public function processRequest()
    {
        $params = $this->params;
        call_user_func_array(array($this, $this->requestAction), $params);

        header($this->response['status_code_header']);
        if ($this->response['body']) 
        {
            echo $this->response['body'];
        }
    }



}

?>