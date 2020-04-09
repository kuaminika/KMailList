<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/../K_Utilities/KIgniter.php";
require_once dirname(__FILE__)."/Token_Utilities/KTokenFacade.php";
require_once dirname(__FILE__)."/Token_Utilities/KTokenToolBox.php";
use K_Utilities\KIgniter;
use Security_Utilities\Token_Utilities\KTokenFacade;
use Security_Utilities\Token_Utilities\KTokenToolBox;

KIgniter::Ignite();

$configs =   \KConfigSet::getCurrentConfigs();
$tokenConfigArr = $configs->getConfig("tokenConfigs");
$toolbox = new KTokenToolBox($tokenConfigArr);
$toolbox->requestParamsArr = ["hihi"=>"hi"];

$facade = KTokenFacade::create($toolbox);


$token = $facade->createToken();

echo $token->getCode();

?>