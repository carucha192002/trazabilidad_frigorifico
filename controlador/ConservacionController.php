<?php
include '../modelo/Conservacion.php';
$conservacion=new Conservacion();

if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $grados = $_POST['grados'];
    $vida = $_POST['vida'];
    $avatar='prod-default.jpg';
    $conservacion->crear($nombre,$grados,$vida,$avatar);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $grados = $_POST['grados'];
    $vida = $_POST['vida'];
    $conservacion->editar($nombre,$id_editado,$grados,$vida);
}
if($_POST['funcion']=='buscar'){
    $conservacion->buscar();
    $json=array();
    foreach ($conservacion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_conservacion,
            'nombre'=>$objeto->nombre,
            'grados'=>$objeto->grados,
            'vida'=>$objeto->vida,
            'avatar'=>'../img/prod/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $conservacion->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/prod/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $conservacion->cambiar_logo($id,$nombre);
        foreach ($conservacion->objetos as $objeto) {
            if($objeto->avatar!='prod-default.jpg'){
                unlink('../img/prod/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_conservacion'){
    $conservacion->rellenar_conservacion();
    $json=array();
    foreach ($conservacion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_conservacion,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='datosconservacion_rellenar'){
    $id=$_POST['id'];
    $conservacion->datosconservacion_rellenar($id);
    $json=array();
    foreach ($conservacion->objetos as $objeto) {
        $json[]=array(
            'grados'=>$objeto->grados,
            'vida'=>$objeto->vida
            
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
?>
