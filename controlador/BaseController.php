<?php
include '../modelo/basededatos.php';
$base = new Base();
    if($_POST['funcion']=='buscar'){
        $base->buscar();
        $json= array();
        foreach ($base->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarultimo'){
        $base->buscarultimo();
        $json= array();
        foreach ($base->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_backup,
                'dia'=>$objeto->dia,
                'nombre'=>$objeto->nombre,
                'fecha'=>$objeto->fecha,
                'usuario'=>$objeto->usuario
               
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
  
?>
