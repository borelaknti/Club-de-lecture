<?php
class Session{

    private bool $loggedIn = false;
    public $userID;
    public $message;


    /*
     * should no keep database objects in sessions because may become old and not updated
     * also can be very large
     */

    function __construct()
    {
        $this->checkMessage();
        $this->checkLogin();
    }

    public function isLoggedIN()
    {
        return $this->loggedIn;
    }

    public function login($user)
    {
        //database should find user based on username/password
        if($user){
            $this->userID = $_SESSION['user_id'] = $user->id;
            $this->loggedIn = true;
        }
    }

    public function newUserloggedIn($userId)
    {
        //database should find user based on username/password
        if($userId){
            $this->userID = $_SESSION['user_id'] = $userId;
            $this->loggedIn = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->userID);
        $_SESSION['logIn'] = false;
        $this->loggedIn = false;
    }

    private function checkLogin()
    {
        if(isset($_SESSION['user_id'])){
            $this->userID = $_SESSION['user_id'];
            $this->loggedIn = true;
        }else{
            unset($this->userID);
            $this->loggedIn = false;
        }
    }

    private function checkMessage(): void
    {
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message = "";
        }
    }

    public function message($msg = ""):string
    {
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }else{
            return $this->message;
        }

    }

}

$session = new Session();
$message = $session->message();
