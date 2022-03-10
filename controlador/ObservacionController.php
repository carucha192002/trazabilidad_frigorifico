<?php
include_once '../modelo/Observacion.php';
include_once '../modelo/Historial.php';
$observacion = new Observacion();
$historial = new Historial();
session_start();


    if($_POST['funcion']=='buscargarronfaenadostropas'){
        $observacion->buscargarronfaenadostropas();
        $json= array();
        foreach ($observacion->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='observacion_foto'){
        $id=$_POST['id'];
        $observacion->observacion_foto($id);
        $json=array();
        foreach ($observacion->objetos as $objeto) {
            $json[]=array(
                'descripcion'=>$objeto->descripcion,
                'foto'=>$objeto->foto,
                'fecha'=>$objeto->fecha_creacion,
                
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
        
    }
 
?>
