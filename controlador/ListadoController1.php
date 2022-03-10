<?php
include '../modelo/finalizado.php';
require "../phpqrcode/qrlib.php";  
$finalizado = new finalizado();      
if($_POST['funcion']=='codigos'){
     
   $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $id = $_POST['id_qr'];
    $tropas = $_POST['tropas'];
    $productor = $_POST['productor'];
    $garron = $_POST['garron'];
    $especie = $_POST['especie'];
    $peso = $_POST['peso'];
    $estado = $_POST['estado'];
    $maximo = $_POST['maximo'];
    $matarife = $_POST['matarife'];
    $etiqueta='etiqueta'.$tropas.$ano.$garron.$peso.'.png';
	$dir = '../etiquetas/faenados/';
        
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
        $filename = $dir.'etiqueta'.$tropas.$ano.$garron.$peso.'.png';
 
        //Parametros de Condiguración
	
	$tamaño = 15; //Tamaño de Pixel
	$level = 'L'; //Precisión Baja
	$framSize = 1; //Tamaño en blanco
	$contenido = "tropa.$tropas.ano.$ano.productor.$productor.especie.$especie.garron.$garron./de.$maximo.matarife.$matarife.peso.$peso"; //Texto


	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize);
	
        //Mostramos la imagen generada
	//echo '<img src="'.$dir.basename($filename).'" /><hr/>'; 
        $finalizado->agregar_qr($id,$etiqueta);
        }
?>