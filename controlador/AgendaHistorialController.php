<?php
include '../modelo/AgendaHistorial.php';
$agenda = new Agenda();


    $agenda->verificar();
    $json=array();
    foreach ($agenda->objetos as $objeto) {
        $json[]=array(
            'descripcion'=>$objeto->descripcion,
            'start'=>$objeto->start,
            'title'=>$objeto->title,
            'color'=>$objeto->color             
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;


?>
