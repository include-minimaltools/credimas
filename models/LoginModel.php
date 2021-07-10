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

                error_log(password_hash($password, PASSWORD_DEFAULT, ['cost' => 5]) . ' | ' . $user->PASSWORD);
                if(password_verify($password, $user->PASSWORD))
                {
                    error_log('LoginModel::Login -> Success');
                    return $user;
                }
                else
                {
                    error_log('LoginModel::Login -> Password incorrect');
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