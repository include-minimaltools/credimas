<?php

class SESSION
{
    private $sessionName = 'user';

    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
            session_start();
    }

    #region get/set
	//getters
	public function GetCurrentUser() 
    {
        return $_SESSION[$this->sessionName];
    }

	//setters
	public function SetCurrentUser($sessionName) 
    {
        $_SESSION[$this->sessionName] = $sessionName;
    }
	#endregion

    public function CloseSession()
    {
        session_unset();
        session_destroy();
    }

    public function Exists()
    {
        return isset($_SESSION[$this->sessionName]);
    }
}

?>