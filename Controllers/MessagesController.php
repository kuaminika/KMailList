<?php 

namespace Controllers;

require_once dirname(__FILE__)."/AController.php";
require_once dirname(__FILE__)."/ControllerToolBox.php";
require_once dirname(__DIR__)."/Mail_Utilities/KRecipient.php";
require_once dirname(__FILE__)."/../Models/ContactFormSubmission.php";

use models\ContactFormSubmission;
class MessagesController extends AController
{



    public function __construct(ControllerToolBox $toolBox)
    {
        parent::__construct($toolBox);

        $this->logTool->log("Messages controller created");
    }


    public function showWhatISent($whatISent)
    {
        try
        {
            $this->response['status_code_header'] = 'HTTP/1.1 200 OK';          
            $this->response['body'] = json_encode($whatISent);

        }
        catch(\K_Utilities\KException $ex)
        {
          
            $this->logTool->log("exception is caught");
           $error =  $ex->getErrorModel();  

           $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
           $this->response['body'] =  $error->_toJson();
        }
        catch(\Exception $ex)
        {
            $this->logTool->log("exception is caught");
          $this->logAndSend("exception","showWhatISent",$ex->getMessage());
        }
    }


    public function sendMessageToAll($messageAndContacts)
    {
        try
        {
            $logs = [];
            
            $itComesFromJSONForm = isset($messageAndContacts["jsonValue"]);
            $logs [] =  ["itComesFromJSONForm" => $itComesFromJSONForm] ;
            $messageAndContacts = $itComesFromJSONForm ?(array) $messageAndContacts["jsonValue"]: $messageAndContacts ;
          
            $messageAndContacts = json_decode(json_encode($messageAndContacts), true);
            

      
           
            $recipients = [];


                $kMailFacade = \Mail_utilities\KMailFacade::create();   

               
                $rawRecipients = $messageAndContacts["recipients"];
                $content =  $messageAndContacts["content"];
                $subject = $messageAndContacts["subject"];
                $recipients = [];
                $recipientslog = [];
                $logs [] =  ["subject" => $subject] ;
                $logs [] =  ["content" => $content] ;
                $logs [] =  ["rawRecipients" => $rawRecipients] ;
                foreach ($rawRecipients as $rawRecipient)
                {
                    $newRecipient =  new \Mail_utilities\KRecipient($rawRecipient);
                 $recipients [] = $newRecipient;
                 $recipientslog [] = $newRecipient->getArrValue();
                }

                $logs [] =  ["recipients" => $recipientslog] ;

           //     $kMailFacade->sendMessageToAll($recipients,$subject,$content);
                
            $this->response['body'] = json_encode($logs);
          
        }
        catch(\Exception $ex)
        {
            $this->logTool->log("exception is caught");
             $this->logAndSend("exception","addSubscriberToList",$ex->getMessage());
        }
    
    }


    public function processContactFormSubmission($contactFormSubmissionArgs)
    {
        try
        {
            $this->logTool->log("processContactFormSubmission received");
            $this->logTool->showVDump($contactFormSubmissionArgs);
        
            $itComesFromJSONForm = isset($contactFormSubmissionArgs["jsonValue"]);
            $finalContactFormSubmissionArgs = $itComesFromJSONForm ?(array) $contactFormSubmissionArgs["jsonValue"]: $contactFormSubmissionArgs ;
          
            $finalContactFormSubmissionArgs = json_decode(json_encode($finalContactFormSubmissionArgs), true);
            
            $this->logTool->log("finalContactFormSubmissionArgs turned into array for proper args");
           $this->logTool->showVDump($finalContactFormSubmissionArgs);

     


            $formSubmission = new ContactFormSubmission($finalContactFormSubmissionArgs);
           $this->logTool->showVDump($formSubmission);
            $this->logTool->log("formSubmission obj created");
            
            $kMailFacade = \Mail_utilities\KMailFacade::create();        
          
            // todo: perhaps kmail facade shouls not receive a model of ContactFormSubmission since it is not in the same namepsace. perhaps an adapter would have been better. 
           $kMailFacade->sendContactFormEmailToRecipient($formSubmission);
            
            $this->logTool->log("formSubmission->_toJson():");

        //    $this->logTool->log($formSubmission->_toJson());

            $this->response['status_code_header'] = 'HTTP/1.1 200 OK';          
            $this->response['body'] =   $formSubmission->_toJson();

        }
        catch(\K_Utilities\KException $ex)
        {
          
            $this->logTool->log("exception is caught");
           $error =  $ex->getErrorModel();  

           $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
           $this->response['body'] =  $error->_toJson();
        }
        catch(\Exception $ex)
        {
            $this->logTool->log("exception is caught");
          $this->logAndSend("exception","addSubscriberToList",$ex->getMessage());
        }

    }
}
