<?php
class View
{
    function __construct()
    {
        
    }

    function render($nombre, $d = [])
    {
        $this->data = $d;

        $this->handleMessages();

        require 'Views/' . $nombre . '.php';
    }

    private function handleMessages()
    {
        if(isset($_GET['success']) && isset($_GET['error']))
        {
            //error            
        }
        else if(isset($_GET['success']))
        {
            $this->handleSuccess();
        }
        else if(isset($_GET['error']))
        {
            $this->handleError();
        }
    }

    private function handleError()
    {
        $hash = $_GET['error'];
        $error = new ErrorMessage();

        if($error->existKey($hash))
            $this->data['error'] = $error->get($hash);
    }

    private function handleSuccess()
    {
        $hash = $_GET['success'];
        $success = new SuccessMessage();

        if($success->existKey($hash))
            $this->data['success'] = $success->get($hash);
    }

    public function showMessages()
    {
        $this->showErrors();
        $this->showSuccess();
    }

    public function showErrors()
    {
        if(array_key_exists('error', $this->data))
            echo '<div class="error">'.$this->data['error'].'</div>';
    }

    public function showSuccess()
    {
        if(array_key_exists('success', $this->data))
            echo '<div class="success">'.$this->data['success'].'</div>';
    }


}
?>