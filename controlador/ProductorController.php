<?php
include '../modelo/Productor.php';
$productor=new Productor();
if($_POST['funcion']=='productor_rellenar'){
    $productor->rellenar_productor();
    $json=array();
    foreach ($productor->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_productor,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='productorcuit_rellenar'){
    $id=$_POST['id'];
    $productor->rellenar_productorcuit($id);
    $json=array();
    foreach ($productor->objetos as $objeto) {
        $json[]=array(
            'cuit'=>$objeto->cuit
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $avatar='prod-default.jpg';
    $cuit = $_POST['cuit'];
    $establecimiento = $_POST['establecimiento'];
    $productor->crear($nombre,$avatar,$cuit,$establecimiento);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $cuit = $_POST['cuit'];
    $establecimiento = $_POST['establecimiento'];
    $productor->editar($nombre,$id_editado,$cuit,$establecimiento);
}
if($_POST['funcion']=='buscar'){
    $productor->buscar();
    $json=array();
    foreach ($productor->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_productor,
            'nombre'=>$objeto->nombre,
            'cuit'=>$objeto->cuit,
            'establecimiento'=>$objeto->establecimiento,
            'avatar'=>'../img/prod/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $productor->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/prod/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $productor->cambiar_logo($id,$nombre);
        foreach ($productor->objetos as $objeto) {
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
?>
