<?php

require_once dirname(__DIR__)."/_requireAll.php";

use PHPUnit\Framework\TestCase;
class ContactFormSubmissionTest extends TestCase 
{


    public function getSpecimenInstance($rawArr = null)
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
  

    public function testInstanciateFromRawArr()
    {

        $rawArr = [];
        $rawArr["message"] = ["title" => "test ", "author"=> "herman  tester ", "content"=>"hihi this is a test"];
        $rawArr["sender"] = ["email" => "test@kuaminika.com", "name"=> "herman"];
        $rawArr["otherAttributes"] = ["phone" => "555-555-5555"];

        
        $specimen = $this->getSpecimenInstance($rawArr);

        $message = $specimen->getMessage();
        $sender = $specimen->getSender();

        $this->assertEquals($message->title,$rawArr["message"]["title"]);
        $this->assertEquals($message->author,$sender->name);
        $this->assertEquals($sender->email,$rawArr["sender"]["email"]);
    }


    public function testGettingJSON()
    {
      $specimen = $this->getSpecimenInstance();
      $something = $specimen->_toJson();
      $itGivesSomething = isset($something);
      self::assertTrue($itGivesSomething,"it ding give nothing");
    }


}