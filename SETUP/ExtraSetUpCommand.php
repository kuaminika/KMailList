<?php

namespace SETUP{
/**
 * this is the default command
 */

    require_once "ASetUpCommand.php";
    use SETUP\ASetUpCommand;

    abstract class ExtraSetUpCommand extends ASetUpCommand
    {
        private $default;
        public function __construct($default)
        {
            $this->default = $default;
            $this->logTool = $default->logTool;//getLogTool();
            $this->dbTool = $default->dbTool;//getDBTool();
            $this->configSet = $default->configSet;
            $this->logTool->log(" finished instanciating ".$this->getName());
        }

       public function runSetUp()
       { 
            $this->logTool->log("-----");
           $this->default->runSetUp();
           $this->logTool->log("-----");
           
           $this->logTool->log("running ".$this->getName());
            $this->_runSetUp();
            $this->logTool->log(" done running ".$this->getName());
        }
        public function getName()
        {
            return "Extra command:".$this->_getName();   
        }

        public function setLogTool($newLogTool)
        {    $this->logTool->log("-before log change----");
            $this->default->setLogTool($newLogTool);   
            $this->logTool=$newLogTool;
             $this->logTool->log("---after log change--");
        }
        abstract protected function _getName();
        abstract protected function _runSetUp();
    }
}
?>