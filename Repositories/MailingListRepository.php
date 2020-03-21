<?php

namespace Repository{

    require_once "./ARepository.php";
    require_once "./interfaces/IMailingListRepository.php";
   require_once "../Models/interfaces/IModel.php";
    require_once "../Models/interfaces/IMailingList.php";
    require_once "../Models/ModelList.php";
    require_once "../Models/StoredMailingListDescription.php";

    use models\ModelList;
    use models\StoredMalingListDescription;
    use Repository\interfaces\IMailingListRepository;

    class MailingListRepository extends ARepository implements IMailingListRepository
    {
     

        public function __construct($toolBox) 
        {
            parent::__construct($toolBox);
            print "In SubClass constructor\n";


            /*  $globalSettings = array(
                 "usersTableName" =>"User",
                "publishersTableName"=>"Publisher",
                "messagesTableName"=>"Message",
                "listsTableName"=>"MailingList",
                "subscribersListTableName"=>"SubscriberList",
                "subscribersTableName"=>"Subscriber",
                "logToolTableName"=>"Log"
            );
             * 
             */
            $listsTableName = $this->configSet->getConfig("listsTableName");
            $publishersTableName = $this->configSet->getConfig("publishersTableName");
            $usersTableName = $this->configSet->getConfig("usersTableName");
 
            $this->_queryBoard["insertQuery"] = "INSERT INTO `".$listsTableName."` (`owner_id`, `name`) VALUES ('%d', '%s')";
            $this->_queryBoard["findAllQuery"] = "SELECT ml.name                                                     
                                                        , u.email as owner_email
                                                        , p.id    as owner_id 
                                                        , u.id    as user_id
                                                        , ml.id   as mailingList_id
                                                        , u.name  as owner_name
                                                    FROM `".$listsTableName."` ml
                                                    INNER JOIN ".$publishersTableName." p on ml.owner_id = p.id
                                                    INNER JOIN ".$usersTableName." u on p.user_id = u.id";

        }


        public function findById($id)
        {


        }

        public function insert( $newIModel )
        {

            $ml =  $newIModel;
            $ownerId= $ml->getOwner()->id;
            $name = $ml->getName();
            $query =  sprintf($this->_queryBoard["insertQuery"], $ownerId,$name); 

            $this->logTool->log("about to trun queyr:");
            $this->logTool->log($query);
            $this->dbTool->runQuery($query);
        }
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
               $result->add( new StoredMalingListDescription($currentRow));
            }         
         
            $this->logTool->log($result->_toJson());
            
            return $result;
       
        }

    }

}
?>