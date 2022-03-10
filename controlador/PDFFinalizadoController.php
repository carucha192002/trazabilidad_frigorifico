<?php
require_once('../vendor/autoload.php');
require_once('../modelo/PdfFinalizado.php');
include_once '../modelo/Historial.php';
$historial = new Historial();
$id = $_POST['id'];
$tropas = $_POST['tropas'];
$html = getHtml($id);
$css = file_get_contents("../css/pdffinalizado.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->setFooter('{PAGENO}');
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/finalizados/pdf-finalizados.pdf","F");
$descripcion='Se ha impreso la matanza para la tropa N°: '.$tropas;
$historial->crear_historial($descripcion,7,3,$id); 