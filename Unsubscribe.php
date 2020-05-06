<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use models\StoredSubscriber;
use Service\SubscriberService;
use Service\ServiceToolBox;
//ServiceToolBox
use Security_Utilities\Token_Utilities\KTokenFacade;
require_once dirname(__FILE__)."/K_Utilities/KIgniter.php";
require_once dirname(__FILE__)."/KConfigSet.php";
require_once dirname(__FILE__)."/Security_Utilities/Token_Utilities/KTokenFacade.php";
require_once dirname(__FILE__)."/Services/ServiceToolBox.php";
require_once dirname(__FILE__)."/Services/SubscriberService.php";
require_once dirname(__FILE__)."/Models/StoredSubscriber.php";
$code = $_GET["UNSUBSCRIBE"];


try
{

    \K_Utilities\KIgniter::Ignite();
    $_KTokenFacade = KTokenFacade::create();
    $result = $_KTokenFacade->resolveCode($code);

    $subscriber = new StoredSubscriber();
    $subscriber->createFromStdObj($result);
    $serviceToolBoxx = ServiceToolBox::createToolBox("Subscriber");
    $susService = new SubscriberService($serviceToolBoxx);

    $susService->removeSubscriberToList($subscriber);

    echo $subscriber->email . " is removed";
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}
