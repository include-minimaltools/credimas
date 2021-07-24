<?php 

class ViewLoansController extends SessionController
{
    private $user;   
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function Render()
    {
        $this->view->render('ViewLoans/index',[
            'role' => $this->user->ROLE,
            'photo' => $this->user->PHOTO,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME,
            'defaultEvents' => $this->LoadCalendar()
        ]);

        
    }

    function LoadCalendar()
    {
        $fees_documents = $this->model->LoadFeesDocuments($this->user);
        $defaultEvents = '';

        foreach ($fees_documents as $key => $fee_document) 
        {
            if($fee_document->STATUS == 'paid')
            {
                $className = "bg-secondary";
            }
            else if($fee_document->STATUS == 'late')
            {
                $className = "bg-danger";
            } 
            else if($fee_document->STATUS == 'pending')
            {
                $className = "bg-primary";
            }
            else if($fee_document->STATUS == 'in process')
            {
                $className = "bg-dark";
            }
            
            $defaultEvents .= '{
                id:' . $fee_document->ID . ',
                title: "Cuota ' . $fee_document->N_PARTIAL . '",
                start: new Date("' . date('Y-m-d',strtotime($fee_document->PAYMENT_DATE."+ 1 days")) . '"),
                className: "' . $className . '",
                status: "' . $fee_document->STATUS . '"
            },';
        }

        return $defaultEvents;
    }
}
?>