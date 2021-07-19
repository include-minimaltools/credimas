<?php 

require_once 'database/USER.php';
require_once 'database/CURRENCY.php';
require_once 'database/LENDER.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/FEE_DOCUMENT.php';

class NewLoanModel extends Model
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

    function GetClients()
    {
        return (new USER())->GetByRole('client');
    }

    function GetCurrencies()
    {
        return (new CURRENCY())->GetAll();
    }

    function GetId($username)
    {
        $result = new USER();
        return $result->GetByUsername($username)->ID;
    }

    function CreateNewLoan($session,$lender, $client, $currency, $gross_amount, $partials, $interes_rate, $partial_amount, $term, $init_date)
    {
        $newLoan = new LOAN_DOCUMENT();

        $newLoan->ID_LENDER = $lender;
        $newLoan->ID_CLIENT = $client;
        $newLoan->CURRENCY = $currency;
        $newLoan->GROSS_AMOUNT = $gross_amount;
        $newLoan->PARTIALS = $partials;
        $newLoan->INTERES_RATE = $interes_rate;
        $newLoan->PARTIAL_AMOUNT = $partial_amount;
        $newLoan->TERM = $term;
        $newLoan->INIT_DATE = $init_date;
        $newLoan->USER_CREATE = $session->ID;
        $newLoan->DATE_CREATE = Date('Y-m-d');

        for ($i=1; $i <= $partials; $i++) 
        {
            $payment_date = date('Y-m-d',strtotime($init_date."+".(intval($term) * $i)." days"));
            $this->CreateNewFee($i, $partial_amount, $interes_rate, $payment_date, $session);
        }
        
    }

    function CreateNewFee($partial, $amount, $interes_rate, $payment_date, $session)
    {
        $newFee = new FEE_DOCUMENT();

        $newFee->ID_LOAN = 0;
        $newFee->N_PARTIAL = $partial;
        $newFee->GROSS_AMOUNT = $amount;
        $newFee->INTERES_RATE = $interes_rate;
        $newFee->DEDUCTION = 0;
        $newFee->TOTAL_AMOUNT = round($amount * $interes_rate / 100, 2) + $amount;
        $newFee->BALANCE = round($amount * $interes_rate / 100, 2) + $amount;
        $newFee->PAYMENT_DATE = $payment_date;
        $newFee->USER_CREATE = $session->ID;
        $newFee->DATE_CREATE = Date('Y-m-d');
        $newFee->Status = 'pending';

        foreach ($newFee->array() as $key => $value) {
            error_log($key . ':' . $value);
        }
    }
}