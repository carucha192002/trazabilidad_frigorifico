<?php
require_once('../vendor/autoload.php');
require_once('../modelo/pdfEtiquetasovinos.php');
include_once '../modelo/Historial.php';
$historial = new Historial();
$id_ingresos = $_POST['id_ingresos'];
$id = $_POST['id'];
$html = getHtml($id_ingresos);

$css = file_get_contents("../css/pdfEtiquetas.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [105, 105]] );
$mpdf-> setAutoTopMargin = 'false';

$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output("../pdf/etiquetas/pdf-".$id_ingresos.".pdf","F");
$descripcion='Ha creado la etiqueta: '.$id;
$historial->crear_historial($descripcion,7,3,$id_ingresos);

