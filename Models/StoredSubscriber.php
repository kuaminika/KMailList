<?php

namespace models;
require_once dirname(__FILE__)."/interfaces/ISubscriber.php";
require_once dirname(__FILE__)."/StoredUser.php";

use models\interfaces\ISubscriber;
use stdClass;

/**
 * this model represents a susbcriber from a list. 
 * not a subscriber for as a whole
 */
class StoredSubscriber extends StoredUser implements ISubscriber
{/*
    private $id;

    private $email;
    private $name;
*/
    private $subscriberId;
    private $membershipId;
    private $dateAdded;
    private $addedById;
    private $addedBy;
    private $listId;
    
    public function __construct($raw=null)
    {        
        if(!isset($raw)) return;
     
        $raw = $this->confirmMembershipInfo($raw);
        $this->id = $raw["user_id"];
        $this->email = $raw["email"];
        $this->name = $raw["name"];
        $this->listId = $raw["list_id"];
        $this->subscriberId = $raw["id"];
        $this->membershipId = $raw["membership_id"];
        $this->dateAdded = $raw["date_subscribed"];
        $this->addedById = $raw["added_by_id"];
        $this->addedBy = $raw["added_by"];
    }

    private function confirmMembershipInfo($raw)
    {
        $defaultListId = 999;
        if(!key_exists("list_id",$raw))
            $raw["list_id"]= $defaultListId;
       
        if(!key_exists("membership_id",$raw))
            $raw["membership_id"]=  $raw["user_id"];

        return $raw;
    }


    public function createFromStdObj(stdClass $raw)
    {
        $this->id = $raw->id;
        $this->email = $raw->email;
        $this->name = $raw->name;
        $this->listId = $raw->listId;
        $this->subscriberId = $raw->subscriberId;
        $this->membershipId = $raw->membershipId;
        $this->dateAdded = $raw->dateAdded;
        $this->addedById = $raw->addedById;
        $this->addedBy = $raw->addedBy;
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

   

    /**
     * Get the value of membershipId
     */ 
    public function getMembershipId()
    {
        return $this->membershipId;
    }

    /**
     * Get the value of listId
     */ 
    public function getListId()
    {
        return $this->listId;
    }
}




?>