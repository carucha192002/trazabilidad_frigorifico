<?php
include_once '../modelo/Catalogo.php';
include_once '../modelo/Historial.php';
$catalogo = new Catalogo();
$historial = new Historial();
    if($_POST['funcion']=='buscar'){
        $catalogo->buscar();
        $json= array();
        foreach ($catalogo->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    
    if($_POST['funcion']=='quedanencorral'){
        $catalogo->quedanencorral();
        $json= array();
        foreach ($catalogo->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
   
    if($_POST['funcion']=='buscar_reduccion_existe_vuelta'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $catalogo->buscar_reduccion_existe_vuelta($fecha);
    }
    if($_POST['funcion']=='buscarid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $clasificacion=$_POST['clasificacion'];
        $catalogo->verificar_especie($clasificacion);
        $especie=$catalogo->objetos[0]->especie;
        $catalogo->buscarid($fecha,$especie);
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='reduccionfaena'){
        $tropas = $_POST['tropas'];
        $catalogo->reduccionfaena($tropas);
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_reducir,
                'fecha'=>$objeto->fecha,
                'tropa'=>$objeto->tropa,
                'clasificacion'=>$objeto->clasificacion,
                'cantidad'=>$objeto->cantidad,
                'desde'=>$objeto->comienzo,
                'hasta'=>$objeto->hasta,
                'estado'=>$objeto->estado,
                'corral'=>$objeto->corral

            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='consultarsiexiste'){
        $tropa=$_POST['tropa'];
        $catalogo->consultarsiexiste($tropa);
    }
    if($_POST['funcion']=='verificar'){
        $cantidad=$_POST['cantidad'];
        $clasificacion=$_POST['clasificacion'];
        $id_ingreso=$_POST['id_ingresos'];
        $catalogo->verificar_especie($id_ingreso);
        $especie=$catalogo->objetos[0]->especie;
        $catalogo->ultimoid($especie);
        $catalogo->verificar($cantidad,$especie);

    }
    if($_POST['funcion']=='verificarreduccion'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropas=$_POST['tropas'];
        $catalogo->verificarreduccion($tropas,$fecha);
    }
    if($_POST['funcion']=='agregar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $clasificacion=$_POST['clasificacion'];
        $hasta=$_POST['hasta'];
        $id_ingreso=$_POST['id_ingreso'];
        $catalogo->verificar_especie($id_ingreso);
        $especie=$catalogo->objetos[0]->especie;
        $catalogo->ultimoid($especie);
        $catalogo->agregar($cantidad,$fecha,$especie,$hasta);

       
    }
    if($_POST['funcion']=='añadirproceso'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d H:i:s");
        $ano =date("Y");
        $tropa=$_POST['tropa'];
        $id_matarife=$_POST['id_matarife'];
        $estado=$_POST['estado'];
        $catalogo->añadirproceso($tropa,$id_matarife,$fecha,$ano,$estado);

    }
    if($_POST['funcion']=='reemplazar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['hasta'];
        $id=$_POST['id'];
        $catalogo->reemplazar($id,$cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazarfaenas'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        
        $id=$_POST['id'];
        $catalogo->reemplazarfaenas($id);
    }
    if($_POST['funcion']=='reemplazarestado'){
        $id_ingreso=$_POST['id_ingreso'];
        $catalogo->reemplazarestado($id_ingreso);
    }
    if($_POST['funcion']=='reemplazarestadoparcial'){
        $tropa=$_POST['tropa'];
        $catalogo->reemplazarestadoparcial($tropa);
    }
    if($_POST['funcion']=='reemplazarestadototalingreso'){
        $tropa=$_POST['tropa'];
        $catalogo->reemplazarestadototalingreso($tropa);
    }
    if($_POST['funcion']=='reemplazarestadototal'){
        $tropa=$_POST['tropa'];
        $catalogo->reemplazarestadototal($tropa);
    }
    if($_POST['funcion']=='verificarparcialparaestado'){
        $tropa=$_POST['tropa'];
        $catalogo->verificarparcialparaestado($tropa);
    }
    if($_POST['funcion']=='buscaridfaenas'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $tropa=$_POST['tropa'];
        $catalogo->buscaridfaenas($tropa);
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='reemplazarestadofaenas'){
        $tropa=$_POST['tropa'];
        $catalogo->reemplazarestadofaenas($tropa);
    }
    if($_POST['funcion']=='ultimoid'){
        $clasificacion=$_POST['clasificacion']; 
        $id_ingresos=$_POST['id_ingresos']; 
       $catalogo->verificar_especie($id_ingresos);
       $especie=$catalogo->objetos[0]->especie;
        $catalogo->ultimoid($especie);
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
            
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarromaneos'){
        $catalogo->verificarromaneos();
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarcorrales'){
        $catalogo->verificarcorrales();
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
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
    if($_POST['funcion']=='verificarcorralesreducidos'){
        $catalogo->verificarcorralesreducidos();
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
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


    if($_POST['funcion']=='verificardatosreduccion'){
        $catalogo->verificardatosreduccion(); 
    }

    if($_POST['funcion']=='verificarcorralreduccion'){
        $catalogo->verificarcorralreduccion();
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
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
        $catalogo->traerdatos($cantidad,$fecha,$tropas);
        $json=array();
        foreach ($catalogo->objetos as $objeto) {
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
        $quedan = $_POST['quedan'];
        $corral = $_POST['corral'];
        $promedio = $_POST['promedio'];
        $dte = $_POST['dte'];
        $nombrematarife = $_POST['nombrematarife'];
        $kilosenpie = $_POST['kilosenpie'];
        $tci = $_POST['tci'];
        $id_ingreso = $_POST['id_ingreso'];
        $descripcion='Se ha pasado a faena la tropa: '.$tropa;
        $catalogo->crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife,$quedan,$corral,$promedio,$dte,$nombrematarife,$kilosenpie,$tci,$id_ingreso);
        $historial->crear_historial($descripcion,5,2,$id_ingreso);
    }
    if($_POST['funcion']=='crearvolver'){
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

        $catalogo->crearvolver($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife);
    }
    


?>
