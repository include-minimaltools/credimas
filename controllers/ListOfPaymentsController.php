<?php 

class ListOfPaymentsController extends SessionController
{
    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function Render($data = null)
    {
        $id_client = isset($data) ? $data[0] : null;
        $status = isset($data) ? $data[1] : 'null';

        $payments = $this->model->GetPayments($this->user->ID);

        $this->view->render('ListOfPayments/index',[
            'role' => $this->user->ROLE,
            'photo' => $this->user->PHOTO,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME,
            'id_client' => $id_client,
            'status' => $status,
            'tblPending' => $this->LoadDataTable($payments, 'pending'),
            'tblAccepted' => $this->LoadDataTable($payments, 'accepted'),
            'tblRejected' => $this->LoadDataTable($payments, 'rejected'),
            'payments' => $this->GetJsonData($payments)
        ]);
    }

    function GetJsonData($payments)
    {
        $result = [];
        foreach ($payments as $key => $payment) 
        {
            $feeDocument = $this->model->GetFeeDocument($payment->ID_FEE_DOCUMENT);
            $financialEntity = $this->model->GetFinancialEntity($payment->FINANCIAL_ENTITY);

            if($payment->STATUS == 'accepted')
                $status = 'Aceptado';
            else if($payment->STATUS == 'rejected')
                $status = 'Rechazado';
            else if($payment->STATUS == 'pending')
                $status = 'Pendiente';
            

            array_push($result, [
                'id' => $payment->ID,
                'financial_entity' => $financialEntity->DESCRIPTION,
                'exchange_rate' => $payment->EXCHANGE_RATE,
                'currency' => $payment->CURRENCY,
                'amount' => $payment->AMOUNT,
                'transaction' => $payment->TRANSACTION,
                'status' => $status,

                'document_currency' => $feeDocument->CURRENCY,
                'gross_amount' => $feeDocument->GROSS_AMOUNT,
                'interes' => $feeDocument->INTERES,
                'deduction' => $feeDocument->DEDUCTION,
                'total_amount' => $feeDocument->TOTAL_AMOUNT
            ]);
        }

        return json_encode($result);
    }

    function LoadDataTable($payments, $status)
    {
        $dataTable = '';

        foreach ($payments as $key => $payment) 
        {
            if($status != $payment->STATUS)
                continue;

            $client = $this->model->GetClientById($payment->ID_CLIENT);
            $feeDocument = $this->model->GetFeeDocument($payment->ID_FEE_DOCUMENT);
            $financialEntity = $this->model->GetFinancialEntity($payment->FINANCIAL_ENTITY);
            $currency = $this->model->GetCurrencyById($payment->CURRENCY);

            if($payment->STATUS == 'accepted')
                $status = '<span class="btn-sm btn-success color-white">Aceptado</span>';
            else if($payment->STATUS == 'rejected')
                $status = '<span class="btn-sm btn-danger color-white">Rechazado</span>';
            else if($payment->STATUS == 'pending')
                $status = '<span class="btn-sm btn-warning color-white">Pendiente</span>';

            $dataTable .= '<tr>
            <td> <span>'. $client->FIRST_NAME . ' ' . $client->FIRST_LASTNAME .'</span></td>
            <td> <span>'. $feeDocument->N_PARTIAL .'</span></td>
            <td> <span>'. $feeDocument->TOTAL_AMOUNT . ' (' . $feeDocument->CURRENCY . ')</span></td>
            <td> <span>'. $financialEntity->DESCRIPTION . '</span></td>
            <td> <span>'. $currency->DESCRIPTION . '</span></td>
            <td> <span>'. $payment->AMOUNT . '</span></td>
            <td> <span>'. $payment->EXCHANGE_RATE . '</span></td>
            <td> '. $status .'</td>
            <td>
                <label class="btn-sm btn-primary fa fa-eye" data-toggle="modal" data-target="#modal" id="btnEdit_'.$payment->ID.'"></label>
            </td>
            </tr>';
        }

        return $dataTable;
    }

    function AcceptPayment()
    {
        $id = $this->POST('id');
        $this->model->AcceptPayment($id, $this->user);
        $this->Redirect('listofpayments',[]);
    }

    function RefusePayment()
    {
        $id = $this->POST('id');
        $this->model->RefusePayment($id, $this->user);
        $this->Redirect('listofpayments',[]);
    }
}