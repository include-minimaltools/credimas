<?php 

class LoginController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function Render()
    {
        $this->view->render('Login/index');   
    }

    function Authenticate()
    {
        if($this->ExistPOST(['username', 'password']))
        {
            $username = $this->POST('username');
            $password = $this->POST('password');

            if($username == '' || empty($username) || $password == '' || empty($password))
            {
                $this->Redirect('', ['error' => ErrorMessage::LOGIN_AUTHENTICATE_EMPTY]);
                return;
            }

            $user = $this->model->Login($username, $password);

            if($user != null)
            {
                $this->Initialize($user);
                $this->Redirect('',['success' => SuccessMessage::LOGIN]);
            }
            else 
            {
                $this->Redirect('',['error' => ErrorMessage::LOGIN_AUTHENTICATE_DATA]);
            }
            
        }
        else
        {
            $this->Redirect('',['error' => ErrorMessage::LOGIN_AUTHENTICATE]);
        }
    }
}
?>