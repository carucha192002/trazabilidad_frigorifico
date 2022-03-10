<?php
include "barcode.php";
include "finalizado.php";
$finalizado = new finalizado();
$filepath = $_POST['filepath'];
$text = $_POST['text'];

//barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );
barcode( $filepath, $text,'70','horizontal','code128',true,1);
$finalizado->agregar_barra($text);

?>
