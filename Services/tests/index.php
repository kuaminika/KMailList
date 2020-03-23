<?php 

     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);


     require_once dirname(__FILE__)."/PublisherServiceTester.php";
     require_once dirname(__FILE__)."/../../K_Utilities/KIgniter.php";

     $igniter = \K_Utilities\KIgniter::Ignite();
       $pst = new \Service\test\PublisherServiceTester();

       $pst->testfindAll();

    ?>