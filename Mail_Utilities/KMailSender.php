<?php

namespace Mail_utilities;
require_once dirname(__FILE__)."/../VendorUtilities/mailjet/vendor/autoload.php";
require_once dirname(__FILE__)."/KMailTool.php";

use Mailjet\Resources;

class KMailSender extends KMailTool
{    
    
    function sendEMail($recipientList_array,IKMailMessage $message)//,$content_String,$emailInfo = [])
    {
        $sender_Email = $message ->getSender();
        $this->logTool->showObj($recipientList_array);

       $this->logTool->log("body bout to be created");
        $body =	[
            
            'FromEmail'  => $sender_Email,            
            'FromName'   => $this->projectName,            
            'Subject'    => $message->getSubject()." - ".$message->getPurpose(),            
            'Text-part'  => $message->textPart(),
            'Html-part'  => $message->getContent(),            
            'Recipients' =>(array) $recipientList_array
            
        ];
        $this->logTool->log("body created");
        $this->logTool->showObj($body);
       // KLog::Create()->logArrayAsJSON($body);
        
        $mj = new \Mailjet\Client($this->apikey, $this->apisecret);
        
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        
        $response->success() && $this->showDataPretty($response->getData());
     //  KLog::Create()->logArrayAsJSON( (array)$response->getStatus());
        
        $this->logTool->showObj( (array)$response->getStatus());
     
    }

}



?>