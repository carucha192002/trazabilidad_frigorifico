<?php
include '../modelo/Especies.php';
$especies = new Especies();
if($_POST['funcion']=='buscardatos'){
    $especies->buscardatos();
    $json= array();
    foreach ($especies->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $avatar='esp-default.jpg';
    $especies->crear($nombre,$avatar);
}
if($_POST['funcion']=='crearsubcategoria'){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $diente = $_POST['diente'];
    $avatar='subesp-default.jpg';
    $especies->crearsubcategoria($id,$nombre,$codigo,$diente,$avatar);
}
if($_POST['funcion']=='editarsubcategoria'){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $diente = $_POST['diente'];
    $especies->editarsubcategoria($id,$nombre,$codigo,$diente);
}
if($_POST['funcion']=='buscarsubcategoria'){
    $id = $_POST['id'];
    $especies->buscarsubcategoria($id);
    $json=array();
    foreach ($especies->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_especie,
            'subcategoria'=>$objeto->id_subespecies,
            'nombre'=>$objeto->nombre, 
            'diente'=>$objeto->diente,
            'codigo'=>$objeto->codigo
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $especies->editar($nombre,$id_editado);
}
if($_POST['funcion']=='buscar'){
    $especies->buscar();
    $json=array();
    foreach ($especies->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_especies_sub,
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/esp/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $especies->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/esp/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $especies->cambiar_logo($id,$nombre);
        foreach ($especies->objetos as $objeto) {
            if($objeto->avatar!='esp-default.jpg'){
                unlink('../img/esp/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_especies'){
    $especies->rellenar_especies();
    $json=array();
    foreach ($especies->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_especies_sub,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='codigos'){
    $id=$_POST['id'];
    $especies->codigos($id);
    $json=array();
    foreach ($especies->objetos as $objeto) {
        $json[]=array(
            'codigo'=>$objeto->codigo,
            'diente'=>$objeto->diente,
            'categoria'=>$objeto->categoria
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
