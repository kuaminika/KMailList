<?php

namespace models\interfaces
{


    require_once dirname(__FILE__)."/IUser.php";

    interface ISubscriber extends IUser{

        public function getDateAdded();
        public function getAddedBy();

    }
}
?>