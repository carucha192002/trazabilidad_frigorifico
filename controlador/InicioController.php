<?php
include '../modelo/Inicio.php';
$inicio= new Inicio();
session_start();
if($_POST['funcion']=='traer'){
    $id=$_SESSION['usuario'];
    $inicio->traer($id); 
    $json=array();
    foreach ($inicio->objetos as $objeto) {
        $json[]=array(
            'nombre'=>$objeto->nombre_us,
            'dni'=>$objeto->dni_us,
            'tipo'=>$objeto->tipo,
            'email'=>$objeto->email,
            'avatar'=>$objeto->avatar,
            'telefono'=>$objeto->telefono_us,
            'categoria'=>$objeto->categoria,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;   
}
?>