<?php
require_once "app/views/view.php";
define('URL', '/restaurante/');
class Controller {
    public $view;
    public function __construct($view,$param){
        $this->view = new View();
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