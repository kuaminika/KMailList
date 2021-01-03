<?php
/*
// remove comments for dev mode
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require_once dirname(__FILE__)."/../K_Utilities/KIgniter.php";
require_once dirname(__FILE__)."/../Controllers/_requireAll.php";


//inspired from : https://developer.okta.com/blog/2019/03/08/simple-rest-api-php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );


$requestMethod = $_SERVER["REQUEST_METHOD"];





$request =$_REQUEST;

if( !array_key_exists("context",$request))
{
    header("HTTP/1.1 404 Not Found");
   // echo "context missing";
    
   echo json_encode( $_SERVER);
   exit();
}
$requestParams = $request;
if($requestMethod == "POST")
{
    $json = file_get_contents('php://input');
   $json_decoded = ["jsonValue" =>json_decode($json)];
   
    $requestParams = array_merge($_POST,$json_decoded);
}
unset($requestParams["context"]);
unset($requestParams["requestAction"]);

$controllerName ="\\Controllers\\". $request["context"]."sController";

$controllerExists = class_exists($controllerName);
if(!$controllerExists)
{

    header("HTTP/1.1 404  Not Found");
    exit();
}
\K_Utilities\KIgniter::Ignite();
$setUpControllerName = "SetUp";
$setUpControllerCalled = strstr($controllerName,$setUpControllerName );

if($setUpControllerCalled)
{
    echo "set up controller is called ";
    echo $controllerName;
    die;
}

// \Controllers\PublishersController


$createControllerParams = array("context"       =>$request["context"]
                                ,"configs"      =>\KConfigSet::getCurrentConfigs()
                                ,"requestAction"=>$request["requestAction"]
                                ,"requestParams" =>$requestParams
                                ,"requestMethod" =>$requestMethod);
$contrrolerToolBox = \Controllers\ControllerToolBox::createNew($createControllerParams );
$controller = new $controllerName($contrrolerToolBox);

$controller->processRequest();

?>