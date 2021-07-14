<?php 

require_once 'database/USER.php';

class NewUserModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetAll()
    {
        $result = new USER();
        return $result->GetAll();
    }

    function GetId($username)
    {
        $result = new USER();
        return $result->GetByUsername($username)->ID;
    }
}?>