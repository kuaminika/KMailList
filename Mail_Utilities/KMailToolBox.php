<?php
namespace Mail_utilities;


require_once dirname(__FILE__)."/../KConfigSet.php";
//require_once dirname(__FILE__)."/../Log_Utilities/ILogTool.php";
class KMailToolBox
{    
    var $apikey;
    var $projectName;
    var $apisecret;
    var $logTool;
    var $sourceHost;
    var $purposedEmails;
    var $purposedEmailSenders;
    function __construct($mailConfigs,$logTool)//$apiKey,$apiSecret,$projectName)
    {
       // $mailConfigs = $configs->getConfig("mailConfigs");
        $mailConfigSet = \KConfigSet::createLocalConfigSet($mailConfigs);
        $this->apikey = $mailConfigSet->getConfig("apiKey");// $mailConfigs ["apiKey"];
        $this->apisecret = $mailConfigSet->getConfig("apiSecret");//$mailConfigs["apiSecret"];
        $this->projectName = $mailConfigSet->getConfig("projectName");//$mailConfigs["projectName"];

        $this->purposedEmails = $mailConfigSet->getConfig("purposedEmailConfigs");//$mailConfigs["purposedEmailConfigs"];
        $this->sourceHost =  $mailConfigSet->getConfig("sourceHost");
        $this->purposedEmailSenders =$mailConfigSet->getConfig("purposedEmailAuthor");// $mailConfigs["purposedEmailAuthor"];

        $this->logTool = $logTool;// $configs->getConfig("currentLogTool");
        
        $this->logTool->log("done constructing KMailToolBox");
    }

}


?>