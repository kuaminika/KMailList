<?php 

namespace Controllers;

require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/../Services/ServiceToolBox.php";
require_once dirname(__FILE__)."/../Services/_requireAllServices.php";

class ControllerToolBox
{

    private $service;
    private $logTool;
    private $requestAction;
    private $requestParams;

    public function __construct($param)
    {
        $this->service = $param["service"];
        $this->logTool = $param["logTool"];
        $this->requestAction = $param["requestAction"];
        $this->requestParams = $param["requestParams"];
    }

    private static function getBlankCreateParams()
    {
        $result = array("context"      =>"NotFoundContext"
                       ,"configs"      =>\KConfigSet::getCurrentConfigs()
                       ,"requestAction"=>"NotFoundMethod"
                       ,"requestParams" => array());

        return $result;

    }

    public static function createNew($createParams)
    {
        $createParams = isset( $createParams) ? $createParams : self::getBlankCreateParams();

        $context = $createParams["context"];
        $configs = isset($createParams["configs"])? $createParams["configs"]: \KConfigSet::getCurrentConfigs();
        //todo figure out what must be done when context not found
        $serviceName = "\\Service\\".$context."Service";

        $serviceToolBox = \Service\ServiceToolBox::createToolBox($context,$configs);

        $service = new $serviceName($serviceToolBox);
    
        $param = array(
             "logTool"       => $serviceToolBox->logTool
            ,"service"       => $service
            ,"requestAction" => $createParams["requestAction"]
            ,"requestParams" => $createParams["requestParams"]
        ); 

        $result = new ControllerToolBox($param);
        return $result;

    }

    /**
     * Get the value of service
     */ 
    public function getService()
    {
        return $this->service;
    }

    /**
     * Get the value of logTool
     */ 
    public function getLogTool()
    {
        return $this->logTool;
    }

    /**
     * Get the value of requestParams
     */ 
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * Get the value of requestAction
     */ 
    public function getRequestAction()
    {
        return $this->requestAction;
    }
}
?>