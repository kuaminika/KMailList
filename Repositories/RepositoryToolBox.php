<?php 

namespace Repository
{

   class RepositoryToolBox
   {
       public $dbTool;
       public $configSet;
       public $logTool;
        public function __construct($dbTool,$config,$logTool)
        {
            $this->dbTool = $dbTool;
            $this->configSet = $config;   
            $this->logTool = $logTool;         
        }
   }


}
?>