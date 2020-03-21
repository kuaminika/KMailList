<?php

    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    require_once "testers/PublisherRepositoryTester.php";
    require_once "testers/MailingListRepositoryTester.php";

    $tester = new \Repository\Testers\PublisherRepositoryTester();
    $tester->TestPublisherRepositor_findAll();

    $tester = new \Repository\Testers\MailingListRepositoryTester();
    $tester->testAddingMailingList();

?>