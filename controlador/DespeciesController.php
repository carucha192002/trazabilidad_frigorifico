<?php
include '../modelo/Despieces.php';
$despieces=new Despieces();
if($_POST['funcion']=='buscardatos'){
    $despieces->buscardatos();
    $json= array();
    foreach ($despieces->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='editar'){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $despiece = $_POST['despiece'];
    $despieces->editar($id,$nombre,$codigo,$despiece);
}

?>
