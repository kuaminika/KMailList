<?php 

    namespace DB_Utilities
    {
        use DB_Utilities\IDBTool;
    use Exception;

require_once "IDBTool.php";
        class MYSQL_DBTool   implements IDBTool      
        {
            private $servername;
            private $username;
            private $password;
            private $dbname;            
            private $connection;
            private $queryStatement;
            private $queryObjectOpened = FALSE;
            private $queryCount =0;
            private $insertId;
             public function __construct($servername, $username, $password, $dbname)
             {
                 $this->servername = $servername;
                 $this->username = $username;
                 $this->password = $password;
                 $this->dbname = $dbname;
             }   

             public function __destruct()
             {
                if(!$this->connection) return;

                 if($this->queryObjectOpened)
                     $this->queryStatement->close();

                $this->connection->close();

             }

             public function connectToDB()
             {
                $charset = 'utf8';
                    // Create connection
                    $this->connection = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
                    // Check connection
                    if ($this->connection->connect_error) {
                        die("Connection failed: " .$this->connection->connect_error);
                    }		
                    
                    $this->connection->set_charset($charset);
                  //  echo "Connected successfully";
             }

             public function fetchAll($callback = null)
              {
                $params = array();
                $row = array();
                $meta = $this->queryStatement->result_metadata();
                while ($field = $meta->fetch_field()) {
                    $params[] = &$row[$field->name];
                }
                call_user_func_array(array($this->queryStatement, 'bind_result'), $params);
                $result = array();
                while ($this->queryStatement->fetch()) {
                    $r = array();
                    foreach ($row as $key => $val) {
                        $r[$key] = $val;
                    }
                    if ($callback != null && is_callable($callback)) {
                        $value = call_user_func($callback, $r);
                        if ($value == 'break') break;
                    } else {
                        $result[] = $r;
                    }
                }
                $this->queryStatement->close();
                $this->queryObjectOpened = FALSE;
                return $result;
            }
             public function runQuery($query)
             {
                 if(!isset($this->connection)) throw new Exception("cannot do".$query.":no connection established");
                
                 if($this->queryObjectOpened)
                   $this->queryStatement->close();

                $this->queryStatement = $this->connection->prepare($query);

                if(!$this->queryStatement) throw new Exception('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);    

                $this->queryStatement->execute();
                $this->insertId = $this->connection->insert_id;

                if ($this->queryStatement->errno)
                {
                    throw new Exception('Unable to prepare MySQL statement (check your syntax) - ' . $this->queryStatement->error);    

                }
                 
                $this->queryObjectOpened = TRUE;
            
                 $this->queryCount++;

                return $this;
             }


             public function convertDate($date)
             {
                 $d = $date;
               return $d->format('Y-m-d H:i:s');
             }

             public function fetchArray() {
                $params = array();
                $row = array();
                $meta = $this->queryStatement->result_metadata();
                while ($field = $meta->fetch_field()) {
                    $params[] = &$row[$field->name];
                }
                call_user_func_array(array($this->queryStatement, 'bind_result'), $params);
                $result = array();
                while ($this->queryStatement->fetch()) {
                    foreach ($row as $key => $val) {
                     
                        $result[$key] = $val;
                    }
                }
                $this->queryStatement->close();
                $this->queryObjectOpened = FALSE;
                return $result;
            }
             public function tableExists($tableName)
             {
                $queryToCheck = "show tables like '".$tableName."';";
               return !empty( $this->runQuery($queryToCheck)->fetchArray());
             }

             public function validateFKIsPossible($fkHostTableName,$tableName)
             {
                 
                $doAble = $this->tableExists( $fkHostTableName);      
                
                if( ! $doAble) 
                {
                    throw new Exception("failed to create ". $tableName." because ". $fkHostTableName." does not exist");
                }
             }
             
             public function fkBuildFKCommand($fkHostTableName,$tableName,$localColumn,$foreignColumn)
             {
                 $keyName = $fkHostTableName."_".$tableName;
                 $addKeyCmd = "ALTER TABLE `".$tableName."` ADD KEY `".$keyName."` (`".$localColumn."`);";

                 $addFKCmd = "ALTER TABLE `".$tableName."`
                 ADD CONSTRAINT  `".$keyName."` FOREIGN KEY (`".$localColumn."`) REFERENCES `".$fkHostTableName."` (`".$foreignColumn."`);";

                $this->runQuery($addKeyCmd);
                $this->runQuery($addFKCmd);

             }


             /**
             * Get the value of insertId
             */ 
            public function getInsertId()
            {
                return $this->insertId;
            }
        }

            
    }

?>