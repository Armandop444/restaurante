<?php
include_once "app/models/login.php";
class LoginController extends Controller{
    private $user;
    public function __construct($param){
        #Mandar a llamar la vista y parametro
        $this->user = new Login();
        parent::__construct("login",$param);
    }
    public function validar(){
        //Obtener datos del formulario de login y en dado caso no existan se ponen vacios
        $u = $_POST["user"] ?? '';
        $p = $_POST["pass"] ?? '';
        //Validar que existe el usuario
        if ($record=$this->user->validarLogin($u,$p)){
            //Verificar si no hay una sesion iniciada
            if (!isset($_SESSION)) {
                session_start();
            }
            //Creamos las variables de sesion
            $_SESSION["id_usr"] = $record["id_usr"];
            $_SESSION["tipo"] = $record["tipo"];
            $_SESSION["usuario"] = $record["usuario"];
            $_SESSION["nuser"] = "{$record["nombres"]} {$record["apellidos"]}";

            //Verificamos si que tipo de usuario es
            if($record["tipo"]==1){
                $info = array('success' => true, 'msg' => 'Usuario correcto','link' => URL."dashboard");
            }else{
                $info = array('success' => true, 'msg' => 'Usuario correcto','link' => URL."dashboarduser");
            }
        }else{
            $info = array('success' => false, 'msg' => 'Usuario o Contraseña incorrecta');
        }

        echo json_encode($info);
    }

    //Destuir inicio de sesion
    public function cerrar(){
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        $this->view->render("login");
    }
}

?>