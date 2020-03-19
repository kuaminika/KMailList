<?php

namespace SETUP{
/**
 * this is the default command
 */

    require_once "ExtraSetUpCommand.php";

    use Exception;
    use SETUP\ExtraSetUpCommand;

    class AddListTable extends ExtraSetUpCommand
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
            return "AddListTable";
        }

        public function _runSetUp()
        {
            $tableName = $this->configSet->getConfig("listsTableName");
            $fkHostTableName = $this->configSet->getConfig("publishersTableName");
          
            $tbExistRslt = $this->dbTool->tableExists( $tableName);      
            
            if($tbExistRslt) return;
            $this->dbTool->validateFKIsPossible($fkHostTableName,$tableName);

            $createUsersTblQuery = "CREATE TABLE `". $tableName."` (
              `id` int(10) NOT NULL,
              `owner_id` int(10) NOT NULL,
              `name` varchar(500) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
            
          
            
            $this->dbTool->runQuery($createUsersTblQuery);

            $this->dbTool->runQuery("ALTER TABLE `". $tableName."`ADD PRIMARY KEY (`id`);");
            $this->dbTool->runQuery("ALTER TABLE `". $tableName."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

            $this->dbTool->fkBuildFKCommand($fkHostTableName,$tableName,"owner_id","id");
        }



    }
}
?>