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

    //common database methods
    /**
     * @return array|null
     */
    public static function findAllMember(): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName." WHERE utilisateur.login_utilisateur IS NULL and utilisateur.mot_de_passe IS NULL ");
    }

    //common database methods
    /**
     * @return array|null
     */
    public static function findActifMember(): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName." WHERE (utilisateur.login_utilisateur IS NULL and utilisateur.mot_de_passe IS NULL) and utilisateur.etatUtilisateur = 'A' ");
    }
    

    /**
     * @return array|null
     */
    public static function findAllAvailable(): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName." WHERE utilisateur.etatUtilisateur = 'A'");
    }

     /**
     * @param $id
     * @return array|null
     */
    public static function findAssociation($id): ?array
    {
        return static::findBySql("SELECT * FROM ".static::$tableName." WHERE association.numAssociation = $id");
    }

    /**
     * @param $id
     * @return array|null
     */
    public static function findMemberAssociation($id): ?array
    {
        return static::findBySql("SELECT * FROM utilisateurassocier us JOIN association a on a.numAssociation = us.fknumAssociation JOIN utilisateur u on u.numUtilisateur = us.fknumUtilisateur WHERE a.numAssociation = $id");
    }

    /**
     * @param $id
     * @return array|null
     */
    public static function findAssociationMember($id): ?array
    {
        return static::findBySql("SELECT * FROM utilisateurassocier us JOIN association a on a.numAssociation = us.fknumAssociation JOIN utilisateur u on u.numUtilisateur = us.fknumUtilisateur WHERE u.numUtilisateur = $id");
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
    * @param $id
    * @return array
    */
    public function deleteMembreAssociation($id)
    {
       
        $sql = "DELETE  FROM utilisateurassocier  WHERE utilisateurassocier.fknumAssociation = $id";
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

    /**
    * @param $id
    * @return array
    */
    public function deleteAssociation($id)
    {
       
        $sql = "DELETE  FROM association  WHERE association.numAssociation = $id";
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

    /**
    * @param $id
    * @return array
    */
    public function updateEtat($id,$etat)
    {
       
        $sql = "UPDATE utilisateur SET etatUtilisateur= '".$etat."' WHERE utilisateur.numUtilisateur= $id";
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

    /**
     * @param $nom
     * @param $createur
     * @param $date
     * @param $adress
     * @return array
     */
    public function createAssociationArray( $nom, $createur, $date, $adress): array
    {
        return  ['nomAssociation'=>$nom, 'adresseAssociation'=>$adress, 'Datecreation'=>$date, 'nomCreateur'=>$createur];

    }

    /**
     * @param $member
     * @param $association
     * @return array
     */
    public function createPartnerArray( $member,$association ): array
    {
        return  ['fknumAssociation'=>$association, 'fknumUtilisateur'=>$member,'dateAjout' => NULL];

    }

    /**
     * @param $partnerArray
     * @return array|false
     */
    public function createPartner($partnerArray)
    {
        global $database;

        $sql = "INSERT INTO utilisateurassocier ( fknumAssociation, fknumUtilisateur, dateAjout) VALUES (?,?,?)";

        $resultSet = $database->openConnection()->prepare($sql);
        $results = $resultSet->execute(array($partnerArray["fknumAssociation"],$partnerArray["fknumUtilisateur"],$partnerArray["dateAjout"]));
        //die(var_dump($results));
        if ($results){
            if ($database->lastInsertId() > 0)
            {
                return ['success'=>true, 'id'=>$database->lastInsertId()];
            }
        }else
            return ['success'=>false];

    }

     /**
     * @param $associationArray
     * @return array|false
     */
    public function createAssociation($associationArray)
    {
        global $database;

        $sql = "INSERT INTO association ( nomAssociation, adresseAssociation, Datecreation, nomCreateur) VALUES (?,?,?,?)";

        $resultSet = $database->openConnection()->prepare($sql);
        $results = $resultSet->execute(array($associationArray["nomAssociation"],$associationArray["adresseAssociation"],$associationArray["Datecreation"],$associationArray["nomCreateur"]));
        //die(var_dump($results));
        if ($results){
            if ($database->lastInsertId() > 0)
            {
                return ['success'=>true, 'numAssociation'=>$database->lastInsertId()];
            }
        }else
            return ['success'=>false];

    }

}