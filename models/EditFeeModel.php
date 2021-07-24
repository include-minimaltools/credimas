<?php 

require_once 'database/USER.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/FEE_DOCUMENT.php';
require_once 'database/CURRENCY.php';

class EditFeeModel extends Model
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

    function GetClients(int $id_lender)
    {
        $result = [];
        $loan_documents = $this->GetLoansDocumentsByLender($id_lender);

        foreach ($loan_documents as $key => $loan_document) 
        {
            $client = (new USER)->Get($loan_document->ID_CLIENT);
            array_push($result,$client);
        }

        
        return $result;
    }

    function GetFeesDocuments($id_lender, $id_client)
    {
        
        $result = [];
        $loan_documents = (new LOAN_DOCUMENT)->GetByIdLenderAndIdClient($id_lender, $id_client);
        
        foreach ($loan_documents as $key => $loan_document) 
        {
            $fees_documents = (new FEE_DOCUMENT())->GetByIdLoan($loan_document->ID);

            foreach ($fees_documents as $k => $fee_document) 
            {
                array_push($result, $fee_document);
            }
        }

        return $result;
    }

    function GetCurrencyById($id)
    {
        $result = (new CURRENCY())->Get($id);
        return $result;
    }

    function ProcessDeduction($idFeeDocument, $deduction)
    {
        try
        {
            $feeDocument = (new FEE_DOCUMENT())->Get($idFeeDocument);

            $feeDocument->DEDUCTION = $deduction;
            $feeDocument->TOTAL_AMOUNT = $feeDocument->GROSS_AMOUNT + $feeDocument->INTERES - $feeDocument->DEDUCTION;

            $feeDocument->Update();
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}?>