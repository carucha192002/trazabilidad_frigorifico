<?php
include '../modelo/Corral.php';
$corral = new Corral();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre1'];
    $numero = $_POST['nombre'];
    $avatar='corral-default.jpg';
    $corral->crear($nombre,$avatar,$numero);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre1'];
    $id_editado=$_POST['id'];
    $numero = $_POST['nombre'];
    $corral->editar($nombre,$id_editado,$numero);
}
if($_POST['funcion']=='buscar'){
    $corral->buscar();
    $json=array();
    foreach ($corral->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_corral,
            'nombre'=>$objeto->nombre,
            'numero'=>$objeto->numero,
            'avatar'=>'../img/corral/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $corral->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/corral/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $corral->cambiar_logo($id,$nombre);
        foreach ($corral->objetos as $objeto) {
            if($objeto->avatar!='corral-default.jpg'){
                unlink('../img/corral/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_corrales'){
    $corral->rellenar_corrales();
    $json=array();
    foreach ($corral->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_corral,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
