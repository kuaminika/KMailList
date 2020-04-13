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
            $fkHostTableName = $this->configSet->getConfig("listsTableName");
            $fk2HostTableName = $this->configSet->getConfig("subscribersTableName");
          
            $tbExistRslt = $this->dbTool->tableExists( $tableName);      
            
            if($tbExistRslt) return;
            $this->dbTool->validateFKIsPossible($fkHostTableName,$tableName);
            $this->dbTool->validateFKIsPossible($fk2HostTableName,$tableName);

            $createUsersTblQuery = "CREATE TABLE `". $tableName."` (
                `id` int(10) NOT NULL,
              `subscriber_id` int(10) NOT NULL,
              `list_id` int(10) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            
          
            
            $this->dbTool->runQuery($createUsersTblQuery);
            $this->dbTool->runQuery("ALTER TABLE `". $tableName."`ADD PRIMARY KEY (`id`);");
            $this->dbTool->runQuery("ALTER TABLE `". $tableName."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

            $this->dbTool->runQuery("ALTER TABLE `". $tableName."` ADD UNIQUE( `subscriber_id`, `list_id`);");

            $this->dbTool->fkBuildFKCommand($fk2HostTableName,$tableName,"subscriber_id","id");

            $this->dbTool->fkBuildFKCommand($fkHostTableName,$tableName,"list_id","id");
        }



    }
}
?>