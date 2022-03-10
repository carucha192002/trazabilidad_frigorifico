<?php
require_once('../vendor/autoload.php');
require_once('../modelo/PdfDiarioCaprinos.php');
if($_POST['funcion']=='caprinos'){
$fecha = $_POST['fecha'];
$especie = $_POST['especie'];

$html = getHtml($fecha,$especie);
$css = file_get_contents("../css/pdfpalco.css");
    $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
    $mpdf->setFooter('{PAGENO}');
    $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/romaneos/pdf-romaneo_caprino.pdf","F");
}
?>
