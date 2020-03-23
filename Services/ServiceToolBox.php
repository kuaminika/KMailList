<?php

namespace Service;
require_once dirname(__FILE__)."/../Repositories/requireAll.php";


class ServiceToolBox{

    public $repo;
    public $logTool;
    public $configSet;

    public function __construct($params)
    {
        $this->repo = $params["repo"];
        $this->logTool = $params["logTool"];
        $this->configSet =  $params["configSet"];
    }


    
    public static function createToolBox($context,$configs= null)
    { 
        // prerequisite:  igniter ran meaning that DB is already set up in configs

        $repositoryClassName = "\\Repository\\".$context."Repository";
  
        $logTool  = $configs->getConfig("currentLogTool");//\Log_Utilities\LogToolCreator::getCreateLogFn("echo")();
        $logTool->log("hihi im here :)");
        $configs = isset($configs)? $configs: \KConfigSet::getCurrentConfigs(); 
        $dbTool= $configs->getConfig("currentDbTool");
        $params = [];
        $params["dbTool"]=$dbTool;
        $params["configSet"]=$configs;
        $params["logTool"]=$logTool;

        $repotoolBox = new \Repository\RepositoryToolBox( $params);
        $params["repo"] = new $repositoryClassName($repotoolBox);

        $toolBox = new ServiceToolBox($params);

        return $toolBox;
        
    }
}

?>