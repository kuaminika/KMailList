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
            $configs =  \KConfigSet::getCurrentConfigs();
           
           // $logTool  = $this->getLogTool("echo")();

        //   $logTool  = \Log_Utilities\LogToolCreator::getCreateLogFn("echo")();//$this->getLogTool("echo")();
            $logTool =$configs->logTool;
            $dbTool = $configs->dbTool;
            $logTool->log("hihi im here :)");
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