<?php
include '../modelo/Procedencia.php';
$procedencia = new Procedencia();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $avatar='procedencia-default.jpg';
    $procedencia->crear($nombre,$avatar);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $procedencia->editar($nombre,$id_editado);
}
if($_POST['funcion']=='buscar'){
    $procedencia->buscar();
    $json=array();
    foreach ($procedencia->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_procedencia,
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/procedencia/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $procedencia->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/procedencia/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $procedencia->cambiar_logo($id,$nombre);
        foreach ($procedencia->objetos as $objeto) {
            if($objeto->avatar!='procedencia-default.jpg'){
                unlink('../img/procedencia/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_procedencia'){
    $procedencia->rellenar_procedencia();
    $json=array();
    foreach ($procedencia->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_procedencia,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
