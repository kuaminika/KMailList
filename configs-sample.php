<?php


$dbSetUpConfigs = array(
    "servername"=>"localhost"
    ,"username"=>"****"
    ,"password"=>"*****"
    ,"dbname"=>"***"
);        

             
 $globalSettings = array(
     "usersTableName" =>"wp_kml_User",
     "publishersTableName"=>"wp_kml_Publisher",
     "messagesTableName"=>"wp_kml_Message",
     "listsTableName"=>"wp_kml_MailingList",
     "subscribersListTableName"=>"wp_kml_SubscriberList",
     "subscribersTableName"=>"wp_kml_Subscriber",
     "logToolTableName"=>"wp_kml_Log"
 );



$tokenConfigs = [
     "secretKey"=>"seriz"
    , "tokenType"=>"JWT"
    , "lifeSpan_hrs" =>1
];

$mailConfigs =  [
    "apiKey"=> '****************************',
    "apiSecret" =>   '****************************',
    "businessRecipientList"=>[ ["Email"=>"***@gmail.com","Name"=>"test  person"]],
    "itRecipientList"=>[ ["Email"=>"kuaminika@gmail.com"]  ,["Email"=>"kuaminika@heartmindequation.com"] ],
    "outboundEmailForContactForm"=>"contact@heartmindequation.com" ,
    "projectName"=>"Heart mind equation",
    "sourceHost"=>"https://heartmindequation.com",
    "purposedEmailAuthor"=>["thanksForJoining"=>["author_email"=>"ludemia@heartmindequation.com","author_name" =>"Lude Mia"]],
    "purposedEmailConfigs"=>["thanksForJoining_en"=>[
                                                  "title"=>"Welcome to the equation"
                                                 ,"content"=>'Thank you for joining. You will now be notified as to when new content is generated from <b><a href="https://www.heartmindequation.com"> my site</a></b>'
                                               ]
                            ,"thanksForJoining_fr"=>["title"=>"Bienvenue à l'équation"
                                                    ,"content"=>'Merci de nous joindre. Vous serez désormais informé de la génération de nouveau contenu à partir de <b><a href="https://www.heartmindequation.com"> mon site</a></b>'
                                                   ]
      
                            ],
    "commandListMap"=> ["whenJoinedMailingList"=>["NotifyJoinMailingListCommand"]]
];

$purposedEmailAuthor = $mailConfigs["purposedEmailAuthor"];
$purposedEmailConfigs = $mailConfigs["purposedEmailConfigs"];

$purposedEmailAuthor["youReceivedFromContactForm"] = ["author_email"=>"info@heartmindequation.com","author_name" =>"HME INFO"];

$mailConfigs["purposedEmailAuthor"] = $purposedEmailAuthor;

$purposedEmailConfigs["youReceivedFromContactForm_en"] = [  "title"=>"You Received email from contact form"   ,"content"=>'Here are the contents of the message' ];
$purposedEmailConfigs["youReceivedFromContactForm_fr"] = [  "title"=>"You Received email from contact form"   ,"content"=>'Voici les contenus du message' ];
$mailConfigs["purposedEmailConfigs"] =$purposedEmailConfigs;



$globalSettings ["mailConfigs"] = $mailConfigs;
$globalSettings ["tokenConfigs"] = $tokenConfigs;

$globalSettings ["messageMap"] = [
                                  "thanksForJoin"=>["en"=>"Thank you",
                                                    "fr"=>"Merci " ]
                                                ];

