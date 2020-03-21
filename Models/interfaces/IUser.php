<?php

namespace models\interfaces{

    require_once "IModel.php";
    interface IUser extends IModel
    {
     
        
        public function getName();
        public function getEmail();
    }


}


?>