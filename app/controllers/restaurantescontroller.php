<?php
include_once "app/models/restaurantes.php";
class RestaurantesController extends Controller {
    private $restaurante;
    public function __construct($param){
        $this->restaurante = new Restaurantes();
        #mandar a llamar la vista y parametro
        parent::__construct("restaurantes",$param,true);
    }

    public function getAll(){
        $records = $this->restaurante->getAll();
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

        if ($_POST["idrestaurante"]=="0") {
            if(count($this->restaurante->getRestauranteByName($_POST["nombre"]))>0){
                $info = array('success' => false, 'msg' => "El Restaurante ya existe");
            } else {
                $records = $this->restaurante->save($_POST, $img);
                $info = array('success' => true, 'msg' => "Registro Guardado Con Exito");
            }
        }
        echo json_encode($info);
    }
}

?>