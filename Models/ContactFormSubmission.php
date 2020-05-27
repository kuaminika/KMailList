<?php

namespace models;

class ContactFormSubmission extends AModel
{
    private $message;
    private $recipientPublisher;
    private $subscriberSender;
    private $otherAttributes;

    public function __construct($raw)
    {
        if(!\key_exists("message",$raw)) throw new \Exception("message is not provided in:".json_encode($raw));
        if(!\key_exists("sender",$raw)) throw new \Exception("sender is not provided in:".json_encode($raw));
        if(!\key_exists("otherAttributes",$raw)) throw new \Exception("other attributes are not provided in:".json_encode($raw));


        $this->message = new FormedOutMessage($raw["message"]);
        $this->subscriberSender = new FormedOutSubscriber($raw["sender"]);
        $this->otherAttributes = $raw["otherAttributes"];
        $this->message->setAuthor($this->subscriberSender->getName());
    }

    public function getSender(){ return $this->subscriberSender;}
    public function getMessage()  {   return $this->message;    }
    public function getRecipient() { return $this->recipientPublisher;}


    public function getContent()
    {

        $otherAttriubuteRows ="";

        foreach ($this->otherAttributes as $key => $value) {

           $otherAttriubuteRows .="<tr><td style='padding:2px'>".$key."</td><td>".$value."</td></tr>";
        }

        $messageParams = "
        <table>
            <tr> <td style='padding:2px'>From</td><td style='padding:2px'>".$this->message->getAuthor()."</td> </tr>
            <tr> <td style='padding:2px'>Email</td><td style='padding:2px'>".$this->subscriberSender->getEmail()."</td> </tr>
            ".$otherAttriubuteRows."
            <tr><td colspan='2' style='padding:2px'>Message</td> </tr>
            <tr>
                <td  colspan='2' style='padding:5px'>
                ".$this->message->getContent()."
                </td>
            </tr>
        </table>";
        

        return $messageParams;

    }


    public function setRecipient(StoredPublisher $sb)
    {
        $this->recipientPublisher = $sb;
    }

    public function _toJson()
    {
        $result = "{";

        $result.="'message':'". $this->message->_toJson()."'";
        $result.="',sender':'". $this->subscriberSender->_toJson()."'";
        $result.=$this->recipientPublisher ? "',recipient':'". $this->recipientPublisher->_toJson()."'": "";
        $result.="',otherAttributes':'".\json_encode($this->otherAttributes)."'";
        $result .= "}";
        return $result;
    }
}