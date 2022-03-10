<?php
require_once('../vendor/autoload.php');
require_once('../modelo/PDFObservacion.php');
include_once('../modelo/Historial.php');
$historial = new Historial();
$id = $_POST['id'];
$html = getHtml($id);
$css = file_get_contents("../css/pdfObservados.css");
$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/Observacion/pdf-Observacion.pdf","F");
$historial->retornar($id);
$tropas=$historial->objetos[0]->tropa;
$id_ingresos=$historial->objetos[0]->id_ingreso;
$descripcion='Se ha impreso la/s observacion/es para la tropa N°: '.$tropas;
$historial->crear_historial($descripcion,4,6,$id_ingresos);
