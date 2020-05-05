<?php 
namespace Mail_utilities;

require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/KMailToolBox.php";
require_once dirname(__FILE__)."/KMailSender.php";
require_once dirname(__FILE__)."/KMailTemplate.php";
require_once dirname(__FILE__)."/KMailMessage.php";

require_once dirname(__FILE__)."/../Services/MessageService.php";
require_once dirname(__FILE__)."/../Models/StoredMessage.php";

use KConfigSet;
use models\interfaces\ISubscriber;
use models\StoredMessage;
use models\StoredSubscriber;
class KMailFacade
{
   //private $messageService;
    private $mailoolBox;

    private function __construct(KMailToolBox $mailToolBox)//MessageService $messageService)
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

    public function thankForJoiningMailingList(StoredMessage $storedMessage,ISubscriber $storedSubscriber)
    {
        $purpose = "Thank you";

        $toolbox = $this->mailoolBox;
    
        $sender = new KMailSender($toolbox);
    
        $testFormat =  file_get_contents(dirname(__FILE__).'/templateFormats/welcomeLetter_en.html');
       $template = new KMailTemplate($purpose, $testFormat);
        //"kuaminika@gmail.com","Message from contact form","this is a test"
        $messageParams = ["sender"=>$storedMessage->getAuthorEmail()//"kuaminika@gmail.com"
                         ,"subject"=>$storedMessage->getTitle()//"Welcome to the equattion"
                         ,"content"=>$storedMessage->getContent()//'Thank you for joining. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                         ,"recipientName"=>$storedSubscriber->getName()
                         ,"recipientEmail"=>$storedSubscriber->getEmail() ];
        $message = new KMailMessage($messageParams,$template);
        $sender->sendEMail([["Email"=>$storedSubscriber->getEmail(),"Name"=>$storedSubscriber->getName()]],$message);
    
    }


}




?>