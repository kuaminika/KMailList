<?php 

require_once dirname(__DIR__)."/_requireAll.php";

//use Mail_utilities;
use PHPUnit\Framework\TestCase;

class KMailFacadeTester extends TestCase
{


    public function instanciateFacade()
    {  K_Utilities\KIgniter::Ignite();
        $kMailFacade = \Mail_utilities\KMailFacade::create(); 
        return $kMailFacade;       
    }
    public function getContactFormSpecimen($rawArr = null)
    {

      if($rawArr== null)
      {
        $rawArr = [];
        $rawArr["message"] = ["title" => "test ", "author"=> "herman  tester ", "content"=>"hihi this is a test"];
        $rawArr["sender"] = ["email" => "test@kuaminika.com", "name"=> "herman"];
        $rawArr["otherAttributes"] = ["phone" => "555-555-5555"];
      }
      $specimen =  new models\ContactFormSubmission($rawArr);
      return $specimen;
    }
  


    public function testSendingMessageToContactForm()
    {
        try
        {
            $kMailFacade= $this->instanciateFacade();
            $contactFormSubmission = $this->getContactFormSpecimen();
            
            $kMailFacade->sendContactFormEmailToRecipient($contactFormSubmission);
            self::assertTrue(true);// meaning it didnt fail
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function testInstanciatingFacade()
    {
        $specimen = $this->instanciateFacade();

        $this->assertNotEmpty( $specimen , "The facade is empty" );
    }
}