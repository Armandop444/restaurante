<?php
require_once "app/controllers/errorescontroller.php";
require_once "app/controllers/controller.php";
$url = $_GET['action'] ?? null;
$url = rtrim($url);
$url = explode("/", $url);

#validar que la url tenga contenido
if (empty($url[0])){
    $archivoController = 'app/controllers/dashboarduser';
    $url[0]="DashboardUser";
}else{
    $archivoController = "app/controllers/{$url[0]}";
}
$archivoController .= "controller.php";

#mandar a llamar al archivo php
if (file_exists($archivoController)) {
    $url[0].="Controller";
    require $archivoController;
    $controller = new $url[0]($url[1] ?? "");    
}else{
    $controller = new ErroresController();
}

?>