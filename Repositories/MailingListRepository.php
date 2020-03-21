<?php

namespace Repository{

    require_once "./ARepository.php";
    require_once "./interfaces/IMailingListRepository.php";
   // require_once "../Models/StoredMessage.php";
 //   require_once "../Models/FormedOutMessage.php";
    require_once "../Models/interfaces/IModel.php";
    require_once "../Models/interfaces/IMailingList.php";
    require_once "../Models/ModelList.php";

    use models\interfaces\IMailingList;
    use models\interfaces\IModel;
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
            
            $this->_queryBoard["insertQuery"] = "INSERT INTO `".$listsTableName."` (`owner_id`, `name`) VALUES ('%d', '%s')";


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

       
        }

    }

}
?>