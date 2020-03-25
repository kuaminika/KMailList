<?php

namespace Service\test;

require_once dirname(__FILE__)."/../../K_Utilities/TestToolBox.php";
require_once dirname(__FILE__)."/../PublisherService.php";
require_once dirname(__FILE__)."/../ServiceToolBox.php";
use K_Utilities\TestToolBox;
class PublisherServiceTester
{

    private $toolBox;
    public function __construct()
    {
        $this->toolBox = new TestToolBox();
        $this->toolBox->writeHeading1("Testing publisher service");
    }

    public function testfindAll()
    {
        $this->toolBox->writeHeading2("testing find all");

        
        $serviceToolBox = \Service\ServiceToolBox::createToolBox("Publisher");
        $publisherService = new \Service\PublisherService($serviceToolBox );
       $reslt = $publisherService->findAll();
       //var_dump($reslt->getContents());
        $list = $reslt->getContents();

        $this->toolBox->showListResults($list);

    }


    public function testInsert($newPublisher)
    {

    }


    
}

?>