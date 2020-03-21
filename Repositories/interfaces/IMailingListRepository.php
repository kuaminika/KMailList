<?php

namespace Repository\interfaces
{

  require_once "IRepository.php";

  interface IMailingListRepository extends IRepository
  {
      public function findById($id);
  }

}

?>