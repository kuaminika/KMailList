<?php
 namespace SETUP{

    abstract class ASetUpCommand
    {
        protected $dbTool;
        protected $logTool;
        protected $configSet;

        abstract public function runSetUp();
        abstract public function getName();

        public function getLogTool()
        {
            return $this->logTool;
        }

        public function getDBTool()
        {
            return $this->dbTool;
        }

        public function setLogTool($newLogTool)
        {
            $this->logTool= $newLogTool;
        }
        public function setDBTool($dbTool)
        {
            $this->logTodbToolol= $dbTool;
        }
    }

 } 

?>