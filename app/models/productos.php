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

    //guardar registro de producto
    public function save($data,$img, $img2, $img3){
        return $this->executeInsert("Insert into productos set idrestaurante='{$data["nombreR"]}', nombre='{$data["nombre"]}',
        descripcion='{$data["descripcion"]}', foto1='{$img}', foto2='{$img2}', foto3='{$img3}', precio='{$data["precio"]}' ");
    }
    public function update($data,$img, $img2, $img3){
        return $this->executeUpdate("Update productos set idrestaurante='{$data["nombreR"]}', nombre='{$data["nombre"]}',
        descripcion='{$data["descripcion"]}', foto1=if('{$img}'='',foto1,'{$img}'), foto2=if('{$img2}'='',foto2,'{$img2}'), 
        foto3=if('{$img3}'='',foto3,'{$img3}'), precio='{$data["precio"]}' where idproducto ='{$data['idproducto']}' ");
        
    }

    //buscar un registro de producto
    public function getOneProducto($id){
        return $this->executeQuery("select productos.*, restaurantes.nombre_restaurante as nombre_restaurante 
        from productos inner join restaurantes on restaurantes.idrestaurante = productos.idrestaurante where idproducto= '$id'");
    }

    public function deleteProducto($id){
        return $this->executeUpdate("delete from productos where idproducto='$id'");
    }

    public function getIngredientesByProducto($id){
        return $this->executeQuery("Select ingredientes.*, productos.nombre as nombre_producto from ingredientes inner join productos on
        productos.idproducto = ingredientes.idproducto where productos.idproducto='$id'");
    }

    //Buscar por nombre
    public function getIngredienteByNameAndIdP($name,$id){
        return $this->executeQuery("Select * from ingredientes where descripcion ='$name' and idproducto='$id'");
    }

    public function saveIngrediente($data){
        return $this->executeInsert("insert into ingredientes (idproducto , descripcion, costo_adicional) VALUES ('{$data["idproductoI"]}',
        '{$data["descripcionI"]}', '{$data["costoI"]}')");
    }

    //buscar un registro de Ingrediente
    public function getOneIngrediente($id){
        return $this->executeQuery("Select * from ingredientes where idingrediente= '$id'");
    }

    //Buscar por nombre y id
    public function getIngredienteByNameAndId($name,$id){
        return $this->executeQuery("Select * from ingredientes where descripcion='$name' and idingrediente<>'$id'");
    }
    public function updateIngrediente($data){
        return $this->executeUpdate("Update ingredientes set idproducto = '{$data["idproductoI"]}', descripcion = '{$data["descripcionI"]}',
        costo_adicional = '{$data["costoI"]}' WHERE ingredientes.idingrediente = '{$data["idingrediente"]}' AND ingredientes.idproducto = '{$data["idproductoI"]}'");   
    }

    public function deleteIngrediente($id){
        return $this->executeUpdate("delete from ingredientes where idingrediente='$id'");
    }

    //Obtiene los productos filtrados
    public function getProductosReportes($data){
        $condicion="";
        if ($data['id']!=0) {
            $condicion=" and productos.idrestaurante='{$data['id']}'";   
        }
        if($data['fechaI']!='' && $data['fechaF']!=''){
            $condicion.=" and restaurantes.fecha_ingreso between '{$data['fechaI']}' AND '{$data['fechaF']}'";
        }else if($data['fechaI']!=''){
            $condicion.="and restaurantes.fecha_ingreso = '{$data['fechaI']}'";           
        }
        
       return $this->executeQuery("select productos.*, restaurantes.nombre_restaurante,restaurantes.fecha_ingreso FROM productos inner join restaurantes on restaurantes.idrestaurante = productos.idrestaurante where 1 {$condicion}");        
    }   
}
?>