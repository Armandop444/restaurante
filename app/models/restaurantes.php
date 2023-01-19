<?php
include_once "app/models/db.class.php";
class Restaurantes extends DB{
    public function __construct(){
        parent::conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select * from restaurantes order by nombre_restaurante");
    }
}
?>