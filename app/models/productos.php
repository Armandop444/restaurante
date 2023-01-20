<?php
include_once "app/models/db.class.php";
class Productos extends DB{
    public function __construct(){
        parent::conectar();
    }

    //Obtener todos los datos
    public function getAll(){
        return $this->executeQuery("select productos.*, restaurantes.nombre_restaurante as nombre_restaurante 
        from productos inner join restaurantes on restaurantes.idrestaurante = productos.idrestaurante");
    }

    //Buscar por nombre
    public function getProductoByName($name){
        return $this->executeQuery("Select * from productos where nombre ='$name'");
    }
    //Buscar por nombre y id
    public function getProductoByNameAndId($name,$id){
        return $this->executeQuery("Select * from productos where nombre='$name' and idproducto<>'$id'");
    }

    //guardar registro de usuario
    public function save($data,$img, $img2, $img3){
        return $this->executeInsert("Insert into productos set idrestaurante='{$data["nombreR"]}', nombre='{$data["nombre"]}',
        descripcion='{$data["descripcion"]}', foto1='{$img}', foto2='{$img2}', foto3='{$img3}', precio='{$data["precio"]}' ");
    }
    public function update($data,$img, $img2, $img3){
        return $this->executeUpdate("Update productos set idrestaurante='{$data["nombreR"]}', nombre='{$data["nombre"]}',
        descripcion='{$data["descripcion"]}', foto1=if('{$img}'='',foto1,'{$img}'), foto2=if('{$img2}'='',foto2,'{$img2}'), 
        foto3=if('{$img3}'='',foto3,'{$img3}'), precio='{$data["precio"]}' where idproducto ='{$data['idproducto']}' ");
        
    }

    //buscar un registro de usuario
    public function getOneProducto($id){
        return $this->executeQuery("select productos.*, restaurantes.nombre_restaurante as nombre_restaurante 
        from productos inner join restaurantes on restaurantes.idrestaurante = productos.idrestaurante where idproducto= '$id'");
    }

    public function deleteProducto($id){
        return $this->executeUpdate("delete from productos where idproducto='$id'");
    }
}
?>