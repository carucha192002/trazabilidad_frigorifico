<?php
include '../modelo/reducir.php';
$reducir = new Reducir();

    if($_POST['funcion']=='buscar_reduccion'){
        $reducir->buscar_reduccion();
        $json= array();
        foreach ($reducir->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscar_reduccionfaena'){
        $reducir->buscar_reduccionfaena();
        $json= array();
        foreach ($reducir->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscar_reduccion_existe'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $reducir->buscar_reduccion_existe();

    }
    if($_POST['funcion']=='buscar_reduccion_existe_vuelta'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $reducir->buscar_reduccion_existe_vuelta($fecha);

    }
    if($_POST['funcion']=='buscarid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $reducir->buscarid($fecha);
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarcorralreducciontropa'){
        $reducir->verificarcorralreducciontropa();
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'corral'=>$objeto->corral,
                'cantidad'=>$objeto->cantidad,
                'subespecie'=>$objeto->subespecie
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='reduccionfaena'){
        $tropas = $_POST['tropas'];
        $id_reducir = $_POST['reducir'];
        $reducir->reduccionfaena($tropas,$id_reducir);
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_reducir,
                'fecha'=>$objeto->fecha,
                'tropa'=>$objeto->tropa,
                'clasificacion'=>$objeto->clasificacion,
                'cantidad'=>$objeto->cantidad,
                'desde'=>$objeto->desde,
                'hasta'=>$objeto->hasta,
                'estado'=>$objeto->estado,
                'corral'=>$objeto->corral

            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='reduccionfaenavolver'){
        $tropas = $_POST['tropas'];
        $id_reducir = $_POST['reducir'];
        $reducir->reduccionfaenavolver($tropas,$id_reducir);
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_reducir,
                'fecha'=>$objeto->fecha,
                'tropa'=>$objeto->tropa,
                'clasificacion'=>$objeto->clasificacion,
                'cantidad'=>$objeto->cantidad,
                'desde'=>$objeto->desde,
                'hasta'=>$objeto->hasta,
                'estado'=>$objeto->estado,
                'reduccion'=>$objeto->reduccion,
                'corral'=>$objeto->corral

            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $reducir->verificar($cantidad,$fecha);
    }
    if($_POST['funcion']=='verificarreduccion'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropas=$_POST['tropas'];
        $reducir->verificarreduccion($tropas,$fecha);
    }
    if($_POST['funcion']=='verificarreduccionvolver'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropas=$_POST['tropas'];
        $reducir->verificarreduccionvolver($tropas,$fecha);
    }
    if($_POST['funcion']=='agregar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $reducir->agregar($cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['hasta'];
        $id=$_POST['id'];
        $reducir->reemplazar($id,$cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazarestado'){
        $tropa=$_POST['tropa'];
        $reducir->reemplazarestado($tropa);
    }
    if($_POST['funcion']=='reemplazarestadoreducir'){
        $id=$_POST['id'];
        $reducir->reemplazarestadoreducir($id);
    }
    if($_POST['funcion']=='ultimoid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $reducir->ultimoid($fecha);
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarromaneos'){
        $reducir->verificarromaneos();
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarcorrales'){
        $reducir->verificarcorrales();
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'corral'=>$objeto->corral,
                'cantidad'=>$objeto->cantidad,
                'especie'=>$objeto->especie,
                'subespecie'=>$objeto->subespecie
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarcorralreduccion'){
        $reducir->verificarcorralreduccion();
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'corral'=>$objeto->corral,
                'cantidad'=>$objeto->cantidad,
                'subespecie'=>$objeto->subespecie
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='traerdatos'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $tropas=$_POST['tropas'];
        $reducir->traerdatos($cantidad,$fecha,$tropas);
        $json=array();
        foreach ($reducir->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id,
                'ultimo'=>$objeto->ultimo
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='crear'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $tropa = $_POST['tropa'];
        $clasificacion = $_POST['clasificacion'];
        $cantidad = $_POST['cantidad'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $estado = $_POST['estado'];
        $seleccionado = $_POST['seleccionado'];
        $id_matarife = $_POST['id_matarife'];
        $reducir->crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife);
    }
    if($_POST['funcion']=='crearvolver'){
        $tropa = $_POST['tropa'];
        $id_matarife = $_POST['id_matarife'];
        $reducir->crearvolver($tropa,$id_matarife);
    }
    if($_POST['funcion']=='crearvolverparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $tropa = $_POST['tropa'];
        $clasificacion = $_POST['clasificacion'];
        $cantidad = $_POST['cantidad'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $estado = $_POST['estado'];
        $seleccionado = $_POST['seleccionado'];
        $id_matarife = $_POST['id_matarife'];
        $reducir->crearvolverparcial($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife);
    }
    
   


?>
