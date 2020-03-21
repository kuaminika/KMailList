<?php

namespace models\interfaces {
    interface IMessage extends IModel
    {

      //  public function getAuthorId();
        public function getContent();
        public function getTitle();
        public function getLastUpdateDate();
        public function getDateSent();



    }
}


?>