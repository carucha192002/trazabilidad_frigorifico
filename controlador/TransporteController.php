<?php
include '../modelo/Transporte.php';
$transporte = new Transporte();
if($_POST['funcion']=='rellenar_transporte'){
    $transporte->rellenar_transporte();
    $json=array();
    foreach ($transporte->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_transporte,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $habilitacion = $_POST['habilitacion'];
    $avatar='transporte-default.jpg';
    $transporte->crear($nombre,$avatar,$habilitacion);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $habilitacion = $_POST['habilitacion'];
    $transporte->editar($nombre,$id_editado,$habilitacion);
}
if($_POST['funcion']=='buscar'){
    $transporte->buscar();
    $json=array();
    foreach ($transporte->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_transporte,
            'nombre'=>$objeto->nombre,
            'habilitacion'=>$objeto->habilitacion,
            'avatar'=>'../img/transporte/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='datostransporte_rellenar'){
    $habilitacion= $_POST['habilitacion'];
    $transporte->rellenar_transporte1($habilitacion);
    $json=array();
    foreach ($transporte->objetos as $objeto) {
        $json[]=array(
            'habilitacion'=>$objeto->habilitacion,
        
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $transporte->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/transporte/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $transporte->cambiar_logo($id,$nombre);
        foreach ($transporte->objetos as $objeto) {
            if($objeto->avatar!='transporte-default.jpg'){
                unlink('../img/transporte/'.$objeto->avatar);
            }            
        }
        $json= array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
    else{
        $json= array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='transporte_rellenar'){
        $transporte->rellenar_transporte();
        $json=array();
        foreach ($transporte->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_transporte,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
}
?>
