<?php 

require_once 'database/USER.php';
require_once 'database/CLIENT.php';

class LenderModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function GetClients()
    {
        $result = new CLIENT();
        return $result->GetAll();
    }

    function GetUserById($id)
    {
        $result = (new USER())->Get($id);
        return $result;
    }

    function UpdateType($id, $type, $user)
    {
        $client = (new CLIENT())->Get($id);

        $client->TYPE = $type;
        $client->USER_UPDATE = $user->ID;
        $client->DATE_UPDATE = Date("Y-m-d");

        $client->Update();
    }
}?>