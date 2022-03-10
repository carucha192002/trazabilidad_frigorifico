<?php
include_once 'conexion.php';
class Tropas{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($matarife,$procedencia,$especie,$vigencia,$desde,$cantidad,$hasta,$ano,$avatar){
        $sql="SELECT id_tropas FROM tropas where matarife=:matarife and procedencia=:procedencia and especie=:especie and vigencia=:vigencia";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':procedencia'=>$procedencia,':especie'=>$especie,':vigencia'=>$vigencia)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO tropas(matarife,procedencia,especie,vigencia,desde,cantidad,hasta,avatar,ano) values (:matarife,:procedencia,:especie,:vigencia,:desde,:cantidad,:hasta,:avatar,:ano);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':matarife'=>$matarife,':procedencia'=>$procedencia,':especie'=>$especie,':vigencia'=>$vigencia,':desde'=>$desde,':cantidad'=>$cantidad,':hasta'=>$hasta,':avatar'=>$avatar,':ano'=>$ano));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT id_tropas, matarife.nombre as matarife,procedencia.nombre as procedencia, especies.nombre as especiesanimal,vigencia,desde,tropas.cantidad as cantidad,hasta,tropas.avatar as avatar FROM tropas 
           join matarife on matarife=id_matarife 
           join procedencia on procedencia=id_procedencia
           join especies on especie=id_especies_sub 
           where visibilidad='A' and matarife.nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especiesanimal,vigencia,desde,tropas.cantidad as cantidad,hasta,tropas.avatar as avatar FROM tropas
          join matarife on matarife=id_matarife
          join procedencia on procedencia=id_procedencia
          join especies on especie=id_especies_sub where visibilidad='A' and  matarife NOT LIKE '' ORDER BY id_tropas LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($matarife,$id_editado,$procedencia,$especie,$vigencia,$desde,$cantidad,$hasta){
        $sql="UPDATE tropas SET matarife=:matarife,procedencia=:procedencia,especie=:especie,vigencia=:vigencia,desde=:desde,cantidad=:cantidad,hasta=:hasta where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':matarife'=>$matarife,':procedencia'=>$procedencia,':especie'=>$especie,':vigencia'=>$vigencia,':desde'=>$desde,':cantidad'=>$cantidad,':hasta'=>$hasta));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM tropas where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE tropas SET avatar=:nombre where id_tropas=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
        function ver_borrados(){
            $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especiesanimal,vigencia,desde,tropas.cantidad as cantidad,hasta,tropas.avatar as avatar FROM tropas
            join matarife on matarife=id_matarife
            join procedencia on procedencia=id_procedencia
            join especies on especie=id_especies_sub where visibilidad=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>'I'));
            $this->objetos = $query->fetchall();
            return $this->objetos;
            }
 function borrar($id){
        $sql="UPDATE tropas SET visibilidad=:estado where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':estado'=>'I'));
        if(!empty($query->execute(array(':id'=>$id,':estado'=>'I')))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function agregar_nuevo($id){
        $sql="UPDATE tropas SET visibilidad=:estado where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':estado'=>'I'));
        if(!empty($query->execute(array(':id'=>$id,':estado'=>'A')))){
            echo 'agregado';
        }
        else{
            echo 'no agregado';
        }
    }
    function rellenar_desdetropas(){
        $sql="SELECT max(hasta) as desdetropas FROM tropas";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_listados(){
        $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especies,vigencia,desde,tropas.cantidad as cantidad,hasta,usados,tropas.cantidad-usados as limite FROM tropas
        join matarife on matarife=id_matarife
        join procedencia on procedencia=id_procedencia
        join especies on especie=id_especies_sub
        where visibilidad='A'";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_tropas($id){
        $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especies,vigencia,desde,tropas.cantidad as cantidad,hasta FROM tropas
        join matarife on matarife=id_matarife
        join procedencia on procedencia=id_procedencia
        join especies on especie=id_especies_sub where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_tropastodas(){
        $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especies,vigencia,desde,tropas.cantidad as cantidad,hasta FROM tropas
        join matarife on matarife=id_matarife
        join procedencia on procedencia=id_procedencia
        join especies on especie=id_especies_sub
        where visibilidad='A'";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function comprobar($matarife,$especie){
        $sql="SELECT min(desde) as numerotropa,usados FROM `tropas` WHERE  matarife=:matarife and especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function comprobartropas($matarife,$especie){
        $sql="SELECT min(desde)+usados  as numerotropa,cantidad-usados as limite FROM `tropas` WHERE  matarife=:matarife and especie=:especie and vigencia>year(curdate()) and visibilidad='A' and cantidad-usados>0";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function comparaciones($matarife,$especie,$ano){
        $sql="SELECT min(desde)+usados  as numerotropa,cantidad-usados as limite,vigencia-year(curdate()) as vigencia,id_tropas FROM `tropas` WHERE  matarife=:matarife and especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verificar_datos($valor){
        $sql="SELECT id_tropas FROM `tropas` WHERE desde=:desde";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':desde'=>$valor)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo "no";
        }else{
            echo "si";
        }
    }
    function verificar_datos1($valor){
        $sql="SELECT id_tropas FROM `tropas` WHERE desde=:desde";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':desde'=>$valor)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo "no";
        }
       
    }
    function comprobarano($matarife,$especie){
        $sql="SELECT ano FROM `tropas` WHERE  matarife=:matarife and especie=:especie and vigencia>year(curdate()) and visibilidad='A' and cantidad-usados>0";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo "1";
        }else{
            echo "0";
        }
    }
  
    function guardar($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci){
        $sql="INSERT INTO ingresos(ano,fecha,libro,folio,destino,especie,subespecie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,digestormuertos,digestorcaidos,matarifesub_item,tci) values (:ano,:fecha,:libro,:folio,:destino,:especie,:subespecie,:cantidad,:kilos,:muertos,:caidos,:enpie,:kilosenpie,:conservacion,:vencimiento,:corral,:corralero,:matarife,:productor,:guia,:fechaguia,:dtamodal,:fechadtamodal,:llenarprocedencia,:provinciamodal,:localidadmodal,:CPmodal,:llenartransporte,:llenarchofer,:dnimodal,:habilitacionmodal,:horasdeviajemodal,:lavadomodal,:prescintomodal,:prescintomodalacoplado,:observacionmodal,:kiloscuerosmodal,:numtropas,:cargodatos,:digestormuertos,:digestorcaidos,:matarifesub_item,:tci);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':subespecie'=>$subespecie,':cantidad'=>$cantidad,':kilos'=>$kilos,':muertos'=>$muertos,':caidos'=>$caidos,':enpie'=>$enpie,':kilosenpie'=>$kilosenpie,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
        ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':cargodatos'=>$cargo,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
        $sql="UPDATE tropas SET usados=usados+1  WHERE  matarife=:matarife and especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie)); 
        $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$numtropas,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'INGRESO'));        
    
    }
    function guardar1($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie1,$cantidad1,$kilos1,$muertos1,$caidos1,$enpie1,$kilosenpie1,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci){
        $sql="INSERT INTO ingresos(ano,fecha,libro,folio,destino,especie,subespecie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,digestormuertos,digestorcaidos,matarifesub_item,tci) values (:ano,:fecha,:libro,:folio,:destino,:especie,:subespecie,:cantidad,:kilos,:muertos,:caidos,:enpie,:kilosenpie,:conservacion,:vencimiento,:corral,:corralero,:matarife,:productor,:guia,:fechaguia,:dtamodal,:fechadtamodal,:llenarprocedencia,:provinciamodal,:localidadmodal,:CPmodal,:llenartransporte,:llenarchofer,:dnimodal,:habilitacionmodal,:horasdeviajemodal,:lavadomodal,:prescintomodal,:prescintomodalacoplado,:observacionmodal,:kiloscuerosmodal,:numtropas,:cargodatos,:digestormuertos,:digestorcaidos,:matarifesub_item,:tci);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':subespecie'=>$subespecie1,':cantidad'=>$cantidad1,':kilos'=>$kilos1,':muertos'=>$muertos1,':caidos'=>$caidos1,':enpie'=>$enpie1,':kilosenpie'=>$kilosenpie1,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
        ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':cargodatos'=>$cargo,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
        $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$numtropas,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'INGRESO'));        
    
    }
    function guardar2($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie2,$cantidad2,$kilos2,$muertos2,$caidos2,$enpie2,$kilosenpie2,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci){
        $sql="INSERT INTO ingresos(ano,fecha,libro,folio,destino,especie,subespecie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,digestormuertos,digestorcaidos,matarifesub_item,tci) values (:ano,:fecha,:libro,:folio,:destino,:especie,:subespecie,:cantidad,:kilos,:muertos,:caidos,:enpie,:kilosenpie,:conservacion,:vencimiento,:corral,:corralero,:matarife,:productor,:guia,:fechaguia,:dtamodal,:fechadtamodal,:llenarprocedencia,:provinciamodal,:localidadmodal,:CPmodal,:llenartransporte,:llenarchofer,:dnimodal,:habilitacionmodal,:horasdeviajemodal,:lavadomodal,:prescintomodal,:prescintomodalacoplado,:observacionmodal,:kiloscuerosmodal,:numtropas,:cargodatos,:digestormuertos,:digestorcaidos,:matarifesub_item,:tci);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':subespecie'=>$subespecie2,':cantidad'=>$cantidad2,':kilos'=>$kilos2,':muertos'=>$muertos2,':caidos'=>$caidos2,':enpie'=>$enpie2,':kilosenpie'=>$kilosenpie2,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
        ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':cargodatos'=>$cargo,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
        $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$numtropas,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'INGRESO'));        
    
    }
    function guardar3($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie3,$cantidad3,$kilos3,$muertos3,$caidos3,$enpie3,$kilosenpie3,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci){
        $sql="INSERT INTO ingresos(ano,fecha,libro,folio,destino,especie,subespecie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,digestormuertos,digestorcaidos,matarifesub_item,tci) values (:ano,:fecha,:libro,:folio,:destino,:especie,:subespecie,:cantidad,:kilos,:muertos,:caidos,:enpie,:kilosenpie,:conservacion,:vencimiento,:corral,:corralero,:matarife,:productor,:guia,:fechaguia,:dtamodal,:fechadtamodal,:llenarprocedencia,:provinciamodal,:localidadmodal,:CPmodal,:llenartransporte,:llenarchofer,:dnimodal,:habilitacionmodal,:horasdeviajemodal,:lavadomodal,:prescintomodal,:prescintomodalacoplado,:observacionmodal,:kiloscuerosmodal,:numtropas,:cargodatos,:digestormuertos,:digestorcaidos,:matarifesub_item,:tci);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':subespecie'=>$subespecie3,':cantidad'=>$cantidad3,':kilos'=>$kilos3,':muertos'=>$muertos3,':caidos'=>$caidos3,':enpie'=>$enpie3,':kilosenpie'=>$kilosenpie3,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
        ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':cargodatos'=>$cargo,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
        $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$numtropas,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'INGRESO'));        
    
    }
    function guardar4($ano,$fecha,$libro,$folio,$destino,$especie,$subespecie4,$cantidad4,$kilos4,$muertos4,$caidos4,$enpie4,$kilosenpie4,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci){
        $sql="INSERT INTO ingresos(ano,fecha,libro,folio,destino,especie,subespecie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,digestormuertos,digestorcaidos,matarifesub_item,tci) values (:ano,:fecha,:libro,:folio,:destino,:especie,:subespecie,:cantidad,:kilos,:muertos,:caidos,:enpie,:kilosenpie,:conservacion,:vencimiento,:corral,:corralero,:matarife,:productor,:guia,:fechaguia,:dtamodal,:fechadtamodal,:llenarprocedencia,:provinciamodal,:localidadmodal,:CPmodal,:llenartransporte,:llenarchofer,:dnimodal,:habilitacionmodal,:horasdeviajemodal,:lavadomodal,:prescintomodal,:prescintomodalacoplado,:observacionmodal,:kiloscuerosmodal,:numtropas,:cargodatos,:digestormuertos,:digestorcaidos,:matarifesub_item,:tci);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':subespecie'=>$subespecie4,':cantidad'=>$cantidad4,':kilos'=>$kilos4,':muertos'=>$muertos4,':caidos'=>$caidos4,':enpie'=>$enpie4,':kilosenpie'=>$kilosenpie4,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
        ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':cargodatos'=>$cargo,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
        $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$numtropas,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'INGRESO'));        
    
    }
    function editardatos($id,$ano,$fecha,$libro,$folio,$destino,$especie,$cantidad,$kilos,$muertos,$caidos,$enpie,$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargo,$fechaedicion,$subespecie,$digestormuertos,$digestorcaidos,$matarifesub_item,$tci){
        $sql="UPDATE ingresos SET ano=:ano,fecha=:fecha,libro=:libro,folio=:folio,destino=:destino,especie=:especie,subespecie=:subespecie,cantidad=:cantidad,kilos=:kilos,muertos=:muertos,caidos=:caidos,enpie=:enpie,kilosenpie=:kilosenpie,conservacion=:conservacion,vencimiento=:vencimiento,corral=:corral,corralero=:corralero,matarife=:matarife,productor=:productor,guia=:guia,fechaguia=:fechaguia,dtamodal=:dtamodal,fechadtamodal=:fechadtamodal,llenarprocedencia=:llenarprocedencia,provinciamodal=:provinciamodal,localidadmodal=:localidadmodal,CPmodal=:CPmodal,llenartransporte=:llenartransporte,llenarchofer=:llenarchofer,dnimodal=:dnimodal,habilitacionmodal=:habilitacionmodal,horasdeviajemodal=:horasdeviajemodal,lavadomodal=:lavadomodal,prescintomodal=:prescintomodal,prescintomodalacoplado=:prescintomodalacoplado,observacionmodal=:observacionmodal,kiloscuerosmodal=:kiloscuerosmodal,numtropas=:numtropas,edito=:edito,fechaeditar=:fechaeditar,digestormuertos=:digestormuertos,digestorcaidos=:digestorcaidos,matarifesub_item=:matarifesub_item,tci=:tci WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':cantidad'=>$cantidad,':kilos'=>$kilos,':muertos'=>$muertos,':caidos'=>$caidos,':enpie'=>$enpie,':kilosenpie'=>$kilosenpie,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
        ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':edito'=>$cargo,':fechaeditar'=>$fechaedicion,':subespecie'=>$subespecie,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
        echo 'add';       
    
    }
    function listartropas(){
        $sql="SELECT id_ingresos as id,fecha,concat(matarife.nombre,' ','(',submatarife.nombre,')')as matarife,numtropas as tropa,procedencia.nombre as procedencia,especies.nombre as especie,subespeces.nombre as subespecie, productor.nombre as productor, guia,tci, etapa FROM `ingresos` JOIN procedencia on llenarprocedencia=id_procedencia JOIN especies on especie=id_especies_sub JOIN matarife on matarife=id_matarife JOIN submatarife on matarifesub_item=id_submatarife join subespeces on subespecie=id_subespecies JOIN productor on productor=id_productor WHERE ingresos.estado='A' order by id_ingresos desc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function vertropas($id){
        $sql="SELECT id_ingresos as id,fecha,ano,numtropas as tropa,procedencia.nombre as procedencia,especies.nombre as especie, matarife.nombre as matarife, productor.nombre as productor, guia,dtamodal as dta,muertos,caidos,enpie,kilosenpie,corral,corraleros.nombre as corralero, transporte.nombre as transporte,chofer.nombre as chofer,habilitacionmodal as habilitacion,observacionmodal as observacion,ingresos.cantidad as cantidad, submatarife.nombre as submatarife FROM `ingresos`
        JOIN procedencia on llenarprocedencia=id_procedencia
        JOIN especies on especie=id_especies
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        join corraleros on corralero=id_corraleros
        join transporte on llenartransporte=id_transporte
        JOIN submatarife on matarifesub_item=id_submatarife
        join chofer on llenarchofer=id_chofer WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function ver($id){
        $sql="SELECT * FROM `ingresos` WHERE  id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verprincipal($id){
        $sql="SELECT id_ingresos,ano,fecha,libro,folio,destino.nombre as destino,especies.nombre as especie,ingresos.cantidad as cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion.nombre as conservacion,vencimiento,corral.nombre as corral,corraleros.nombre as corralero,Concat(matarife.nombre,' ','(',submatarife.nombre,')') as matarife, productor.nombre as productor,guia,fechaguia,dtamodal,fechadtamodal,procedencia.nombre as llenarprocedencia,provincias.nombre as provinciamodal,localidades.nombre as localidadmodal,CPmodal,transporte.nombre as transporte,chofer.nombre as llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,subespeces.nombre as subespecie,digestormuertos,digestorcaidos,tci  FROM `ingresos` 
        JOIN destino on destino=id_destino
        JOIN especies on especie=id_especies
        JOIN conservacion on conservacion=id_conservacion
        JOIN corral on corral=id_corral
        JOIN corraleros on corralero=id_corraleros
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN procedencia on llenarprocedencia=id_procedencia
        JOIN provincias on provinciamodal=id_provincia
        JOIN localidades on localidadmodal=id
        JOIN transporte on llenartransporte=id_transporte
        JOIN chofer on llenarchofer=id_chofer 
        JOIN subespeces on subespecie=id_subespecies
        JOIN submatarife on matarifesub_item = id_submatarife
        WHERE ingresos.id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

    function verclasificacion($id){
        $sql="SELECT subespeces.nombre as subespecie,enpie,kilosenpie FROM ingresos 
        JOIN subespeces on subespecie=id_subespecies
        where id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function vercorral($id){
        $sql="SELECT id_ingresos,ano,fecha,libro,folio,destino.nombre as destino,especies.nombre as especie,ingresos.cantidad as cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral.nombre as corral,corraleros.nombre as corralero,matarife.nombre as matarife, productor.nombre as productor,guia,fechaguia,dtamodal,fechadtamodal,procedencia.nombre as llenarprocedencia,provincias.nombre as provinciamodal,localidades.nombre as localidadmodal,CPmodal,transporte.nombre as llenartransporte,chofer.nombre as llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas FROM `ingresos` 
        JOIN destino on destino=id_destino
        JOIN especies on especie=id_especies
        JOIN corral on corral=id_corral
        JOIN corraleros on corralero=id_corraleros
        join matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN procedencia on llenarprocedencia=id_procedencia
        join provincias on provinciamodal=id_provincia
        JOIN localidades on localidadmodal=id
        JOIN transporte on llenartransporte=id_transporte
        JOIN chofer on llenarchofer=id_chofer
        WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verfoto($id){
        $sql="SELECT cargodatos,CONCAT(usuario.nombre_us,' ',usuario.apellidos_us)as nombre,avatar From ingresos 
        JOIN usuario on cargodatos=id_usuario
        WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datos($id){
        $sql="SELECT fechaeditar as fecha,CONCAT(usuario.nombre_us,' ',usuario.apellidos_us)as edito From ingresos 
        JOIN usuario on edito=id_usuario WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
        echo '1';
        }else{
            echo '0';
        }
        
    }
    function datosvalidos($id){
        $sql="SELECT fechaeditar as fecha,CONCAT(usuario.nombre_us,' ',usuario.apellidos_us)as edito From ingresos 
        JOIN usuario on edito=id_usuario WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
        
    }
    function marcador($id_ingresos){
        $sql="SELECT etapa as marcador FROM `ingresos` where id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }  
    function buscarlistado($cantidad,$especie){
        $sql="SELECT id_matarife,tropa,seleccionado,clasificacion,concat(desde,'-',hasta) as garron,corral.numero as corral,Dte as dta,faenas.kilosenpie as kilosenpie FROM `faenas` 
        JOIN corral on corral=id_corral
        JOIN ingresos on id_ingreso=id_ingresos
       WHERE id_ingreso=:id AND ingresos.especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$cantidad,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
           
    } 
  
    function crear_comienzo($id,$comenzar){
        $sql="SELECT id_tropas FROM tropas where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE tropas SET usados=:usados where id_tropas=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':usados'=>$comenzar,':id'=>$id));
          echo 'add';
        }
        else{
            echo 'noadd';
        }
    }
    function asignarnuevo($id){
        $sql="UPDATE tropas SET visibilidad='I' where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'creado';

        }
        else{
            echo 'no creado';
        }
    }
    function verciclos1($id){
        $sql="SELECT cantidad1 FROM `ingresos` WHERE cantidad1>0 and id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }  
    function verciclos2($id){
        $sql="SELECT cantidad2 FROM `ingresos` WHERE cantidad2>0 and id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
}

?>