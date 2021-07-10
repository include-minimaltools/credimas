<?php

require_once 'database/USER.php';

class SignUpController extends SessionController
{   
    function __construct()
    {
        parent::__construct();
    }

    public function Render()
    {
        $this->view->render('login/signup', []);
    }

    public function NewUser()
    {
        if($this->ExistPOST(['username','password','phone','address','first_name','second_name','first_lastname','second_lastname']))
        {
            $username = $this->POST('username');
            $password = $this->POST('password');
            $phone = $this->POST('phone');
            $address = $this->POST('address');
            $first_name = $this->POST('first_name');
            $second_name = $this->POST('second_name');
            $first_lastname = $this->POST('first_lastname');
            $second_lastname = $this->POST('second_lastname');
            
            if ($username == '' || empty($username) ||
                $password == '' || empty($password) ||
                $phone == ''    || empty($phone) ||
                $address == ''  || empty($address) ||
                $first_name == '' || empty($first_name) ||
                $second_name == '' || empty($second_name) ||
                $first_lastname == '' || empty($first_lastname) ||
                $second_lastname == '' || empty($second_lastname))
            {
                error_log("SignUpController::NewUser -> " . $username . " " . $password);
                $this->Redirect('signup', ['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY]);
                return;
            }

            $user = new USER();

            $user->USERNAME = $username;
            $user->PASSWORD = $password;
            $user->ROLE = 'user';
            $user->PHONE = $phone;
            $user->ADDRESS = $address;
            $user->FIRST_NAME = $first_name;
            $user->SECOND_NAME = $second_name;
            $user->FIRST_LASTNAME = $first_lastname;
            $user->SECOND_LASTNAME = $second_lastname;
            $user->USER_CREATE = 'admin';
            $user->DATE_CREATE = date_default_timezone_get();
            $user->VERIFIED = false;


            if($user->Exists($username))
                $this->Redirect('signup', ['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER_EXIST]);
            else if ($user->Save())
                $this->Redirect('signup', ['success' => SuccessMessage::SUCCES_SIGNUP_NEWUSER]);
            else
            $this->redirect('signup',['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER]);
        }
        else
        {
            $this->redirect('signup',['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER]);
        }
    }
}

?>