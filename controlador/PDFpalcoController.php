<?php
require_once('../vendor/autoload.php');
require_once('../modelo/PDFpalco.php');
    $especie = $_POST['especie'];
    $checked=json_decode($_POST['json']);
    $html = getHtml($checked,$especie);
    $css = file_get_contents("../css/pdfpalco.css");
    $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
    $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output("../pdf/Listados/pdf-informe".$_POST['especie'].".pdf","F");
?>

