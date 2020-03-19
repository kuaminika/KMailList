<?php

namespace SETUP{
/**
 * this is the default command
 */

    require_once "ExtraSetUpCommand.php";

    use Exception;
    use SETUP\ExtraSetUpCommand;

    class AddSubscriberListTable extends ExtraSetUpCommand
    {
/**
 * 
 *    "usersTableName" =>"Isaje",
 *   "publishersTableName"=>"Piblikate",
 *   "messagesTableName"=>"Mesaj",
 *   "listsTableName"=>"ListManb",
 *   "subscribersListTableName"=>"Manb_List",
  *  "subscribersTableName"=>"Manb"
 */
        public function _getName()
        {
            return "AddSubscriberListTable";
        }

        public function _runSetUp()
        {
            $tableName = $this->configSet->getConfig("subscribersListTableName");
            $fkHostTableName = $this->configSet->getConfig("publishersTableName");
            $fk2HostTableName = $this->configSet->getConfig("subscribersTableName");
          
            $tbExistRslt = $this->dbTool->tableExists( $tableName);      
            
            if($tbExistRslt) return;
            $this->dbTool->validateFKIsPossible($fkHostTableName,$tableName);
            $this->dbTool->validateFKIsPossible($fk2HostTableName,$tableName);

            $createUsersTblQuery = "CREATE TABLE `". $tableName."` (
              `subscriber_id` int(10) NOT NULL,
              `list_id` int(10) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            
          
            
            $this->dbTool->runQuery($createUsersTblQuery);

            $this->dbTool->fkBuildFKCommand($fk2HostTableName,$tableName,"subscriber_id","id");

            $this->dbTool->fkBuildFKCommand($fkHostTableName,$tableName,"list_id","id");
        }



    }
}
?>