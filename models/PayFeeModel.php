<?php 

require_once 'database/FEE_DOCUMENT.php';
require_once 'database/USER.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/CURRENCY.php';
require_once 'database/FINANCIAL_ENTITY.php';
require_once 'database/PAYMENT_DETAIL.php';


class PayFeeModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetFeeDocumentById($id)
    {
        $result = (new FEE_DOCUMENT())->Get($id);
        return $result;
    }

    function GetLoanDocumentById($id)
    {
        $result = (new LOAN_DOCUMENT())->Get($id);
        return $result;
    }

    function GetUserById($id)
    {
        $result = (new USER())->Get($id);
        return $result;
    }

    function GetCurrencyById($id)
    {
        $result = (new CURRENCY())->Get($id);
        return $result;
    }

    function GetCurrencies()
    {
        return (new CURRENCY())->GetAll();
    }

    function GetFinancialEntities()
    {
        $entities = (new FINANCIAL_ENTITY())->GetAll();
        return $entities;
    }

    function NewPaymentDetails($fee_id,$financial_entity,$currency,$amount,$exchange_rate,$document_currency,$transaction, $user)
    {
        $payment = new PAYMENT_DETAIL();

        $payment->ID_FEE_DOCUMENT = $fee_id;
        $payment->ID_CLIENT = $user->ID;
        $payment->FINANCIAL_ENTITY = $financial_entity;
        $payment->CURRENCY = $currency;
        $payment->AMOUNT = $amount;
        $payment->EXCHANGE_RATE = $exchange_rate;
        $payment->CURRENCY_DOCUMENT = $document_currency;
        $payment->TRANSACTION = $transaction;
        $payment->STATUS = 'pending';
        $payment->USER_CREATE = $user->ID;
        $payment->DATE_CREATE = Date("Ymd");

        $payment->Save();

        $feeDocument = (new FEE_DOCUMENT)->Get($fee_id);
        $feeDocument->STATUS = 'in process';
        
        $feeDocument->Save();
    }
}?>