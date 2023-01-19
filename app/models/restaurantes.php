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
    //Buscar por nombre y id
    public function getRestauranteByNameAndId($name,$id){
        return $this->executeQuery("Select * from restaurantes where nombre_restaurante='$name' and idrestaurante<>'$id'");
    }

    //guardar registro de restaurante
    public function save($data,$img){
        return $this->executeInsert("Insert into restaurantes (nombre_restaurante, direccion, telefono, contacto, foto, fecha_ingreso, latitud, longitud) VALUES
        ('{$data["nombre"]}', '{$data["direccion"]}', '{$data["telefono"]}', '{$data["contacto"]}', '{$img}', '{$data["fechaI"]}', '{$data["lat"]}', '{$data["lon"]}')");
    }
    public function update($data,$img){
        return $this->executeUpdate("Update restaurantes SET nombre_restaurante='{$data["nombre"]}', direccion='{$data["direccion"]}',
        telefono='{$data["telefono"]}', contacto='{$data["contacto"]}', foto=if('{$img}'='',foto,'{$img}'), fecha_ingreso ='{$data["fechaI"]}',
        latitud='{$data["lat"]}', longitud='{$data["lon"]}' WHERE idrestaurante='{$data["idrestaurante"]}'");
    }

    //buscar un registro de restaurante
    public function getOneRestaurante($id){
        return $this->executeQuery("Select * from restaurantes where idrestaurante='$id'");
    }

    public function deleteRestaurante($id){
        return $this->executeUpdate("delete from restaurantes where idrestaurante='$id'");
    }
}
?>