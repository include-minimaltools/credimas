<?php 

require_once 'database/USER.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/FEE_DOCUMENT.php';

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

    function GetFeeDocuments($id)
    {
        $result = [];

        $loan_documents = (new LOAN_DOCUMENT())->GetByIdClient($id);

        foreach ($loan_documents as $key => $loan_document) 
        {
            $fees_documents = (new FEE_DOCUMENT)->GetByIdLoan($loan_document->ID);

            foreach ($fees_documents as $fee_document) 
            {
                array_push($result, $fee_document);
            }
        }

        return $result;
    }

    function GetLenderNameByIdLoan($id_loan)
    {
        $loan_document = (new LOAN_DOCUMENT())->Get($id_loan);

        $result = (new USER())->Get($loan_document->ID_LENDER);

        return $result->FIRST_NAME . ' ' . $result->FIRST_LASTNAME;
    }
}?>