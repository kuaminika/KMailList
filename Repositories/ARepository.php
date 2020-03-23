<?php

namespace Repository
{
    require_once  dirname(__FILE__)."/../Models/ModelList.php";
    use \models\ModelList;

    class ARepository
    {
        protected $_queryBoard;
        protected $configSet;
        protected $dbTool;
        protected $logTool;

        public function __construct($toolBox)
        {
            $this->dbTool = $toolBox->dbTool;
            $this->configSet = $toolBox->configSet;// \KConfigSet::getCurrentConfigs();
            $this->_queryBoard = [];
            $this->logTool = $toolBox->logTool;
        }


        protected function _insert( $insertArgs)
        {
            $query = vsprintf($this->_queryBoard["insertQuery"],$insertArgs);

            $this->logTool->log("about to trun queyr:");
            $this->logTool->log($query);
            $this->dbTool->runQuery($query);
        }

        protected function _findAll($storedModelType)
        {
            
            $findAllQuery = $this->_queryBoard["findAllQuery"];

            $dbResultSet =  $this->dbTool->runQuery( $findAllQuery)->fetchAll();
            
            $this->logTool->log("about to do fetching");
            $this->logTool->log($findAllQuery);

            $result =  new ModelList();
            for ($i=0; $i <sizeOf($dbResultSet) ; $i++)
            { 
               $currentRow =  $dbResultSet[$i];
               $result->add( new $storedModelType($currentRow));
            }         
            $this->logTool->showObj(  $result);
            
            $this->logTool->log($result->_toJson());
            
            return $result;
        }

    }
}


?>