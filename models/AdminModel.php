<?php 

require_once 'database/USER.php';

class AdminModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetAll()
    {
        $result = new USER();
        return $result->GetAll();
    }

    function GetAllArray()
    {
        $result = [];

        $userlist = new USER();
        $users = $userlist->GetAll();

        foreach ($users as $key => $user) {
            $item = [
                'ID' => $user->ID,
				'USERNAME' => $user->USERNAME,
				'PASSWORD' => $user->PASSWORD,
				'ROLE' => $user->ROLE,
				'PHOTO' => $user->PHOTO,
				'ADDRESS' => $user->ADDRESS,
				'PHONE' => $user->PHONE,
				'FIRST_NAME' => $user->FIRST_NAME,
				'SECOND_NAME' => $user->SECOND_NAME,
				'FIRST_LASTNAME' => $user->FIRST_LASTNAME,
				'SECOND_LASTNAME' => $user->SECOND_LASTNAME,
				'IDENTIFICATION' => $user->IDENTIFICATION,
				'IDENTIFICATION_PHOTO' => $user->IDENTIFICATION_PHOTO,
				'VERIFIED' => $user->VERIFIED
            ];

            array_push($result, $item);
        }
        
        return $result;
    }

    function GetById($id)
    {
        $result = new User();

        $result = $result->Get($id);

        return $result;
    }
}?>