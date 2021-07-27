<?php 

class LenderController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function Render($data = null)
    {
        $type = !$data ? 'A' : $data[0];
        $user = $this->getUserSessionData();
        $this->view->render('Home/lender',
        [
            'clients' => $this->GetClients($type),
            'photo' => $user->PHOTO,
            'type' => $type,
            'role' => $user->ROLE,
            'name' => $user->FIRST_NAME . ' ' . $user->FIRST_LASTNAME,
            'clients_data' => $this->GetJsonData()
        ]);
    }

    function GetJsonData()
    {
        $result = [];
        $clients = $this->model->GetClients();
        
        foreach ($clients as $client) 
        {
            array_push($result ,$client->array());
        }

        return json_encode($result);
    }

    function GetClients($type)
    {
        $clients = $this->model->GetClients();
        $html = '';

        if(empty($clients))
            return $html;

        foreach ($clients as $key => $item) 
        {

            if($item->TYPE != $type)
                continue;

            $user = $this->model->GetUserById($item->ID);

            $html = $html . '
            <tr>
                <td> <span class="Usuario">'. $user->USERNAME .'</span></td>
                <td> <span class="Nombre">'. $user->FIRST_NAME .'</span> </td>
                <td> <span class="Nombre">'. $user->SECOND_NAME .'</span> </td>
                <td> <span class="Apellido">'. $user->FIRST_LASTNAME .'</span> </td>
                <td> <span class="Apellido">'. $user->SECOND_LASTNAME .'</span> </td>
                <td> <span class="Apellido">'. $item->TYPE .'</span> </td>
                <td> <span class="Accion">
                    <a href="'.URL.'/newloan" type="button" class="btn btn-outline-primary btn-sm">Realizar préstamo</a>
                    <button data-toggle="modal" data-target="#modal" type="button" class="btn btn-outline-primary btn-sm" id="btnEdit_'. $user->ID .'">Editar tipo</button>
                </span> </td>
            </tr>';
        }
        return $html;
    }
    
    function UpdateType()
    {
        $id = $this->POST('id');
        $type = $this->POST('type');

        $this->model->UpdateType($id, $type, $this->user);

        $this->Redirect('',[]);
    }
}

?>