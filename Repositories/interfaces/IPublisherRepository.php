<?php

namespace Repository\interfaces
{
  interface IPublisherReposiory extends IRepository
  {
      public function findById($id);
  }

}

?>