<?php
include_once "app/models/productos.php";
class ProductosController extends Controller {
    private $producto;
    public function __construct($param){
        $this->producto = new Productos();
        #mandar a llamar la vista y parametro
        parent::__construct("productos",$param,true);
    }

    public function getAll(){
        $records = $this->producto->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function save(){
        $img = "";
        $img2 = "";
        $img3 = "";
        if (isset($_FILES["foto"])){
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])){
                if(($_FILES["foto"]["type"]== "image/png") || ($_FILES["foto"]["type"]== "image/jpeg") || ($_FILES["foto"]["type"]== "image/jpg")){
                    copy($_FILES["foto"]["tmp_name"],__DIR__."/../../public_html/fotos/".$_FILES["foto"]["name"]) or die("No se pudo guardar el archivo");
                    $img = URL . "public_html/fotos/" . $_FILES["foto"]["name"];
                }else{
                    $img = "";
                }
            }
        }
        if (isset($_FILES["foto2"])){
            if (is_uploaded_file($_FILES["foto2"]["tmp_name"])){
                if(($_FILES["foto2"]["type"]== "image/png") || ($_FILES["foto2"]["type"]== "image/jpeg") || ($_FILES["foto2"]["type"]== "image/jpg")){
                    copy($_FILES["foto2"]["tmp_name"],__DIR__."/../../public_html/fotos/".$_FILES["foto2"]["name"]) or die("No se pudo guardar el archivo");
                    $img2 = URL . "public_html/fotos/" . $_FILES["foto2"]["name"];
                }else{
                    $img2 = "";
                }
            }
        }
        if (isset($_FILES["foto3"])) {
            if (is_uploaded_file($_FILES["foto3"]["tmp_name"])) {
                if (($_FILES["foto3"]["type"] == "image/png") || ($_FILES["foto3"]["type"] == "image/jpeg") || ($_FILES["foto3"]["type"] == "image/jpg")) {
                    copy($_FILES["foto3"]["tmp_name"], __DIR__ . "/../../public_html/fotos/" . $_FILES["foto3"]["name"]) or die("No se pudo guardar el archivo");
                    $img3 = URL . "public_html/fotos/" . $_FILES["foto3"]["name"];
                } else {
                    $img3 = "";
                }
            }
        }

        if ($_POST["idproducto"]=="0") {

            if(count($this->producto->getProductoByName($_POST["nombre"]))>0){
                $info = array('success' => false, 'msg' => "El Producto ya existe");
            } else {
                if($_POST["nombreR"]=="0"){
                    $info = array('success' => false, 'msg' => "Seleccione un Restaurante");
                }else{
                    $records = $this->producto->save($_POST, $img, $img2, $img3);
                    $info = array('success' => true, 'msg' => "Registro Guardado Con Exito");
                }                
            }
        } else {
            if(count($this->producto->getProductoByNameAndId($_POST["nombre"],$_POST["idproducto"]))>0){
                $info = array('success' => false, 'msg' => "El Producto ya existe");
            } else {
                //Recordarme que si viene seleccione no hacer cambios
                if($_POST["nombreR"]=="0"){
                    $info = array('success' => false, 'msg' => "Seleccione un Restaurante");
                } else {
                    $records = $this->producto->update($_POST, $img, $img2, $img3);
                    $info = array('success' => true, 'msg' => "Registro Actualizado Con Exito");
                }
            }
        }
        echo json_encode($info);
    }

    public function getOneProducto(){
        $records = $this->producto->getOneProducto($_GET["id"]);
        if (count($records)>0){
            $info = array('success' => true, 'records' => $records);
        }else{
            $info = array('success' => false, 'msg' => "El Producto no existe");
        }
        echo json_encode($info);
    }

    public function deleteProducto(){
        $records = $this->producto->deleteProducto($_GET["id"]);
        $info = array('success' => true, 'msg' => "Registro eliminado con exito");
        echo json_encode($info);
    }

    public function getIngredientesByProducto(){
        $records = $this->producto->getIngredientesByProducto($_GET["id"]);
        if (count($records)>0){
            $info = array('success' => true, 'records' => $records);
        }else{
            $records = $this->producto->getOneProducto($_GET["id"]);
            $info = array('success' => true, 'records' => $records);
        }
        echo json_encode($info);
    }

    public function saveIngrediente(){
        if ($_POST["idingrediente"]=="0") {
            if(count($this->producto->getIngredienteByNameAndIdP($_POST["descripcionI"],$_POST["idproductoI"]))>0){
                $info = array('success' => false, 'msg' => "El Ingrediente ya existe");
            } else {
                    $records = $this->producto->saveIngrediente($_POST);
                    $info = array('success' => true, 'msg' => "Registro Guardado Con Exito");
            }
        } else {
            if(count($this->producto->getIngredienteByNameAndId($_POST["descripcionI"],$_POST["idingrediente"]))>0){
                $info = array('success' => false, 'msg' => "El Ingrediente ya existe");
            } else {
                    $records = $this->producto->updateIngrediente($_POST);
                    $info = array('success' => true, 'msg' => "Registro Actualizado Con Exito");
                
            }
        }
        echo json_encode($info);

    }

    public function getOneIngrediente(){
        $records = $this->producto->getOneIngrediente($_GET["id"]);
        if (count($records)>0){
            $info = array('success' => true, 'records' => $records);
        }else{
            $info = array('success' => false, 'msg' => "El Ingrediente no existe");
        }
        echo json_encode($info);
    }

    public function deleteIngrediente(){
        $records = $this->producto->deleteIngrediente($_GET["id"]);
        $info = array('success' => true, 'msg' => "Registro eliminado con exito");
        echo json_encode($info);
    }
}

?>