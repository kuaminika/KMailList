
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testing sending emails</title>


    <?php

use Mail_utilities\KMailFacade;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__)."/../../K_Utilities/KIgniter.php";
require_once dirname(__FILE__)."/../../KConfigSet.php";
require_once dirname(__FILE__)."/../KMailToolBox.php";
require_once dirname(__FILE__)."/../KMailSender.php";
require_once dirname(__FILE__)."/../KMailTemplate.php";
require_once dirname(__FILE__)."/../KMailMessage.php";
require_once dirname(__FILE__)."/../../Models/StoredSubscriber.php";
require_once dirname(__FILE__)."/../KMailFacade.php";
    K_Utilities\KIgniter::Ignite();

    $configs = KConfigSet::getCurrentConfigs();


    $rawRecipient = [];
    $rawRecipient["user_id"] = 0;
    $rawRecipient["email"]= "lemanod@gmail.com";
    $rawRecipient["name"]= "gro mesye";
    $rawRecipient["id"]  =0 ;
    $rawRecipient["date_subscribed"]= "n/a";
    $rawRecipient["added_by_id"]= 0;
    $rawRecipient["added_by"]="n/a";

    $_StoredSubscriber = new \models\StoredSubscriber($rawRecipient);

    $kMailFacade = Mail_utilities\KMailFacade::create();

    $purposedMail = $kMailFacade->getPurposedEmail("thanksForJoining","fr");

    $kMailFacade->thankForJoiningMailingList( $purposedMail,  $_StoredSubscriber);
/*

    $mailConfigs = $configs->getConfig("mailConfigs");
   $logTool =  $configs->getConfig("currentLogTool");
    $toolbox = new Mail_utilities\KMailToolBox($mailConfigs,$logTool);

    $sender = new Mail_utilities\KMailSender($toolbox);

    $testFormat =  file_get_contents('../templateFormats/test1.html');
   // $template = new Mail_utilities\KMailTemplate("Contact"," <h3>This is to inform that a message was sent from the contact form:</h3>  %s");
   $template = new Mail_utilities\KMailTemplate("Contact", $testFormat);
    //"kuaminika@gmail.com","Message from contact form","this is a test"
    $messageParams = ["sender"=>"kuaminika@gmail.com"
                     ,"subject"=>"Welcome to the equattion"
                     ,"content"=>'Thank you for joining. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                     ,"recipientName"=>"herman"
                     ,"recipientEmail"=>"lemanod@gmail.com" ];
    $message = new Mail_utilities\KMailMessage($messageParams,$template);
    echo "test sending contact form message";
    echo $message->getContent();
    $sender->sendEMail([["Email"=>"lemanod@gmail.com"]],$message);
    //echo $testFormat;*/
    ?>
</head>
<body>
    
</body>
</html>
