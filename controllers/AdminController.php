<?php 

class AdminController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function Render()
    {
        $this->GetAllUsers();
    }

    function GetAllUsers()
    {
        $users = $this->model->GetAll();
        $html = '';

        foreach ($users as $key => $item) {
            $html = $html . '<tr>
                <td> <span class="Usuario">'. $item->USERNAME .'</span></td>
                <td> <span class="Nombre">'. $item->FIRST_NAME .'</span> </td>
                <td> <span class="Nombre">'. $item->SECOND_NAME .'</span> </td>
                <td> <span class="Apellido">'. $item->FIRST_LASTNAME .'</span> </td>
                <td> <span class="Apellido">'. $item->SECOND_LASTNAME .'</span> </td>
                <td> <span class="Rol">'. $item->ROLE .'</span> </td>
                <td> <span class="Verificado">';
                
            if($item->VERIFIED)    
                $html = $html . '<button type="button" disabled class="btn btn-outline-success btn-sm">Verificado</button>';

            else
                $html = $html . '<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalUser" id="btnVerify_'.$item->ID.'">Verificar</button>';

            $html = $html .'</span> </td> </tr>';
        }
        
        $this->view->render('Home/admin',[
            'tblUsers' => $html,
            'users' => json_encode($this->model->GetAllArray()),
            'photo' => $this->getUserSessionData()->PHOTO
        ]);

        return $html;
    }
}
?>