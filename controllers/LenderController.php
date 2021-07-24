<?php 

class LenderController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function Render()
    {
        $user = $this->getUserSessionData();
        $this->view->render('Home/lender',[
            'clients' => $this->GetClients(),
            'photo' => $user->PHOTO,
            'role' => $user->ROLE,
            'name' => $user->FIRST_NAME . ' ' . $user->FIRST_LASTNAME
        ]);
    }

    function GetClients()
    {
        $clients = $this->model->GetClients();
        $html = '';

        if(empty($clients))
            return $html;

        foreach ($clients as $key => $item) {
            $html = $html . '
            <tr>
                <td> <span class="Usuario">'. $item->USERNAME .'</span></td>
                <td> <span class="Nombre">'. $item->FIRST_NAME .'</span> </td>
                <td> <span class="Nombre">'. $item->SECOND_NAME .'</span> </td>
                <td> <span class="Apellido">'. $item->FIRST_LASTNAME .'</span> </td>
                <td> <span class="Apellido">'. $item->SECOND_LASTNAME .'</span> </td>
                <td> <span class="Accion">
                    <a href="'.URL.'/newloan" type="button" class="btn btn-outline-primary btn-sm">Realizar préstamo</a>
                </span> </td>
            </tr>';
        }
        return $html;
    }
}
?>