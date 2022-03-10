<?php
include '../modelo/Etiquetas.php';
$etiquetas=new Etiquetas();

if($_POST['funcion']=='buscar'){
    $etiquetas->buscar();
    $json=array();
    foreach ($etiquetas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->numtropas,
            'id_ingresos'=>$objeto->id_ingresos,
            'matarife'=>$objeto->matarife,
            'productor'=>$objeto->productor,
            'guia'=>$objeto->guia,
            'destino'=>$objeto->destino,
            'especie'=>$objeto->especie, 
            'subespecies'=>$objeto->subespecies,
            'ano'=>$objeto->ano,
            'enpie'=>$objeto->enpie,
            'desde'=>$objeto->desde,
            'hasta'=>$objeto->hasta,
            'avatar'=>'../img/matarife/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='agregaretiqueta'){
    $id = $_POST['id'];
    $id_ingresos = $_POST['id_ingresos'];
    $ano = $_POST['ano'];
    $guia = $_POST['guia'];
    $especie = $_POST['especie'];
    $subespecies = $_POST['subespecies'];
    $matarife = $_POST['matarife'];
    $etiquetas->agregaretiqueta($id,$id_ingresos,$ano,$guia,$especie,$subespecies,$matarife);
}
if($_POST['funcion']=='buscarsiexisteetiqueta'){
    $id_ingresos = $_POST['id_ingresos'];
    $etiquetas->buscarsiexisteetiqueta($id_ingresos);
    $json=array();
    foreach ($etiquetas->objetos as $objeto) {
        $json[]=array(
            'etiqueta'=>$objeto->etiqueta

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

?>