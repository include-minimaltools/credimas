<?php 

require_once 'database/USER.php';

class LenderModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetClients()
    {
        $result = new USER();
        return $result->GetByRole('client');
    }
}?>