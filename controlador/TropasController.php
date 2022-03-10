<?php
include_once '../modelo/tropas.php';
include_once '../modelo/Historial.php';
$tropas = new Tropas();
$historial = new Historial();
session_start();
if($_POST['funcion']=='session'){
    $tipo=$_SESSION['us_tipo'];
    echo $tipo;
}
if($_POST['funcion']=='rellenar_desdetropas'){
    $tropas->rellenar_desdetropas();
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->desdetropas
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='crear'){
    $matarife = $_POST['matarife'];
    $procedencia = $_POST['procedencia'];
    $especie = $_POST['especie'];
    $vigencia = $_POST['vigencia'];
    $desde = $_POST['desde'];
    $cantidad = $_POST['cantidad'];
    $hasta = $_POST['hasta'];
    $ano = $_POST['ano'];
    $avatar='tropas-default.jpg';
    $tropas->crear($matarife,$procedencia,$especie,$vigencia,$desde,$cantidad,$hasta,$ano,$avatar);
}
if($_POST['funcion']=='verificar_datos_minimo'){
    $matarife = $_POST['matarife'];
    $procedencia = $_POST['procedencia'];
    $especie = $_POST['especie'];
    $vigencia = $_POST['vigencia'];
    $desde = $_POST['desde'];
    $cantidad = $_POST['cantidad'];
    $hasta = $_POST['hasta'];
    $ano = $_POST['ano'];
    $avatar='tropas-default.jpg';
    for ($valor=$desde; $valor < $hasta ; $valor++) { 
        $tropas->verificar_datos1($valor);
        
    }
}
if($_POST['funcion']=='editar'){
    $matarife = $_POST['matarife'];
    $id_editado=$_POST['id'];
    $procedencia = $_POST['procedencia'];
    $especie = $_POST['especie'];
    $vigencia = $_POST['vigencia'];
    $desde = $_POST['desde'];
    $cantidad = $_POST['cantidad'];
    $hasta = $_POST['hasta'];    
    $tropas->editar($matarife,$id_editado,$procedencia,$especie,$vigencia,$desde,$cantidad,$hasta);
}
if($_POST['funcion']=='buscar'){
    $tropas->buscar();
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_tropas,
            'matarife'=>$objeto->matarife,
            'procedencia'=>$objeto->procedencia,
            'especiesanimal'=>$objeto->especiesanimal,
            'vigencia'=>$objeto->vigencia,
            'desde'=>$objeto->desde,
            'cantidad'=>$objeto->cantidad,
            'hasta'=>$objeto->hasta,
            'avatar'=>'../img/tropas/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='marcador'){
    $id_ingresos=$_POST['id_ingresos'];
    $tropas->marcador($id_ingresos);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'marcador'=>$objeto->marcador
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='ver_borrados'){
    $tropas->ver_borrados();
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_tropas,
            'matarife'=>$objeto->matarife,
            'procedencia'=>$objeto->procedencia,
            'especie'=>$objeto->especiesanimal,
            'desde'=>$objeto->desde,
            'cantidad'=>$objeto->cantidad,
            'hasta'=>$objeto->hasta
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $tropas->borrar($id);
}
if($_POST['funcion']=='agregar_nuevo'){
    $id=$_POST['id'];
    $tropas->agregar_nuevo($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/tropas/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $tropas->cambiar_logo($id,$nombre);
        foreach ($tropas->objetos as $objeto) {
            if($objeto->avatar!='tropas-default.jpg'){
                unlink('../img/tropas/'.$objeto->avatar);
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
if($_POST['funcion']=='listar'){
    $tropas->buscar_listados();    
    $json= array();
    foreach ($tropas->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='comprobar'){
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $tropas->comprobar($matarife,$especie);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'numero'=>$objeto->numerotropa,
            'usados'=>$objeto->usados
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='comprobartropas'){
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $tropas->comprobartropas($matarife,$especie);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'numero'=>$objeto->numerotropa,
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='comprobarano'){
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $tropas-> comprobarano($matarife,$especie);
}

if($_POST['funcion']=='guardar'){
        $ano=$_POST['anols'];
        $fecha=$_POST['fecha'];
        $libro=$_POST['libro'];
        $folio=$_POST['folio'];
        $destino=$_POST['destino'];
        $especie=$_POST['especiels'];
        $subespecie=$_POST['subespecie'];
        $subespecie1=$_POST['subespecie1'];
        $subespecie2=$_POST['subespecie2'];
        $subespecie3=$_POST['subespecie3'];
        $subespecie4=$_POST['subespecie4'];
        $cantidad=$_POST['cantidad'];
        $cantidad1=$_POST['cantidad1'];
        $cantidad2=$_POST['cantidad2'];
        $cantidad3=$_POST['cantidad3'];
        $cantidad4=$_POST['cantidad4'];
        $kilos=$_POST['kilos'];
        $kilos1=$_POST['kilos1'];
        $kilos2=$_POST['kilos2'];
        $kilos3=$_POST['kilos3'];
        $kilos4=$_POST['kilos4'];
        $muertos=$_POST['muertos'];
        $muertos1=$_POST['muertos1'];
        $muertos2=$_POST['muertos2'];
        $muertos3=$_POST['muertos3'];
        $muertos4=$_POST['muertos4'];
        $caidos=$_POST['caidos'];
        $caidos1=$_POST['caidos1'];
        $caidos2=$_POST['caidos2'];
        $caidos3=$_POST['caidos3'];
        $caidos4=$_POST['caidos4'];
        $enpie=$_POST['enpie'];
        $enpie1=$_POST['enpie1'];
        $enpie2=$_POST['enpie2'];
        $enpie3=$_POST['enpie3'];
        $enpie4=$_POST['enpie4'];
        $kilosenpie=$_POST['kilosenpie'];
        $kilosenpie1=$_POST['kilosenpie1'];
        $kilosenpie2=$_POST['kilosenpie2'];
        $kilosenpie3=$_POST['kilosenpie3'];
        $kilosenpie4=$_POST['kilosenpie4'];
        $conservacion=$_POST['conservacion'];
        $vencimiento=$_POST['vencimiento'];
        $corral=$_POST['corral'];
        $corralero=$_POST['corralero'];
        $matarife=$_POST['matarife_ls'];
        $productor=$_POST['productor'];
        $guia=$_POST['guia'];
        $fechaguia=$_POST['fechaguia'];
        $dtamodal=$_POST['dtamodal'];
        $fechadtamodal=$_POST['fechadtamodal'];
        $llenarprocedencia=$_POST['llenarprocedencia'];
        $provinciamodal=$_POST['provinciamodal'];
        $localidadmodal=$_POST['localidadmodal'];
        $CPmodal=$_POST['CPmodal'];
        $llenartransporte=$_POST['llenartransporte'];
        $llenarchofer=$_POST['llenarchofer'];
        $dnimodal=$_POST['dnimodal'];
        $habilitacionmodal=$_POST['habilitacionmodal'];
        $horasdeviajemodal=$_POST['horasdeviajemodal'];
        $lavadomodal=$_POST['lavadomodal'];
        $prescintomodal=$_POST['prescintomodal'];
        $prescintomodalacoplado=$_POST['prescintomodalacoplado'];
        $observacionmodal=$_POST['observacionmodal'];
        $kiloscuerosmodal=$_POST['kiloscuerosmodal'];
        $numtropas=$_POST['numtropas'];
        $cargo=$_POST['cargo'];
        $digestormuertos=$_POST['digestormuertos'];
        $digestorcaidos=$_POST['digestorcaidos'];
        $matarifesub_item=$_POST['matarifesub_item'];
        $tci=$_POST['tci'];
    
   
    $descripcion='Ha creado la ficha para la tropa: '.$numtropas;
    if($destino==0){
        echo 'destino';
    }else if($especie==0){
        echo 'especie'; 
    }else if($subespecie==0){
        echo 'subespecie'; 
    }else if($conservacion==0){
        echo 'conservacion'; 
    }else if($corral==0){
        echo 'corral'; 
    }else if($corralero==0){
        echo 'corralero'; 
    }else if($matarife==0){
        echo 'matarife'; 
    }else if($productor==0){
        echo 'productor'; 
    }else if($llenarprocedencia==0){
        echo 'procedencia'; 
    }else if($provinciamodal==0){
        echo 'provincia'; 
    }else if($localidadmodal==0){
        echo 'localidad'; 
    }else if($llenartransporte==0){
        echo 'transporte'; 
    }else if($llenarchofer==0){
        echo 'chofer'; 
    }else if($matarifesub_item==0){
        echo 'Matarife Sub Item'; 
    }else if($cantidad==0){
        echo 'Cantidad'; 
    }else{
        echo 'add';
        if(!empty($cantidad1) && !empty($cantidad2)&&!empty($cantidad3)&&!empty($cantidad4)){
            $tropas->guardar($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar1($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie1,$cantidad1,$kilos1,$muertos1,$caidos1,$enpie1,$kilosenpie1,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar2($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie2,$cantidad2,$kilos2,$muertos2,$caidos2,$enpie2,$kilosenpie2,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar3($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie3,$cantidad3,$kilos3,$muertos3,$caidos3,$enpie3,$kilosenpie3,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar4($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie4,$cantidad4,$kilos4,$muertos4,$caidos4,$enpie4,$kilosenpie4,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
        }else if(!empty($cantidad1) && !empty($cantidad2)&&!empty($cantidad3)){
            $tropas->guardar($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar1($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie1,$cantidad1,$kilos1,$muertos1,$caidos1,$enpie1,$kilosenpie1,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar2($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie2,$cantidad2,$kilos2,$muertos2,$caidos2,$enpie2,$kilosenpie2,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar3($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie3,$cantidad3,$kilos3,$muertos3,$caidos3,$enpie3,$kilosenpie3,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
        }else if(!empty($cantidad1) && !empty($cantidad2)){
            $tropas->guardar($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar1($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie1,$cantidad1,$kilos1,$muertos1,$caidos1,$enpie1,$kilosenpie1,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar2($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie2,$cantidad2,$kilos2,$muertos2,$caidos2,$enpie2,$kilosenpie2,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
        } else if (!empty($cantidad1)){
             $tropas->guardar($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
            $tropas->guardar1($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie1,$cantidad1,$kilos1,$muertos1,$caidos1,$enpie1,$kilosenpie1,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
        }else if (!empty($cantidad)){
             $tropas->guardar($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
          
        }
        $historial->traerid();
        $id_ingreso=$historial->objetos[0]->ultimo;
        $historial->crear_historial($descripcion,2,1,$id_ingreso);
    }
 
}

if($_POST['funcion']=='guardar1'){
    $ano=$_POST['ano'];
    $fecha=$_POST['fecha'];
    $libro=$_POST['libro'];
    $folio=$_POST['folio'];
    $destino=$_POST['destino'];
    $especie=$_POST['especie'];
    $subespecie1=$_POST['subespecie1'];
    $cantidad1=$_POST['cantidad1'];
    $kilos1=$_POST['kilos1'];
    $muertos1=$_POST['muertos1'];
    $caidos1=$_POST['caidos1'];
    $enpie1=$_POST['enpie1'];
    $kilosenpie1=$_POST['kilosenpie1'];
    $conservacion=$_POST['conservacion'];
    $vencimiento=$_POST['vencimiento'];
    $corral=$_POST['corral'];
    $corralero=$_POST['corralero'];
    $matarife=$_POST['matarife'];
    $productor=$_POST['productor'];
    $guia=$_POST['guia'];
    $fechaguia=$_POST['fechaguia'];
    $dtamodal=$_POST['dtamodal'];
    $fechadtamodal=$_POST['fechadtamodal'];
    $llenarprocedencia=$_POST['llenarprocedencia'];
    $provinciamodal=$_POST['provinciamodal'];
    $localidadmodal=$_POST['localidadmodal'];
    $CPmodal=$_POST['CPmodal'];
    $llenartransporte=$_POST['llenartransporte'];
    $llenarchofer=$_POST['llenarchofer'];
    $dnimodal=$_POST['dnimodal'];
    $habilitacionmodal=$_POST['habilitacionmodal'];
    $horasdeviajemodal=$_POST['horasdeviajemodal'];
    $lavadomodal=$_POST['lavadomodal'];
    $prescintomodal=$_POST['prescintomodal'];
    $prescintomodalacoplado=$_POST['prescintomodalacoplado'];
    $observacionmodal=$_POST['observacionmodal'];
    $kiloscuerosmodal=$_POST['kiloscuerosmodal'];
    $numtropas=$_POST['numtropas'];
    $cargo=$_POST['cargo'];
    $digestormuertos=$_POST['digestormuertos'];
    $digestorcaidos=$_POST['digestorcaidos'];
    $matarifesub_item=$_POST['matarifesub_item'];
    $tci=$_POST['tci'];
    $tropas->guardar1($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie1,$cantidad1,$kilos1,$muertos1,$caidos1,$enpie1,$kilosenpie1,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
}
if($_POST['funcion']=='guardar2'){
    $ano=$_POST['ano'];
    $fecha=$_POST['fecha'];
    $libro=$_POST['libro'];
    $folio=$_POST['folio'];
    $destino=$_POST['destino'];
    $especie=$_POST['especie'];
    $subespecie2=$_POST['subespecie2'];
    $cantidad2=$_POST['cantidad2'];
    $kilos2=$_POST['kilos2'];
    $muertos2=$_POST['muertos2'];
    $caidos2=$_POST['caidos2'];
    $enpie2=$_POST['enpie2'];
    $kilosenpie2=$_POST['kilosenpie2'];
    $conservacion=$_POST['conservacion'];
    $vencimiento=$_POST['vencimiento'];
    $corral=$_POST['corral'];
    $corralero=$_POST['corralero'];
    $matarife=$_POST['matarife'];
    $productor=$_POST['productor'];
    $guia=$_POST['guia'];
    $fechaguia=$_POST['fechaguia'];
    $dtamodal=$_POST['dtamodal'];
    $fechadtamodal=$_POST['fechadtamodal'];
    $llenarprocedencia=$_POST['llenarprocedencia'];
    $provinciamodal=$_POST['provinciamodal'];
    $localidadmodal=$_POST['localidadmodal'];
    $CPmodal=$_POST['CPmodal'];
    $llenartransporte=$_POST['llenartransporte'];
    $llenarchofer=$_POST['llenarchofer'];
    $dnimodal=$_POST['dnimodal'];
    $habilitacionmodal=$_POST['habilitacionmodal'];
    $horasdeviajemodal=$_POST['horasdeviajemodal'];
    $lavadomodal=$_POST['lavadomodal'];
    $prescintomodal=$_POST['prescintomodal'];
    $prescintomodalacoplado=$_POST['prescintomodalacoplado'];
    $observacionmodal=$_POST['observacionmodal'];
    $kiloscuerosmodal=$_POST['kiloscuerosmodal'];
    $numtropas=$_POST['numtropas'];
    $cargo=$_POST['cargo'];
    $digestormuertos=$_POST['digestormuertos'];
    $digestorcaidos=$_POST['digestorcaidos'];
    $matarifesub_item=$_POST['matarifesub_item'];
    $tci=$_POST['tci'];
    $tropas->guardar2($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie2,$cantidad2,$kilos2,$muertos2,$caidos2,$enpie2,$kilosenpie2,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
}
if($_POST['funcion']=='editardatostropas'){
    $id=$_POST['id'];
    $ano=$_POST['ano'];
    $fecha=$_POST['fecha'];
    $libro=$_POST['libro'];
    $folio=$_POST['folio'];
    $destino=$_POST['destino'];
    $especie=$_POST['especie'];
    $subespecie=$_POST['subespecie'];
    $cantidad=$_POST['cantidad'];
    $kilos=$_POST['kilos'];
    $muertos=$_POST['muertos'];
    $caidos=$_POST['caidos'];
    $enpie=$_POST['enpie'];
    $kilosenpie=$_POST['kilosenpie'];
    $conservacion=$_POST['conservacion'];
    $vencimiento=$_POST['vencimiento'];
    $corral=$_POST['corral'];
    $corralero=$_POST['corralero'];
    $matarife=$_POST['matarife'];
    $productor=$_POST['productor'];
    $guia=$_POST['guia'];
    $fechaguia=$_POST['fechaguia'];
    $dtamodal=$_POST['dtamodal'];
    $fechadtamodal=$_POST['fechadtamodal'];
    $llenarprocedencia=$_POST['llenarprocedencia'];
    $provinciamodal=$_POST['provinciamodal'];
    $localidadmodal=$_POST['localidadmodal'];
    $CPmodal=$_POST['CPmodal'];
    $llenartransporte=$_POST['llenartransporte'];
    $llenarchofer=$_POST['llenarchofer'];
    $dnimodal=$_POST['dnimodal'];
    $habilitacionmodal=$_POST['habilitacionmodal'];
    $horasdeviajemodal=$_POST['horasdeviajemodal'];
    $lavadomodal=$_POST['lavadomodal'];
    $prescintomodal=$_POST['prescintomodal'];
    $prescintomodalacoplado=$_POST['prescintomodalacoplado'];
    $observacionmodal=$_POST['observacionmodal'];
    $kiloscuerosmodal=$_POST['kiloscuerosmodal'];
    $numtropas=$_POST['numtropas'];
    $cargo=$_POST['cargo'];
    $fechaedicion=$_POST['fechaedicion'];
    $digestormuertos=$_POST['digestormuertos'];
    $digestorcaidos=$_POST['digestorcaidos'];
    $matarifesub_item=$_POST['matarifesub_item'];
    $tci=$_POST['tci'];
    $descripcion='Se edito la ficha para la tropa: '.$numtropas;
    
    if($destino==0){
        echo 'destino';
    }else if($especie==0){
        echo 'especie'; 
    }else if($subespecie==0){
        echo 'subespecie'; 
    }else if($conservacion==0){
        echo 'conservacion'; 
    }else if($corral==0){
        echo 'corral'; 
    }else if($corralero==0){
        echo 'corralero'; 
    }else if($matarife==0){
        echo 'matarife'; 
    }else if($productor==0){
        echo 'productor'; 
    }else if($llenarprocedencia==0){
        echo 'procedencia'; 
    }else if($provinciamodal==0){
        echo 'provincia'; 
    }else if($localidadmodal==0){
        echo 'localidad'; 
    }else if($llenartransporte==0){
        echo 'transporte'; 
    }else if($llenarchofer==0){
        echo 'chofer'; 
    }else{
         $tropas->editardatos($id,$ano,$fecha,$libro,$folio,$destino,$especie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$fechaedicion,$subespecie,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci);
        $historial->crear_historial($descripcion,1,1,$id);
    }
   
}
if($_POST['funcion']=='listartropas'){
    $tropas->listartropas();
    $json= array();
    foreach ($tropas->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} 
if($_POST['funcion']=='ver'){
    $id=$_POST['id'];
    $tropas->ver($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_ingresos,
            'ano'=>$objeto->ano,
            'fecha'=>$objeto->fecha,
            'libro'=>$objeto->libro,
            'folio'=>$objeto->folio,
            'destino'=>$objeto->destino,
            'especie'=>$objeto->especie,
            'raza'=>$objeto->raza,
            'cantidad'=>$objeto->cantidad,
            'kilos'=>$objeto->kilos,
            'muertos'=>$objeto->muertos,
            'caidos'=>$objeto->caidos,
            'enpie'=>$objeto->enpie,
            'kilosenpie'=>$objeto->kilosenpie,
            'conservacion'=>$objeto->conservacion,
            'vencimiento'=>$objeto->vencimiento,
            'corral'=>$objeto->corral,
            'corralero'=>$objeto->corralero,
            'matarife'=>$objeto->matarife,
            'productor'=>$objeto->productor,
            'guia'=>$objeto->guia,
            'fechaguia'=>$objeto->fechaguia,
            'dtamodal'=>$objeto->dtamodal,
            'fechadtamodal'=>$objeto->fechadtamodal,
            'numdtamodal'=>$objeto->numdtamodal,
            'dtafeedlot'=>$objeto->dtafeedlot,
            'llenarprocedencia'=>$objeto->llenarprocedencia,
            'provinciamodal'=>$objeto->provinciamodal,
            'localidadmodal'=>$objeto->localidadmodal,
            'CPmodal'=>$objeto->cpmodal,
            'llenartransporte'=>$objeto->llenartransporte,
            'llenarchofer'=>$objeto->llenarchofer,
            'dnimodal'=>$objeto->dnimodal,
            'camionmodal'=>$objeto->camionmodal,
            'habilitacionmodal'=>$objeto->habilitacionmodal,
            'horasdeviajemodal'=>$objeto->horasdeviajemodal,
            'TRImodal'=>$objeto->trimodal,
            'lavadomodal'=>$objeto->lavadomodal,
            'prescintomodal'=>$objeto->prescintomodal,
            'prescintomodalacoplado'=>$objeto->prescintomodalacoplado,
            'observacionmodal'=>$objeto->observacionmodal,
            'kiloscueromodal'=>$objeto->kiloscuerosmodal,
            'numtropas'=>$objeto->numtropas
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
} 
if($_POST['funcion']=='verprincipal'){
    $id=$_POST['id'];
    $tropas->verprincipal($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id_ingresos'=>$objeto->id_ingresos,
            'cargo'=>$objeto->cargodatos,
            'ano'=>$objeto->ano,
            'fecha'=>$objeto->fecha,
            'libro'=>$objeto->libro,
            'folio'=>$objeto->folio,
            'destino'=>$objeto->destino,
            'especie'=>$objeto->especie,
            'cantidad'=>$objeto->cantidad,
            'kilos'=>$objeto->kilos,
            'muertos'=>$objeto->muertos,
            'caidos'=>$objeto->caidos,
            'enpie'=>$objeto->enpie,
            'kilosenpie'=>$objeto->kilosenpie,
            'conservacion'=>$objeto->conservacion,
            'vencimiento'=>$objeto->vencimiento,
            'corral'=>$objeto->corral,
            'corralero'=>$objeto->corralero,
            'matarife'=>$objeto->matarife,
            'productor'=>$objeto->productor,
            'guia'=>$objeto->guia,
            'fechaguia'=>$objeto->fechaguia,
            'dtamodal'=>$objeto->dtamodal,
            'fechadtamodal'=>$objeto->fechadtamodal,
            'llenarprocedencia'=>$objeto->llenarprocedencia,
            'provinciamodal'=>$objeto->provinciamodal,
            'localidadmodal'=>$objeto->localidadmodal,
            'CPmodal'=>$objeto->cpmodal,
            'llenartransporte'=>$objeto->transporte,
            'llenarchofer'=>$objeto->llenarchofer,
            'dnimodal'=>$objeto->dnimodal,
            'habilitacionmodal'=>$objeto->habilitacionmodal,
            'horasdeviajemodal'=>$objeto->horasdeviajemodal,
            'lavadomodal'=>$objeto->lavadomodal,
            'prescintomodal'=>$objeto->prescintomodal,
            'prescintomodalacoplado'=>$objeto->prescintomodalacoplado,
            'observacionmodal'=>$objeto->observacionmodal,
            'kiloscueromodal'=>$objeto->kiloscuerosmodal,
            'numtropas'=>$objeto->numtropas,
            'subespecie'=>$objeto->subespecie,
            'digestormuertos'=>$objeto->digestormuertos,
            'digestorcaidos'=>$objeto->digestorcaidos,
            'tci'=>$objeto->tci,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='verciclos1'){
    $id=$_POST['id'];
    $tropas->verciclos1($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'cantidad'=>$objeto->cantidad1,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='verciclos2'){
    $id=$_POST['id'];
    $tropas->verciclos2($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'cantidad'=>$objeto->cantidad2,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='verclasificacion'){
    $id=$_POST['id'];
    $tropas->verclasificacion($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'subespecie'=>$objeto->subespecie,
            'cantidad'=>$objeto->enpie,
            'kilos'=>$objeto->kilosenpie

        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='vercorral'){
    $id=$_POST['id'];
    $tropas->vercorral($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'corral'=>$objeto->corral,
            'corralero'=>$objeto->corralero,
            'enpie'=>$objeto->enpie
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='verfoto'){
    $id=$_POST['id'];
    $tropas->verfoto($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='datos'){
    $id=$_POST['id'];
    $tropas->datos($id);
}
if($_POST['funcion']=='datosvalidos'){
    $id=$_POST['id'];
    $tropas->datosvalidos($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'fecha'=>$objeto->fecha,
            'edito'=>$objeto->edito
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
/*if($_POST['funcion']=='buscarlistado'){
    $checked=json_decode($_POST['json']);
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
while ($i <= $cantidad) {
    $i++;
        $tropas->buscarlistado($cantidad);
    }
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(  
        'dato'=>$objeto->dato,
        'desde'=>$objeto->desde,
        'hasta'=>$objeto->hasta
    );
}
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

}*/
if($_POST['funcion']=='crear_comienzo'){
    $id = $_POST['id'];
    $comenzar = $_POST['comenzar'];
    $tropas->crear_comienzo($id,$comenzar);
}
if($_POST['funcion']=='comparaciones'){
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $ano=$_POST['ano'];
    $tropas->comparaciones($matarife,$especie,$ano);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'numero'=>$objeto->numerotropa,
            'limite'=>$objeto->limite,
            'vigencia'=>$objeto->vigencia,
            'id'=>$objeto->id_tropas
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='asignarnuevo'){
    $id = $_POST['id'];
    $tropas->asignarnuevo($id);
}
if($_POST['funcion']=='verificar_datos'){
    $valor=$_POST['valor'];
    $tropas->verificar_datos($valor);
}
if($_POST['funcion']=='realizar_verificacion'){
    $valor=$_POST['index'];
    $tropas->verificar_datos($valor);
}
?>
