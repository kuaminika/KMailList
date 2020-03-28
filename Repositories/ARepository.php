<?php

namespace Repository
{
    require_once  dirname(__FILE__)."/../Models/ModelList.php";
    require_once dirname(__FILE__)."/../Models/KError.php";
    require_once dirname(__FILE__)."/../K_Utilities/KException.php";
    require_once dirname(__FILE__)."/../K_Utilities/KErrorCodeMap.php";

    use K_Utilities\KErrorCodeMap;
    use K_Utilities\KException;
    use \models\ModelList;
    use \models\KError;

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
            $usersTableName = $this->configSet->getConfig("usersTableName");
            $this->_queryBoard["selectUserByEmailQuery"] = "SELECT id from `".$usersTableName."` WHERE email = '%s'";
            $this->_queryBoard["insertUserQuery"] = "INSERT INTO  `".$usersTableName."` ( `name`, email) values ('%s','%s');";
        }



        protected function getFunctionAddress($functionName)
        {
            $result = get_class($this)."-->".$functionName;

            return $result;
        }

        protected function logAndThrow($errorCode,$location,$errorMessage=null)
        {
            $errorMessage = isset($errorMessage)? $errorMessage : KErrorCodeMap::errorCodeDescription($errorCode);
            $error = new KError($errorMessage,$location,$errorCode);

            $this->logTool->log($error->_toJson());


            $exception = new KException($error);

            throw $exception;


        }

        protected function _insert( $insertArgs)
        {
            $query = vsprintf($this->_queryBoard["insertQuery"],$insertArgs);

            $this->logTool->log("about to trun queyr:");
            $this->logTool->log(json_encode($query));
            $this->dbTool->runQuery($query);
        }


        protected function _convertResultSetToStoredTypeList($storedModelType,$dbResultSet)
        {

            $result =  new ModelList();
            for ($i=0; $i <sizeOf($dbResultSet) ; $i++)
            { 
               $currentRow =  $dbResultSet[$i];
               $result->add( new $storedModelType($currentRow));
            }      
            return $result;   
        }

        protected function _findAll($storedModelType)
        {
            
            $findAllQuery = $this->_queryBoard["findAllQuery"];

            $dbResultSet =  $this->dbTool->runQuery( $findAllQuery)->fetchAll();
            
            $this->logTool->log("about to do fetching");
            $this->logTool->log($findAllQuery);

            $result =  $this->_convertResultSetToStoredTypeList($storedModelType, $dbResultSet);      
            $this->logTool->showObj(  $result);
            
            $this->logTool->log($result->_toJson());
            
            return $result;
        }

    }
}


?>