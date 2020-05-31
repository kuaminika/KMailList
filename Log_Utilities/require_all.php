<?php 

foreach (scandir(dirname(__FILE__)) as $filename)
 {
    $position = strrpos($filename,"index");
     $hasController =   $position >-1;
     if($hasController) continue;


    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}