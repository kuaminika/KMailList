<?php

namespace Repository{

    require_once dirname(__FILE__)."/ARepository.php";
    require_once dirname(__FILE__)."/interfaces/IMailingListRepository.php";
    require_once dirname(__FILE__)."/../Models/StoredMessage.php";
    require_once dirname(__FILE__)."/../Models/FormedOutMessage.php";
    require_once dirname(__FILE__)."/../Models/ModelList.php";

    //require_once dirname(__FILE__)."/../Models/FormedOutMessage.php";

    //use models\ModelList;
    //use models\StoredMessage;
    use Repository\interfaces\IMailingListRepository;

    class MessageRepository extends ARepository implements IMailingListRepository
    {
        public function __construct($toolBox) 
        {
            parent::__construct($toolBox);
            $usersTableName = $this->configSet->getConfig("usersTableName");
           // $listsTableName = $this->configSet->getConfig("listsTableName");           
            $messagesTableName = $this->configSet->getConfig("messagesTableName");

            $this->_queryBoard["findAllQuery"] = "SELECT u.name     as author_name
                                                       , u.email    as author_email 
                                                       , u.id       as author_id
                                                       , m.id       as message_id 
                                                       , m.title    as title
                                                       , m.content  as content
                                                       , m.last_update_date 
                                                       , m.list_id  
                                                       , m.sent_date
                                                    FROM `".$usersTableName."` u 
                                                    INNER JOIN ".$messagesTableName." m on u.id = m.author_id";
                                                  //  INNER JOIN ".$listsTableName." ml on ml.id = ml.list_id ";

        }


        public function findById($id)
        {


        }

        public function insert( $newIModel )
        {




        }
        public function delete($id){}
        public function update($iModel){}
        public function findAll(){

            $result =  $this->_findAll("models\StoredMessage");
            return $result;       
       
        }

    }

}
?>