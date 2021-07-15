<?php 

class CurrenciesController extends SessionController
{
    private $user;
    private $currencies = [];
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function Render()
    {
        $this->view->render('FinancialEntities/index',[
            'financialEntities' => $this->GetDataTable(),
            'role' => $this->user->ROLE,
            'photo' => $this->user->PHOTO,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME,
            'entities' => json_encode($this->entities)
        ]);
    }

    function InsertOrUpdateCurrency()
    {
        if($this->ExistPOST(["id","description"]))
        {
            $id = $this->POST('id');
            $description = $this->POST('description');

            error_log('ID: '.$id.' Description: '.$description);

            if(empty($id) || $id == '' || empty($description) || $description == '')
            {
                error_log("Esta vacio");
                return;
            }
            
            $currency = new FINANCIAL_ENTITY();
            if($currency->Exist($id))
            {
                $currency = $currency->Get($id);
                $currency->ID = $id;
                $currency->DESCRIPTION = $description;
                $currency->USER_UPDATE = $this->user->USERNAME;
                // $currency->DATE_UPDATE = '';

                if($currency->Update())
                {
                    $this->Redirect('financialentities',[]);
                }
                else
                {
                    $this->Redirect('error',[]);
                }
            }
            else
            {
                $currency->ID = $id;
                $currency->DESCRIPTION = $description;
                $currency->USER_CREATE = $this->user->USERNAME;
                $currency->DATE_CREATE = '';

                if($currency->Save())
                {
                    $this->Redirect('financialentities',[]);
                }
                else
                {
                    $this->Redirect('error',[]);
                }
            }
        }
        else
        {
            error_log("No existen los post solicitados");
        }
    }

    function GetDataTable()
    {
        $currencies = $this->model->GetFinancialEntities();
        $html = '';
        if(empty($currencies))
            return $html;

        foreach ($currencies as $key => $item) {
            $html = $html . '
            <tr>
                <td> <span class="Entidad Financiera">'. $item->ID .'</span></td>
                <td> <span class="Descripción">'. $item->DESCRIPTION .'</span> </td>
                <td> <span class="Acción"><button class="btn btn-sm btn-primary fa fa-edit" data-toggle="modal" data-target="#modalCurrency" id="btnEdit_'. $item->ID .'"></i></button></span></td>
            </tr>';

            array_push($this->entities,[
                "ID" => $item->ID,
                "DESCRIPTION" => $item->DESCRIPTION
            ]);
        }
        return $html;
    }
}
?>
