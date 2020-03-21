<?php

namespace models
{
    require_once "interfaces/IMailingList.php";
    require_once "StoredPubliser.php";
    require_once "AModel.php";
    use models\interfaces\IMailingList;
 class FormedOutMailingListDescription extends AModel implements IMailingList 
 {
    private $name;
    private $owner;
    private $owner_id;
    private $owner_user_id;
    private $owner_name;
    private $owner_email;


    public function __construct($raw)
    {            
          $this->name = $raw["name"];
          $this->owner_id =  $raw["owner_id"];
          $this->owner_user_id = $raw["owner_user_id"];
          $this->owner_name = $raw["owner_name"];
          $this->owner_email = $raw["owner_email"];
          $raw["user_id"] = $this->owner_user_id;
          $raw["name"] = $this ->owner_name;
          $raw["email"]= $this->owner_email;
          $raw["publisherId"] = $this->owner_id;
          $this->owner = new StoredPublisher($raw);       
    }


    
    /**
     * Get the value of owner_id
     */ 
    public function getOwner_id()
    {
        return $this->owner_id;
    }

    /**
     * Set the value of owner_id
     *
     * @return  self
     */ 
    public function setOwner_id($owner_id)
    {
        $this->owner_id = $owner_id;

        return $this;
    }

    
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */ 
    public function setOwner(StoredPublisher $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    
    /**
     * Get the value of owner_user_id
     */ 
    public function getOwner_user_id()
    {
        return $this->owner_user_id;
    }

    /**
     * Set the value of owner_user_id
     *
     * @return  self
     */ 
    public function setOwner_user_id($owner_user_id)
    {
        $this->owner_user_id = $owner_user_id;

        return $this;
    }

    
    /**
     * Get the value of owner_name
     */ 
    public function getOwner_name()
    {
        return $this->owner_name;
    }

    /**
     * Set the value of owner_name
     *
     * @return  self
     */ 
    public function setOwner_name($owner_name)
    {
        $this->owner_name = $owner_name;

        return $this;
    }

    /**
     * Get the value of owner_email
     */ 
    public function getOwner_email()
    {
        return $this->owner_email;
    }

    /**
     * Set the value of owner_email
     *
     * @return  self
     */ 
    public function setOwner_email($owner_email)
    {
        $this->owner_email = $owner_email;

        return $this;
    }

 }




}
?>
