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
                <td> <span class="Rol">'. $item->ROLE .'</span> </td>';
                
            if($item->VERIFIED)    
                $html = $html . '<td> <span class="Verificado"> <button type="button" disabled class="btn btn-outline-success btn-sm">Verificado</button> </span> </td>
                <td> <span class="Acción"> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalUser" id="btnCancel_'.$item->ID.'">Anular</button> </span> </td>';

            else
                $html = $html . '<td> <span class="Verificado"> <button type="button" disabled class="btn btn-outline-danger btn-sm">No verificado</button> </span> </td>
                <td> <span class="Acción"> <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalUser" id="btnVerify_'.$item->ID.'">Verificar</button> </span> </td>';

            $html = $html .'</tr>';
        }
        
        $this->view->render('Home/admin',[
            'tblUsers' => $html,
            'users' => json_encode($this->model->GetAllArray()),
            'photo' => $this->getUserSessionData()->PHOTO
        ]);
        return $html;
    }

    function Verificate()
    {
        if(!$this->ExistPOST("id"))
            return error_log('No existe post');
        

        $id = $this->POST('id');
        
        $user = $this->model->GetById($id);

        $user->VERIFIED = $user->VERIFIED ? false : true;

        $user->Update();

        $this->Redirect('admin',[]);
    }
}
?>