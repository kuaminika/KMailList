<?php

namespace SETUP{
/**
 * this is the default command
 */

    require_once "ExtraSetUpCommand.php";
    use SETUP\ExtraSetUpCommand;

    class AddSubscribersTable extends ExtraSetUpCommand
    {

        public function _getName()
        {
            return "AddSubscribersTable";
        }

        public function _runSetUp()
        {

            $tableName = $this->configSet->getConfig("subscribersTableName");
            $fkHostTableName = $this->configSet->getConfig("usersTableName");
          

            $tbExistRslt = $this->dbTool->tableExists( $tableName);      
            
            if($tbExistRslt) return;
            $this->dbTool->validateFKIsPossible($fkHostTableName,$tableName);

            $createUsersTblQuery = "CREATE TABLE `". $tableName."` (
                `id` int(10) NOT NULL,
                `user_id` int(10) NOT NULL,
                `date_subscribed` DATETIME NOT NULL,
                `added_by_id` int NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;  
            ";
            

            $this->dbTool->runQuery($createUsersTblQuery);

            $this->dbTool->runQuery("ALTER TABLE `". $tableName."`ADD PRIMARY KEY (`id`);");
            $this->dbTool->runQuery("ALTER TABLE `". $tableName."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

            $this->dbTool->fkBuildFKCommand($fkHostTableName,$tableName,"user_id","id");
        }



    }
}
?>