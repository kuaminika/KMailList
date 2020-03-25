<?php

namespace models\interfaces
{


    interface ISubscriber extends IUser{

        public function getDateAdded();
        public function getAddedBy();

    }
}
?>