<?php 


namespace APISetUpTools;

class LogRepository extends SetUpTool
{
    private $inner;
    private $logTableName;

    function __construct(SetUpTool $inner)
    {
        $this->inner = $inner;
        $this->dbTool = $inner->dbTool;
        $this->dbLogTool = $inner->dbLogTool;
        $this->logTableName = $this->inner->dbLogTool->getLogTableName();
    }


    public function getAllLogs()
    {
       $query =  "SELECT * FROM `".$this->logTableName."`";
       $dbResultSet =   $this->dbTool->runQuery($query)->fetchAll();
       return $dbResultSet;

    }
}