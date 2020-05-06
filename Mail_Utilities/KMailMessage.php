<?php
namespace Mail_utilities;

require_once dirname(__FILE__)."/interfaces/IKMailMessage.php";

//_ContactFormNotification

class KMailMessage implements IKMailMessage
{
    private  $content;
    private  $sender;
    private  $subject;
    private  $template;
    private $recipientName;
    private $recipientEmail;
    private $sourceHost;
    private $recipientMembershipId;


    public function __construct($params,IKMailTemplate $template)
    {
        $this->sender = $params["sender"];
        $this->subject = $params["subject"];
        $this->template = $template;
        $this->content = $params["content"];
        $this->sourceHost = $params["sourceHost"];
        $this->recipientMembershipId = $params["membershipId"];
        $this->recipientName = $params["recipientName"];
        $this->recipientEmail = $params["recipientEmail"];
    }

   public function textPart()
   {
        $result = json_encode([
                 "sender" => $this->sender
                ,"subject" =>$this->subject
                ,"content" => $this->getContent()
        ]);

        return $result;
   }

   public function getPurpose()
   {
       $result = $this->template->getPurpose();
       return $result;
   }

    /**
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }


    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }



    /**
     * Set the value of template
     *
     * @return  self
     */ 
    public function setTemplate(IKMailTemplate $template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
       $d = new \DateTime();
       $result = str_replace("##CONTENT##", $this->content, $this->template->getFormat());
       $result = str_replace("##RECIPIENT_NAME##", $this->getRecipientName(), $result);
       $result = str_replace("##RECIPIENT_EMAIL##", $this->getRecipientEmail(), $result);
       $result = str_replace("##SOURCE_HOST##", $this->sourceHost, $result);
       $result = str_replace("##SENDER_EMAIL##", $this->sender, $result);
       $result = str_replace("##MEMBERSHIP_ID##",$this->recipientMembershipId,$result );
       $result = str_replace("##DATE##", $d->format('Y-m-d'), $result);

      return  $result;

     
    }

    /**
     * Get the value of recipientName
     */ 
    public function getRecipientName()
    {
        return $this->recipientName;
    }


    /**
     * Get the value of recipientEmail
     */ 
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }
}

?>