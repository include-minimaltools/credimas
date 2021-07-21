<?php 

require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/FEE_DOCUMENT.php';
require_once 'database/USER.php';

class ViewLoansModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function LoadFeesDocuments(USER $user)
    {
        $result = [];

        $loan_documents = (new LOAN_DOCUMENT())->GetByIdClient($user->ID);

        foreach ($loan_documents as $k => $loan_document) 
        {
            $fees_documents = (new FEE_DOCUMENT())->GetByIdLoan($loan_document->ID);

            foreach ($fees_documents as $key => $fee_document) 
            {
                array_push($result, $fee_document);
            }
        }

        return $result;
    }
}?>