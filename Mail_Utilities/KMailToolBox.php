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
    var $mainRecipientPublisher;
    var $itRecipientList;

    private $commandListMap;
    function __construct($mailConfigs,$logTool)
    {
       
        $mailConfigSet = \KConfigSet::createLocalConfigSet($mailConfigs);
        $this->apikey = $mailConfigSet->getConfig("apiKey");
        $this->apisecret = $mailConfigSet->getConfig("apiSecret");
        $this->projectName = $mailConfigSet->getConfig("projectName");
        $this->mainRecipientPublisher = $mailConfigSet->getConfig("businessRecipientList")[0];
        $this->purposedEmails = $mailConfigSet->getConfig("purposedEmailConfigs");
        $this->sourceHost =  $mailConfigSet->getConfig("sourceHost");
        $this->purposedEmailSenders =$mailConfigSet->getConfig("purposedEmailAuthor");
        $this->itRecipientList = $mailConfigSet->getConfig("itRecipientList");
        $this->logTool = $logTool;

        $this->tokenFacade =  KTokenFacade::create();
        $this->commandListMap =  $mailConfigSet->getConfig("commandListMap");
        $this->logTool->log("done constructing KMailToolBox");
    }


    public function createEchoLog()
    {
      $newEchoLogFn =   \KConfigSet::getCurrentConfigs()->getConfig("newEchoLogFn");

      return $newEchoLogFn();
    }
    public function GetExtraCommandList($commandListName)
    {
        $result = $this->commandListMap[$commandListName];
        return $result;
    }

}


?>