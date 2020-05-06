<?php
namespace Mail_utilities;

require_once dirname(__DIR__)."/Security_Utilities/Token_Utilities/KTokenFacade.php";

require_once dirname(__FILE__)."/../KConfigSet.php";
use Security_Utilities\Token_Utilities\KTokenFacade;
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
    var $tokenFacade;
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

       // $tokenToolBox = KTokenFacade::createToolBox();
        $this->tokenFacade =  KTokenFacade::create();
        
        $this->logTool->log("done constructing KMailToolBox");
    }

}


?>