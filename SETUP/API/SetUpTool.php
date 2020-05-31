<?php 

namespace APISetUpTools;

class SetUpTool
{

    public $dbTool;
    private $echoLogTool;
    public $dbLogTool;

    public function __construct()
    {

        $configs = isset($configs)? $configs: \KConfigSet::getCurrentConfigs(); 
       $this->dbTool =  $configs->getConfig("currentDbTool");
       $this->dbLogTool = $configs->getConfig("currentDBLogTool");
      
    }

    public function getEchoLogTool()
    {
        $this->echoLogTool =\Log_Utilities\LogToolCreator::getCreateLogFn("echo")();
        return $this->echoLogTool;
    }
}