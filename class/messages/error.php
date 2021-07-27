<?php
class ErrorMessage
{
    const TEST = "404";
    const SIGNUP_NEWUSER = "4572726f721";
    const SIGNUP_NEWUSER_EMPTY = "4572726f722";
    const SIGNUP_NEWUSER_EXIST = "4572726f723";
    const LOGIN_AUTHENTICATE_EMPTY = "4572726f724";
    const LOGIN_AUTHENTICATE = "4572726f725";
    const LOGIN_AUTHENTICATE_DATA = "4572726f726";
    const NEWLOAN_EMPTY = "4572726f725";
    const NEWLOAN_PHOTO_REQUIRED = "4572726f726";
    const ERROR = "4572726afafref726";

    private $bugs = [];

    public function __construct()
    {
        $this->bugs = [
            ErrorMessage::TEST => 'Mensaje de error',
            ErrorMessage::SIGNUP_NEWUSER => 'Ha ocurrido un error al intentar procesar la solicitud.',
            ErrorMessage::SIGNUP_NEWUSER_EMPTY => 'Llena los campos de usuario y contraseña.',
            ErrorMessage::SIGNUP_NEWUSER_EXIST => 'El usuario que ha ingresado ya existe.',
            ErrorMessage::LOGIN_AUTHENTICATE_EMPTY => 'Llena los campos de usuario y contraseña.',
            ErrorMessage::LOGIN_AUTHENTICATE => 'Ha ocurrido un error al iniciar sesion',
            ErrorMessage::LOGIN_AUTHENTICATE_DATA => 'Usuario y/o contraseña incorrecta',
            ErrorMessage::NEWLOAN_EMPTY => 'Debe llenar todos los campos para continuar, vuelva a intentarlo',
            ErrorMessage::NEWLOAN_PHOTO_REQUIRED => 'Debe anexar una imagen del recibo para continuar, vuelva a intentarlo',
            ErrorMessage::ERROR => 'Ha ocurrido un error inesperado'

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