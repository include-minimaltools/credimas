<?php 

class HomeController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function Render()
    {
        $lenders = $this->GetLenders();
        $this->view->render('Home/index',[
            'users' => $lenders
        ]);
    }

    function GetLenders()
    {
        $lenders = $this->model->GetLenders();
        $html = '';

        if(empty($lenders))
            return $html;

        foreach ($lenders as $key => $item) {
            $html = $html . '
            <tr>
                <td> <span class="Usuario">'. $item->USERNAME .'</span></td>
                <td> <span class="Nombre">'. $item->FIRST_NAME .'</span> </td>
                <td> <span class="Nombre">'. $item->SECOND_NAME .'</span> </td>
                <td> <span class="Apellido">'. $item->FIRST_LASTNAME .'</span> </td>
                <td> <span class="Apellido">'. $item->SECOND_LASTNAME .'</span> </td>
                <td> <span class="Accion">
                    <button type="button" ' . $this->getUserSessionData()->VERIFIED ? '' : 'disabled' .' class="btn btn-outline-primary btn-sm">Solicitar préstamo</button>
                </span> </td>
            </tr>';
        }
        return $html;
    }
}
?>