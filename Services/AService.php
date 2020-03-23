<?php
namespace Service{

    require_once dirname(__FILE__)."/ServiceToolBox.php";

    class AService
    {
        protected $repository;
        protected $logTool;
        protected $configSet;


        public function __construct(ServiceToolBox $serviceToolBox)
        {
            $this->repository = $serviceToolBox->repo;
            $this->logTool = $serviceToolBox->logTool;
            $this->configSet = $serviceToolBox->configSet;
        }

         
        public function insert( $formedOutModel )
        {
            $this->repository->insert($formedOutModel);
        }
        
        public function findAll()
        {

          
          $result =   $this->repository->findAll();
          return $result;
        }

    }
}
?>