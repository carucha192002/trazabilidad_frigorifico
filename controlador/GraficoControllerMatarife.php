<?php
include '../modelo/GraficosMatarife.php';
$graficos = new Graficos();
if($_POST['funcion']=='faena_mes_matarife'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $graficos->faena_mes_matarife($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_anterior_productor'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $graficos->faena_mes_anterior_productor($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

