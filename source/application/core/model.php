<?php

class Model
{
    // соединение с бд
    protected $conn;
    
    // подключение к бд
    public function db_connect()
    {
        try
        {
            $this->conn = new PDO( "mysql:host=".Config::$db_host.";port=".Config::$db_port.";dbname=".Config::$db_base, Config::$db_user, Config::$db_password );
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->conn->query( 'SET NAMES utf8' );
        }
        catch(PDOException $e)
        {
            echo "Database connection error.";
            
            $message = "Exception: ".get_class($e)." with message: ".$e->getMessage()." on line ".$e->getLine();
			if(ini_get('display_errors') == 1) { echo "<br /><br />",$message; }
            if(ini_get('log_errors') == 1) error_log($message);
            
            exit;
        }
    }
    
    // отключение от бд
    public function db_disconnect()
    {
        $this->conn = null;
    }
}