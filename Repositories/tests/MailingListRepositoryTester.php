<?php
namespace Repository\Tests{


    
    require_once "requireCommon.php";
   require_once dirname(__FILE__)."/"."../MailingListRepository.php";
   require_once dirname(__FILE__)."/"."../../Models/FormedOutMailingListDescription.php";

  
  use \models\FormedOutMailingListDescription;

    class MailingListRepositoryTester
    {
    
        public function testAddingMailingList()
        {
            echo "<h2>test adding new mailing list</h2>";
            $toolBox = \Repository\RepositoryToolBox::createToolBox();
            $toolBox->dbTool->connectToDB();
            $logTool = $toolBox->logTool;
            $repo = new  \Repository\MailingListRepository($toolBox);


            $rawFormMailingListDescription = [];

            $d = new \DateTime();

            $rawFormMailingListDescription ["name"]="Test from index". $d->format('Y-m-d\TH:i:s.u');
            $rawFormMailingListDescription ["owner_id"]=1;
            $rawFormMailingListDescription ["owner_user_id"]=1;
            $rawFormMailingListDescription ["owner_name"]="dont matter";
            $rawFormMailingListDescription ["owner_email"]="dont matter";


            $specimen = new FormedOutMailingListDescription($rawFormMailingListDescription);
            $logTool->log("<b>before:</b>");
            $repo->findAll();
             $repo->insert($specimen);

             $logTool->log("<b>after:</b>");
             $repo->findAll();


        }



    }


}

?>