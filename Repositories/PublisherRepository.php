<?php

namespace Repository{

    use Repository\interfaces\IPublisherReposiory;

    class PublisherRepository implements IPublisherReposiory
    {
        private $_queryBoard;
        private $configSet;
        public function __construct($configSet)
        {
            $this->configSet = $configSet;
            $usersTableName = $this->configSet["usersTableName"];
            $publishersTableName = $this->configSet["publishersTableName"];
            $this->_queryBoard = [];
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

        public function insert($newIModel ){}
        public function delete($id){}
        public function update($iModel){}
        public function findAll(){}

    }

}
?>