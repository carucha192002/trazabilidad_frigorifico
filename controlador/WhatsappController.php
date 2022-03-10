<?php
include_once '../modelo/Whatsapp.php';
include_once '../modelo/Historial.php';
$historial = new Historial();
$whatsapp = new Whatsapp();
if($_POST['funcion']=='datoswhatsapp'){
    $id=$_POST['id'];    
    $whatsapp->datoswhatsapp($id);
    $descripcion='Se ha enviado un Whatsapp al numero: '.$whatsapp->objetos[0]->telefono;
    $historial->crear_historial($descripcion,7,3,$id);
    $json= array();
    foreach ($whatsapp->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'matarife'=>$objeto->matarife,
            'especie'=>$objeto->especie,
            'subespecies'=>$objeto->subespecies,
            'matarife'=>$objeto->matarife,
            'guia'=>$objeto->guia,
            'numtropas'=>$objeto->numtropas,
            'cantidad'=>$objeto->cantidad,
            'telefono'=>$objeto->telefono,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}