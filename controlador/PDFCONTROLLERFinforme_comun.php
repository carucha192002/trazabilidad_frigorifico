<?php
require_once('../vendor/autoload.php');
require_once('../modelo/pdffichas2_comun.php');
$id = $_POST['id'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$html = getHtmlinforme($id,$desde,$hasta);
$css = file_get_contents("../css/pdffichas2.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/Fichastodas/pdf-parcial.pdf","F");