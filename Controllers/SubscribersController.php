<?php 

namespace Controllers;

require_once dirname(__FILE__)."/AController.php";
require_once dirname(__FILE__)."/ControllerToolBox.php";
require_once dirname(__FILE__)."/../Models/FormedOutSubscriber.php";

//use models\FormedOutMailingListDescription;
use \models\FormedOutSubscriber;
class SubscribersController extends AController
{

    public function __construct(ControllerToolBox $toolBox)
    {
        parent::__construct($toolBox);

        $this->logTool->log(" Subscriber controller created");
    }

    public function addSubscriberToList($formedOutSubscriberArgs)
    {
        $newSubscriber = new FormedOutSubscriber($formedOutSubscriberArgs);


        //if($this->service->subscriberExistsInList($newSubscriber))



       // echo "oo";
       // print_r ($formedOutSubscriberArgs);
        $this->response['status_code_header'] = 'HTTP/1.1 200 OK';


        $newList = $this->service->addSubscriberToList($newSubscriber);
        $this->response['body'] =   $newList->_toJson();
    }
}


?>