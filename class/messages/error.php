<?php
class ErrorMessage
{
    const TEST = "404";
    const ERROR_SIGNUP_NEWUSER = "4572726f721";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "4572726f722";
    const ERROR_SIGNUP_NEWUSER_EXIST = "4572726f723";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "4572726f724";
    const ERROR_LOGIN_AUTHENTICATE = "4572726f725";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "4572726f726";

    private $bugs = [];

    public function __construct()
    {
        $this->bugs = [
            ErrorMessage::TEST => 'Mensaje de error',
            ErrorMessage::ERROR_SIGNUP_NEWUSER => 'Ha ocurrido un error al intentar procesar la solicitud.',
            ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY => 'Llena los campos de usuario y contraseña.',
            ErrorMessage::ERROR_SIGNUP_NEWUSER_EXIST => 'El usuario que ha ingresado ya existe.',
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Llena los campos de usuario y contraseña.',
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE => 'Ha ocurrido un error al iniciar sesion',
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE_DATA => 'Usuario y/o contraseña incorrecta'
        ];
    }

    public function get($hash)
    {
        return $this->bugs[$hash];
    }

    public function existKey($key)
    {
        return array_key_exists($key, $this->bugs);      
    }
} 
?>