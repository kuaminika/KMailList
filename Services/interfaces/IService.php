<?php
  namespace Service\interfaces {
    interface IService
    {
        public function insert( $newIModel );
     //   public function delete($iModel);
       // public function update($iModel);
        public function findAll();
    }
  }
?>