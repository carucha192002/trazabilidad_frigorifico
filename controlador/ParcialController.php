<?php
include '../modelo/Parcial.php';
$parcial = new Parcial();
    if($_POST['funcion']=='buscar'){
        $parcial->buscar();
        $json= array();
        foreach ($parcial->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $parcial->buscarid($fecha);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarfaenados'){
        $tropa=$_POST['tropas'];
        $parcial->buscarfaenados($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'maximo'=>$objeto->maximo
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarfaenadostotal'){
        $tropa=$_POST['tropas'];
        $parcial->buscarfaenadostotal($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'enpie'=>$objeto->enpie,
                'desde'=>$objeto->desde,
                'hasta'=>$objeto->hasta
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarfaenadosparcial'){
        $tropa=$_POST['tropas'];
        $parcial->buscarfaenadosparcial($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'enpie'=>$objeto->enpie,
                'desde'=>$objeto->desde,
                'hasta'=>$objeto->hasta
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $parcial->verificar($cantidad,$fecha);
    }
    if($_POST['funcion']=='agregar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $parcial->agregar($cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['hasta'];
        $id=$_POST['id'];
        $parcial->reemplazar($id,$cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazarestado'){
        $tropa=$_POST['tropa'];
        $parcial->reemplazarestado($tropa);
    }
    if($_POST['funcion']=='ultimoid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $parcial->ultimoid($fecha);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verreduccion'){
        $tropa=$_POST['tropa'];
        $parcial->verreduccion($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'tropa'=>$objeto->tropa,
                'clasificacion'=>$objeto->clasificacion,
                'cantidad'=>$objeto->cantidad,
                'desde'=>$objeto->desde,
                'hasta'=>$objeto->hasta,
                'reduccion'=>$objeto->reduccion,
                'motivo'=>$objeto->motivo,
                'estado'=>$objeto->estado,
                'corral'=>$objeto->corral,
                'fecha'=>$objeto->fecha,
                'fechaingreso'=>$objeto->fechaingreso 
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarfinalizados'){
        $parcial->verificarfinalizados();
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarparciales'){
        $parcial->verificarparciales();
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarcorrales'){
        $parcial->verificarcorrales();
        $json=array();
        foreach ($parcial->objetos as $objeto) {
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
    if($_POST['funcion']=='traerdatos'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $tropas=$_POST['tropas'];
        $parcial->traerdatos($cantidad,$fecha,$tropas);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
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
        $parcial->crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado);
    }
    if($_POST['funcion']=='reducir'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $tropa = $_POST['tropa'];
        $clasificacion = $_POST['clasificacion'];
        $cantidad = $_POST['cantidad'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $vuelven = $_POST['vuelven'];
        $reduccion = $_POST['reduccion'];
        $comienzo = $_POST['comienzo'];
        $motivo = $_POST['motivo'];
        $estado = $_POST['estado'];
        $corral = $_POST['corral'];
        $parcial->reducir($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$vuelven,$reduccion,$comienzo,$motivo,$estado,$corral);
    }
    if($_POST['funcion']=='reducirparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $tropa = $_POST['tropa'];
        $clasificacion = $_POST['clasificacion'];
        $cantidad = $_POST['cantidad'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $vuelven = $_POST['vuelven'];
        $reduccion = $_POST['reduccion'];
        $comienzo = $_POST['comienzo'];
        $motivo = $_POST['motivo'];
        $estado = $_POST['estado'];
        $corral = $_POST['corral'];
        $parcial->reducirparcial($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$vuelven,$reduccion,$comienzo,$motivo,$estado,$corral);
    }
  
    if($_POST['funcion']=='reemplazarestadoingresos'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropa = $_POST['tropa'];
        $corral = $_POST['corral'];
        $comienzo = $_POST['desde'];
        $reduccion = $_POST['reduccion'];
        $parcial->reemplazarestadoingresos($fecha,$tropa,$corral,$comienzo,$reduccion);
    }
    if($_POST['funcion']=='procesoreducciontotal'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d H:i:s");
        $ano = date("Y");
        $tropa = $_POST['tropa'];
        $matarife = $_POST['id_matarife'];
        $parcial->procesoreducciontotal($fecha,$tropa,$matarife,$ano);
    }
    if($_POST['funcion']=='procesoreduccionparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d H:i:s");
        $ano = date("Y");
        $tropa = $_POST['tropa'];
        $matarife = $_POST['id_matarife'];
        $parcial->procesoreduccionparcial($fecha,$tropa,$matarife,$ano);
    }
    if($_POST['funcion']=='reemplazarestadoingresosparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropa = $_POST['tropa'];
        $corral = $_POST['corral'];
        $comienzo = $_POST['comienzo'];
        $reduccion = $_POST['reduccion'];
        $parcial->reemplazarestadoingresosparcial($fecha,$tropa,$corral,$comienzo,$reduccion);
        
    }
    if($_POST['funcion']=='procesado'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->procesado($fecha,$tropa);
        
    }
    if($_POST['funcion']=='verfaenasparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->verfaenasparcial($tropa);
        
    }
    if($_POST['funcion']=='guardarmatanza'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $fecha = date("Y-m-d");
        $fechafaena = date("d-m-Y");
        $fecha1=date("d-m-Y",strtotime($fechafaena."+ 363 days"));
        $fechacsv = date("d/m/Y");
        $tropa = $_POST['tropas'];
        $productor = $_POST['productor'];
        $garron = $_POST['garron'];
        $especie = $_POST['especie'];
        $peso = $_POST['peso'];
        $estado = $_POST['estado'];
        $id_especies = $_POST['id_especies'];
        $codigo = $_POST['codigo'];
        $destinocsv = $_POST['destinocsv'];
        $idultimo = $_POST['idultimo'];
        $parcial->guardarmatanza ($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo );
                               
        
    }

    if($_POST['funcion']=='estadomatanza'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->estadomatanza($ano,$tropa);
        
    }
    if($_POST['funcion']=='estadomatanzaproceso'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $fecha = date("Y-m-d H:i:s");
        $tropa = $_POST['tropas'];
        $matarife=$_POST['id_matarife'];
        $parcial->estadomatanzaproceso($ano,$tropa,$matarife,$fecha);
        
    }
 
       
    if($_POST['funcion']=='matanzaestado'){
        $tropa = $_POST['tropas'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $parcial->matanzaestado($tropa,$desde,$hasta);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'estado'=>$objeto->estado
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='guardardatosfinalizados'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $tropa = $_POST['tropas'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $parcial->guardardatosfinalizados($desde,$hasta,$tropa);
       
    }
    if($_POST['funcion']=='buscarestadosfaenas'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->buscarestadosfaenas($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'total'=>$objeto->total
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='cantidadbuscarestadosfaenas'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->cantidadbuscarestadosfaenas($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'total'=>$objeto->total
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='totalparafaenar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->totalparafaenar($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'total'=>$objeto->total
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }

    if($_POST['funcion']=='procesadofaenados'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $tropa = $_POST['tropas'];
        $parcial->procesadofaenados($tropa);
        $json=array();
        foreach ($parcial->objetos as $objeto) {
            $json[]=array(
                'total'=>$objeto->total
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }

?>
