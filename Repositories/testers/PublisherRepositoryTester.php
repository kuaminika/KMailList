<?php

namespace Repository\Testers
{
   
    require_once "requireCommon.php";
   require_once dirname(__FILE__)."/"."../PublisherRepository.php";
   // require_once "./../PublisherRepository.php";
    
    class PublisherRepositoryTester
    {

        public function __construct()
        {
            echo "<h1>PublisherRepository tests </h1>";
            
        }

        private function getLogTool($stringLogType)
        {

            $logTypeFn = ["echo"=>function()
                                {

                                    $logTool  = new \Log_Utilities\EchoLogTool("logTool_main");
                                    return $logTool;
                                },
                        "db"=>function($dbTool,$settings)
                        {
                            $params = array(
                                "name"=>"REPOSIROTY TESTER",
                               "dbTool"=>$dbTool,
                               "logTableName"=>$settings[ "logToolTableName"]
                            ); 
                            $logTool = new \Log_Utilities\DBTableLogTool($params);
                            return $logTool;
                        }
                    ];
            return $logTypeFn[$stringLogType];

        }


        public function TestPublisherRepositor_findAll()
        {
            global $globalSettings,$dbSetUpConfigs; 

            echo "<h2>test find all:</h2>";

            $servername = $dbSetUpConfigs["servername"];
            $username =  $dbSetUpConfigs["username"];
            $password=  $dbSetUpConfigs["password"];
            $dbname =  $dbSetUpConfigs["dbname"];         

                        
            $settings = $globalSettings;
            $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);
           
            $logTool  = $this->getLogTool("echo")();
            $logTool->log("hihi im here :)");
            $configs =  \KConfigSet::createNewConfigs($settings );
            $toolBox = new \Repository\RepositoryToolBox($dbTool,$configs,$logTool);
            
            $toolBox->dbTool->connectToDB();
            $publisherRepo = new  \Repository\PublisherRepository($toolBox);
            $publisherRepo->findAll();
        }



    }




}



?>