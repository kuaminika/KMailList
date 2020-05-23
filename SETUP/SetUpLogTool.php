<?php

namespace SETUP{
/**
 * this is the default command
 */

    require_once "ExtraSetUpCommand.php";

    require_once dirname(__DIR__)."/Log_Utilities/DBTableLogTool.php";
    use Exception;
    use Log_Utilities\DBTableLogTool;
    use SETUP\ExtraSetUpCommand;

    class SetUpLogTool extends ExtraSetUpCommand
    {

        public function _getName()
        {
            return "SetUpLogTool";
        }

        public function _runSetUp()
        {
            $tableName = $this->configSet->getConfig("logToolTableName");
         
          
            $tbExistRslt = $this->dbTool->tableExists( $tableName);      
            
            if($tbExistRslt) 
            {
                
            $this->setDBLogTool($tableName);
            return;
            }
            $createUsersTblQuery = "CREATE TABLE `". $tableName."` (
              `id` int(10) NOT NULL,
              `LOG_CONTENT` TEXT NOT NULL,
              `LOG_DATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            
          
            
            $this->dbTool->runQuery($createUsersTblQuery);

            $this->dbTool->runQuery("ALTER TABLE `". $tableName."`ADD PRIMARY KEY (`id`);");
            $this->dbTool->runQuery("ALTER TABLE `". $tableName."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
            
            $this->setDBLogTool($tableName);
        }


        private function setDBLogTool($tableName)
        {
            $this->logTool->log("setting log");

            $params = array(
                "name"=>$this->_getName(),
               "dbTool"=>$this->dbTool,
               "logTableName"=>$tableName
            );

            $this->setLogTool(new \Log_Utilities\DBTableLogTool($params));

        }

    }
}
?>