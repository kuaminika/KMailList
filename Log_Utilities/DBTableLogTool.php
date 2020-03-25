<?php

namespace Log_Utilities{

use Exception;

require_once "ILogTool.php";

 class DBTableLogTool implements ILogTool 
 {
    private $name;
    private $dbTool;
    private $logTableName;

    public function __construct($params)
    {
       $name= $params["name"];

        $this->name = isset($name)? $name:"log";

        $this->dbTool = $params["dbTool"] ;
        $this->logTableName = $params["logTableName"] ;


        $this->writeInDB( "log tool:".$this->name."-created"); 

    }

    public function logWithTab($str)
    {
        $this->writeInDB(  "--->"."-".$this->name.":". $str); 
    }



      private function writeInDB($str)
      {
        $str = str_replace("'", "\'", $str);
      
        $cmd = "INSERT INTO `".$this->logTableName."` (`id`, `LOG_CONTENT`, `LOG_DATE`) VALUES (NULL, '".$str."', CURRENT_TIMESTAMP);";
        try{
          $this->dbTool->runQuery($cmd);
        }
        catch(Exception $ex)
        {
            echo "cmd:".$cmd;
            echo "</br>";
            echo $ex->getMessage();
        }
     
        }


    public function log($str)
    {
        $this->writeInDB(   "-".$this->name.":". $str); 
    }

    public function showObj($obj)
    {   
        $str = json_encode($obj);

        $this->writeInDB(   "-".$this->name.":". $str);   

    }



 }


}

?>