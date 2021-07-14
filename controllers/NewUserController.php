<?php

require_once 'database/USER.php';
require_once 'database/CLIENT.php';
require_once 'database/LENDER.php';

class NewUserController extends SessionController
{   
    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    public function Render()
    {
        $this->view->render('NewUser/index', [
            'photo' => $this->user->PHOTO,
            'role' => $this->user->ROLE,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME
        ]);
    }

    function CreateUser()
    {
        if($this->ExistPOST(['username','password','confirmPassword','role','phone','identify','address','first_name','second_name','first_lastname','second_lastname']))
        {
            $username = $this->POST('username');
            $password = $this->POST('password');
            $confirmPassword = $this->POST('confirmPassword');
            $phone = $this->POST('phone');
            $identification = $this->POST('identify');
            $address = $this->POST('address');
            $first_name = $this->POST('first_name');
            $second_name = $this->POST('second_name');
            $first_lastname = $this->POST('first_lastname');
            $second_lastname = $this->POST('second_lastname');
            $role = $this->POST('role');
            
            if ($username == '' || empty($username) ||
                $password == '' || empty($password) ||
                $confirmPassword == '' || empty($confirmPassword) ||
                $identification == '' || empty($identification) ||
                $role == '' || empty($role) ||
                // $address == ''  || empty($address) ||
                // $first_name == '' || empty($first_name) ||
                // $second_name == '' || empty($second_name) ||
                // $first_lastname == '' || empty($first_lastname) ||
                // $second_lastname == '' || empty($second_lastname))
                $phone == ''    || empty($phone))
            {
                // $this->Redirect('signup', ['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY]);
                error_log('Error, falta un parametro obligatorio');
                return;
            }

            if($confirmPassword != $password)
            {
                error_log('Error, la contraseña no es igual');
                return;
            }

            $user = new User();
            
            // Si existe una foto, sustituir la anterior
            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != NULL)
            {
                $user->PHOTO = $this->setPhoto($_FILES['photo'], "images/users/");
            }

                
            if(isset($_FILES['photo_identify']) && $_FILES['photo_identify']['name'] != NULL)
            {
                $user->IDENTIFICATION_PHOTO = $this->setPhoto($_FILES['photo_identify'], "images/identification/");
            }

            $date = getdate();

            $user->USERNAME = $username;
            $user->PASSWORD = $password;
            $user->PHONE = $phone;
            $user->ADDRESS = $address;
            $user->ROLE = $role;
            $user->IDENTIFICATION = $identification;
            $user->FIRST_NAME = $first_name;
            $user->SECOND_NAME = $second_name;
            $user->FIRST_LASTNAME = $first_lastname;
            $user->SECOND_LASTNAME = $second_lastname;
            $user->USER_CREATE = $this->user->USERNAME;
            $user->DATE_CREATE = $date['year'] . '-' .  $date['month'] . '-' . $date['mday'];
            $user->VERIFIED = false;

            if($user->ExistsUsername($user->USERNAME))
            {
                error_log("El nombre de usuario ya existe");
            }
            else
            {
                if($user->Save())
                {
                    if ($role == 'lender')
                    {
                        $lender = new LENDER();

                        $lender->ID = $this->model->GetId($user->USERNAME);
                        $lender->CAPITAL = 0;
                        $lender->ACCOUNTS_RECEIVABLE = 0;
                        $lender->LOANS = 0;
                        $lender->USER_CREATE = $this->user->USERNAME;
                        $lender->DATE_CREATE = $user->DATE_CREATE;

                        $lender->Save();
                    }
                    else if ($role == 'client')
                    {
                        $client = new CLIENT();
                        
                        $client->ID = $this->model->GetId($user->USERNAME);
                        $client->TYPE = 'C';
                        $client->ACCOUNTS_PAYABLE = 0;
                        $client->LOANS = 0;
                        $client->USER_CREATE = $this->user->USERNAME;
                        $client->DATE_CREATE = $user->DATE_CREATE;

                        $client->Save();
                    }
                    $this->Redirect('admin', []);
                }
                else
                {
                    error_log("No se pudo actualizar");
                }
                
            }
        }
        else
        {
            error_log('NewUser::CreateUser: No se encontro post');
        }
    }

    private function setPhoto($photo, $target_dir)
    {
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($photo["tmp_name"]);

        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            return NULL;

            // $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPHOTO_FORMAT]);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                return $hash;
            } else {
                return NULL;
                // $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPHOTO]);
            }
        }
        
    }
}

?>