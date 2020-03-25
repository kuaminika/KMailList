<?php

namespace models
{
    require_once "interfaces/IPublisher.php";
  
  require_once dirname(__FILE__)."/StoredUser.php";
    //  require_once "AModel.php";
    use models\interfaces\IPublisher;
 class StoredPublisher extends StoredUser implements IPublisher 
 {
 //   private $name;
  //  private $email;
   // private $id; 
    private $publisherId;


    public function __construct($raw)
    {     
       
        /*  $this->id = $raw["user_id"];
          $this->name = $raw["name"];
          $this->email =$raw["email"];*/
          $this->publisherId = $raw["publisherId"];
       
    }

    public function getName()
    {
        return $this->name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getPublisherId()
    {
        return $this->publisherId;
    }
    public function getEmail()
    {
        return $this->email;
    }
 }

}
?>
