<?php
include '../modelo/destino.php';
$destino = new Destino();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $avatar='destino-default.jpg';
    $destino->crear($nombre,$codigo,$avatar);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $codigo = $_POST['codigo'];
    $destino->editar($nombre,$codigo,$id_editado);
}
if($_POST['funcion']=='buscar'){
    $destino->buscar();
    $json=array();
    foreach ($destino->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_destino,
            'nombre'=>$objeto->nombre,
            'codigo'=>$objeto->codigo,
            'avatar'=>'../img/destino/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $destino->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/destino/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $destino->cambiar_logo($id,$nombre);
        foreach ($destino->objetos as $objeto) {
            if($objeto->avatar!='destino-default.jpg'){
                unlink('../img/destino/'.$objeto->avatar);
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
}
if($_POST['funcion']=='rellenar_destinos'){
    $destino->rellenar_destinos();
    $json=array();
    foreach ($destino->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_destino,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
