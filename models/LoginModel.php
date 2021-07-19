<?php 

require_once 'database/USER.php';

class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function Login($username, $password)
    {
        try
        {
            $query = $this->prepare('SELECT * FROM USERS WHERE USERNAME = :USERNAME');
            $query->execute(['USERNAME' => $username]);

            if($query->rowCount() == 1)
            {
                $item = $query->fetch(PDO::FETCH_ASSOC);
                
                $user = new USER();
                $user->From($item);

                if(password_verify($password, $user->PASSWORD))
                {
                    return $user;
                }
                else
                {
                    return NULL;
                }
            }
        }
        catch(PDOException $ex)
        {
            error_log('LoginModel::Login -> exception: ' . $ex);
            return NULL;
        }
    }
}?>