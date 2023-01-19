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
}

?>