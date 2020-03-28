<?php 

namespace Controllers;

require_once dirname(__FILE__)."/AController.php";
require_once dirname(__FILE__)."/ControllerToolBox.php";
require_once dirname(__FILE__)."/../Models/FormedOutSubscriber.php";
require_once dirname(__FILE__)."/../Models/KError.php";
//use models\FormedOutMailingListDescription;

use Exception;
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

        try
        {

            $newSubscriber = new FormedOutSubscriber($formedOutSubscriberArgs);

            $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
         

            
            $newList = $this->service->addSubscriberToList($newSubscriber);
            $this->response['body'] =   $newList->_toJson();

        }
        catch(\K_Utilities\KException $ex)
        {
           $error =  $ex->getErrorModel();  
          
           $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
           $this->response['body'] =  $error->_toJson();
        }
        catch(Exception $ex)
        {
          $this->logAndSend("exception","addSubscriberToList",$ex->getMessage());
        }
    }
}


?>