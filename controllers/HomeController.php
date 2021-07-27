<?php 

class HomeController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function Render()
    {
        $user = $this->getUserSessionData();

        $fee_documents = $this->model->GetFeeDocuments($user->ID);

        $this->view->render('Home/index',[
            'lenders' => $this->GetLenders(),
            'role' => $user->ROLE,
            'photo' => $user->PHOTO,
            'name' => $user->FIRST_NAME . ' ' . $user->FIRST_LASTNAME,
            'tblPending' => $this->LoadFeeDocumentsDataTable($fee_documents, 'pending'),
            'tblLate' => $this->LoadFeeDocumentsDataTable($fee_documents, 'late')
        ]);
    }

    function LoadFeeDocumentsDataTable($params, $status)
    {
        $html = '';
        foreach ($params as $key => $param) 
        {
            if($param->STATUS != $status)
                continue;

            $html .= '
            <tr>
                <td> <span>'. $param->N_PARTIAL .'</span></td>
                <td> <span>'. $param->PAYMENT_DATE .'</span></td>
                <td> <span>'. $param->TOTAL_AMOUNT .'</span></td>
                <td> <span>'. $this->model->GetLenderNameByIdLoan($param->ID_LOAN) .'</span></td>
                <td> <button class="btn btn-primary" id="btnPay_'. $param->ID.'"><i class="fa fa-money"> Pagar</i></button></td>
            </tr>';
        }
        
        if($html == '')
        {
            $html = '<tr><td colspan="4" class="text-center"><span>Ninguna</span></td></tr>';    
        }

        return $html;
    }

    function GetLenders()
    {
        $lenders = $this->model->GetLenders();
        $html = '';

        if(empty($lenders))
            return $html;

        foreach ($lenders as $key => $item) {
            $html .= '
            <tr>
                <td> <span>'. $item->USERNAME .'</span></td>
                <td> <span>'. $item->FIRST_NAME .'</span> </td>
                <td> <span>'. $item->SECOND_NAME .'</span> </td>
                <td> <span>'. $item->FIRST_LASTNAME .'</span> </td>
                <td> <span>'. $item->SECOND_LASTNAME .'</span> </td>
                <td> <span>'. $item->PHONE .'</span> </td>
                
                <!--<td> <span class="Accion">
                    <button type="button" class="btn btn-outline-primary btn-sm">Solicitar préstamo</button>
                </span> </td> -->
            </tr>';
        }
        return $html;
  
    }

    
}
?>