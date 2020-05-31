<?php 
require_once  dirname(__DIR__)."/configs.php";
require_once dirname(__DIR__)."/K_Utilities/KIgniter.php";
foreach (scandir(dirname(__FILE__)) as $filename) {
    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path) ) {
        require_once $path;
    }
}