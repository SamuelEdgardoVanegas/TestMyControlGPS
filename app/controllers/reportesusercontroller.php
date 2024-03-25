<?php

include_once "app/models/restaurantesuser.php";
include_once "vendor/autoload.php";

class ReportesUserController extends Controller {
    private $reporte;
    public function __construct($parametro) {
        $this->reporte = new RestauranteUser();
        parent::__construct("reportesuser",$parametro,true);
    }

    public function getReporte() {
       // $registros=$this->reporte->getReportesRestaurantes($_GET);
        $data = $_GET;

       // Verificar si se proporcionaron fechas de inicio y fin
        if (!empty($data['fecha_inicio']) && !empty($data['fecha_fin'])) {
           // Convertir las fechas al formato MySQL
            $fechaInicio = date("Y-m-d", strtotime($data['fecha_inicio']));
            $fechaFin = date("Y-m-d", strtotime($data['fecha_fin']));
           // Agregar las fechas como condiciones a la consulta SQL
            $data['rango_fechas'] = [$fechaInicio, $fechaFin];
        }
       // Llamar al método del modelo con los datos actualizados
        $registros = $this->reporte->getReportesRestaurantes($data);
        
        //print_r($registros);
        //Encabezado del informe
        $htmlHeader="<h1>Restaurantes</h1>";
        $htmlHeader.="<h3>Listado general</h3>";
        //Cuerpo del informe
        $html="<table width='100%' border='1'><thead><tr>";
        $html.="<th>Corr</th>";
        $html.="<th>Restaurante</th>";
        $html.="<th>Direccion</th>";
        $html.="<th>Telefono</th>";
        $html.="<th>Fecha de Ingreso</th>";
        $html.="<th>Producto</th>";
        $html.="<th>Precio</th>";
        $html.="</tr></thead><tbody>";
        $total=0;
        foreach ($registros as $key => $value) {
            $html.="<tr>";
            $html.="<td>".($key+1)."</td>";
            $html.="<td>{$value["nombre_restaurante"]}</td>";
            $html.="<td>{$value["direccion"]}</td>";
            $html.="<td>{$value["telefono"]}</td>";
            $html.="<td>{$value["fecha_ingreso"]}</td>";
            $html.="<td>{$value["nombre"]}</td>";
            $html.="<td>$ " . $value["precio"] . "</td>";
            $html.="</tr>";
        }
        $html.="<tr>";
        $html.="<th colspan='7'>Listado</th>";
        $html.="</tr>";
        $html.="</tbody></table>";
        //echo $html;
        $mpdfConfig=array(
            'mode'=>'utf-8',
            'format'=>'Letter', //Tamaño del papel
            'default_font_size'=>0,
            'default_font'=>'',
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>40,
            'margin_header'=>10,
            'margin_footer'=>20,
            'orientation'=>'P'
        );
        $mpdf=new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}