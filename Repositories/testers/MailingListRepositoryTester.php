<?php
namespace Repository\Testers{


    
    require_once "requireCommon.php";
   require_once dirname(__FILE__)."/"."../MailingListRepository.php";
   require_once dirname(__FILE__)."/"."../../Models/FormedOutMailingListDescription.php";

  
  use \models\FormedOutMailingListDescription;

    class MailingListRepositoryTester
    {
        //TODO make sure that theres one method for that only
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

        public function testAddingMailingList()
        {
                
            global $globalSettings,$dbSetUpConfigs; 


            echo "<h2>test adding new mailing list</h2>";

            $servername = $dbSetUpConfigs["servername"];
            $username =  $dbSetUpConfigs["username"];
            $password=  $dbSetUpConfigs["password"];
            $dbname =  $dbSetUpConfigs["dbname"];         

                        
            $settings = $globalSettings;
            $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);
           
            $logTool  = $this->getLogTool("echo")();

            $configs =  \KConfigSet::createNewConfigs($settings );
            $toolBox = new \Repository\RepositoryToolBox($dbTool,$configs,$logTool);
            
            $toolBox->dbTool->connectToDB();
            $repo = new  \Repository\MailingListRepository($toolBox);


            $rawFormMailingListDescription = [];

            $d = new \DateTime();

            $rawFormMailingListDescription ["name"]="Test from index". $d->format('Y-m-d\TH:i:s.u');
            $rawFormMailingListDescription ["owner_id"]=1;
            $rawFormMailingListDescription ["owner_user_id"]=1;
            $rawFormMailingListDescription ["owner_name"]="dont matter";
            $rawFormMailingListDescription ["owner_email"]="dont matter";


            $specimen = new FormedOutMailingListDescription($rawFormMailingListDescription);

             $repo->insert($specimen);




        }



    }


}

?>