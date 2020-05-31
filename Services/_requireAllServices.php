<?php
/*
require_once dirname(__FILE__)."/PublisherService.php";
require_once dirname(__FILE__)."/MailingListService.php";
require_once dirname(__FILE__)."/MessageService.php";
require_once dirname(__FILE__)."/SubscriberService.php";
*/
//require_once dirname(__FILE__)."/";
foreach (scandir(dirname(__FILE__)) as $filename) {
    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}