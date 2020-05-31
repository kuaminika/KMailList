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



require_once dirname(__DIR__)."/../Log_Utilities/require_all.php";
require_once dirname(__FILE__)."/require_all.php";

$kApiTool = new \K_Utilities\K_APITool();
\K_Utilities\KIgniter::Ignite();
$namespace = "\\". "APISetUpTools";

$configs = isset($configs)? $configs: \KConfigSet::getCurrentConfigs(); 
   


$logTool =   $configs->getConfig("currentDBLogTool");// Log_Utilities\LogToolCreator::getCreateLogFn("echo")();

$logTool->log("about to instanciate:". $namespace );

//showVDump
$logTool->log($kApiTool->getRequestMethod());

$logTool->showVDump($kApiTool->getRequestParams());

$requestCommandKeyName = "context";
$request = $kApiTool->getRequestParams();
//LaunchSetU
$commandGiven =   key_exists($requestCommandKeyName,$request);

$defaultCommand = "LaunchSetUp";

$commandToExecute = $commandGiven ? $request[$requestCommandKeyName]: $defaultCommand;


$className = $commandToExecute."Command";
$toolClassName = "SetUpTool";
$path = $namespace ."\\".$className;
$pathOfTool =  $namespace ."\\". $toolClassName;

$logTool->log("about to instanciate:". $pathOfTool );


$logTool->log("about to instanciate:". $pathOfTool );

$tool = new $pathOfTool();
$logTool->log("instanciated ". $pathOfTool) ;


$command = new $path($tool);

$command->execute();
