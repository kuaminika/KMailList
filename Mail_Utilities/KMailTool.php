<?php
namespace Mail_utilities;
require_once dirname(__FILE__)."/KMailToolBox.php";

abstract class KMailTool
{
    var $apikey;
    var $projectName;
    var $apisecret;
    var $sourceHost;
    protected $logTool;
    
    function __construct(KMailToolBox $toolBox)
    {
  
        $this->apikey = $toolBox->apikey;
        $this->apisecret = $toolBox->apisecret;
        $this->projectName = $toolBox->projectName;
        $this->sourceHost = $toolBox->sourceHost;
        $this->logTool = $toolBox->logTool;
        $this->logTool->log("done constructing kmailtool");
    }
    
    function showDataPretty($data)    
    {     
        $this->logTool->log("supposed to get some");
        $this->logTool->showObj($data);

       // echo '<pre>' . var_export($data, true) . '</pre>';               
    }
}


?>