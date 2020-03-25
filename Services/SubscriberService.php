<?php

namespace Service;

use models\FormedOutSubscriber;
use Service\interfaces\IService;

require_once dirname(__FILE__)."/interfaces/IService.php";
require_once dirname(__FILE__)."/AService.php";

class SubscriberService extends AService implements IService

{

    public function delete($iModel)
    {}
    public function update($iModel)
    {}

    public function addSubscriberToList(FormedOutSubscriber $subscriberFromForm)
    {
        $list_id = $subscriberFromForm->getListToAddId();

       $storedSubscriber = $this->repository->getOrInsert($subscriberFromForm);
       $result =   $this->repository->addSubscriberToList($storedSubscriber,$list_id);
       return $result;
    }


   
    public function subscriberExistsInList(FormedOutSubscriber $subscriberFromForm)
    {
      //  $this->service->subscriberExistsInList()
    }

}

?>