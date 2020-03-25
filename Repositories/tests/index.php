<?php

    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    require_once "PublisherRepositoryTester.php";
    require_once "MailingListRepositoryTester.php";
    require_once dirname(__FILE__)."/SubscriberRepositoryTester.php";

    require_once dirname(__FILE__)."/../../K_Utilities/KIgniter.php";


    \K_Utilities\KIgniter::Ignite();
/*
    $tester = new \Repository\Tests\PublisherRepositoryTester();
    $tester->TestPublisherRepositor_findAll();
*/
    $tester = new \Repository\Tests\MailingListRepositoryTester();
    $tester->testAddingMailingList();

    $tester = new \Repository\Tests\SusbscriberRepositoryTester();
    $tester->insert();


    $tester->findAll();

?>