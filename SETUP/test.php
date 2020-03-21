<?php




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "../Log_Utilities/EchoLogTool.php";
require_once "./SetDBCommand.php";
require_once "./SetUpBuilder.php";
require_once "../DB_Utilities/MYSQL_DBTool.php";
require_once "../KConfigSet.php";

$servername = "localhost";
$username = "datauser";
$password= "data100";
$dbname = "K_mail_list";            

$dbTool = new  DB_Utilities\MYSQL_DBTool($servername, $username, $password, $dbname);
$logTool_main = new Log_Utilities\EchoLogTool("logTool_main");
$logTool = new Log_Utilities\EchoLogTool("SetUpLog");

$settings = array(
    "usersTableName" =>"User",
    "publishersTableName"=>"Publisher",
    "messagesTableName"=>"Message",
    "listsTableName"=>"MailingList",
    "subscribersListTableName"=>"SubscriberList",
    "subscribersTableName"=>"Subscriber",
    "logToolTableName"=>"Log"
);


try
{

    $configs =  \KConfigSet::createNewConfigs($settings );

    $logTool_main->log("about to instanciate SetDBCommand");
    $dbCommand = new SETUP\SetDBCommand($dbTool,$logTool,$configs);
    $logTool_main->log("finshed to instanciate SetDBCommand");

    //$dbCommand->runSetUp();

    $builder = new SETUP\SetUpBuilder($dbCommand);

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
catch(Exception  $e)
{
    $logTool_main->showObj($e);
}
//AddUsersTableCommand
?>