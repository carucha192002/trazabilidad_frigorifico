<?php
include '../modelo/Provincia.php';
$provincia = new Provincia();
if($_POST['funcion']=='rellenar_provincia'){
    $provincia->rellenar_provincia();
    $json=array();
    foreach ($provincia->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_provincia,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='rellenar_localidades'){
    $id_provincia=$_POST['id_provincia'];
    $provincia->rellenar_localidades($id_provincia);
    $json=array();
    foreach ($provincia->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

?>
