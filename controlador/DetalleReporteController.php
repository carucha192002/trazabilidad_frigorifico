<?php
include_once '../modelo/Detalle_venta.php';
include_once '../modelo/Venta.php';
include_once '../modelo/Historial.php';
$detalle_venta = new DetalleVenta();
$venta = new Venta();
$historial = new Historial();
session_start();
$id_usuario = $_SESSION['usuario'];
$tipo_usuario = $_SESSION['us_tipo'];
date_default_timezone_set('America/Argentina/Mendoza');
$fecha = date('Y-m-d H:i:s');
if($_POST['funcion']=='borrar_venta'){
    $id_venta=$_POST['id'];  
    $historial->datosroot($id_usuario);
    $detalle_venta->datos($id_venta);
    $id_ingreso=$detalle_venta->objetos[0]->id_ingreso;

    $borro=$historial->objetos[0]->nombre.' '.$historial->objetos[0]->apellido.' ROOT ';
    if($tipo_usuario==3){
        $descripcion='El usuario: '.$borro .' rechazo el pedido N° '.$id_venta.' el dia: '.$fecha;
        $historial->crear_historial($descripcion,3,5,$id_ingreso);
        $venta->borrar($id_venta);
        $detalle_venta->recuperar($id_venta);
        foreach ($detalle_venta->objetos as $det) {
            $detalle_venta->borrar($det->id_detalle);
        }
    }  
  
        else{
            echo 'nodelete';
        }

   
  
}
