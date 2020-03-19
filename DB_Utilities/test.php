<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./DBToolBuilder.php";
use DB_Utilities;
$config =[];
 $config["servername"] = "localhost";
 $config["username"] = "datauser";
 $config["password"]= "data100";
 $config["dbname"] = "K_mail_list";            
 $config["dbChosenDBToolName"]="MYSQL_DBTool";

$tool = new  DB_Utilities\DBToolBuilder($config);//DB_Utilities\MYSQL_DBTool($servername, $username, $password, $dbname);
$db = $tool->buildDBTool()->connectToDB();

$tbExistRslt = $db->tableExists("User");

$createUsersTblQuery = "CREATE TABLE `Users` (
    `id` int(10) NOT NULL,
    `email` varchar(200) NOT NULL,
    `name` varchar(300) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;  
";


$db->runQuery($createUsersTblQuery);

$db->runQuery("ALTER TABLE `Users`ADD PRIMARY KEY (`id`);")
//var_dump($tbExistRslt);


?>