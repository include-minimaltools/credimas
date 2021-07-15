<?php 

class FinancialEntitiesController extends SessionController
{
    private $user;
    private $entities = [];
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

    function InsertOrUpdateEntity()
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
            
            $financialEntity = new FINANCIAL_ENTITY();
            if(($financialEntity)->Exist($id))
            {
                $financialEntity = $financialEntity->Get($id);
                $financialEntity->ID = $id;
                $financialEntity->DESCRIPTION = $description;
                $financialEntity->USER_UPDATE = $this->user->USERNAME;
                $financialEntity->DATE_UPDATE = '';

                if($financialEntity->Update())
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
                $financialEntity->ID = $id;
                $financialEntity->DESCRIPTION = $description;
                $financialEntity->USER_CREATE = $this->user->USERNAME;
                $financialEntity->DATE_CREATE = '';

                if($financialEntity->Save())
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
        $financialEntities = $this->model->GetFinancialEntities();
        $html = '';
        if(empty($financialEntities))
            return $html;

        foreach ($financialEntities as $key => $item) {
            $html = $html . '
            <tr>
                <td> <span class="Entidad Financiera">'. $item->ID .'</span></td>
                <td> <span class="Descripción">'. $item->DESCRIPTION .'</span> </td>
                <td> <span class="Acción"><button class="btn btn-sm btn-primary fa fa-edit" data-toggle="modal" data-target="#modalFinancialEntity" id="btnEdit_'. $item->ID .'"></i></button></span></td>
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
