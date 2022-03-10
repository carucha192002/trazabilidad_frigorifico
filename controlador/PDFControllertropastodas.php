<?php
require_once('../vendor/autoload.php');
require_once('../modelo/PDFtropastodas.php');
$html = getHtml();
$css = file_get_contents("../css/pdftropas.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/tropas/pdf-registros.pdf","F");
