<?php

namespace Mail_utilities;
require_once dirname(__FILE__)."/KMailTool.php";



class KMailSender extends KMailTool
{    

    function setLogTool($newLogTool)
    {

        $this->logTool = $newLogTool;
    }
    
    function sendEMail($recipientList_array,IKMailMessage $message)
    {$this->logTool->log("inside sendEMail");
        $sender_Email = $message ->getSender();
        $this->logTool->showObj($recipientList_array);

       $this->logTool->log("body bout to be created");
        $body =	[[
            'From' =>["Email"=>$sender_Email,"Name"=>$this->projectName],        
            'To' => $recipientList_array,
            'Subject'    => $message->getSubject()." - ".$message->getPurpose(),            
            'TextPart'  => $message->textPart(),
            'HTMLPart'  => $message->getContent()
            
        ]];
        $this->logTool->log("body created");
        $this->logTool->showObj($body);
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["Messages"=>$body]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json')
        );
        curl_setopt($ch, CURLOPT_USERPWD,$this->apikey.":". $this->apisecret);
        $server_output = curl_exec($ch);
        curl_close ($ch);


        $response = json_decode($server_output);
    
        $this->logTool->showObj( $response);
    
        $this->logTool->showObj(get_class(). ":----------this was the respons:");
        return $response;
    }

}



?>