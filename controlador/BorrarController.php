<?php
include_once '../modelo/Borrar.php';
include_once '../modelo/Historial.php';
$borrar = new Borrar();
$historial = new Historial();
if($_POST['funcion']=='borrartropa'){
    $id=$_POST['id'];
    $descripcion='Se borro la ficha: '.$id;
    $borrar->borrartropa($id);
     
    $historial->crear_historial($descripcion,3,1,$id);
}
?>
