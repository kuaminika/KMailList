<?php 

namespace Controllers;

require_once dirname(__FILE__)."/AController.php";
require_once dirname(__FILE__)."/ControllerToolBox.php";
require_once dirname(__FILE__)."/../Models/FormedOutSubscriber.php";
require_once dirname(__FILE__)."/../Models/KError.php";
require_once dirname(__FILE__)."/../Mail_Utilities/KMailFacade.php";


use Exception;
use \models\FormedOutSubscriber;
use models\StoredSubscriber;

class SubscribersController extends AController
{

    public function __construct(ControllerToolBox $toolBox)
    {
        parent::__construct($toolBox);

        $this->logTool->log(" Subscriber controller created");
    }

    public function removeFromList($rawSubscriber)
    {
         $subscriber = new StoredSubscriber();
         $subscriber->createFromStdObj($rawSubscriber["jsonValue"]);
       
        $this->service->removeSubscriberToList($subscriber);
        $list_id = $subscriber->getListId();
        $result = $this->service->getAllSubscriberFromList($list_id);
        $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
        $this->response['body'] = $result->_toJson();
    }

    public function getSubscribersInList($list_id_holder)
    {
        try
        {
            $list_id = $list_id_holder["list_id"];
            $result = $this->service->getAllSubscriberFromList($list_id);
            $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
            $this->response['body'] = $result->_toJson();
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

    public function addSubscriberToList_selfAdd($formedOutSubscriberArgs)
    {
        try
         {
            $itComesFromJSONForm = isset($formedOutSubscriberArgs["jsonValue"]);
            $formedOutSubscriberArgs = $itComesFromJSONForm ?(array) $formedOutSubscriberArgs["jsonValue"]: $formedOutSubscriberArgs ;
          
            $newSubscriber = new FormedOutSubscriber($formedOutSubscriberArgs);
            $newList = $this->service->addSubscriberToListBySelf($newSubscriber);
          
            $storedSubscriber = $newList->getContents()[0];

            $language =  array_key_exists("language",$formedOutSubscriberArgs) ? $formedOutSubscriberArgs["language"] :"en";
            $kMailFacade = \Mail_utilities\KMailFacade::create();        
            $purposedMail = $kMailFacade->getPurposedEmail("thanksForJoining",$language);    
            
            $kMailFacade->thankForJoiningMailingList( $purposedMail, $storedSubscriber );

            $result = $this->messageMap->getCode("thanksForJoin");
            
            $this->response['status_code_header'] = 'HTTP/1.1 200 OK';          
            $this->response['body'] =  json_encode((array)$result);
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

    public function addSubscriberToList($formedOutSubscriberArgs)
    {

        try
        {
            $itComesFromJSONForm = isset($formedOutSubscriberArgs["jsonValue"]);
            $formedOutSubscriberArgs = $itComesFromJSONForm ?(array) $formedOutSubscriberArgs["jsonValue"]: $formedOutSubscriberArgs ;
          
            $newSubscriber = new FormedOutSubscriber($formedOutSubscriberArgs);

          
            $newList = $this->service->addSubscriberToList($newSubscriber);
            
            $this->response['status_code_header'] = 'HTTP/1.1 200 OK';          
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