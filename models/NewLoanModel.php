<?php 

require_once 'database/CLIENT.php';
require_once 'database/USER.php';
require_once 'database/CURRENCY.php';
require_once 'database/LENDER.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/FEE_DOCUMENT.php';
require_once 'database/CONSECUTIVE.php';

class NewLoanModel extends Model
{
    private $consecutive;
    function __construct()
    {
        parent::__construct();
        $this->consecutive = (new CONSECUTIVE())->Get(1);
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

    function GetLoanConsecutive()
    {
        $result = $this->consecutive->LOAN_DOCUMENTS;
        $this->consecutive->LOAN_DOCUMENTS++;
        $this->consecutive->Update();
        return $result;
    }

    function GetFeeConsecutive()
    {
        $result = $this->consecutive->FEES_DOCUMENTS;
        $this->consecutive->FEES_DOCUMENTS++;
        $this->consecutive->Update();
        return $result;
    }

    function CreateNewLoan($session,$lender, $client, $currency, $gross_amount, $partials, $interes_rate, $partial_amount, $term, $init_date, $loan_receipt)
    {
        $newLoan = new LOAN_DOCUMENT();

        $newLoan->ID = $this->GetLoanConsecutive();
        $newLoan->ID_LENDER = $lender;
        $newLoan->ID_CLIENT = $client;
        $newLoan->CURRENCY = $currency;
        $newLoan->GROSS_AMOUNT = $gross_amount;
        $newLoan->PARTIALS = $partials;
        $newLoan->INTERES_RATE = $interes_rate;
        $newLoan->TOTAL_AMOUNT = $gross_amount;
        $newLoan->BALANCE = $gross_amount;
        $newLoan->PARTIAL_AMOUNT = $partial_amount;
        $newLoan->TERM = $term;
        $newLoan->STATUS = "pending";
        $newLoan->LOAN_RECEIPT = $loan_receipt;
        $newLoan->INIT_DATE = $init_date;
        $newLoan->USER_CREATE = $session->ID;
        $newLoan->DATE_CREATE = Date('Y-m-d');
        $newLoan->Save();

        $userclient = (new CLIENT())->Get($client);
        $userclient->LOANS++;
        $userclient->USER_UPDATE = $lender;
        $userclient->DATE_UPDATE = Date('Y-m-d');

        $userclient->Update();


        for ($i=1; $i <= $partials; $i++) 
        {
            $payment_date = date('Y-m-d',strtotime($init_date."+".(intval($term) * $i)." days"));

            $interes = round(($gross_amount - $partial_amount * ($i - 1)) * $interes_rate / 100, 2);
            // error_log('Interes en cuota '.$i.': '.$interes);
            $this->CreateNewFee
            (   
                $newLoan->ID,
                $i, 
                $newLoan->PARTIAL_AMOUNT,
                $interes,
                $newLoan->CURRENCY,
                $payment_date,
                $session
            );
        }
    }

    function CreateNewFee($id_loan, $partial, $gross_amount, $interes, $currency, $payment_date, $session)
    {
        $newFee = new FEE_DOCUMENT();

        $newFee->ID = $this->GetFeeConsecutive();
        $newFee->ID_LOAN = $id_loan;
        $newFee->N_PARTIAL = $partial;
        $newFee->CURRENCY = $currency;
        $newFee->GROSS_AMOUNT = $gross_amount;
        $newFee->INTERES = $interes;
        $newFee->DEDUCTION = 0;
        $newFee->TOTAL_AMOUNT =  $interes + $gross_amount;
        $newFee->BALANCE = $interes + $gross_amount;
        $newFee->PAYMENT_DATE = $payment_date;
        $newFee->USER_CREATE = $session->ID;
        $newFee->DATE_CREATE = Date('Y-m-d');
        $newFee->Status = 'pending';

        // foreach ($newFee->array() as $key => $value) 
        // {
        //     error_log($key . ':' . $value);
        // }

        $newFee->Save();
    }
}