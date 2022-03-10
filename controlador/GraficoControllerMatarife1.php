<?php
include_once '../modelo/GraficosMatarife1.php';
$graficos = new Graficos1();
if($_POST['funcion']=='faena_mes_matarife'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $id_matarife1=json_decode($_POST['idmatarife1']);
    $graficos->faena_mes_matarife($id_matarife,$id_matarife1);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_matarife_comun'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $graficos->faena_mes_matarife_comun($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_matarife1'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $graficos->faena_mes_matarife1($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_matarife1_comun'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $graficos->faena_mes_matarife1_comun($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_anterior_productor'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $id_matarife1=json_decode($_POST['idmatarife12']);
    $graficos->faena_mes_anterior_productor($id_matarife,$id_matarife1);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_anterior_productor_comun'){
    $id_matarife=json_decode($_POST['idmatarife']);
    $graficos->faena_mes_anterior_productor_comun($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_anterior_productor1'){
    $id_matarife=json_decode($_POST['idmatarife']);
 
    $graficos->faena_mes_anterior_productor1($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='faena_mes_anterior_productor1_comun'){
    $id_matarife=json_decode($_POST['idmatarife']);
 
    $graficos->faena_mes_anterior_productor1_comun($id_matarife);
    $json= array();
    foreach ($graficos->objetos as $objeto) {
        $json[]=$objeto;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

