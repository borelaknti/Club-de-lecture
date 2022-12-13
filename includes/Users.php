<?php
include_once realpath(dirname(__FILE__)).'/DatabaseObjects.php';

class Users extends DatabaseObjects
{

    private string $username;
    private string $password;
    protected static string $tableName = "utilisateur";


    /**
     * @param string $username
     * @param string $password
     * @return false|mixed|null
     */
    public function authenticate(string $username = '', string $password = '')
    {

        global $database;

        $this->username = cleanUpInputs($username);
        $this->password = cleanUpInputs($password);

        $sql  = "SELECT * FROM utilisateur ";
        $sql .= "WHERE login_utilisateur = ?";
      

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute(array($this->username));

        $resultArray = [];
        while ($row = $resultSet->fetchall()[0]){
            $resultArray = $row;
        }

        
        if(!empty($resultArray) && $this->verifyPassword($this->password,$resultArray['mot_de_passe'])){
            $_SESSION['logIn'] = 'logged';
            
            return array_shift($resultArray);
        }else{
            $_SESSION['logIn'] = 'false';
            return false;
        }
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
     * @return array|null
     */
    public static function finduser($id): ?array
    {
        return static::findBySql("SELECT * FROM utilisateur u  WHERE u.numUtilisateur = $id");
    }

    /**
     * @param $username
     * @return array|null
     */
    public static function findMail($username): ?array
    {
        return static::findBySql("SELECT utilisateur.utilisateur_email FROM utilisateur   WHERE utilisateur.login_utilisateur = '".$username."'");
    }


    /**
     * @param $userArray
     * @return array|false
     */
    public function createUser($userArray)
    {
        global $database;

        $userArray['mot_de_passe'] = $this->setPassword($userArray['mot_de_passe']);

        $values = array_values($userArray);

        $sql = "INSERT INTO utilisateur ( nomUtilisateur, prenomUtilisateur, dateNaissance, etatUtilisateur, adresseUtilisateur, sexeUtilisateur,login_utilisateur, mot_de_passe, utilisateur_email) VALUES (?,?,?,?,?,?,?,?,?)";

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute($values);

        if ($database->lastInsertId() > 0){
            return ['success'=>true, 'numUtilisateur'=>$database->lastInsertId()];
        }
        return false;

    }

     /**
     * @param $userArray
     * @return array|false
     */
    public function createMember($userArray)
    {
        global $database;

        $sql = "INSERT INTO utilisateur ( nomUtilisateur, prenomUtilisateur, dateNaissance, etatUtilisateur, adresseUtilisateur, sexeUtilisateur,login_utilisateur, mot_de_passe, utilisateur_email) VALUES (?,?,?,?,?,?,?,?,?)";

        $resultSet = $database->openConnection()->prepare($sql);
        $results = $resultSet->execute(array($userArray["nomUtilisateur"],$userArray["prenomUtilisateur"],$userArray["dateNaissance"],$userArray["etatUtilisateur"],$userArray["adresseUtilisateur"],$userArray["sexeUtilisateur"],$userArray["login_utilisateur"],$userArray["mot_de_passe"],$userArray["utilisateur_email"]));
        
        if ($results){
            if ($database->lastInsertId() > 0)
            {
                return ['success'=>true, 'numUtilisateur'=>$database->lastInsertId()];
            }
        }else
            return ['success'=>false];

    }


    /**
     * @param $username
     * @return bool
     */
    public function userUnique($username): bool
    {
        global $database;

        $this->username = cleanUpInputs($username);
        $sql  = "SELECT * FROM utilisateur ";
        $sql .= "WHERE login_utilisateur = ? ";
        $sql .= "LIMIT 1";

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute(array($this->username));

        $resultArray = [];
        while ($row = $resultSet->fetchAll()){
            $resultArray = $row;
        }

        if(!empty($resultArray)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function emailUnique($email): bool
    {
        global $database;

        $this->email = cleanUpInputs($email);
        $sql  = "SELECT * FROM utilisateur ";
        $sql .= "WHERE utilisateur_email = ? ";
        $sql .= "LIMIT 1";

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute(array($this->email));

        $resultArray = [];
        while ($row = $resultSet->fetchAll()){
            $resultArray = $row;
        }

        if(!empty($resultArray)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $email
     * @return array|false
     */
    public function passwordTime($email)
    {
        global $database;
        $timeStamp = time();
        $sql = "UPDATE utilisateur SET email_time = '".$timeStamp."' Where utilisateur_email = '".$email."' ";
        $resultSet = $database->openConnection()->prepare($sql);
        if($resultSet->execute())
        {
            return ['success'=> true];
        }
        return false;

    }

    /**
     * @param $nom
     * @param $prenom
     * @param $dateNaissance
     * @param $adresse
     * @param $sexe
     * @param $login
     * @param $mot_de_passe
     * @param $email
     * @return array
     */
    public function createUserArray( $nom, $prenom, $dateNaissance, $adresse, $sexe,$login, $mot_de_passe, $email): array
    {
        $etat = 'A';
        return  ['nomUtilisateur'=>$nom, 'prenomUtilisateur'=>$prenom, 'dateNaissance'=>$dateNaissance, 'etatUtilisateur'=>$etat, 'adresseUtilisateur'=>$adresse, 'sexeUtilisateur'=>$sexe,'login_utilisateur'=>$login, 'mot_de_passe'=>$mot_de_passe, 'utilisateur_email'=>$email];

    }

    /**
     * @param $username
     * @param $password 
     * @return array
     */
    public function createResetPasswordArray($username, $password) :array
    {
        return  ['login_utilisateur'=>$username,'mot_de_passe'=>$password];
    }

    /**
     * @param $username
     * @param $time 
     * @return bool
     */
    public function checkLinkExpired($username,$time) :bool
    {
        global $database;
        $time = cleanUpInputs($time);
        $sql = "SELECT * from utilisateur ";
        $sql .= "where login_utilisateur= ? ";
        $sql .= "LIMIT 1";

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute(array($username));

        $storedTime = '';
        while ($row = $resultSet->fetchAll())
        {
            $storedTime = $row[0]['email_time'];
        }
        if(($time-$storedTime)/60 < 60)
        {
            return true;
        }else
        {
            return false;
        }
    }
    /**
     * @param $nom
     * @param $prenom
     * @param $dateNaissance
     * @param $adresse
     * @param $sexe
     * @param $login
     * @param $mot_de_passe
     * @param $email
     * @return array
     */
    public function createUserMember( $nom, $prenom, $dateNaissance, $adresse, $sexe, $email): array
    {
        $etat = 'A';
        return  ['nomUtilisateur'=>$nom, 'prenomUtilisateur'=>$prenom, 'dateNaissance'=>$dateNaissance, 'etatUtilisateur'=>$etat, 'adresseUtilisateur'=>$adresse, 'sexeUtilisateur'=>$sexe,'login_utilisateur'=>NUll, 'mot_de_passe'=>NUll, 'utilisateur_email'=>$email];
    }

    /**
     * @param $userPasswordArray
     * @return array|false
     */
    public function updatePwd($userPasswordArray) 
    {
        global $database;

        $pwd = [':password' =>$this->setPassword($userPasswordArray['mot_de_passe'])];
        $sql = "UPDATE utilisateur set mot_de_passe = :password where login_utilisateur = '".$userPasswordArray['login_utilisateur']."'";
        $resultSet = $database->openConnection()->prepare($sql);
        if($resultSet->execute($pwd))
        {
            return ['success'=> true];
        }
        return false;
    }

    /**
     * @param string $password
     * @return false|string|null
     */
    private function setPassword(string $password):string
    {
       return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    private function verifyPassword(string $password,string $hashedPassword): bool
    {
       return password_verify ($password, $hashedPassword); //utiliser lors de la creation d'un utilisateur a partir du formulaire pour l'encryption
        
    }

}