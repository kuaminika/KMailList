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
        $raw["id"] = \key_exists("user_id",$raw)? $raw["user_id"] :0;
        parent::__construct($raw);
        $this->publisherId = \key_exists("publisherId",$raw)?  $raw["publisherId"]:0;
       
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
