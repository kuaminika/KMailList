<?php

//todo: move to K_Utilities
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
        $result = isset( self::$currentConfigs)? self::$currentConfigs: new KConfigSet([]);
        return $result;
    }

    /**
     * this method creates configs that will not be kept globally
     */
    public static function createLocalConfigSet($configArray)
    {
        $result = new KConfigSet($configArray);
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

    public function setConfig($newConfigName,$value)
    {
        $this->configSetArray[$newConfigName]=$value;
    }

    public function addConfig($newConfigName,$value)
    {
        $this->configSetArray[$newConfigName]=$value;
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