<?php

namespace Service;

use Exception;
use models\FormedOutSubscriber;
use models\StoredSubscriber;
use Service\interfaces\IService;

require_once dirname(__FILE__)."/interfaces/IService.php";
require_once dirname(__FILE__)."/AService.php";

class SubscriberService extends AService implements IService

{
    public function addSubscriberToList(FormedOutSubscriber $subscriberFromForm)
    {
        $list_id = $subscriberFromForm->getListToAddId();
       $storedSubscriber = $this->repository->getOrInsert($subscriberFromForm);
       $result =   $this->repository->addSubscriberToList($storedSubscriber,$list_id);
       return $result;
    }

    public function removeSubscriberToList(StoredSubscriber $subscriberFromForm)
    {
        $this->logTool->log("inside the the remove");
        $this->logTool->log($subscriberFromForm->_toJson());
        $this->repository->removeSubscriberToList($subscriberFromForm);     
    }

    public function getAllSubscriberFromList($list_id)
    {
        if(!$list_id) throw new Exception("missing list id");

       $found =  $this->repository->getSubscriberInListLike($list_id);
       return $found;
    }

   
    public function subscriberExistsInList(FormedOutSubscriber $subscriberFromForm)
    {
     $found = $this->repository->subscriberExistsInList($subscriberFromForm);
     return  $found ;

    }

}

?>