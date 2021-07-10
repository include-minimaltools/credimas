<?php
    interface IModel
    {
        public function Save();
        public function GetAll();
        public function Get($id);
        public function Delete($id);
        public function Update();
        public function From($array);

        // public function Save() {}
        // public function GetAll() {}
        // public function GetItem($id) {}
        // public function DeleteItem($id) {}
        // public function InsertOrUpdateItem() {}
        // public function From($array) {}
    }
?>