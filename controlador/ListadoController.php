<?php
include_once '../modelo/Listado.php';
require '../vendor/autoload.php';
include_once '../modelo/Historial.php';
$listado = new Listado();
$historial = new Historial();
session_start();
    if($_POST['funcion']=='buscar'){
        $listado->buscar();
        $json= array();
        foreach ($listado->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verlistado'){
        $listado->verlistado();
        $json=array();
        $contador=1;
        foreach ($listado->objetos as $objeto) {
            $json[]=array(       
                'id'=>$contador++,
                'matarife'=>$objeto->matarife,
                'enpie'=>$objeto->enpie,
                'identificador'=>$objeto->identificador,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verlistado_editar'){
        $listado->verlistado_editar();
        $json=array();
        $contador=1;
        foreach ($listado->objetos as $objeto) {
            $json[]=array(       
                'id'=>$contador++,
                'matarife'=>$objeto->matarife,
                'enpie'=>$objeto->enpie,
                'desde'=>$objeto->desde,
                'hasta'=>$objeto->hasta,
                'tropa'=>$objeto->tropa,
                'ingresos'=>$objeto->ingresos,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $listado->buscarid($fecha);
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarfaenados'){
        $id_ingresos=$_POST['id_ingresos'];
        $listado->buscarfaenados($id_ingresos);
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'maximo'=>$objeto->maximo
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarfaenadostotal'){
        $tropa=$_POST['tropas'];
        $listado->buscarfaenadostotal($tropa);
        $json=array();
        foreach ($listado->objetos as $objeto) {
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
        $id_ingresos=$_POST['id_ingresos'];
        $maximo=$_POST['maximo'];
        $listado->buscarfaenadosparcial($id_ingresos);
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'enpie'=>$objeto->enpie,
                'desde'=>$maximo,
                'hasta'=>$objeto->hasta
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='buscarfaenadosparcial1'){
        $id_ingresos=$_POST['id_ingresos'];
        $maximo=$_POST['maximo'];
        $listado->buscarfaenadosparcial1($id_ingresos);
        $json=array();
        foreach ($listado->objetos as $objeto) {
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
        $listado->verificar($cantidad,$fecha);
    }
    
    if($_POST['funcion']=='agregar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['cantidad'];
        $listado->agregar($cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazar'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $cantidad=$_POST['hasta'];
        $id=$_POST['id'];
        $listado->reemplazar($id,$cantidad,$fecha);
    }
    if($_POST['funcion']=='reemplazarestado'){
        $tropa=$_POST['tropa'];
        $listado->reemplazarestado($tropa);
    }
    if($_POST['funcion']=='ultimoid'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $listado->ultimoid($fecha);
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verreduccion'){
        $tropa=$_POST['tropa'];
        $listado->verreduccion($tropa);
        $json=array();
        foreach ($listado->objetos as $objeto) {
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
        $listado->verificarfinalizados();
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarparciales'){
        $listado->verificarparciales();
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'cantidad'=>$objeto->cantidad
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='verificarcorrales'){
        $listado->verificarcorrales();
        $json=array();
        foreach ($listado->objetos as $objeto) {
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
        $listado->traerdatos($cantidad,$fecha,$tropas);
        $json=array();
        foreach ($listado->objetos as $objeto) {
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
        $listado->crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado);
    }
    if($_POST['funcion']=='reducir_parcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d");
        $ultimo = $_POST['ultimo'];
        $reduccion = $_POST['reduccion'];
        $corral = $_POST['corral'];
        $id_ingresos = $_POST['id_ingresos'];
        $porque = $_POST['porque'];
        $quedan = $_POST['quedan'];
        $desde = $_POST['desde'];
        $listado->traer_datos($id_ingresos);
        $ano=$listado->objetos[0]->ano;
        $libro=$listado->objetos[0]->libro;
        $folio=$listado->objetos[0]->folio;
        $destino=$listado->objetos[0]->destino;
        $especie=$listado->objetos[0]->especie;
        $subespecie=$listado->objetos[0]->subespecie;
        $cantidad=$reduccion;
        $kilos=$listado->objetos[0]->kilos;
        $muertos=$listado->objetos[0]->muertos;
        $caidos=$listado->objetos[0]->caidos;
        $enpie=$reduccion;
        $kilosenpie=$listado->objetos[0]->kilosenpie;
        $conservacion=$listado->objetos[0]->conservacion;
        $vencimiento=$listado->objetos[0]->vencimiento;
        $corral=$corral;
        $corralero=$listado->objetos[0]->corralero;
        $matarife=$listado->objetos[0]->matarife;
        $productor=$listado->objetos[0]->productor;
        $guia=$listado->objetos[0]->guia;
        $fechaguia=$listado->objetos[0]->fechaguia;
        $dtamodal=$listado->objetos[0]->dtamodal;
        $fechadtamodal=$listado->objetos[0]->fechadtamodal;
        $llenarprocedencia=$listado->objetos[0]->llenarprocedencia;
        $provinciamodal=$listado->objetos[0]->provinciamodal;
        $localidadmodal=$listado->objetos[0]->localidadmodal;
        $CPmodal=$listado->objetos[0]->cpmodal;
        $llenartransporte=$listado->objetos[0]->llenartransporte;
        $llenarchofer=$listado->objetos[0]->llenarchofer;
        $dnimodal=$listado->objetos[0]->dnimodal;
        $habilitacionmodal=$listado->objetos[0]->habilitacionmodal;
        $horasdeviajemodal=$listado->objetos[0]->horasdeviajemodal;
        $lavadomodal=$listado->objetos[0]->lavadomodal;
        $prescintomodal=$listado->objetos[0]->prescintomodal;
        $prescintomodalacoplado=$listado->objetos[0]->prescintomodalacoplado;
        $observacionmodal='Reduccion de: '.$reduccion.' garrones por: '.$porque;
        $kiloscuerosmodal=$listado->objetos[0]->kiloscuerosmodal;
        $numtropas=$listado->objetos[0]->numtropas;
        $cargodatos=$listado->objetos[0]->cargodatos;
        $digestormuertos=$listado->objetos[0]->digestormuertos;
        $digestorcaidos=$listado->objetos[0]->digestorcaidos;
        $etapa='INGRESO';
        $matarifesub_item=$listado->objetos[0]->matarifesub_item;
        $tci=$listado->objetos[0]->tci;

        $listado->promedio($id_ingresos);
        $promedio=$listado->objetos[0]->promedio;
        $promedio_volver=Round($promedio*$reduccion);
        $listado->volver($fecha,$ano,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$promedio_volver,$muertos,$caidos,$enpie,
        $promedio_volver,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,
        $llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,
        $horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargodatos,
        $digestormuertos,$digestorcaidos,$etapa,$matarifesub_item,$tci);
        $promedio_guardar=round($promedio*$quedan);
        $listado->guardar_promedio($promedio_guardar,$id_ingresos);
        $listado->finalizar_faena($id_ingresos,$desde);
        $listado->cambiar_ingreso($id_ingresos,$quedan);
        $listado->cambiar_faena($id_ingresos,$quedan,$desde);
        echo 'add';
    }
    if($_POST['funcion']=='reducir_total'){
        $id_ingresos = $_POST['id_ingresos'];
        $listado->cambiar_faena_total($id_ingresos);
        $listado->eliminar_faena_total($id_ingresos);
        echo 'add';
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
        $listado->reducirparcial($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$vuelven,$reduccion,$comienzo,$motivo,$estado,$corral);
    }
  
    if($_POST['funcion']=='reemplazarestadoingresos'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropa = $_POST['tropa'];
        $corral = $_POST['corral'];
        $comienzo = $_POST['desde'];
        $reduccion = $_POST['reduccion'];
        $listado->reemplazarestadoingresos($fecha,$tropa,$corral,$comienzo,$reduccion);
    }
    if($_POST['funcion']=='procesoreducciontotal'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d H:i:s");
        $ano = date("Y");
        $tropa = $_POST['tropa'];
        $matarife = $_POST['id_matarife'];
        $listado->procesoreducciontotal($fecha,$tropa,$matarife,$ano);
    }
    if($_POST['funcion']=='procesoreduccionparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y-m-d H:i:s");
        $ano = date("Y");
        $tropa = $_POST['tropa'];
        $matarife = $_POST['id_matarife'];
        $listado->procesoreduccionparcial($fecha,$tropa,$matarife,$ano);
    }
    if($_POST['funcion']=='reemplazarestadoingresosparcial'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $tropa = $_POST['tropa'];
        $corral = $_POST['corral'];
        $comienzo = $_POST['comienzo'];
        $reduccion = $_POST['reduccion'];
        $listado->reemplazarestadoingresosparcial($fecha,$tropa,$corral,$comienzo,$reduccion);
        
    }
    if($_POST['funcion']=='procesado'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $fecha = date("Y");
        $id_ingresos = $_POST['id_ingresos'];
        $listado->procesado($id_ingresos);
        
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
        $tci = $_POST['tci'];
        $id_ingresos = $_POST['id_ingresos'];
        $descripcion='Se proceso el garro N°: '.$garron.' con un peso de: '.$peso.' de la tropa N°: '.$tropa;
        $listado->obtener_conservacion($id_ingresos);
        $conservacion=$listado->objetos[0]->conservacion;

        
        if($conservacion==1){
            $fechafaena = date("d-m-Y");
            $fecha1=date("d-m-Y",strtotime($fechafaena."+ 7 days"));
            $listado->guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos);
            $historial->crear_historial($descripcion,6,2,$id_ingresos);
        }else  if($conservacion==3){
            $fechafaena = date("d-m-Y");
            $fecha1=date("d-m-Y",strtotime($fechafaena."+ 363 days"));
            $listado->guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos);
        $historial->crear_historial($descripcion,6,2,$id_ingresos);
        }else  if($conservacion==4){
            $fechafaena = date("d-m-Y");
            $fecha1=date("d-m-Y",strtotime($fechafaena."+ 532 days"));
           $listado->guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos);
           $historial->crear_historial($descripcion,6,2,$id_ingresos);
        }
     
    
    }


    if($_POST['funcion']=='buscarmatanza'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $id_ingresos = $_POST['id_ingresos'];
        $listado->buscarmatanza($id_ingresos);
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'garron'=>$objeto->garron
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    if($_POST['funcion']=='estadomatanza'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $fecha =date("d/m/Y");
        $id_ingresos = $_POST['id_ingresos'];
        $listado->estadomatanza($id_ingresos,$fecha);
        
    }
    if($_POST['funcion']=='estadomatanzaproceso'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $fecha = date("Y-m-d H:i:s");
        $tropa = $_POST['tropas'];
        $matarife=$_POST['id_matarife'];
        $listado->estadomatanzaproceso($ano,$tropa,$matarife,$fecha);
        
    }
    if($_POST['funcion']=='matanzaestado'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $id_ingresos = $_POST['id_ingresos'];
        $listado->matanzaestado($id_ingresos);
       
    }
    if($_POST['funcion']=='camarasdestino'){
        $camara = $_POST['camara'];
        $tropa = $_POST['tropas'];
        $id_ingresos = $_POST['id_ingresos'];
        $descripcion='La tropa N°: '.$tropa.' se envio a la camara N°: '.$camara;
        $historial->crear_historial($descripcion,6,2,$id_ingresos);
        $listado->camarasdestino($camara,$id_ingresos); 

    }
    if($_POST['funcion']=='despiece'){
        $especie = $_POST['especie'];
        $tropa = $_POST['tropas'];
        $id_especies = $_POST['id_especies'];
        $id_ingresos = $_POST['id_ingresos'];
        $listado->conservacion($id_ingresos,$id_especies);
        $conservacion=$listado->objetos[0]->conservacion;
        if($conservacion!=4){
        $listado->especie($id_especies);
        $nombre_especie=$listado->objetos[0]->nombre;
        $listado->despiece($nombre_especie);
        $codigo=$listado->objetos[0]->codigo;
        $listado->agregar_despiece($codigo,$id_ingresos,$id_especies);
           echo 'agregado';
        }else{
            echo 'error';
        }
   
       
       
    }

    if($_POST['funcion']=='camaraproceso'){
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $fecha = date("Y-m-d H:i:s");
        $tropa = $_POST['tropas'];
        $matarife=$_POST['id_matarife'];
        $camara=$_POST['camara'];
        $listado->camaraproceso($ano,$tropa,$matarife,$fecha,$camara);
        
    }
    if($_POST['funcion']=='vercamaraprocesado'){
        $id = $_POST['id_ingresos'];
        $listado->vercamaraprocesado($id);
        
    }
    if($_POST['funcion']=='buscargarronfaenados'){
        $id_ingresos=$_POST['id_ingresos'];
        $listado->buscargarronfaenados($id_ingresos);
        $json= array();
        foreach ($listado->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='editargarronpeso'){
        $tropa=$_POST['tropa'];
        $garron=$_POST['garron'];
        $peso=$_POST['peso'];
        $id=$_POST['id_editar'];
        $peso_editar=$_POST['editar_peso'];
        $observacion_decomiso=$_POST['observacion_decomiso'];
        $id_ingresos=$_POST['id_ingresos'];
        $avatar=$_FILES['avatar_mod']['name'];

           if($avatar!=""){
            
            $nombre_avatar=uniqid().'-'.$avatar;
            //$ruta='../util/img/usuarios/'.$nombre_avatar;
            //move_uploaded_file($_FILES['avatar_mod']['tmp_name'],$ruta);
            $archivo=$nombre_avatar;
            $extension=pathinfo($archivo,PATHINFO_EXTENSION);
            $nombre_base=basename($archivo,'.'.$extension);
            $handle = new \Verot\Upload\Upload($_FILES['avatar_mod']);
            if ($handle->uploaded) {
            $handle->file_new_name_body       = $nombre_base;
                $handle->image_resize         = true;
                $handle->image_x              = 200;
                $handle->image_y             = 200;
                $handle->process('../img/observacion/');
                if ($handle->processed) {
                    //echo 'image resized';
                    $handle->clean();
                } else {
                    echo 'error : ' . $handle->error;
                }
            }
            $listado->editargarronpeso($tropa,$garron,$peso,$peso_editar,$id);
            $listado->subir_foto($id,$nombre_avatar,$observacion_decomiso);
            $listado->editar($id);
            $descripcion='Se editaron datos del garron N°: '.$garron.' con la foto: '.$nombre_base.' y la observacion: '.$observacion_decomiso;
            $historial->crear_historial($descripcion,6,2,$id_ingresos);
            echo "guardado";

        }else{
            $listado->editargarronpeso($tropa,$garron,$peso,$peso_editar,$id);
            $listado->comparargarron($id);
            $pesocomparado=$listado->objetos[0]->peso;
            $descripcion='Se edito el peso del garron N°: '.$garron.' de: '.$peso.' a: '.$pesocomparado;
            $historial->crear_historial($descripcion,6,2,$id_ingresos);
            echo 'guardado';
        }
     
        
        
    }
    if($_POST['funcion']=='buscargarronfaenadostropas'){
        $listado->buscargarronfaenadostropas();
        $json= array();
        foreach ($listado->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='ultimoidfaenados'){
        $listado->ultimoidfaenados();
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id
                
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
        
    }
    if($_POST['funcion']=='observacion_foto'){
        $id=$_POST['id'];
        $listado->observacion_foto($id);
        $json=array();
        foreach ($listado->objetos as $objeto) {
            $json[]=array(
                'descripcion'=>$objeto->descripcion,
                'foto'=>$objeto->foto,
                'fecha'=>$objeto->fecha_creacion,
                
            );
        } 
        $jsonstring=json_encode($json);
        echo $jsonstring;
        
    }
    if($_POST['funcion']=='verificar_faena'){
        $error=0;
        $productos=json_decode($_POST['productos']);
        if(empty($productos)){
            echo '0';
        }else{
        $id_ingresos=$productos[0]->id;
        $listado->obtener_faena_cantidad ($id_ingresos);
        $seleccionado=$listado->objetos[0]->cantidad;
       foreach ($productos as $objeto) {
            $listado->obtener_faena ($objeto->id,$objeto->garron,$objeto->tropas);
            foreach ($listado->objetos as $obj) {
                $total=$obj->total;
               
            }
         if($total==0){
                $error=$error+0;
            }
            else{
                $error=$error+1;
            }
        } 
        if($error==$seleccionado){
            echo 0;
        } else{
            echo 1;
        } 
    }
    }
    if($_POST['funcion']=='verificar_faltantes'){
        $productos=json_decode($_POST['productos']);
        $json=array();
       foreach ($productos as $objeto) {
            $listado->obtener_faena_faltante ($objeto->id,$objeto->tropas,$objeto->garron);
            foreach ($listado->objetos as $objeto) {
                $json[]=array(
                    'garron'=>$objeto->garron
                    
                );
            }
        }  
        $jsonstring=json_encode($json);
        echo $jsonstring;
 
    }
    if($_POST['funcion']=='guardarmatanza_faltante'){
        $productos=json_decode($_POST['productos']);
        $datos= date_default_timezone_set('America/Argentina/Mendoza');
        $ano = date("Y");
        $fecha = date("Y-m-d");
        $fechafaena = date("d-m-Y");
        $fecha1=date("d-m-Y",strtotime($fechafaena."+ 363 days"));
        $fechacsv = date("d/m/Y");
        foreach ($productos as $objetos) {
            
            $tropa = $objetos->tropas;
            $productor = $objetos->productor;
            $garron = $objetos->garron;
            $especie = $objetos->especie;
            $peso = $objetos->peso;
            $estado = $objetos->estado;
            $id_especies = $objetos->id_especies;
            $idultimo = $objetos->idultimo;
            $tci = $objetos->tci;
            $id_ingresos = $objetos->id;
          
        $descripcion='Se proceso el garro N°: '.$garron.' con un peso de: '.$peso.' de la tropa N°: '.$tropa;
        $listado->obtener_conservacion($id_ingresos);
        $conservacion=$listado->objetos[0]->conservacion;
        $listado->obtener_codigo($id_especies,$especie);
        $codigo =$listado->objetos[0]->codigo;
        $listado->obtener_destino($id_ingresos);
        $destinocsv=$listado->objetos[0]->codigocsv;

        
        if($conservacion==1){
            $fechafaena = date("d-m-Y");
            $fecha1=date("d-m-Y",strtotime($fechafaena."+ 7 days"));
            $listado->guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos);
            $historial->crear_historial($descripcion,6,2,$id_ingresos);
        }else  if($conservacion==3){
            $fechafaena = date("d-m-Y");
            $fecha1=date("d-m-Y",strtotime($fechafaena."+ 363 days"));
            $listado->guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos);
        $historial->crear_historial($descripcion,6,2,$id_ingresos);
        }else  if($conservacion==4){
            $fechafaena = date("d-m-Y");
            $fecha1=date("d-m-Y",strtotime($fechafaena."+ 532 days"));
           $listado->guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos);
           $historial->crear_historial($descripcion,6,2,$id_ingresos);
        }
     
        }
    }
    if($_POST['funcion']=='guardar_faena'){
        $listados=json_decode($_POST['json']);
        foreach ($listados as $prod) {
            $id=$prod->id;
            $cantidad=$prod->cantidad;
            $desde=$prod->desde;
            $hasta=$prod->hasta;
            $listado->guardar_faena($id,$cantidad,$desde,$hasta);
            $listado->muertosycaidos($id);
            $muertos=$listado->objetos[0]->muertos;
            $caidos=$listado->objetos[0]->caidos;
            $ingresocantidad=$listado->objetos[0]->cantidad;
            $comprobar=$muertos+$caidos;
            if($comprobar==0){
            $total=$cantidad;
            $listado->guardar_faena_ingresos($id,$total);
            }else{
            $total=$cantidad-($muertos+$caidos);
            $total1=$cantidad;
            $listado->guardar_faena_ingresos1($id,$total,$total1);
            }
        }
        echo 'edit';
 
    }
?>
