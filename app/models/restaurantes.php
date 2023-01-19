<?php
include_once "app/models/db.class.php";
class Restaurantes extends DB{
    public function __construct(){
        parent::conectar();
    }

    //Obtener todos los datos ordenados por nombre
    public function getAll(){
        return $this->executeQuery("Select * from restaurantes order by nombre_restaurante");
    }

    //Buscar por nombre
    public function getRestauranteByName($name){
        return $this->executeQuery("Select * from restaurantes where nombre_restaurante='$name'");
    }

    //guardar registro de restaurante
    public function save($data,$img){
        return $this->executeInsert("Insert into restaurantes (nombre_restaurante, direccion, telefono, contacto, foto, fecha_ingreso, latitud, longitud) VALUES
        ('{$data["nombre"]}', '{$data["direccion"]}', '{$data["telefono"]}', '{$data["contacto"]}', '{$img}', '{$data["fechaI"]}', '{$data["lat"]}', '{$data["lon"]}')");
    }

}
?>