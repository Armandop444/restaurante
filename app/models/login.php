<?php
include_once "app/models/db.class.php";
class Login extends DB {
    public function __construct(){
        //Metodo de conectar de la clase padre
        parent::conectar();
    }

    public function validarLogin($user,$pass){
        $result=$this->conexion->query("SELECT * FROM usuarios WHERE usuario='$user' AND password=MD5('{$pass}')");
        return $result->fetch_assoc();
    }
}
?>