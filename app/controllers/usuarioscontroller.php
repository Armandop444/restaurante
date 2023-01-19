<?php
include_once "app/models/usuarios.php";
class UsuariosController extends Controller {
    private $usuario;
    public function __construct($param){
        $this->usuario = new Usuarios();
        #mandar a llamar la vista y parametro
        parent::__construct("usuarios",$param,true);
    }

    public function getAll(){
        $records = $this->usuario->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function save(){
        $img = "";
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

        if ($_POST["id_usr"]=="0") {
            if(count($this->usuario->getUserByName($_POST["user"]))>0){
                $info = array('success' => false, 'msg' => "El Usuario ya existe");
            } else {
                $records = $this->usuario->save($_POST, $img);
                $info = array('success' => true, 'msg' => "Registro Guardado Con Exito");
            }
        } else {
            if(count($this->usuario->getUserByNameAndId($_POST["user"],$_POST["id_usr"]))>0){
                $info = array('success' => false, 'msg' => "El Usuario ya existe");
            } else {
                $records = $this->usuario->update($_POST, $img);
                $info = array('success' => true, 'msg' => "Registro Actualizado Con Exito");
            }
        }
        echo json_encode($info);
    }

    public function getOneUser(){
        $records = $this->usuario->getOneUser($_GET["id"]);
        if (count($records)>0){
            $info = array('success' => true, 'records' => $records);
        }else{
            $info = array('success' => false, 'msg' => "El Usuario no existe");
        }
        echo json_encode($info);
    }

    public function deleteUser(){
        $records = $this->usuario->deleteUser($_GET["id"]);
        $info = array('success' => true, 'msg' => "Registro eliminado con exito");
        echo json_encode($info);
    }
}

?>