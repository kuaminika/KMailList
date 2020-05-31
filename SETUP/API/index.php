<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//inspired from : https://developer.okta.com/blog/2019/03/08/simple-rest-api-php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


echo "setup api reahced";

require_once dirname(__DIR__)."/../Log_Utilities/require_all.php";
require_once dirname(__FILE__)."/require_all.php";

$namespace = "\\". "APISetUpTools";

$className = "LaunchSetUpCommand";
$toolClassName = "SetUpTool";
$path = $namespace ."\\".$className;
$pathOfTool =  $namespace ."\\". $toolClassName;

$logTool = Log_Utilities\LogToolCreator::getCreateLogFn("echo")();


echo $namespace;
$logTool->log("about to instanciate:". $pathOfTool );

$tool = new $pathOfTool();
$logTool->log("instanciated ". $pathOfTool) ;


$instance = new $path($tool);
$logTool->log( "instanciated ". $path) ;

$instance->execute();