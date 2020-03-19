<?php
namespace models\interfaces 
{
    interface IMailingList extends IModel 
    {
        public function getOwnerId();
        public function getName();        
    }
}

?>