<?php
include '../modelo/Reporte.php';
$reporte = new Reporte();
session_start();
$id_usuario = $_SESSION['usuario'];

if($_POST['funcion']=='listar'){
    $reporte->buscar();    
    $json= array();
    foreach ($reporte->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='mostrar_consultas'){
    $reporte->venta_dia_vendedor();
    foreach ($reporte->objetos as $objeto) {
        $venta_dia_vendedor=$objeto->venta_dia_vendedor;
    }
    $reporte->venta_diaria();
    foreach ($reporte->objetos as $objeto) {
        $venta_diaria=$objeto->venta_diaria;
    }
    $reporte->venta_mensual();
    foreach ($reporte->objetos as $objeto) {
        $venta_mensual=$objeto->venta_mensual;
    }
    $reporte->venta_anual();
    foreach ($reporte->objetos as $objeto) {
        $venta_anual=$objeto->venta_anual;
    }
    $json= array();
    foreach ($reporte->objetos as $objeto) {
        $json[]=array(
            'venta_dia_vendedor'=>$venta_dia_vendedor,
            'venta_diaria'=>$venta_diaria,
            'venta_mensual'=>$venta_mensual,
            'venta_anual'=>$objeto->venta_anual
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
