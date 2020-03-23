<?php
namespace Service;
use Service\interfaces\IService;

require_once dirname(__FILE__)."/interfaces/IService.php";
require_once dirname(__FILE__)."/AService.php";

class MessageService extends AService implements IService
{
    public function __construct(ServiceToolBox $toolBox) 
    {
        parent::__construct($toolBox);

        $this->logTool->log("Message service created");
       // $this->repository = $toolBox->repo;
    }


    public function delete($iModel)
    {}
    public function update($iModel)
    {}
}


?>