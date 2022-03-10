<?php
include_once '../modelo/informe.php';
$informe = new Informe();

if($_POST['funcion']=='rellenar_usuario'){
    $informe->usuario();
    $json=array();
    foreach ($informe->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre,
            'id_submatarife'=>$objeto->id_submatarife
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='rellenar_usuario_comun'){
    $informe->usuario_comun();
    $json=array();
    foreach ($informe->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre,
            'id_submatarife'=>'0'
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='listar_cerrados'){
    $id_usuario=$_POST['id'];
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $informe->buscar($id_usuario,$desde,$hasta);
 
    $json= array();
    foreach ($informe->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->$id,
            'fecha'=>$objeto->$fecha,            
            'cantidad'=>$objeto->$cantidad,
            'tropa'=>$objeto->$tropa,
            'clasificacion'=>$objeto->$clasificacion,
            'dte'=>$objeto->$dte,
            'id_matarife'=>$objeto->$id_matarife
            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='listar_busqueda'){
    $id_usuario=$_POST['id'];
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $submatarife=$_POST['submatarife'];
    $informe->listar_busqueda($id_usuario,$desde,$hasta,$submatarife);    
    $json= array();
    foreach ($informe->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='listar_busqueda_comun'){
    $id_usuario=$_POST['id'];
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $informe->listar_busqueda_comun($id_usuario,$desde,$hasta);    
    $json= array();
    foreach ($informe->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='listar_busqueda_todas'){
    $id_usuario=$_POST['id'];
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $informe->listar_busqueda_todas($id_usuario,$desde,$hasta);    
    $json= array();
    foreach ($informe->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='listar_busqueda_todas_comun'){
    $id_usuario=$_POST['id'];
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $informe->listar_busqueda_todas_comun($id_usuario,$desde,$hasta);    
    $json= array();
    foreach ($informe->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

  



   
?>