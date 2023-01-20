<?php
include_once "app/models/productos.php";
require_once 'vendor/autoload.php';
class ReportesController extends Controller{
    private $productos;
    public function __construct($param){
        #Mandar a llamar la vista y parametro
        $this->productos = new Productos();
        parent::__construct("reportes", $param, true);
    }

    public function getReporte(){

        $resultadoProductos = $this->productos->getProductosReportes($_GET);
        //variable para contruir el reporte
        $htmlheader = "<h1>Restaurante</h1><h2>Reporte</h2>";
        $htmlheader .= "<h3>Listado De Productos</h3>";
        $html = "<br><table width='100%' border=1><thead><tr>";
        $html .= "<th>#</th>";
        $html .= "<th>Nombre Producto</th>";
        $html .= "<th>Descripcion</th>";
        $html .= "<th>Nombre Restaurante</th>";
        $html .= "<th>Fecha Ingreso</th>";
        $html .= "<th>Precio</th>";
        $html .= "</tr></thead><tbody>";
        foreach ($resultadoProductos as $key => $value) {
            $moneda=number_format($value['precio'], 2, '.', ',');
            $Date = new DateTime($value['fecha_ingreso']);
            $fecha=$Date->format('d-m-Y');
            $html .= "<tr>";
            $html .= "<td>" . ($key + 1) . "</td>";
            $html .= "<td>{$value['nombre']}</td>";
            $html .= "<td>{$value['descripcion']}</td>";
            $html .= "<td>{$value['nombre_restaurante']}</td>";
            $html .= "<td>{$fecha}</td>";
            $html .= "<td>{$moneda}</td>";
            $html .= "</tr>";

        }

        $html .= "</tbody></table>";
        $mpdfConfig = array(
            'mode' => 'utf-8',
            'format' => 'Letter',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_header' => 10,
            'margin_footer' => 20,
            'margin_top' => 40,
            'orientation' => 'P'
        );
        $mpdf= new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlheader);
        $mpdf->WriteHTML($html);
        $mpdf->Output();



    }
}

?>