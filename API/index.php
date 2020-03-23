<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/../K_Utilities/KIgniter.php";
require_once dirname(__FILE__)."/../Controllers/requireAll.php";


//inspired from : https://developer.okta.com/blog/2019/03/08/simple-rest-api-php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$request = $_REQUEST;

$requestMethod = $_SERVER["REQUEST_METHOD"];

\K_Utilities\KIgniter::Ignite();

if(!$request["context"])
{
    header("HTTP/1.1 404 Not Found");
    exit();
}
$controllerName ="\\Controllers\\". $request["context"]."sController";
$controllerExists = class_exists($controllerName);
if(!$controllerExists)
{

    header("HTTP/1.1 404  Not Found");
    exit();
}

// \Controllers\PublishersController


$createControllerParams = array("context"       =>$request["context"]
                                ,"configs"      =>\KConfigSet::getCurrentConfigs()
                                ,"requestAction"=>$request["requestAction"]
                                ,"requestParams" => array());
$contrrolerToolBox = \Controllers\ControllerToolBox::createNew($createControllerParams );
$controller = new $controllerName($contrrolerToolBox);

$controller->processRequest();

?>