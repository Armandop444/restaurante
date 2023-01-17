<?php
require_once "app/views/view.php";
define('URL', '/restaurante/');
class Controller {
    public $view;
    public function __construct($view,$param,$validar=false){
        $this->view = new View();
        //Se verifica si esta logeado o no
        if ($validar){
            if(!isset($_SESSION)){
                session_start();
            }
            //Se verifica si no existe la session con el id usuario
            if(!isset($_SESSION["id_usr"])){
                $this->view->render("login");
                exit(0);
            }
            //Se verifica si el el tipo de usuario o admin, en caso sea usuario lo envia a dashboarduser
            if ($_SESSION["tipo"]==="2") {
                $this->view->Render("dashboarduser");
                return;
            }
            
        }
        if (empty($param)){
            $this->view->render($view);
            return;
        }
        if (method_exists($this, $param)){
            $this->$param();
        } else {
            $this->view->render($view);
            //echo "metodo no disponible";
        }
    }
}
?>