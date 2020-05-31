<?php

namespace SETUP
{

use Exception;

require_once dirname(__FILE__)."/ExtraSetUpCommand.php";
require_once dirname(__FILE__)."/RequireAllCommands.php";

    class SetUpBuilder
    {

        private $defaultSetUp;
        private $confirmedSetUp;

        public function __construct($default)
        {
            $this->defaultSetUp = $default;
            $this->confirmedSetUp = $default;
        }


        public function setLogTool($newLogTool)
        {
                $this->confirmedSetUp->setLogTool($newLogTool);
        }

        public function reset()
        {
            
            $this->confirmedSetUp = $this->defaultSetUp;
        }

        public function addSetup($setUpClassName)
        {
            $setUpClassName= "SETUP\\".$setUpClassName;
            if(!class_exists($setUpClassName))
            {
               throw new Exception($setUpClassName." not found"); 
            }

            $this->confirmedSetUp = new $setUpClassName($this->confirmedSetUp);
            return $this->confirmedSetUp;
        }
        public function getCommand()
        {
            return $this->confirmedSetUp;
        }

    }


}


?>