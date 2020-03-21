<?php

namespace DB_Utilities{

 interface IDBTool{

 
    public function connectToDB();
    public function runQuery($query);
    public function tableExists($tableName);
    public function fkBuildFKCommand($fkHostTableName,$tableName,$localColumn,$foreignColumn);
    public function validateFKIsPossible($fkHostTableName,$tableName); 

 }



}



?>