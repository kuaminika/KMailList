<?php

namespace SETUP{
/**
 * this is the default command
 */

    require_once "ASetUpCommand.php";
    use SETUP\ASetUpCommand;

    class SetDBCommand extends ASetUpCommand
    {
          private $setUpName;
          public function __construct($dbTool,$logTool,$configSet)
          {
            $this->setUpName = "SetDBCommand";
            $this->dbTool = $dbTool;
            $this->logTool = $logTool;
            $this->configSet = $configSet;


          }  

          public function getName()
          {
              return $this->setUpName;
          }

          public function runSetUp()
          {

            $this->logTool->log("running :".$this->setUpName);
            
            $this->logTool->logWithTab("setting up DB");
            $this->dbTool->connectToDB();
            $this->logTool->logWithTab("done setting up DB");
          }
    }


}


?>