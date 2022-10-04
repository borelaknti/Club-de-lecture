<?php
include_once realpath(dirname(__FILE__)).'/DatabaseObjects.php';

class Users extends DatabaseObjects
{

    private string $username;
    private string $password;


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
        $sql .= "WHERE loginUtilisateur = ?";
        //$sql .= "LIMIT 1";
        //$sql = "SELECT * FROM utilisateur  WHERE loginUtilisateur = 'borel' ";

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute(array($this->username));

        $resultArray = [];
        while ($row = $resultSet->fetchall()[0]){
            $resultArray = $row;
        }

        //die(var_dump($this->verifyPassword($this->password,$resultArray['motDePasse'])));
        if(!empty($resultArray) && $this->verifyPassword($this->password,$resultArray['motDePasse'])){
            $_SESSION['logIn'] = 'logged';
            //die(var_dump($resultArray));
            return array_shift($resultArray);
        }else{
            $_SESSION['logIn'] = 'false';
            return false;
        }
    }

    /**
     * @param $userArray
     * @return array|false
     */
    public function createUser($userArray)
    {
        global $database;

        $userArray['password'] = $this->setPassword($userArray['password']);

        $values = array_values($userArray);

        $sql = "INSERT INTO users (name, username, email, password) VALUES (?,?,?,?)";

        $resultSet = $database->openConnection()->prepare($sql);
        $resultSet->execute($values);

        if ($database->lastInsertId() > 0){
            return ['success'=>true, 'userid'=>$database->lastInsertId()];
        }
        return false;

    }

    /**
     * @param $username
     * @return bool
     */
    public function userUnique($username): bool
    {
        global $database;

        $this->username = cleanUpInputs($username);
        $sql  = "SELECT * FROM users ";
        $sql .= "WHERE username = ? ";
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
     * @param $name
     * @param $username
     * @param $email
     * @param $password
     * @return array
     */
    public function createUserArray($name, $username, $email, $password): array
    {
        return ['name'=>$name, 'username'=>$username, 'email'=>$email, 'password'=>$password];

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
       //return password_verify ($password, $hashedPassword); utiliser lors de la creation d'un utilisateur a partir du formulaire pour l'encryption
        if(strcmp($password,$hashedPassword) == 0 )
            return true;
        else
            return false;
    }

}