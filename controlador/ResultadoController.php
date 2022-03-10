<?php
include_once '../modelo/Resultado.php';
include_once '../modelo/conexion.php';
include_once '../modelo/Venta.php';
include_once '../modelo/Historial.php';
$historial = new Historial();
$venta= new Venta();
$resultado = new Resultado();
session_start();
$id_usuario = $_SESSION['usuario'];
if($_POST['funcion']=='cambiar_resultado'){   
    date_default_timezone_set('America/Argentina/Mendoza');
    $fecha = date('Y-m-d H:i:s'); 
    $id=$_POST['id'];
    $resultado->cambiar_resultado($id,$fecha);
    $resultado->datos($id);
    $id_ingresos=$resultado->objetos[0]->id_ingreso;
    $descripcion='Se confirmo la entrega de los animales descriptos en la factura N°: '.$id;
    $historial->crear_historial($descripcion,7,3,$id_ingresos);
}
if($_POST['funcion']=='listar'){
    $resultado->buscar($id_usuario);    
    $json= array();
    foreach ($resultado->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='listar_entregada'){
    $resultado->buscar_entregada($id_usuario);    
    $json= array();
    foreach ($resultado->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='mostrar_consultas'){
    $resultado->venta_dia_vendedor($id_usuario);
    foreach ($resultado->objetos as $objeto) {
        $venta_dia_vendedor=$objeto->venta_dia_vendedor;
    } 
    $resultado->contar_entregas($id_usuario);
    foreach ($resultado->objetos as $objeto) {
        $contar_entregas=$objeto->contar_entregas;
    } 
    $resultado->contar_procesos($id_usuario);
    foreach ($resultado->objetos as $objeto) {
        $contar_procesos=$objeto->contar_procesos;
    } 
    $resultado->venta_semanal($id_usuario);
    foreach ($resultado->objetos as $objeto) {
        $venta_semanal=$objeto->venta_semanal;
    } 
    $resultado->venta_mensual($id_usuario);
    foreach ($resultado->objetos as $objeto) {
        $venta_mensual=$objeto->venta_mensual;
    }
    $resultado->venta_anual($id_usuario);
    foreach ($resultado->objetos as $objeto) {
        $venta_anual=$objeto->venta_anual;
    }
    $json= array();
    foreach ($resultado->objetos as $objeto) {
        $json[]=array(
            'venta_semanal'=>$venta_semanal,
            'contar_entregas'=>$contar_entregas,
            'contar_procesos'=>$contar_procesos,
            'venta_dia_vendedor'=>$venta_dia_vendedor,            
            'venta_mensual'=>$venta_mensual,
            'venta_anual'=>$objeto->venta_anual
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='buscar_id'){
    $id=$_POST['id'];
    $resultado->buscar_id_nuevo($id);
    $json=array();
    foreach ($resultado->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'salio'=>$objeto->salio,
            'camara'=>$objeto->camara,
            'etiqueta'=>$objeto->etiqueta,
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='despachos'){
    $resultado->despachos();
    $json=array();
    foreach ($resultado->objetos as $objeto) {
        $json[]=array(
            'cantidad'=>$objeto->cantidad,
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='entregar_faena'){
    $id=$_POST['id_productos'];
    $resultado->cambiarestado($id);
}
if($_POST['funcion']=='eliminarbarras'){
    $id=$_POST['id_productos'];
    unlink('../etiquetas/barras/'.$id.'.png');
}
if($_POST['funcion']=='eliminarqr'){
    $etiqueta=$_POST['etiqueta'];
    unlink('../etiquetas/faenados/'.$etiqueta);
}


?>