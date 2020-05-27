<?php

namespace Log_Utilities
{
    interface ILogTool{

         public function log($str);
         public function logWithTab($str);
         public function showObj($obj);
         public function showVDump($obj);

    }
}

?>