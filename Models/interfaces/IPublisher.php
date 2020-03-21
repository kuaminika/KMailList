<?php

namespace models\interfaces {

    require_once "IUser.php";

    interface IPublisher extends IUser
    {
        public function getPublisherId();
    }
}
?>