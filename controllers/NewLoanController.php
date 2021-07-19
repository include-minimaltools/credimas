<?php

require_once 'database/USER.php';

class NewLoanController extends SessionController
{   
    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    public function Render()
    {
        $this->view->render('NewLoan/index', [
            'photo' => $this->user->PHOTO,
            'role' => $this->user->ROLE,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME,
            'clients' => $this->GetClientSelector(),
            'lender' => $this->GetLenderSelector(),
            'currencies' => $this->GetCurrenciesSelector()
        ]);
        $this->GetClientSelector();
    }

    public function CreateLoan()
    {
        if($this->ExistPOST(['client','currency','gross_amount','partials','interes_rate','partial_amount','term','date']))
        {
            $lender = $this->user->ID;
            $client = $this->POST('client');
            $currency = $this->POST('currency');
            $gross_amount = $this->POST('gross_amount');
            $partials = $this->POST('partials');
            $interes_rate = $this->POST('interes_rate');
            $partial_amount = $this->POST('partial_amount');
            $term = $this->POST('term');
            $init_date = $this->POST('date');

            if($client == '' || $currency == '' || $gross_amount == '' || $partials == '' || $interes_rate == '' || $partial_amount == '' || $term == '' || $init_date == '')
            {
                error_log('NewLoanController::CreateLoan->Post vacío');
                return;
            }

            foreach (['client','currency','gross_amount','partials','interes_rate','partial_amount','term','date'] as $key => $value) 
            {
                error_log($this->POST($value));
            }            

            $this->model->CreateNewLoan($this->user,$lender, $client, $currency, $gross_amount, $partials, $interes_rate, $partial_amount, $term, $init_date);
        }
        else
        {
            error_log("NewLoanController::CreateLoan->No se encontró una variable requerida");
        }
    }

    private function GetClientSelector()
    {
        $clients = $this->model->GetClients();
        $html = '<option value=""> Seleccione un prestatario </option>';

        foreach ($clients as $key => $value) 
        {
            $html = $html . '
            <option value="' . $value->ID . '">'. $value->USERNAME . ' - ' . $value->FIRST_NAME . ' ' . $value->FIRST_LASTNAME . '</option>';
            
        }
        return $html;
    }

    private function GetLenderSelector()
    {
        return '<option value="' . $this->user->ID . '">'. $this->user->USERNAME . ' - ' . $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME . '</option>';
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