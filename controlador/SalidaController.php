<?php
include '../modelo/Salidas.php';
$salida = new Salidas();
session_start();
$id_usuario = $_SESSION['usuario'];

if($_POST['funcion']=='listar'){
    $salida->buscar();    
    $json= array();
    foreach ($salida->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

