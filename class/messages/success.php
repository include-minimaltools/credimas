<?php
class SuccessMessage
{
    const TEST = "123";
    const SIGNUP_NEWUSER = "305";
    const LOGIN = "434";

    private $success = [];

    public function __construct()
    {
        $this->success = [
            SuccessMessage::TEST => 'Mensaje de exito',
            SuccessMessage::SIGNUP_NEWUSER => 'Se ha registrado correctamente.',
            SuccessMessage::LOGIN => 'Se ha iniciado sesión correctamente'
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