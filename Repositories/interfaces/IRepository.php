<?php
namespace Repository\interfaces{

    /*
require_once dirname(__FILE__)."/"."../../Models/interfaces/IModel.php";
use models\interfaces\IModel;*/
    interface IRepository
    {
        public function insert( $newIModel );
        public function delete($id);
        public function update($iModel);
        public function findAll();
    }

}
?>