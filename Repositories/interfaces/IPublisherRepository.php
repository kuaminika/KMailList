<?php

namespace Repository\interfaces
{

  require_once "IRepository.php";

  interface IPublisherReposiory extends IRepository
  {
      public function findById($id);
  }

}

?>