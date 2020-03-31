<?php


$dbSetUpConfigs = array(
    "servername"=>"localhost"
    ,"username"=>"datauser"
    ,"password"=>"data100"
    ,"dbname"=>"K_mail_list"
);        

             
 $globalSettings = array(
     "usersTableName" =>"User",
     "publishersTableName"=>"Publisher",
     "messagesTableName"=>"Message",
     "listsTableName"=>"MailingList",
     "subscribersListTableName"=>"SubscriberList",
     "subscribersTableName"=>"Subscriber",
     "logToolTableName"=>"Log"
 );

 
 /*
      $this->id = $raw["message_id"];
          $this->authorId = $raw["author_id"];
          $this->authorName = $raw["author_name"];
          $this->authorEmail = $raw["author_email"];
          $this-> title= $raw["title"];
          $this-> content = $raw["content"];
          $this-> lastUpdateDate = $raw["last_update_date"];
          $this->dateSent = $raw["sent_date"];
          $this->listId =$raw["list_id"];   
 */
$mailConfigs =  [
    "apiKey"=> 'f0166eb5113e25b967e247700dd8c895',
    "apiSecret" =>   '6b936756be02c7c046b95eeeeaf71921',
    "businessRecipientList"=>[ ["Email"=>"ludemia@heartmindequation.com"]],
    "itRecipientList"=>[ ["Email"=>"kuaminika@gmail.com"]  ,["Email"=>"kuaminika@heartmindequation.com"] ],
    "outboundEmailForContactForm"=>"contact@heartmindequation.com" ,
    "projectName"=>"Heart mind equation",
    "purposedEmailAuthor"=>["thanksForJoining"=>["author_email"=>"ludemia@heartmindequation.com","author_name" =>"Lude Mia"]],
    "purposedEmailConfigs"=>["thanksForJoining_en"=>[
                                                  "title"=>"Welcome to the equation"
                                                 ,"content"=>'Thank you for joining. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                                               ]
                            ,"thanksForJoining_fr"=>["title"=>"Bienvenue à l'équation"
                                                    ,"content"=>'Merci de nous joindre. You will now be notified as to when new content is generated from <b><a href="http://www.heartmindequation.com">our site</a></b>'
                                                   ]
      
                            ]
];
$globalSettings ["mailConfigs"] = $mailConfigs;




?>
