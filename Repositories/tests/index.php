<?php

    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    require_once "PublisherRepositoryTester.php";
    require_once "MailingListRepositoryTester.php";

    $tester = new \Repository\Tests\PublisherRepositoryTester();
    $tester->TestPublisherRepositor_findAll();

    $tester = new \Repository\Tests\MailingListRepositoryTester();
    $tester->testAddingMailingList();

?>