<?php 

require_once 'database/USER.php';

class HomeModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetLenders()
    {
        $result = new USER();
        return $result->GetByRole('lender');
    }
}?>