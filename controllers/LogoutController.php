<?php 

class LogoutController extends SessionController
{
    function __construct()
    {
        parent::__construct();
        $this->Logout();
    }

    function Render()
    {
        
    }
}?>