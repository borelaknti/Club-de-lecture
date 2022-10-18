<?php

include_once realpath(dirname(__FILE__)).'/database.php';

class DatabaseObjects{

    //common database methods
    /**
     * @return array|null
     */
    public static function findAll(): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName);
    }

    /**
     * @return array|null
     */
    public static function findAllAvailable(): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName." WHERE utilisateur.etatUtilisateur = 'A'");
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

    /**
    * @param $velo
    * @return array
    */
    public function updateEtat($velo,$etat)
    {
       
        $sql = "UPDATE utilisateur SET etatUtilisateur= '".$etat."' WHERE utilisateur.numUtilisateur= $velo";
        //die(var_dump($sql));
        global $database;
        $req = $database->openConnection()->prepare($sql);
        //die(var_dump($clientsArray));
        $result = $req->execute();
        if ($result){
            return ['success'=>true];
        }
        else{
            return ['success'=>false];
        }

    }

}