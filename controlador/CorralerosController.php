<?php
include '../modelo/Corralero.php';
$corraleros=new Corraleros();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $avatar='corraleros-default.jpg';
    $legajo = $_POST['legajo'];
    $corraleros->crear($nombre,$avatar,$legajo);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $legajo = $_POST['legajo'];
    $corraleros->editar($nombre,$id_editado,$legajo);
}
if($_POST['funcion']=='buscar'){
    $corraleros->buscar();
    $json=array();
    foreach ($corraleros->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_corraleros,
            'nombre'=>$objeto->nombre,
            'legajo'=>$objeto->legajo,
            'avatar'=>'../img/corraleros/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $corraleros->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/corraleros/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $corraleros->cambiar_logo($id,$nombre);
        foreach ($corraleros->objetos as $objeto) {
            if($objeto->avatar!='corraleros-default.jpg'){
                unlink('../img/corraleros/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_corraleros'){
    $corraleros->rellenar_corraleros();
    $json=array();
    foreach ($corraleros->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_corraleros,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
