
<?php




require_once dirname(__DIR__)."/SetDBCommand.php";
require_once dirname(__DIR__)."/SetUpBuilder.php";
require_once dirname(__DIR__)."/../K_Utilities/K_APITool.php";
require_once dirname(__DIR__)."/../K_Utilities/KIgniter.php";
require_once dirname(__DIR__)."/../DB_Utilities/MYSQL_DBTool.php";
require_once dirname(__DIR__)."/../KConfigSet.php";
require_once dirname(__DIR__)."/../configs.php";
foreach (scandir(dirname(__FILE__)) as $filename)
 {
    $position = strrpos($filename,"index");
     $hasController =   $position >-1;
     if($hasController) continue;

    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path)) {
     //  useful for validaing call order
     //   echo "require_once '".$path."'";
     //   echo "</br>";

        require_once $path;
    }
}