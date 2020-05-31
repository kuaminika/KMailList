<?php

namespace Log_Utilities{

    require_once "ILogTool.php";

 class EchoLogTool implements ILogTool 
 {
    private $ln = "</br>";
    private $name;
    public function __construct($name=null)
    {
        $this->name = isset($name)? $name:"log";

        $d = new \DateTime();
           echo  $d->format('Y-m-d\TH:i:s.u').":". "log tool:".$this->name."-created".$this->ln; 
    }

    public function logWithTab($str)
    {
        $d = new \DateTime();
        echo  "--->".$d->format('Y-m-d\TH:i:s.u')."-".$this->name.":". $str.$this->ln; 
    }

    public function log($str)
    {

        $d = new \DateTime();
           echo  $d->format('Y-m-d\TH:i:s.u')."-".$this->name.":". $str.$this->ln; 
    }

    public function showObj($obj)
    {       $d = new \DateTime();
         echo  $d->format('Y-m-d\TH:i:s.u')."-".$this->name.":";
        echo $this->ln; 

        var_dump($obj);

        echo $this->ln; 

    }

    public function showVDump($obj)
    {
        ob_start();
        var_dump($obj);
        $result = ob_get_clean();

        $this->log($result);
    }


 }


}

?>