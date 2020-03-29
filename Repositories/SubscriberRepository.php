<?php

namespace Repository;
require_once dirname(__FILE__)."/interfaces/IRepository.php";
require_once dirname(__FILE__)."/ARepository.php";
require_once dirname(__FILE__)."/../Models/StoredSubscriber.php";

use DateTime;
use Exception;
use models\FormedOutSubscriber;
use models\StoredSubscriber;
use Repository\interfaces\IRepository;

class SubscriberRepository extends ARepository implements IRepository
{


    public function __construct($toolBox) 
    {
        parent::__construct($toolBox);
        $usersTableName = $this->configSet->getConfig("usersTableName");
        $subscribersTableName = $this->configSet->getConfig("subscribersTableName");
        $listMemebersTable =$this->configSet->getConfig("subscribersListTableName");
        $listsTableName = $this->configSet->getConfig("listsTableName");
    
        //generic query to define
        $this->_queryBoard["findAllQuery"] = "SELECT u.name 
                                                   , u.email 
                                                   , s.id as id 
                                                   , u.id as user_id
                                                   , s.date_subscribed
                                                   , s.added_by_id
                                                   , addor.name added_by
                                              FROM `".$usersTableName."` u 
                                              INNER JOIN `".$subscribersTableName."` s on u.id = s.user_id
                                              INNER JOIN ".$usersTableName." addor on addor.id = s.added_by_id ";
        
        //unique queries
        $this->_queryBoard["selectSubscriberByEmailQuery"] = $this->_queryBoard["findAllQuery"] . " WHERE u.email = '%s' ";
        $this->_queryBoard["insertSubscriberQuery"] = "INSERT INTO  `".$subscribersTableName."` ( user_id,date_subscribed,added_by_id ) values (%d,'%s',%d );";

        $this->_queryBoard["insertSubscriberToList"] = "INSERT INTO ". $listMemebersTable." (subscriber_id,list_id) values (%d,%d);"; 

        $this->_queryBoard["selectSubscribersForList"] =   "SELECT u.name 
                                                                , u.email 
                                                                , l.name as list_name
                                                                , l.id as list_id
                                                                , s.id as id 
                                                                , u.id as user_id
                                                                , s.date_subscribed
                                                                , s.added_by_id
                                                                , addor.name added_by
                                                          FROM `".$usersTableName."` u 
                                                          INNER JOIN `".$subscribersTableName."` s on u.id = s.user_id
                                                          INNER JOIN `".$usersTableName."` addor on addor.id = s.added_by_id 
                                                          INNER JOIN `". $listMemebersTable."` m on m.subscriber_id = s.id
                                                          INNER JOIN `".$listsTableName."` l on l.id = m.list_id ";

    }


    public function getSubscriberInListLike( $listId)
    {

        $this->logTool->showObj($listId);
        $query =  $this->_queryBoard["selectSubscribersForList"]." WHERE m.list_id=".$listId;
        $this->logTool->log($query);
        $dbResultSet =   $this->dbTool->runQuery($query)->fetchAll();
        $result =  $this->_convertResultSetToStoredTypeList("models\StoredSubscriber",$dbResultSet);
        return $result;
    }


    public function addSubscriberToList($storedSubscriber,$listId)
    {

        $subscriberId = $storedSubscriber->getSubscriberId();
        try{
      //  $subscriberId = $storedSubscriber->getSubscriberId();
        $insertQuery = sprintf($this->_queryBoard["insertSubscriberToList"],$subscriberId,$listId);
        $this->dbTool->runQuery($insertQuery);

       $dbResultSet =  $this->dbTool->runQuery($this->_queryBoard["selectSubscribersForList"])->fetchAll();
       $result =  $this->_convertResultSetToStoredTypeList("models\StoredSubscriber",$dbResultSet);
       return $result;
        }
        catch(Exception $ex)
        {
            
           $ducplicateError = sprintf("Duplicate entry '%s' for key 'unique_list_subscriber'",$subscriberId."-".$listId);
           $itsDublicate =  strpos($ex->getMessage(), $ducplicateError) ;

            if($itsDublicate)
            {
                $location = $this->getFunctionAddress("addSubscriberToList");
                $this->logAndThrow("alreadyExists",$location);
            }

           echo $itsDublicate ? "its duplicate":"0";
           echo $ex->getMessage();
        }
    }

