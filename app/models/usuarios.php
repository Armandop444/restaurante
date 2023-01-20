<?php
include_once "app/models/db.class.php";
class Usuarios extends DB{
    public function __construct(){
        parent::conectar();
    }

    //Obtener todos los datos ordenados por nombre
    public function getAll(){
        return $this->executeQuery("Select id_usr, usuario, nombres, apellidos, tipo, foto, IF(tipo=1,'Administrador','Usuario') AS ntipo from usuarios order by id_usr");
    }

    //Buscar por nombre
    public function getUserByName($name){
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, foto, tipo from usuarios where usuario='$name'");
    }
    //Buscar por nombre y id
    public function getUserByNameAndId($name,$id){
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, foto, tipo from usuarios where usuario='$name' and id_usr<>'$id'");
    }

    //guardar registro de usuario
    public function save($data,$img){
        return $this->executeInsert("Insert into usuarios (usuario, password, nombres, apellidos, tipo, foto) VALUES
        ('{$data["user"]}', md5('{$data["pass"]}'), '{$data["nombres"]}', '{$data["apellidos"]}', '{$data["tipo"]}', '{$img}' )");
    }
    public function update($data,$img){
        return $this->executeUpdate("Update usuarios SET usuario='{$data["user"]}', password=if('{$data["pass"]}'='', password,md5('{$data["pass"]}')),
        nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', tipo='{$data["tipo"]}', foto=if('{$img}'='',foto,'{$img}')
        where id_usr='{$data['id_usr']}'");
    }

    //buscar un registro de usuario
    public function getOneUser($id){
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, foto, tipo from usuarios where id_usr='$id'");
    }

    public function deleteUser($id){
        return $this->executeUpdate("delete from usuarios where id_usr='$id'");
    }
}
?>