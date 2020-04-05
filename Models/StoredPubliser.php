<?php

namespace models
{
    require_once "interfaces/IPublisher.php";
  
  require_once dirname(__FILE__)."/StoredUser.php";
 
    use models\interfaces\IPublisher;
 class StoredPublisher extends StoredUser implements IPublisher 
 {
    private $publisherId;


    public function __construct($raw)
    {    
          $raw["id"] =  $raw["user_id"];
       parent::__construct($raw);
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
