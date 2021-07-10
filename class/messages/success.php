<?php
class SuccessMessage
{
    const TEST = "123";
    const SUCCES_SIGNUP_NEWUSER = "305";
    const SUCCESS_LOGIN = "434";

    private $success = [];

    public function __construct()
    {
        $this->success = [
            SuccessMessage::TEST => 'Mensaje de exito',
            SuccessMessage::SUCCES_SIGNUP_NEWUSER => 'Se ha registrado correctamente.',
            SuccessMessage::SUCCESS_LOGIN => 'Se ha iniciado sesión correctamente'
        ];
    }

    public function get($hash)
    {
        return $this->success[$hash];
    }

    public function existKey($key)
    {
        return array_key_exists($key, $this->success);      
    }
} 
?>