<?php
namespace models\interfaces 
{
    interface IMailingList extends IModel 
    {
        public function getOwner();
        public function getName();        
    }
}

?>