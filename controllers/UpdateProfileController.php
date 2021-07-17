<?php

require_once 'database/USER.php';

class UpdateProfileController extends SessionController
{   
    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    public function Render()
    {
        $this->view->render('updateprofile/index', [
            "username" => $this->user->USERNAME,
            "identify" => $this->user->IDENTIFICATION,
            "photo" => $this->user->PHOTO,
            "phone" => $this->user->PHONE,
            "role" => $this->user->ROLE,
            "address" => $this->user->ADDRESS,
            "first_name" => $this->user->FIRST_NAME,
            "second_name" => $this->user->SECOND_NAME,
            "first_lastname" => $this->user->FIRST_LASTNAME,
            "second_lastname" => $this->user->SECOND_LASTNAME,
            "verified" => $this->user->VERIFIED,
            'name' => $this->user->FIRST_NAME . ' ' . $this->user->FIRST_LASTNAME
        ]);
    }

    function UpdateUser()
    {
        if($this->ExistPOST(['username','phone','address','first_name','second_name','first_lastname','second_lastname']))
        {
            $username = $this->POST('username');
            $phone = $this->POST('phone');
            $address = $this->POST('address');
            $first_name = $this->POST('first_name');
            $second_name = $this->POST('second_name');
            $first_lastname = $this->POST('first_lastname');
            $second_lastname = $this->POST('second_lastname');
            
            if ($username == '' || empty($username) || $phone == ''    || empty($phone))
            {
                $this->Redirect('signup', ['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY]);
                return;
            }

            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != NULL)
            {
                $temp_photo = $this->user->PHOTO;
                $this->user->PHOTO = $this->setPhoto($_FILES['photo'], "images/users/");
                if($temp_photo != $this->user->PHOTO && $temp_photo != NULL)
                    error_log("Borrando imagen: " . $temp_photo . ': '. unlink('images/users/' . $temp_photo) ? 'Borrado' : 'No se ha podido borrar');    
            }
            
            if(isset($_FILES['photo_identify']) && $_FILES['photo_identify']['name'] != NULL)
            {
                
                $temp_photo = $this->user->IDENTIFICATION_PHOTO;
                error_log('temp -> ' . $temp_photo);
                $this->user->IDENTIFICATION_PHOTO = $this->setPhoto($_FILES['photo_identify'], "images/identification/");
                error_log('new -> ' . $this->user->IDENTIFICATION_PHOTO);
                if($temp_photo != $this->user->IDENTIFICATION_PHOTO && $temp_photo != NULL)
                    error_log("Borrando imagen: " . $this->user->IDENTIFICATION_PHOTO . ': '. unlink('images/identification/' . $temp_photo) ? 'Borrado' : 'No se ha podido borrar');
            }

            $this->user->USERNAME = $username;
            $this->user->PHONE = $phone;
            $this->user->ADDRESS = $address;
            $this->user->FIRST_NAME = $first_name;
            $this->user->SECOND_NAME = $second_name;
            $this->user->FIRST_LASTNAME = $first_lastname;
            $this->user->SECOND_LASTNAME = $second_lastname;
            $this->user->USER_UPDATE = $this->user->USERNAME;
            $this->user->DATE_UPDATE = Date('Ymd');

            error_log($this->user->DATE_UPDATE);

            if($this->user->Exists($this->user->ID))
            {
                if($this->user->Update())
                {
                    $this->Redirect('admin', []);        
                }
                else
                {
                    error_log("No se pudo actualizar");
                }
            }
            else
            {
                error_log("No existe usuario");
            }
        }
        else
        {
            $this->redirect('signup',['error' => ErrorMessage::ERROR_SIGNUP_NEWUSER]);
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