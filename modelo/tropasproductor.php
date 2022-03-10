<?php
include 'conexion.php';
class TropasProductor{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT id_tropas, matarife.nombre as matarife,procedencia.nombre as procedencia, especies.nombre as especiesanimal,vigencia,desde,cantidad,hasta,tropas.avatar as avatar FROM tropas 
           join matarife on matarife=id_matarife 
           join procedencia on procedencia=id_procedencia
           join especies on especie=id_especies 
           where matarife.nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especiesanimal,vigencia,desde,cantidad,hasta,tropas.avatar as avatar FROM tropas
          join matarife on matarife=id_matarife
          join procedencia on procedencia=id_procedencia
          join especies on especie=id_especies where matarife NOT LIKE '' ORDER BY id_tropas LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
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
        $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especies,vigencia,desde,cantidad,hasta FROM tropas
        join matarife on matarife=id_matarife
        join procedencia on procedencia=id_procedencia
        join especies on especie=id_especies";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_tropas($id){
        $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especies,vigencia,desde,cantidad,hasta FROM tropas
        join matarife on matarife=id_matarife
        join procedencia on procedencia=id_procedencia
        join especies on especie=id_especies where id_tropas=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_tropastodas(){
        $sql="SELECT id_tropas,matarife.nombre as matarife, procedencia.nombre as procedencia, especies.nombre as especies,vigencia,desde,cantidad,hasta FROM tropas
        join matarife on matarife=id_matarife
        join procedencia on procedencia=id_procedencia
        join especies on especie=id_especies";
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
    function id_matarife($id){
        $sql="SELECT id_matarife FROM usuario WHERE  id_usuario=:id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function comprobartropas($matarife,$especie,$ano){
        $sql="SELECT min(desde)+usados  as numerotropa FROM `tropas` WHERE  matarife=:matarife and especie=:especie and ano=:ano";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie,':ano'=>$ano)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function comprobarano($matarife,$especie,$ano){
        $sql="SELECT ano FROM `tropas` WHERE  matarife=:matarife and especie=:especie and ano=:ano";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':matarife'=>$matarife,':especie'=>$especie,':ano'=>$ano)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo "1";
        }else{
            echo "0";
        }
    }
    function listartropas($id){
        $sql="SELECT  ingresos.cantidad as cantidad,id_ingresos as id,fecha,ano,numtropas as tropa,procedencia.nombre as procedencia,especies.nombre as especie, matarife.nombre as matarife, productor.nombre as productor, guia,dtamodal as dta FROM `ingresos`
        JOIN procedencia on llenarprocedencia=id_procedencia
        JOIN especies on especie=id_especies
        JOIN matarife on matarife=id_matarife
        JOIN usuario on matarife=usuario.id_matarife
        JOIN productor on productor=id_productor WHERE estado='A' and usuario.id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function vertropas($id){
        $sql="SELECT id_ingresos as id,fecha,ano,numtropas as tropa,procedencia.nombre as procedencia,especies.nombre as especie, matarife.nombre as matarife, productor.nombre as productor, guia,dtamodal as dta,muertos,caidos,enpie,kilosenpie,corral,corraleros.nombre as corralero, transporte.nombre as transporte,chofer.nombre as chofer,habilitacionmodal as habilitacion,observacionmodal as observacion,cantidad FROM `ingresos`
        JOIN procedencia on llenarprocedencia=id_procedencia
        JOIN especies on especie=id_especies
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        join corraleros on corralero=id_corraleros
        join transporte on llenartransporte=id_transporte
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
        $sql="SELECT id_ingresos,ano,fecha,libro,folio,destino.nombre as destino,especies.nombre as especie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion.nombre as conservacion,vencimiento,corral.nombre as corral,corraleros.nombre as corralero,matarife.nombre as matarife, productor.nombre as productor,guia,fechaguia,dtamodal,fechadtamodal,procedencia.nombre as llenarprocedencia,provincias.nombre as provinciamodal,localidades.nombre as localidadmodal,CPmodal,transporte.nombre as transporte,chofer.nombre as llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,subespeces.nombre as subespecie,digestormuertos,digestorcaidos  FROM `ingresos` 
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
        $sql="SELECT id_ingresos,ano,fecha,libro,folio,destino.nombre as destino,especies.nombre as especie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral.nombre as corral,corraleros.nombre as corralero,matarife.nombre as matarife, productor.nombre as productor,guia,fechaguia,dtamodal,fechadtamodal,procedencia.nombre as llenarprocedencia,provincias.nombre as provinciamodal,localidades.nombre as localidadmodal,CPmodal,transporte.nombre as llenartransporte,chofer.nombre as llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas FROM `ingresos` 
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
    function verificarcorrales($id){
        $sql="SELECT corral.nombre as corral,enpie as cantidad, especies.nombre as especie,subespeces.nombre as subespecie FROM `ingresos` 
        JOIN corral on corral=id_corral
        JOIN especies on especie=id_especies
        JOIN subespeces on subespecie=id_subespecies
        WHERE etapa='INGRESO'and matarife=:id order by corral asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>