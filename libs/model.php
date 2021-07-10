<?php
    include_once 'libs/imodel.php';
    
    class Model
    {
        private $database;

        function __construct()
        {
            $this->database = new Database(); 
        }

        function query($query)
        {
            return $this->database->Connect()->query($query);
        }

        function prepare($query)
        {
            return $this->database->Connect()->prepare($query);
        }
    }
?>