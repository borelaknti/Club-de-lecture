<?php
    date_default_timezone_set('America/New_York');
    require_once('config.php');

class MySQLDatabase
{

    private $connection;

    function __construct()
    {
        $this->openConnection();
    }


    /**
     * @return PDO|void
     */
    public function openConnection()
    {

          try {

            $this->connection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $this->connection;

          } catch(PDOException $e) {

            echo "Connection failed: " . $e->getMessage();

          }
    }

    /**
     * @return mixed
     */
    public function lastInsertId():int
    {
        return $this->connection->lastInsertId();
    }

}

$database = new MySQLDatabase();