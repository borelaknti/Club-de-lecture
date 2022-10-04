<?php

include_once realpath(dirname(__FILE__)).'/database.php';

class DatabaseObjects{

    //common database methods
    /**
     * @return array|null
     */
    public static function findAll($limit): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName." LIMIT $limit");
    }

    /**
     * @param string $sql
     * @return array|null
     */
    public static function findBySql(string $sql = ""): ?array
    {
        global $database;
        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute();
        $resultSet->setFetchMode(PDO::FETCH_OBJ);
        $results = null;

        while ($row = $resultSet->fetchAll()){
            $results = $row;
        }

        return $results;
    }


}