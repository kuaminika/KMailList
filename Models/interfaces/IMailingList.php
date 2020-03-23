<?php
namespace models\interfaces 
{

    require_once dirname(__FILE__)."/IModel.php";

    interface IMailingList extends IModel 
    {
        public function getOwner();
        public function getName();        
    }
}

?>