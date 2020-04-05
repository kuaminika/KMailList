<?php

namespace Repository{

    require_once dirname(__FILE__)."/"."ARepository.php";
    require_once dirname(__FILE__)."/"."interfaces/IRepository.php";
    require_once dirname(__FILE__)."/"."../Models/StoredMailingListDescription.php";
    require_once dirname(__FILE__)."/"."../Models/ModelList.php";
    //use Repository\interfaces\IMailingListRepository;
    use Repository\interfaces\IRepository;

    class MailingListRepository extends ARepository implements IRepository// IMailingListRepository
    {
     

        public function __construct($toolBox) 
        {
            parent::__construct($toolBox);
           
            $listsTableName = $this->configSet->getConfig("listsTableName");
            $publishersTableName = $this->configSet->getConfig("publishersTableName");
            $usersTableName = $this->configSet->getConfig("usersTableName"); 
            $listMemebersTable =$this->configSet->getConfig("subscribersListTableName");

            $this->_queryBoard["insertQuery"] = "INSERT INTO `".$listsTableName."` (`owner_id`, `name`) VALUES (%d, '%s')";
            $this->_queryBoard["findAllQuery"] = "SELECT ml.name                                                     
                                                        , u.email as owner_email
                                                        , p.id    as owner_id 
                                                        , u.id    as user_id
                                                        , ml.id   as mailingList_id
                                                        , u.name  as owner_name
                                                        , count(subs.id) as member_count
                                                    FROM `".$listsTableName."` ml
                                                    INNER JOIN ".$publishersTableName." p on ml.owner_id = p.id
                                                    INNER JOIN ".$usersTableName." u on p.user_id = u.id
                                                    left JOIN ".$listMemebersTable." subs  on subs.list_id = ml.id
                                                    group by  ml.name, u.email, p.id  , u.id, ml.id , u.name
                                                    ";

        }


        public function findById($id)
        {


        }

        public function insert( $newIModel )
        { 
            $ml =  $newIModel;
            $ownerId= $ml->getOwner()->id;
            $name = $ml->getName();
            $args = [$ownerId,$name];
            $this->_insert($args );
        }
        public function delete($id){}
        public function update($iModel){}
        public function findAll()
        {           
           $result =  $this->_findAll("models\StoredMalingListDescription");
           return $result;           
        }

    }

}
?>