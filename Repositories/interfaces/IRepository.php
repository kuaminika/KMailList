<?php

//use models\interfaces\IModel;
namespace Repository\interfaces{
    interface IRepository
    {
        public function insert($newIModel );
        public function delete($id);
        public function update($iModel);
        public function findAll();
    }

}
?>