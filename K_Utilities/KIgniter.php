<?php

namespace K_Utilities;
require_once dirname(__FILE__)."/../DB_Utilities/MYSQL_DBTool.php";
require_once dirname(__FILE__)."/../Log_Utilities/LogToolCreator.php";
require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/../configs.php";
class KIgniter
{


    public static function Ignite()
    {
        global $globalSettings,$dbSetUpConfigs; 

            
         $servername = $dbSetUpConfigs["servername"];
        $username =  $dbSetUpConfigs["username"];
        $password =  $dbSetUpConfigs["password"];
        $dbname =  $dbSetUpConfigs["dbname"];         

                    
        $settings = $globalSettings;

        //todo make dbtool creator
        $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);
    
        $dbTool->connectToDB();
        $logTool  = \Log_Utilities\LogToolCreator::getCreateLogFn("db")($dbTool,$settings);

        $logTool->log("hihi im here :)");
        $configs =  \KConfigSet::createNewConfigs($settings );

        $configs->addConfig("currentLogTool",$logTool);
        $configs->addConfig("currentDbTool",$dbTool);
    }



}


?>