<?php
require_once("config.php");


class Database{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private  $dbname = DB_NAME;

    private $connection;
    private $error;
    private $stmt;
    private $dbconnected = false;


    function __construct()
    {
        //data source name
        $dsn = "mysql:host =" .$this->host.";dbname=".$this->dbname;
        try{
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->dbconnected = true;


        }catch(PDOException $e) {
            $this->error = $e->getMessage();
            $this->dbconnected = false;
        }
    
    }


    function getError(){
        return $this->error;
    }

    function isConnected(){
        return $this->dbconnected;

    }
    //prepare statement with query
    function query($query){
        $this->stmt = $this->connection->prepare($query);
    }
    //execute prepared statement
    function execute(){
        return $this->stmt->execute();
    }
    // get the result set as array of object
    function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);

    }

    function rowCount(){
        return $this->stmt->rowCount();
    }

    function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }


    function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;    

            }

        }

        $this->stmt->bindValue($param, $value, $type);
    }






}


?>