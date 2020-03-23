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
      /*      
        global $globalSettings,$dbSetUpConfigs; 

        echo "<h2>test find all:</h2>";

        $servername = $dbSetUpConfigs["servername"];
        $username =  $dbSetUpConfigs["username"];
        $password=  $dbSetUpConfigs["password"];
        $dbname =  $dbSetUpConfigs["dbname"];         

                    
        $settings = $globalSettings;
        $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);
       
       $logTool  = \Log_Utilities\LogToolCreator::getCreateLogFn("echo")();

        $logTool->log("hihi im here :)");*/
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