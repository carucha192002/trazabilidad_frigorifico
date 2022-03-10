<?php
include '../modelo/Etapas.php';
$etapas=new etapas();

if($_POST['funcion']=='veretapas'){
    $etapas->rellenar_etapas();
    $json=array();
    foreach ($etapas->objetos as $objeto) {
        $json[]=array(
            'cantidad'=>$objeto->cantidad
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='procesarfaena'){
    $etapas->procesarfaena();
    $json=array();
    foreach ($etapas->objetos as $objeto) {
        $json[]=array(
            'cantidad'=>$objeto->cantidad
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='reduciretapas'){
    $etapas->reduciretapas();
    $json=array();
    foreach ($etapas->objetos as $objeto) {
        $json[]=array(
            'cantidad'=>$objeto->cantidad
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
?>
