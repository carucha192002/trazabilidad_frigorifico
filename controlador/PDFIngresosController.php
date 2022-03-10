<?php
include_once '../modelo/Historial.php';
require_once('../vendor/autoload.php');
require_once('../modelo/PdfIngresos.php');
$historial = new Historial();
$id = $_POST['id'];
$html = getHtml($id);
$css = file_get_contents("../css/pdfIngresos.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/ingresos/pdf-ingreso.pdf","F");
$descripcion='Se ha impreso la ficha: '.$id;
$historial->crear_historial($descripcion,4,1,$id);
