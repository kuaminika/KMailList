<?php

namespace models;
require_once dirname(__FILE__)."/interfaces/ISubscriber.php";


use models\interfaces\ISubscriber;


class StoredSubscriber extends StoredUser implements ISubscriber
{/*
    private $id;

    private $email;
    private $name;
*/
    private $subscriberId;

    private $dateAdded;
    private $addedById;
    private $addedBy;
    
    public function __construct($raw)
    {
        
        $this->id = $raw["user_id"];

        $this->email = $raw["email"];
        $this->name = $raw["name"];

        $this->subscriberId = $raw["id"];

        $this->dateAdded = $raw["date_subscribed"];
        $this->addedById = $raw["added_by_id"];
        $this->addedBy = $raw["added_by"];

    }


    /**
     * Get the value of dateAdded
     */ 
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set the value of dateAdded
     *
     * @return  self
     */ 
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get the value of addedBy
     */ 
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Set the value of addedBy
     *
     * @return  self
     */ 
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }


    /**
     * Get the value of subscriberId
     */ 
    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    /**
     * Set the value of subscriberId
     *
     * @return  self
     */ 
    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;

        return $this;
    }

    /**
     * Get the value of addedById
     */ 
    public function getAddedById()
    {
        return $this->addedById;
    }

    /**
     * Set the value of addedById
     *
     * @return  self
     */ 
    public function setAddedById($addedById)
    {
        $this->addedById = $addedById;

        return $this;
    }

   
}




?>