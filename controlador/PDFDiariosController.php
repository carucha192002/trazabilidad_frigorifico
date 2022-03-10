<?php

require_once('../vendor/autoload.php');
require_once('../modelo/PDFDiarios.php');
$id = $_POST['id'];
$fecha_datos=$_POST['fecha'];
$id_ingreso=$_POST['id_ingreso'];
$fecha=date("Y", strtotime($fecha_datos));
$html = getHtml($id,$fecha,$id_ingreso);
$css = file_get_contents("../css/pdffinalizado.css");
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("../pdf/reportesdiarios/pdf-reportesdiarios.pdf","F");

