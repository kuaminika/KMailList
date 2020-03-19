<?php


class KConfigSet{
    private $configSetArray;

    private static $currentConfigs;

    public static function createNewConfigs($configArray)
    {
        $result = new KConfigSet($configArray);
        self::$currentConfigs =$result;
        return $result;
    }

    public static function getCurrentConfigs()
    {
        $result = self::$currentConfigs;
        return $result;
    }

    private function __construct($configArray)
    {
        $this->configSetArray = $configArray;
        
    }

    public function hasCongfig($configName)
    {
        $result = array_key_exists($configName,$this->configSetArray);
        return $result;
    }

    public function getConfig( $configName)
    {
        if(!$this->hasCongfig($configName))
        {
            throw new Exception("Config:".$configName." does not exist");
        }


        $result = $this->configSetArray[$configName];

        return $result;

    }



  }




?>