<?php
require_once('../vendor/autoload.php');
require_once('../modelo/pdffichas2.php');
$id = $_POST['id'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$submatarife = $_POST['submatarife'];
$html = getHtmlinforme($id,$desde,$hasta,$submatarife);
$css = file_get_contents("../css/pdffichas2.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/Fichastodas/pdf-parcial.pdf","F");