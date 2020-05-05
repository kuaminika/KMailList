<?php 

namespace Controllers;

require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/../Services/ServiceToolBox.php";
require_once dirname(__FILE__)."/../Services/_requireAllServices.php";

require_once dirname(__FILE__)."/../K_Utilities/KMessageCodeMap.php";
require_once dirname(__FILE__)."/../Security_Utilities/Token_Utilities/KTokenFacade.php";
require_once dirname(__FILE__)."/../Security_Utilities/Token_Utilities/KTokenToolBox.php";


use K_Utilities\KMessageCodeMap;
use Security_Utilities\Token_Utilities\KTokenFacade;
use Security_Utilities\Token_Utilities\KTokenToolBox;
class ControllerToolBox
{

    private $service;
    private $logTool;
    private $requestAction;
    private $requestParams;
    private $requestMethod;
    private $tokenFacade;
    private $messageMap;

    public function __construct($param)
    {
        $this->messageMap = $param["messageMap"]; 
        $this->service = $param["service"];
        $this->logTool = $param["logTool"];
        $this->requestAction = $param["requestAction"];
        $this->requestParams = $param["requestParams"];
        $this->requestMethod = $param["requestMethod"];
        $this->tokenFacade = $param["tokenFacade"];

    }

    private static function getBlankCreateParams()
    {
        $result = array("context"      =>"NotFoundContext"
                       ,"configs"      =>\KConfigSet::getCurrentConfigs()
                       ,"requestAction"=>"NotFoundMethod"
                       ,"requestParams" => array()
                       ,"requestMethod" =>"GET");

        return $result;

    }

    public static function createNew($createParams)
    {

        $createParams = isset( $createParams) ? $createParams : self::getBlankCreateParams();

        $context = $createParams["context"];
        $configs = isset($createParams["configs"])? $createParams["configs"]: \KConfigSet::getCurrentConfigs();
        //todo figure out what must be done when context not found
        $serviceName = "\\Service\\".$context."Service";


        $tokenConfigArr = $configs->getConfig("tokenConfigs");
        $toolbox = new KTokenToolBox($tokenConfigArr);
        $toolbox->requestParamsArr = $createParams;

        $tokenFacade = KTokenFacade::create($toolbox);
        $messageMap = new KMessageCodeMap( $configs->getConfig("messageMap"));


        $serviceToolBox = \Service\ServiceToolBox::createToolBox($context,$configs);

        $service = new $serviceName($serviceToolBox);
    
        $param = array(
             "logTool"        => $serviceToolBox->logTool
            ,"service"        => $service
            ,"requestAction"  => isset($createParams["requestAction"]) ? $createParams["requestAction"]:"index"
            ,"requestParams"  => $createParams["requestParams"]
            ,"requestMethod"  => isset($createParams["requestMethod"]) ? $createParams["requestMethod"]:"GET"
            ,"tokenFacade"    => $tokenFacade
            ,"messageMap"     => $messageMap
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

    /**
     * Get the value of requestMethod
     */ 
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }


    /**
     * Get the value of tokenFacade
     */ 
    public function getTokenFacade()
    {
        return $this->tokenFacade;
    }

    /**
     * Get the value of messageMap
     */ 
    public function getMessageMap()
    {
        return $this->messageMap;
    }
}
?>