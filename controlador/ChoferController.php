<?php
include '../modelo/chofer.php';
$chofer = new Chofer();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $avatar='chofer-default.jpg';
    $dni = $_POST['dni'];
    $chofer->crear($nombre,$avatar,$dni);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $dni = $_POST['dni'];
    $chofer->editar($nombre,$id_editado,$dni);
}
if($_POST['funcion']=='buscar'){
    $chofer->buscar();
    $json=array();
    foreach ($chofer->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_chofer,
            'nombre'=>$objeto->nombre,
            'dni'=>$objeto->dni,
            'avatar'=>'../img/chofer/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $chofer->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/chofer/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $chofer->cambiar_logo($id,$nombre);
        foreach ($chofer->objetos as $objeto) {
            if($objeto->avatar!='chofer-default.jpg'){
                unlink('../img/chofer/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_chofer'){
    $chofer->rellenar_chofer();
    $json=array();
    foreach ($chofer->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_chofer,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='datoschofer_rellenar'){
    $id=$_POST['id'];
    $chofer->datoschofer_rellenar($id);
    $json=array();
    foreach ($chofer->objetos as $objeto) {
        $json[]=array(
            'dni'=>$objeto->dni
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
?>
