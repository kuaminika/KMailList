<?php 

namespace Repository;
 

    require_once dirname(__FILE__)."/../Log_Utilities/LogToolCreator.php";
    require_once dirname(__FILE__)."/../DB_Utilities/MYSQL_DBTool.php";
    require_once dirname(__FILE__)."/../KConfigSet.php";
    require_once dirname(__FILE__)."/../configs.php";

   class RepositoryToolBox
   {
       public $dbTool;
       public $configSet;
       public $logTool;
        public function __construct($params)//$dbTool,$config,$logTool)
        {
            $this->dbTool = $params["dbTool"];
            $this->configSet = $params["configSet"];   
            $this->logTool = $params["logTool"];         
        }


        public static function createToolBox($configs = null)
        { 
          $configs = isset($configs)? $configs: \KConfigSet::getCurrentConfigs(); 
          $dbTool= $configs->getConfig("currentDbTool");
          $logTool  = $configs->getConfig("currentLogTool");

          $params = [];
          $params["dbTool"]=$dbTool;
          $params["configSet"]=$configs;
          $params["logTool"]=$logTool;


          
          $toolBox = new RepositoryToolBox($params);//$dbTool,$configs,$logTool);
          return $toolBox;
        }
   }



?>