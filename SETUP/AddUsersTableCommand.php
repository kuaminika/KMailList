<?php

namespace SETUP{


    require_once "ExtraSetUpCommand.php";
    use SETUP\ExtraSetUpCommand;

    class AddUsersTableCommand extends ExtraSetUpCommand
    {

        public function _getName()
        {
            return "AddUsersTable";
        }

        public function _runSetUp()
        {

            $tableName = $this->configSet->getConfig("usersTableName");

            $tbExistRslt = $this->dbTool->tableExists( $tableName);      
            
            if($tbExistRslt) return;

            $createUsersTblQuery = "CREATE TABLE `". $tableName."` (
                `id` int(10) NOT NULL,
                `email` varchar(200) NOT NULL,
                `name` varchar(300) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;  
            ";
            

            $this->dbTool->runQuery($createUsersTblQuery);

            $this->dbTool->runQuery("ALTER TABLE `". $tableName."`ADD PRIMARY KEY (`id`);");
            $this->dbTool->runQuery("ALTER TABLE `". $tableName."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

        }



    }
}
?>