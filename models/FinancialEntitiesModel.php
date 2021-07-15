<?php 

require_once 'database/FINANCIAL_ENTITY.php';

class FinancialEntitiesModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetFinancialEntities()
    {
        $entities = (new FINANCIAL_ENTITY())->GetAll();
        return $entities;
    }
}?>