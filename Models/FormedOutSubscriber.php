<?php
namespace models;

use Exception;
use models\interfaces\ISubscriber;

require_once dirname(__FILE__)."/interfaces/ISubscriber.php";
require_once dirname(__FILE__)."/AModel.php";

class FormedOutSubscriber extends AModel implements ISubscriber 
{


    private $email;
    private $name;
    private $dateAdded;
    private $addedById;


    private $listToAddId;

    public function __construct($raw)
    {
        if(!array_key_exists("email",$raw) )
            throw new Exception("missing email in:". json_encode($raw));
        if(!array_key_exists("name",$raw))
            throw new Exception("missing name in:". json_encode($raw));
        

          $d = isset( $raw["dateAdded"]) ?  $raw["dateAdded"] : new \DateTime();
        $this->email = $raw["email"];
        $this->name = $raw["name"];
        $this->addedById = isset($raw["addedById"]) ?$raw["addedById"]:0;
        $this->dateAdded =  $d->format('Y-m-d\ H:i:s.u');
        $this->listToAddId = isset($raw["listToAddId"])?$raw["listToAddId"]:0;

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

    public function getAddedBy()
    {
        return "";
    }

    /**
     * Get the value of addedBy
     */ 
    public function getAddedById()
    {
        return $this->addedById;
    }

    /**
     * Set the value of addedBy
     *
     * @return  self
     */ 
    public function setAddedById($addedBy)
    {
        $this->addedById = $addedBy;

        return $this;
    }

    /**
     * Get the value of listToAddId
     */ 
    public function getListToAddId()
    {
        return $this->listToAddId;
    }

    /**
     * Set the value of listToAddId
     *
     * @return  self
     */ 
    public function setListToAddId($listToAddId)
    {
        $this->listToAddId = $listToAddId;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

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
}

?>