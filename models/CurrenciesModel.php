<?php 

require_once 'database/FINANCIAL_ENTITY.php';

class FinancialEntitiesModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetCurrencies()
    {
        $currencies = (new CURRENCY())->GetAll();
        return $currencies;
    }
}?>