<?php 

require_once 'database/USER.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/FEE_DOCUMENT.php';
require_once 'database/CURRENCY.php';
require_once 'database/PAYMENT_DETAIL.php';
require_once 'database/FINANCIAL_ENTITY.php';

class ListOfPaymentsModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetLoansDocumentsByLender($id)
    {
        $result = (new LOAN_DOCUMENT())->GetByIdLender($id);
        return $result;
    }

    function GetPayments($id_lender)
    {
        
        $result = [];
        $loan_documents = (new LOAN_DOCUMENT)->GetByIdLender($id_lender);
        
        foreach ($loan_documents as $key => $loan_document) 
        {
            $fees_documents = (new FEE_DOCUMENT())->GetByIdLoan($loan_document->ID);

            foreach ($fees_documents as $k => $fee_document) 
            {
                $paymentsOfFeeDocument = (new PAYMENT_DETAIL)->GetByFeeId($fee_document->ID);

                foreach ($paymentsOfFeeDocument as $key => $payment_detail) 
                {
                    array_push($result, $payment_detail);
                }
            }
        }

        return $result;
    }

    function GetFeeDocument($id)
    {
        $result = (new FEE_DOCUMENT())->Get($id);
        return $result;
    }

    function GetCurrencyById($id)
    {
        $result = (new CURRENCY())->Get($id);
        return $result;
    }

    function GetFinancialEntity($id)
    {
        $result = (new FINANCIAL_ENTITY())->Get($id);
        return $result;
    }

    function GetClientById($id)
    {
        $result = (new USER())->Get($id);
        return $result;
    }

    function AcceptPayment($id, $user)
    {
        $payment = (new PAYMENT_DETAIL())->Get($id);

        $fee_document = (new FEE_DOCUMENT())->Get($payment->ID_FEE_DOCUMENT);

        $loan_document = (new LOAN_DOCUMENT())->Get($fee_document->ID_LOAN);

        $fee_document->STATUS = "paid";
        $fee_document->USER_UPDATE = $user->ID;
        $fee_document->DATE_UPDATE = Date("Y-m-d");

        $payment->STATUS = "accepted";
        $payment->USER_UPDATE = $user->ID;
        $payment->DATE_UPDATE = Date("Y-m-d");

        $loan_document->BALANCE -= $fee_document->GROSS_AMOUNT;
        $loan_document->USER_UPDATE = $user->ID;
        $loan_document->DATE_UPDATE = Date("Y-m-d");

        $fee_document->Update();
        $payment->Update();
    }

    function RefusePayment($id, $user)
    {
        $payment = (new PAYMENT_DETAIL())->Get($id);

        $fee_document = (new FEE_DOCUMENT())->Get($payment->ID_FEE_DOCUMENT);

        $fee_document->STATUS = "pending";
        $fee_document->USER_UPDATE = $user->ID;
        $fee_document->DATE_UPDATE = Date("Y-m-d");

        $payment->STATUS = "rejected";
        $payment->USER_UPDATE = $user->ID;
        $payment->DATE_UPDATE = Date("Y-m-d");

        $fee_document->Update();
        $payment->Update();
    }
}