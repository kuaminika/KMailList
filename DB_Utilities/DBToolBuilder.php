<?php

namespace DB_Utilities
{
    class DBToolBuilder{

       
        private $configs;
        public function __construct($configs)
        {

            $this->configs = $configs;
/*
            $this->dbChosenDBToolName = $configs["dbChosenDBToolName"];
            $this->servername= $configs["servername"];
            $this->username =$configs["username"];
*/
        }

        
        public function buildDBTool()
        {
            $dbChosenDBToolName = $this->configs["dbChosenDBToolName"];
            $servername= $this->configs["servername"];
            $username =$this->configs["username"];
            $password = $this->configs["password"];
            $dbname = $this->configs["dbname"];



            $db = new $dbChosenDBToolName($servername, $username, $password, $dbname);
            return $db;

        }
    }
}

 
?>