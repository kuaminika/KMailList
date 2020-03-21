<?php

namespace models
{
    require_once "interfaces/IMailingList.php";
    require_once "StoredPubliser.php";
    require_once "AModel.php";
    use models\interfaces\IMailingList;
 class StoredMalingListDescription extends AModel implements IMailingList 
 {
    private $name;
    private $id; 
    private $owner_id;
    private $owner;


    public function __construct($raw)
    {            
          $this->id = $raw["mailingList_id"];
          $this->name = $raw["name"];
          $this->owner_id =  $raw["owner_id"];
          $this->owner = new StoredPublisher($raw);       
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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

 }


}
?>
