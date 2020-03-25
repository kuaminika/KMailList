<?php

namespace Repository{

    require_once dirname(__FILE__)."/"."ARepository.php";
    require_once dirname(__FILE__)."/"."interfaces/IPublisherRepository.php";
    require_once dirname(__FILE__)."/"."../Models/StoredPubliser.php";
    require_once dirname(__FILE__)."/"."../Models/ModelList.php";
 //   require_once "../Models/interfaces/IModel.php";


  //  use models\interfaces\IModel;
    use models\ModelList;
    use models\StoredPublisher;
    use Repository\interfaces\IPublisherReposiory;

    class PublisherRepository extends ARepository implements IPublisherReposiory
    {
     

        public function __construct($toolBox) 
        {
            parent::__construct($toolBox);
            $usersTableName = $this->configSet->getConfig("usersTableName");
            $publishersTableName = $this->configSet->getConfig("publishersTableName");
        
            $this->_queryBoard["findAllQuery"] = "SELECT u.name 
                                                       , u.email 
                                                       , p.id as publisherId 
                                                       , u.id as user_id
                                                    FROM `".$usersTableName."` u 
                                                    INNER JOIN ".$publishersTableName." p on u.id = p.user_id";
        
            $this->_queryBoard["insertUserQuery"] = "INSERT INTO  `".$usersTableName."` (`name`, email) 
                                                          VALUES ('%s','%s');";

            $this->_queryBoard["insertUserQuery"] = "INSERT INTO  `".$usersTableName."` (`name`, email) 
            VALUES ('%s','%s');";

        }


        public function findById($id)
        {

            
        }

        public function insert( $newIModel ){}
        public function delete($id){}
        public function update($iModel){}
        public function findAll(){

            $findAllQuery = $this->_queryBoard["findAllQuery"];

            $dbResultSet =  $this->dbTool->runQuery( $findAllQuery)->fetchAll();
            
            $this->logTool->log("about to do fetching");
            $this->logTool->log($findAllQuery);

            $result =  new ModelList();
            for ($i=0; $i <sizeOf($dbResultSet) ; $i++)
            { 
               $currentRow =  $dbResultSet[$i];
               $result->add( new StoredPublisher($currentRow));
            }         
         
            $this->logTool->log($result->_toJson());
            
            return $result;

        }

    }

}
?>