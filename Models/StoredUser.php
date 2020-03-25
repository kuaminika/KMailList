<?php 
namespace models;

use models\interfaces\IModel;

require_once dirname(__FILE__)."/AModel.php";
require_once dirname(__FILE__)."/interfaces/IModel.php";

class StoredUser extends AModel implements IModel
{
    protected $id;
    protected $name;
    protected $email;

    public function __construct($raw)
    {
        $this->id = $raw["id"];
        $this->name = $raw["name"];
        $this->email = $raw["email"];
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
}

?>