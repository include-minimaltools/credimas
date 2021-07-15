<?php 

require_once 'database/CURRENCY.php';

class CurrenciesModel extends Model
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