    public function getOrInsert($formedOUtModel)
    {
        $newIModel = $formedOUtModel;
        $selectQuery =  sprintf($this->_queryBoard["selectSubscriberByEmailQuery"],$newIModel->getEmail());
        $arrUserResult = $this->dbTool->runQuery( $selectQuery)->fetchArray();
        $subscriberExists =  isset($arrUserResult["id"]);
 
        $this->logTool->log("it exsits:");
        $this->logTool->log( $subscriberExists);

        if( !$subscriberExists)
        {
            $insertedSubscriber =   $this->insert( $newIModel );
            return $insertedSubscriber;
        }

        $storedSubscriber = new StoredSubscriber($arrUserResult);

        return $storedSubscriber;
    }


    
    public function subscriberExistsInList(FormedOutSubscriber $subscriberFromForm)
    {
        $query =  $this->_queryBoard["selectSubscribersForList"] ;

        $dbRow =  $this->dbTool->runQuery($query)->fetchArray(); 

        $found = new \models\StoredSubscriber($dbRow);
         return  $found ;
    }


    public function insert( $formedOUtModel )
    {
        $newIModel = $formedOUtModel;
        try
        {
           $user_id =  $this-> insertUserPart( $newIModel );
           $addedById = $newIModel->getAddedById();
           $addedById = $addedById>1?$addedById :$user_id;
           $dateAdded = $newIModel->getDateAdded();
            
          $d = new \DateTime();
          $myFormatForView =  $this->dbTool->convertDate($d);

          $dateAdded = isset($dateAdded)?$dateAdded: $myFormatForView;
          $insertArgs = [$user_id,$myFormatForView,  $addedById];
          $query = vsprintf($this->_queryBoard["insertSubscriberQuery"],$insertArgs);
         
          $this->dbTool->runQuery($query);

          $selectQuery =  sprintf($this->_queryBoard["selectSubscriberByEmailQuery"],$newIModel->getEmail());
          $arrUserResult = $this->dbTool->runQuery( $selectQuery)->fetchArray(); 

          $result = new StoredSubscriber($arrUserResult);
          
          return $result;
        }
        catch(Exception $ex)
        {
           $ducplicateError = sprintf("Duplicate entry '%s' for key 'email'",$newIModel->getEmail());
            

           $itsDublicate =  strpos($ex->getMessage(), $ducplicateError) ;
           echo $itsDublicate ? "its duplicate":"0";
           echo $ex->getMessage();

        }


    }



    protected function insertUserPart( $newIModel )
    {
        try
        {
            $insertArgs = [$newIModel->getName(),$newIModel->getEmail()];
            $insertUserQuery = vsprintf($this->_queryBoard["insertUserQuery"],$insertArgs);
        
            $this->logTool->log("about to trun queyr:");
            $this->logTool->log( $insertUserQuery);
            $this->dbTool->runQuery( $insertUserQuery);
            $id=  $this->dbTool->getInsertId();
            $this->logTool->log("id from user:".$id);


            return $id;
        }
        catch(Exception $ex)
        {
           $ducplicateError = sprintf("Duplicate entry '%s' for key 'email'",$newIModel->getEmail());
           $itsDublicate =  strpos($ex->getMessage(), $ducplicateError) ;
          
           if(!$itsDublicate)
            { 
                $this->logTool->log( $ex->getMessage());
                die();
            }

            $selectQuery = sprintf($this->_queryBoard["selectUserByEmailQuery"] ,$newIModel->getEmail());
            echo $selectQuery;
            $arrUserResult = $this->dbTool->runQuery( $selectQuery)->fetchArray();
             
            $id = $arrUserResult["id"];

            return $id;


        }


    }


    public function delete($id){}
    public function update($iModel){}
    public function findAll(){

        $result =  $this->_findAll("models\StoredSubscriber");
        return $result;        

    }
}



?>