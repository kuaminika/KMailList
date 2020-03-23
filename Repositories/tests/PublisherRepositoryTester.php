<?php

namespace Repository\Tests
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
           
           // $logTool  = $this->getLogTool("echo")();

           $logTool  = \Log_Utilities\LogToolCreator::getCreateLogFn("echo")();//$this->getLogTool("echo")();

            $logTool->log("hihi im here :)");
            $configs =  \KConfigSet::createNewConfigs($settings );
            $params = [];
            $params["dbTool"]=$dbTool;
            $params["configSet"]=$configs;
            $params["logTool"]=$logTool;

            $toolBox = new \Repository\RepositoryToolBox($params);//$dbTool,$configs,$logTool);
            
            $toolBox->dbTool->connectToDB();
            $publisherRepo = new  \Repository\PublisherRepository($toolBox);
            $publisherRepo->findAll();
        }



    }




}



?>