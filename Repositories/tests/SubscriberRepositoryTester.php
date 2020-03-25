<?php
namespace Repository\Tests;

require_once dirname(__FILE__)."/requireCommon.php";
require_once dirname(__FILE__)."/../SusbscriberRepository.php";
require_once dirname(__FILE__)."/../../Models/FormedOutSubscriber.php";

class SusbscriberRepositoryTester
{

    public function findAll()
    {
        
        $repoToolBox = \Repository\RepositoryToolBox::createToolBox();
        $repo = new \Repository\SusbscriberRepository($repoToolBox);
        $repo->findAll();
    }

    public function insert()
    {
        /*
          $this->email = $raw["email"];
        $this->name = $raw["name"];
        $this->addedBy = isset($raw["addedBy"]) ?$raw["addedBy"]:-1;
        $this->dateAdded = $raw["dateAdded"];// $d;

        */
        $arr =  array(
          "email"=> "kowona2020@mail.com"
        , "addedBy"=>  null
        , "dateAdded"=> null
        , "name"=>"kominikasyon"
        );
        $newSubscriber = new \models\FormedOutSubscriber($arr);
        $repoToolBox = \Repository\RepositoryToolBox::createToolBox();
        $repo = new \Repository\SusbscriberRepository($repoToolBox);
        $repo->getOrInsert($newSubscriber);

    }
 
}

?>