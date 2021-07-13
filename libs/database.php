<?php
class Database
{
    private $host;
    private $database;
    private $user;
    private $password;
    private $charset;

    public function __construct()
    {
        $this->host = constant('HOST');
        $this->database = constant('DATABASE');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->charset = constant('CHARSET');
    }

    public function Connect()
    {
        try
        {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($connection,
                $this->user,
                $this->password,
                $options);

            

                // if($pdo == null)
                //     error_log('Database::Connect -> Error connection ');
                // else
                //     error_log('Database::Connect -> Successfully connection ');

            return $pdo;
        }   
        catch(PDOException $ex)
        {
            error_log('Database::Connect -> Error connection ' . $ex->getMessage());
        }
    }
}
?>