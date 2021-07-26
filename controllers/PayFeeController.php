<?php 

require_once 'database/FEE_DOCUMENT.php';
require_once 'database/LOAN_DOCUMENT.php';
require_once 'database/USER.php';

class PayFeeController extends SessionController
{
    private $user;
    private $fee_document;
    private $loan_document;
    private $lender;
    private $currency;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function Render($data)
    {
        $this->LoadData($data[0]);
        $this->view->render('PayFee/index',[
            'role' => $this->user->ROLE,
            'photo' => $this->user->PHOTO,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME,
            'fee_document' => $this->fee_document->array(),
            'loan_document' => $this->loan_document->array(),
            'lender' => $this->lender->array(),
            'currency' => $this->currency->array(),
            'currencies_selector' => $this->GetCurrenciesSelector(),
            'financialentities_selector' => $this->GetFinancialEntitiesSelector()
        ]);
    }

    function LoadData($idFeeDocument)
    {
        $this->fee_document = $this->model->GetFeeDocumentById($idFeeDocument);

        $this->loan_document = $this->model->GetLoanDocumentById($this->fee_document->ID_LOAN);

        $this->lender = $this->model->GetUserById($this->loan_document->ID_LENDER);

        $this->currency = $this->model->GetCurrencyById($this->fee_document->CURRENCY);
    }

    private function GetCurrenciesSelector()
    {
        $currencies = $this->model->GetCurrencies();
        $html = '<option value=""> Seleccione una moneda </option>';

        foreach ($currencies as $key => $value) {
            $html = $html . '
            <option value="' . $value->ID . '">'. $value->ID . ' - ' . $value->DESCRIPTION . '</option>';
        }

        return $html;
    }

    private function GetFinancialEntitiesSelector()
    {
        $financialentities = $this->model->GetFinancialEntities();
        $html = '<option value=""> Seleccione una entidad financiera </option>';

        foreach ($financialentities as $key => $value) {
            $html = $html . '
            <option value="' . $value->ID . '">'. $value->ID . ' - ' . $value->DESCRIPTION . '</option>';
        }

        return $html;
    }

    function SavePayFee()
    {   
        try
        {
            if($this->ExistPOST(['fee_id', 'financialentity', 'currency', 'amount', 'document_currency']))
            {
                $fee_id = $this->POST('fee_id');
                $financial_entity = $this->POST('financialentity');
                $currency = $this->POST('currency');
                $amount = $this->POST('amount');
                $exchange_rate = $this->ExistPOST(['exchange_rate']) ? $this->POST('exchange_rate') : "1";

                $document_currency = $this->POST('document_currency');

                if(isset($_FILES['transaction']) && $_FILES['transaction']['name'] != NULL)
                {
                    $transaction = $this->setPhoto($_FILES['transaction'], "images/transaction/");
                }
                else
                {
                    $this->Redirect('payfee/render/'.$fee_id,['error' => ErrorMessage::NEWLOAN_PHOTO_REQUIRED]);
                }

                $this->model->NewPaymentDetails(
                    $fee_id,
                    $financial_entity,
                    $currency,
                    $amount,
                    $exchange_rate,
                    $document_currency,
                    $transaction,
                    $this->user
                );
                $this->Redirect('lender',[]);
            }
            else
            {
                error_log("PayFeeController::Save -> Se ingreso un post vacío");
                $this->Redirect('payfee/render/'.$this->POST('fee_id'),['error' => ErrorMessage::NEWLOAN_EMPTY]);
            }
        } catch(Exception $ex)
        {
            error_log("PayFeeController::Save -> ".$ex);
            $this->Redirect('error',[]);
        }
        
    }

    private function setPhoto($photo, $target_dir)
    {
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($photo["tmp_name"]);

        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            return NULL;

        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                return $hash;
            } else {
                return NULL;
            }
        }        
    }
}
?>