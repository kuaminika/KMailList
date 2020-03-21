<?php

namespace Repository{

    require_once "./ARepository.php";
    require_once "./interfaces/IPublisherRepository.php";
    require_once "../Models/StoredMessage.php";
    require_once "../Models/FormedOutMessage.php";
    require_once "../Models/ModelList.php";

    use models\ModelList;
    use models\StoredMessage;
    use Repository\interfaces\IPublisherReposiory;

    class MessageRepository extends ARepository implements IPublisherReposiory
    {
     

        public function __construct($toolBox) 
        {
            parent::__construct($toolBox);
            print "In SubClass constructor\n";
            $usersTableName = $this->configSet->getConfig("usersTableName");
            $publishersTableName = $this->configSet->getConfig("publishersTableName");
        
            $this->_queryBoard["findAllQuery"] = "SELECT u.name 
                                                       , u.email 
                                                       , p.id as publisherId 
                                                       , u.id 
                                                    FROM `".$usersTableName."` u 
                                                    INNER JOIN ".$publishersTableName." p on u.id = p.user_id";

        }


        public function findById($id)
        {


        }

        public function insert(StoredMessage $newIModel )
        {




        }
        public function delete($id){}
        public function update($iModel){}
        public function findAll(){

       
        }

    }

}
?>