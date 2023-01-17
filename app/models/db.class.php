<?php
class DB {
    protected $conexion;
    protected $isConnected=false;
    //Conexion a la base de datos
    public function conectar(){
        $this->conexion = new mysqli("localhost", "root", "root","pedidos");
        if ($this->conexion->connect_errno){
            echo "Error de conexion: {$this->conexion->connect_errno}";
            $this->isConnected = false;
        }else{
            $this->isConnected = true;
        }
        return $this->isConnected;
    }
}
    
?>