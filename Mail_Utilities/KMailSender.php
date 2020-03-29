<?php

namespace Mail_utilities;
require_once dirname(__FILE__)."/../VendorUtilities/mailjet/vendor/autoload.php";


use Mailjet\Resources;

class KMailSender extends KMailTool
{    
    
    function sendEMail($sender_Email,$recipientList_array,$content_String,$emailInfo = [])
    {
        
        $this->logTool->showObj($recipientList_array);

       $this->logTool->log("body bout to be created");
        $body =	[
            
            'FromEmail' => $sender_Email,            
            'FromName' => $this->projectName." - Contact",            
            'Subject' => "Message from contact form",            
            'Text-part' => "This is to inform that a message was sent from the contact form:".json_encode($emailInfo),
            'Html-part' => "
            
			       <h3>This is to inform that a message was sent from the contact form:</h3>
            
			 ".$content_String ,
            
            'Recipients' =>$recipientList_array
            
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