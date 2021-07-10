<?php class ErrorController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function Render()
    {
        $this->view->render('Error/index');   
    }
}?>