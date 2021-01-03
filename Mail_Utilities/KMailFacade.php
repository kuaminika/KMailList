<?php 
namespace Mail_utilities;

require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/KMailToolBox.php";
require_once dirname(__FILE__)."/KMailSender.php";
require_once dirname(__FILE__)."/KMailTemplate.php";
require_once dirname(__FILE__)."/KMailMessage.php";
require_once dirname(__FILE__)."/ExtendedKMailMessage.php";
require_once dirname(__FILE__)."/KCommand_Abstract.php";
require_once dirname(__FILE__)."/KCommand_NotifyJoinMailingListCommand.php";


require_once dirname(__DIR__)."/Security_Utilities/Token_Utilities/KTokenFacade.php";
require_once dirname(__FILE__)."/../Services/MessageService.php";
require_once dirname(__FILE__)."/../Models/StoredMessage.php";
require_once dirname(__FILE__)."/../Models/StoredSubscriber.php";

use Exception;
use KConfigSet;
//use models\interfaces\ISubscriber;
use Security_Utilities\Token_Utilities\KTokenFacade;
use models\StoredPublisher;
use models\ContactFormSubmission;
use models\StoredMessage;
use models\StoredSubscriber;
class KMailFacade
{
   //private $messageService;
    private $mailoolBox;

    private function __construct(KMailToolBox $mailToolBox)
    {
       $this->mailoolBox = $mailToolBox;

    }


    public static function create()
    {//newEchoLogFn
        $configs = KConfigSet::getCurrentConfigs();
        $mailConfigs = $configs->getConfig("mailConfigs");
        $logTool =  $configs->getConfig("currentLogTool");  
        $toolbox = new KMailToolBox($mailConfigs,$logTool);
        $result = new KMailFacade($toolbox);
        return $result;
    }

    public function getPurposedEmail($key,$languageCode = "en")
    {
        $finalKey = $key."_".$languageCode;
        $purosedEMailarr = ["message_id"=>0,
                            "author_id"  =>0,
                            "last_update_date" =>"",
                            "list_id" =>0,
                            "sent_date"=>"n/a"
                            ];
        

        $this->mailoolBox->logTool->showVDump( $this->mailoolBox->purposedEmails);
       
        $purosedEMailarr= array_merge($purosedEMailarr, $this->mailoolBox->purposedEmails[$finalKey]);
        $purosedEMailarr = array_merge($purosedEMailarr, $this->mailoolBox->purposedEmailSenders[$key]);

     
        $this->mailoolBox->logTool->showVDump($purosedEMailarr);
        $this->mailoolBox->logTool->log(\get_class() .":final purosedEMailarr");
        //note this model should not be included in here
        $result = new StoredMessage($purosedEMailarr);

        return $result;
    }

    //todo: need to find a way to make the  ContactFormSubmission model be local to the Mail_Utilities namespace
    public function sendContactFormEmailToRecipient(ContactFormSubmission $cfSubmission)
    {
        try
        {
            $recipient =  $cfSubmission->getRecipient();
            $purpose = "youReceivedFromContactForm";
            
            if(!$recipient)
            {
                $args = $this->mailoolBox->mainRecipientPublisher;
                $recipient = new StoredPublisher(["name"=>$args["Name"],"email"=>$args["Email"]]);
                $cfSubmission->setRecipient($recipient);
            }
            
            $messageFromForm =  $cfSubmission->getMessage();
            $contactFormSender = $cfSubmission->getSender();
            $toolbox = $this->mailoolBox;
            $storedMessage =$this->getPurposedEmail($purpose);
            $mailSender = new KMailSender($toolbox);
            $testFormat =  file_get_contents(dirname(__FILE__).'/templateFormats/'.$purpose.'_en.html');
            $tokenFacade = KTokenFacade::create();
            $code = $tokenFacade->createCode($contactFormSender);
            
            $template = new KMailTemplate("Heart mind equation", $testFormat);
            
            $toolbox->logTool->log("the following is the message from the form");
            $toolbox->logTool->showVDump($messageFromForm);

            $toolbox->logTool->showVDump($storedMessage);
            $toolbox->logTool->log("the following is a purposed  message");

            $messageParams = ["sender"=>$storedMessage->getAuthorEmail()//$contactFormSender->getEmail()
                            ,"subject"=>$storedMessage->getTitle() 
                            ,"content"=>$storedMessage->getContent()
                            ,"payLoad"=>$cfSubmission->getContent()
                            ,"recipientName"=>$recipient->getName()
                            ,"recipientEmail"=>$recipient->getEmail() 
                            ,"membershipId"=>$code
                            ,"sourceHost"=> $toolbox->sourceHost
                        ];

          
            $toolbox->logTool->log("the following is the message params");
            $toolbox->logTool->showVDump($messageParams);

            
            $message = new ExtendedKMailMessage($messageParams,$template);
            

            $finalRecipientList =  array_merge( $toolbox->itRecipientList,[ $this->mailoolBox->mainRecipientPublisher]);
            $status = $mailSender->sendEMail($finalRecipientList , $message);
            $toolbox->logTool->showVDump($status);
            $toolbox->logTool->log("<h1>---------------the staus</h1>");



            $statusIsGood =isset($status->Messages);
            if(!$statusIsGood)
            {
                throw new \Exception("Mezanmi, ket, the '".$purpose ."' message failed check log to get more details");
            }
               
            
            return 1;// $status;
        }
        catch(\Exception $ex)
        {

            $this->mailoolBox->logTool->showVDump($ex);
            throw $ex;
        }
        
    }



