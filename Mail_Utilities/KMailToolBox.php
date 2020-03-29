<?php
namespace Mail_utilities;
//require_once dirname(__FILE__)."/../Log_Utilities/ILogTool.php";
class KMailToolBox
{    
    var $apikey;
    var $projectName;
    var $apisecret;
    var $logTool;

    function __construct($mailConfigs)//$apiKey,$apiSecret,$projectName)
    {
  
        $this->apikey = $mailConfigs["apiKey"];
        $this->apisecret = $mailConfigs["apiSecret"];
        $this->projectName = $mailConfigs["projectName"];

        $this->logTool = $mailConfigs["logTool"];
        
        $this->logTool->log("done constructing KMailToolBox");
    }

}


?>