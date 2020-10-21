<?php

namespace Mail_utilities;


class NotifyJoinMailingListCommand extends KCommandAbstract
{
    private $messageSent;
    private $mailoolBox;
    private $sender;
   public function __construct(KMailToolBox $mailToolBox, KMailMessage $messageSent, KMailSender $sender)
   {
      $this->mailoolBox = $mailToolBox;
      $this->messageSent = $messageSent;
      $this->sender = $sender;

   }


    public function Execute()
    { $this->mailoolBox->logTool->log("inside NotifyJoinMailingListCommand->Execute ");
       $recipients = $this->mailoolBox->itRecipientList;// $this->mailoolBox->mainRecipientPublisher;// array_merge($this->mailoolBox->mainRecipientPublisher,$this->mailoolBox->itRecipientList );
       $recipients[]  = $this->mailoolBox->mainRecipientPublisher;
      $this->mailoolBox->logTool->showObj($recipients);
        $this->sender->sendEMail( $recipients,  $this->messageSent);
        $this->mailoolBox->logTool->log("leaving NotifyJoinMailingListCommand->Execute ");
    }
}