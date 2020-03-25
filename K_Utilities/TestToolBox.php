<?php
namespace K_Utilities;

require_once dirname(__FILE__)."/../Repositories/RepositoryToolBox.php";
require_once dirname(__FILE__)."/../Log_Utilities/LogToolCreator.php";
require_once dirname(__FILE__)."/../DB_Utilities/MYSQL_DBTool.php";
require_once dirname(__FILE__)."/../KConfigSet.php";
require_once dirname(__FILE__)."/../configs.php";

class TestToolBox{
    
    public function writeHeading1($str)
    {
        echo "<h1>".$str."</h1>";
    }

    public function writeHeading2($str)
    {
        echo "<h2>".$str."</h2>";        
    }
    
    public function showListResults($list)
    {
        
        ?>
        <ul>
        <?php
        foreach ( $list  as $el) 
        {?>
         <li><?php echo $el->_toJson(); ?></li>

        <?php
        }?>
        </ul>
        <?php
    }

    public function startConnection()
    {
        global $dbSetUpConfigs; 

       

        $servername = $dbSetUpConfigs["servername"];
        $username =  $dbSetUpConfigs["username"];
        $password=  $dbSetUpConfigs["password"];
        $dbname =  $dbSetUpConfigs["dbname"];         

        $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);

        $dbTool->connectToDB();
    }
/*
    public function createRepositoryToolBox()
    {
        global $globalSettings,$dbSetUpConfigs; 

        echo "<h2>test find all:</h2>";

        $servername = $dbSetUpConfigs["servername"];
        $username =  $dbSetUpConfigs["username"];
        $password=  $dbSetUpConfigs["password"];
        $dbname =  $dbSetUpConfigs["dbname"];         

                    
        $settings = $globalSettings;
        $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);
       
       // $logTool  = $this->getLogTool("echo")();

       $logTool  = \Log_Utilities\LogToolCreator::getCreateLogFn("echo")();//$this->getLogTool("echo")();

        $logTool->log("hihi im here :)");
        $configs =  \KConfigSet::createNewConfigs($settings );
        $params = [];
        $params["dbTool"]=$dbTool;
        $params["configSet"]=$configs;
        $params["logTool"]=$logTool;

        $toolBox = new \Repository\RepositoryToolBox($params);//$dbTool,$configs,$logTool);
        return $toolBox;
    }*/


}



?>