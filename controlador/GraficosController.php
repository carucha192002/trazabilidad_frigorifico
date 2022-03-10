<?php
include '../modelo/Graficos.php';
$graficos = new Graficos();


if($_POST['funcion']=='faena_mes'){
    $graficos->faena_mes();
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='faena_mes_anterior'){
    $graficos->faena_mes_anterior();
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
