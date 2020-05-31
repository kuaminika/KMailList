<?php 

namespace APISetUpTools;


class LaunchSetUpCommand extends ASetUpToolCommand
{


    public function __construct(SetUpTool $tool)
    {
        $this->tool = $tool;
    }

    public  function execute()
    {
        
            global  $dbSetUpConfigs,$globalSettings;


            $servername = $dbSetUpConfigs["servername"] ;
            $username =$dbSetUpConfigs["username"];
            $password= $dbSetUpConfigs["password"];
            $dbname = $dbSetUpConfigs["dbname"];            

            $dbTool = new  \DB_Utilities\MYSQL_DBTool($servername, $username, $password, $dbname);
            $logTool_main = new \Log_Utilities\EchoLogTool("logTool_main");
            $logTool = new \Log_Utilities\EchoLogTool("SetUpLog");
            $logTool->log($dbname);
           
            try
            {

                $configs =  \KConfigSet::createNewConfigs($globalSettings );

                $logTool_main->log("about to instanciate SetDBCommand");
                $dbCommand = new \SETUP\SetDBCommand($dbTool,$logTool,$configs);
                $logTool_main->log("finshed to instanciate SetDBCommand");

                //$dbCommand->runSetUp();

                $builder = new \SETUP\SetUpBuilder($dbCommand);

                $builder->addSetup("SetUpLogTool");
                $builder->addSetup("SetUpLogTool")->runSetUp();
                $newLogTool =    $builder->getCommand()->getLogTool();
                $builder->reset();
                $builder->setLogTool($newLogTool);
                $builder->addSetup("AddUsersTableCommand");
                $builder->addSetup("AddPublishersTable");
                
                $builder->addSetup("AddListTable");
                $builder->addSetup("AddSubscribersTable");
                
                $builder->addSetup("AddSubscriberListTable");
                $builder->addSetup("AddMessagesTable");
                $builder->getCommand()->runSetUp();
            }
            catch(\Exception  $e)
            {
                $logTool_main->showObj($e);
            }
    }
}