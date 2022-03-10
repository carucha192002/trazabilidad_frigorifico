<?php
	require "../phpqrcode/qrlib.php";    
	$id = $_POST['id'];
    $ano = $_POST['ano'];
    $guia = $_POST['guia'];
    $especie = $_POST['especie'];
    $subespecies = $_POST['subespecies'];
    $matarife = $_POST['nombrematarife'];
	$dir = '../etiquetas/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
	$filename = $dir.'etiqueta'.$ano.$id.'.png';
 
        //Parametros de Condiguración
	
	$tamaño = 10; //Tamaño de Pixel
	$level = 'L'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	$contenido = "tropa.$id.ano.$ano.guia.$guia.especie.$especie.subespecies.$subespecies.matarife.$matarife"; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	
        //Mostramos la imagen generada
	echo '<img src="'.$dir.basename($filename).'" /><hr/>';  
?>