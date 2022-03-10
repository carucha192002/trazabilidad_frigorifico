<?php
require_once('../vendor/autoload.php');
require_once('../modelo/ReportePdf.php');
$id = $_POST['id'];
$html = getHtml($id);
$css = file_get_contents("../css/pdf.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/reportes/reportes.pdf","F");