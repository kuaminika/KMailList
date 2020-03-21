<?php

namespace Repository
{
    class ARepository
    {
        protected $_queryBoard;
        protected $configSet;
        protected $dbTool;
        protected $logTool;

        public function __construct($toolBox)
        {
            $this->dbTool = $toolBox->dbTool;
            $this->configSet = $toolBox->configSet;// \KConfigSet::getCurrentConfigs();
            $this->_queryBoard = [];
            $this->logTool = $toolBox->logTool;
        }

    }
}


?>