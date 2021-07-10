<?php 

require_once 'database/USER.php';

class AdminModel extends Model
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
}?>