    public function thankForJoiningMailingList(StoredMessage $storedMessage,StoredSubscriber $storedSubscriber)
    {
        try
        {

           
            $purpose = "Thank you";

            $toolbox = $this->mailoolBox;
        
            $sender = new KMailSender($toolbox);
        
            $testFormat =  file_get_contents(dirname(__FILE__).'/templateFormats/welcomeLetter_en.html');
            $template = new KMailTemplate($purpose, $testFormat);
            $tokenFacade = KTokenFacade::create();
            $code = $tokenFacade->createCode($storedSubscriber);
            
            $messageParams = ["sender"=>$storedMessage->getAuthorEmail()//ex:"kuaminika@gmail.com"
                            ,"subject"=>$storedMessage->getTitle()//ex:"Welcome to the equattion"
                            ,"content"=>$storedMessage->getContent()//'ex:Thank you for joining. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                            ,"recipientName"=>$storedSubscriber->getName()
                            ,"recipientEmail"=>$storedSubscriber->getEmail() 
                            ,"membershipId"=>$code
                            ,"sourceHost"=> $toolbox->sourceHost
                        ];
        
                        $toolbox->logTool->log("<h1>thanks</h1>");
            $message = new KMailMessage($messageParams,$template);
            $sender->sendEMail([["Email"=>$storedSubscriber->getEmail(),"Name"=> $storedSubscriber->getName()]], $message);
            // TODO : should not be hardcoding the instanciation of this
            $whenDoneCommand =new   NotifyJoinMailingListCommand( $toolbox,$message,$sender);
            $whenDoneCommand->Execute();
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
        }
    
    }

    public function sendMessageToAll( $recipients,$subject,$content)
    {


        try{
           
               $toolbox = $this->mailoolBox;
                $purpose = "NewPost";
               /* $logTool = $toolbox->createEchoLog(); // for debugging purposes
                $logTool->toggleActivation(0);*/
                $storedMessage =$this->getPurposedEmail($purpose);
                $mailSender = new KMailSender($toolbox);
                $tokenFacade = KTokenFacade::create();
                $testFormat =  file_get_contents(dirname(__FILE__).'/templateFormats/greetWithHello_en.html');
                $template = new KMailTemplate($purpose, $testFormat);
                $receiptMsg = "message was sent to these emails:";
                $messageParams = ["sender"=>$storedMessage->getAuthorEmail()//"kuaminika@gmail.com"
                        ,"subject"=>$subject//"Welcome to the equattion"
                        ,"content"=>$content//'Thank you for joining. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                        ,"recipientName"=>""
                        ,"recipientEmail"=>""
                        ,"membershipId"=>""
                        ,"sourceHost"=> $toolbox->sourceHost
                        ];
           
                foreach ($recipients as  $recipient) {
                    try
                    {

                    
                        $code = $tokenFacade->createCode($recipient);
                   
                        $messageParams["recipientName"] = $recipient->getName();
                     
                        $messageParams["recipientEmail"] = $recipient->getEmail();
                  
                        $messageParams["membershipId"] = $code;

                   
                        $message = new KMailMessage($messageParams,$template);
                       // $mailSender->setLogTool($logTool);
                        $response =  $mailSender->sendEMail([$recipient->getArrValue()], $message);
                       
                        $receiptMsg .= json_encode($recipient->getArrValue()).$recipient->getEmail()."-".$recipient->getName()."\n<br>";
                        $receiptMsg .= json_encode($response)."\n</br>";
                    }
                    catch(\Exception $ex)
                    {
                        $toolbox->logTool->log($ex->getMessage());
                        throw $ex;
                    }
                    
                }
                
                $messageParams["recipientName"] = "To whom it may concern";
                $messageParams["recipientEmail"] = "--";
                $messageParams["content"] = $receiptMsg;
                $messageParams["membershipId"] = $code;
                $message = new KMailMessage($messageParams,$template);
             
                       // TODO : should not be hardcoding the instanciation of this
                       $whenDoneCommand =new   NotifyJoinMailingListCommand( $toolbox,$message,$mailSender);
                       $whenDoneCommand->Execute();
                
        }
        catch(\Exception $ex)
        {
            throw $ex;
        }
    
        

    }

}




?>