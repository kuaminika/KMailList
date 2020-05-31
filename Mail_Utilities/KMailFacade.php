<?php 
namespace Mail_utilities;

require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/KMailToolBox.php";
require_once dirname(__FILE__)."/KMailSender.php";
require_once dirname(__FILE__)."/KMailTemplate.php";
require_once dirname(__FILE__)."/KMailMessage.php";
require_once dirname(__FILE__)."/ExtendedKMailMessage.php";

require_once dirname(__DIR__)."/Security_Utilities/Token_Utilities/KTokenFacade.php";
require_once dirname(__FILE__)."/../Services/MessageService.php";
require_once dirname(__FILE__)."/../Models/StoredMessage.php";
require_once dirname(__FILE__)."/../Models/StoredSubscriber.php";

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
    {
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
        
        $purosedEMailarr= array_merge($purosedEMailarr, $this->mailoolBox->purposedEmails[$finalKey]);
        $purosedEMailarr = array_merge($purosedEMailarr, $this->mailoolBox->purposedEmailSenders[$key]);

     

        $result = new StoredMessage($purosedEMailarr);

        return $result;
    }


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

            

            $messageParams = ["sender"=>$contactFormSender->getEmail()
                            ,"subject"=>$storedMessage->getTitle() // 
                            ,"content"=>$storedMessage->getContent()
                            ,"payLoad"=>$cfSubmission->getContent()
                            ,"recipientName"=>$recipient->getName()
                            ,"recipientEmail"=>$recipient->getEmail() 
                            ,"membershipId"=>$code//$storedSubscriber->getMembershipId()
                            ,"sourceHost"=> $toolbox->sourceHost
                        ];

          
            
            
          //  $toolbox->logTool->log("the following is the message params");
          //  $toolbox->logTool->showVDump($messageParams);

            
            $message = new ExtendedKMailMessage($messageParams,$template);

            $finalRecipientList =  array_merge( $toolbox->itRecipientList,[ $this->mailoolBox->mainRecipientPublisher]);
            $status = $mailSender->sendEMail($finalRecipientList , $message);
            
            $statusIsGood =isset($status->Messages);
            if(!$statusIsGood)
            {
                throw new \Exception("Mezanmi, ket, the '".$purpose ."' message failed check log to get more details");
            }
               
            
            return $status;
        }
        catch(Exception $ex)
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
            
            //"kuaminika@gmail.com","Message from contact form","this is a test"
            $messageParams = ["sender"=>$storedMessage->getAuthorEmail()//"kuaminika@gmail.com"
                            ,"subject"=>$storedMessage->getTitle()//"Welcome to the equattion"
                            ,"content"=>$storedMessage->getContent()//'Thank you for joining. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                            ,"recipientName"=>$storedSubscriber->getName()
                            ,"recipientEmail"=>$storedSubscriber->getEmail() 
                            ,"membershipId"=>$code//$storedSubscriber->getMembershipId()
                            ,"sourceHost"=> $toolbox->sourceHost
                        ];
        
            $message = new KMailMessage($messageParams,$template);
            $sender->sendEMail([["Email"=>$storedSubscriber->getEmail(),"Name"=> $storedSubscriber->getName()]], $message);
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
        }
    
    }


}




?>