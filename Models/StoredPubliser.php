<?php
 require_once "./interfaces/IPublisher.php";

 use models\interfaces\IPublisher;


 class StoredPublisher implements IPublisher
 {
    private $name;
    private $email;
    private $id; 
    private $publisherId;


    public function __construct()
    {
       
          
       
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


?>
