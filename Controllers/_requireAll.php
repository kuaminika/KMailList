<?php 
/*
require_once dirname(__FILE__)."/ControllerToolBox.php";
    require_once dirname(__FILE__)."/PublishersController.php";
    require_once dirname(__FILE__)."/MailingListsController.php";
    require_once dirname(__FILE__)."/MessagesController.php";
    require_once dirname(__FILE__)."/SubscribersController.php";
*/

foreach (scandir(dirname(__FILE__)) as $filename)
 {
    $position = strrpos($filename,"Controller");
     $hasController =   $position >-1;
     if(!$hasController) continue;


    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}
?>