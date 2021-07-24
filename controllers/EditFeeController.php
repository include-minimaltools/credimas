<?php 

class EditFeeController extends SessionController
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

        $feesDocuments = $this->GetFeesDocuments($id_client);

        $this->view->render('EditFee/index',[
            'role' => $this->user->ROLE,
            'photo' => $this->user->PHOTO,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME,
            'client_selector' => $this->GetClientsSelector(),
            'id_client' => $id_client,
            'status' => $status,
            'dataTable' => $this->LoadDataTable($feesDocuments, $status),
            'fees_documents' => $this->GetJsonData($feesDocuments)
        ]);
    }

    function GetClientsSelector()
    {
        $result = '<option value="">Seleccione un cliente para cargar sus cuotas</option>';
        $clients = $this->model->GetClients($this->user->ID);
        
        
        foreach ($clients as $key => $client) 
        {
            $result .= '
            <option value="'.$client->ID.'">'.$client->USERNAME.' - '.$client->FIRST_NAME.' '.$client->FIRST_LASTNAME.'</option>';
        }

        return $result;
    }

    function GetJsonData($feesDocuments)
    {
        $result = [];
        foreach ($feesDocuments as $key => $feeDocument)
        {
            array_push($result,
                ["ID" => $feeDocument->ID,
                 "DEDUCTION" => $feeDocument->DEDUCTION,
                 "GROSS_AMOUNT" => $feeDocument->GROSS_AMOUNT]);
        }

        return json_encode($result);
    }

    function LoadDataTable($feesDocuments, $status)
    {
        $dataTable = '';

        if(!isset($status) || $status == null || $status == 'null' || $status == '')
            return;

        foreach ($feesDocuments as $key => $feeDocument) 
        {
            if($feeDocument->STATUS != $status && $status != 'All')
                continue;

            $currency = $this->model->GetCurrencyById($feeDocument->CURRENCY);

            $dataTable .= '<tr>
            <td> <span>'. $feeDocument->N_PARTIAL .'</span></td>
            <td> <span>'. $currency->DESCRIPTION .'</span></td>
            <td> <span>'. $feeDocument->GROSS_AMOUNT .'</span></td>
            <td> <span>'. $feeDocument->TOTAL_AMOUNT - $feeDocument->GROSS_AMOUNT + $feeDocument->DEDUCTION .'</span></td>
            <td> <span>'. $feeDocument->DEDUCTION .'</span></td>
            <td> <span>'. $feeDocument->TOTAL_AMOUNT .'</span></td>';

            if($feeDocument->STATUS == 'paid')
            {
                $dataTable .= '<td> <span class="btn-sm btn-secondary disabled">Pagado</span></td>
                <td><label class="btn-sm btn-secondary fa fa-edit disabled"></label></td>';
            }
            else if($feeDocument->STATUS == 'late')
            {
                $dataTable .= '<td> <span class="btn-sm btn-danger disabled">Atrasado</span></td>
                <td><label id="btnEdit_'.$feeDocument->ID.'" class="btn-sm btn-info fa fa-edit" data-toggle="modal" data-target="#modalDeduction"></label></td>';
                
            } 
            else if($feeDocument->STATUS == 'pending')
            {
                $dataTable .= '<td> <span class="btn-sm btn-primary disabled">Pendiente</span></td>
                <td><label id="btnEdit_'.$feeDocument->ID.'" class="btn-sm btn-info fa fa-edit" data-toggle="modal" data-target="#modalDeduction"></label></td>';
            }
            else if($feeDocument->STATUS == 'in process')
            {
                $dataTable .= '<td> <span class="btn-sm btn-warning disabled">En proceso</span></td>
                <td><label class="btn-sm btn-secondary fa fa-edit disabled"></label></td>';
            }

            $dataTable .= '<td> <span class="Acción">'. '' .'</span></td>
            </tr>';
        }

        return $dataTable;
    }

    function GetFeesDocuments($id_client)
    {
        return $this->model->GetFeesDocuments($this->user->ID, $id_client);
    }

    function ProcessDeduction()
    {
        try
        {
            $client = $this->POST('client');
            $status = $this->POST('status');
            $idFeeDocument = $this->POST('id');
            $deduction = $this->POST('deduction');

            $this->model->ProcessDeduction($idFeeDocument, $deduction);
            $this->Redirect('editfee/render/' . $client . '/' . $status, []);
        }
        catch(Exception $ex)
        {
            error_log('EditFeeController::ProcessDeduction -> Exception: ' . $ex);
        }
    }
}