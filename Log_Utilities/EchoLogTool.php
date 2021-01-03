<?php

namespace Log_Utilities{

    require_once "ILogTool.php";

 class EchoLogTool implements ILogTool 
 {
    private $ln = "</br>";
    private $name;
    private $isActive;

    public function __construct($name=null,$isActive=true)
    {
        $this->name = isset($name)? $name:"log";
        $this->isActive = $isActive;
        $d = new \DateTime();

        if(!$this->isActive) return;
        
           echo  $d->format('Y-m-d\TH:i:s.u').":". "log tool:".$this->name."-created".$this->ln; 
    }

    
    public function toggleActivation($isActive)
    {
        $this->isActive = $isActive;
    }

    public function logWithTab($str)
    {
        if(!$this->isActive) return;
        $d = new \DateTime();
        echo  "--->".$d->format('Y-m-d\TH:i:s.u')."-".$this->name.":". $str.$this->ln; 
    }

    public function log($str)
    {

        if(!$this->isActive) return;
        $d = new \DateTime();
           echo  $d->format('Y-m-d\TH:i:s.u')."-".$this->name.":". $str.$this->ln; 
    }

    public function showObj($obj)
    { 
        
        if(!$this->isActive) return;
              $d = new \DateTime();
         echo  $d->format('Y-m-d\TH:i:s.u')."-".$this->name.":";
        echo $this->ln; 

        var_dump($obj);

        echo $this->ln; 

    }

    public function showVDump($obj)
    {
        
        if(!$this->isActive) return;
        ob_start();
        var_dump($obj);
        $result = ob_get_clean();

        $this->log($result);
    }


 }


}

?>