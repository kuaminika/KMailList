<?php
namespace Mail_utilities;

require_once "interfaces/IKRecipient.php";


class KRecipient implements IKRecipient
{

    private $name;
    private $email;

    public function __construct($params)
    {
        $this->name = $params["name"];
        $this->email = $params["email"];
    }

    public function getName(){

        return $this->name;

    }
    public function getEmail(){
        return $this->email;
    }


    public function getArrValue()
    {
      return  ["Email"=>$this->email,"Name"=>$this->name];
    }


    public function _toJson()
    {
       return  json_encode($this->getArrValue());
    }
}