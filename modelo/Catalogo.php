<?php
include 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class Catalogo{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscar(){
        $sql="SELECT @ROW := @ROW + 1 as ID,id_ingresos,CONCAT(matarife.nombre,' ','(',submatarife.nombre,')') as matarife,numtropas,enpie as cantidad,especies.nombre as especie, subespeces.nombre as subespecies,guia,kilosenpie/enpie as promedio,enpie,corral,matarife.id_matarife as id_matarife,kilosenpie,tci FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN submatarife on matarifesub_item=id_submatarife
        join (SELECT @ROW := 0) t2
        WHERE etapa='INGRESO'";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function quedanencorral(){
        $sql="SELECT @ROW := @ROW + 1 as ID,clasificacion as subespecies,tropa as numtropas,faenas.cantidad as enpie,desde,hasta,estado,matarife,etapa,quedan,matarife.nombre as matarife,quedan,matarife.id_matarife as id_matarife FROM faenas
        join (SELECT @ROW := 0) t2
        join matarife on faenas.matarife= matarife.id_matarife
        WHERE faenas.estado='PARCIAL' and faenas.etapa='A'
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_reduccion_existe_vuelta($fecha){
        $sql="SELECT id_ingresos FROM ingresos where ano=:ano and etapa='FAENA_REDUCCION'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$fecha)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'add';
        }
        else{
          echo 'noadd';
        }
    }
    function verificar($cantidad,$especie){
        $sql="SELECT id FROM ultimo where day(fecha)=day(curdate())and month(fecha)=month(curdate()) and year(fecha)=year(curdate()) and especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
          echo 'add';
        }
        
    }
    function verificarreduccion($tropas,$fecha){
        $sql="SELECT id_reducir FROM reducir where tropa=:tropa and year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropas)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
          echo 'add';
        }
    }
    function agregar($cantidad,$fecha,$especie,$hasta){
        $sql="SELECT id FROM ultimo where fecha=:fecha and especie=:especie;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE ultimo SET cantidad=:cantidad where fecha=:fecha and especie=:especie";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':cantidad'=>$hasta,':especie'=>$especie));
            echo 'noadd';
        }
        else{
          $sql="INSERT INTO ultimo(fecha,cantidad,especie) values (:fecha,:cantidad,:especie);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':fecha'=>$fecha,':cantidad'=>$cantidad,':especie'=>$especie));
          echo 'add';
        }
    }

    function buscarid($fecha,$especie){
        $sql="SELECT id FROM ultimo where day(fecha)=day(curdate()) and especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscaridfaenas($tropa){
        $sql="SELECT id FROM faenas where  year(fecha)=year(curdate()) and etapa='A' and tropa=:tropa";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function reduccionfaena($tropas){
        $sql="SELECT * FROM reducir  where tropa=:tropa and year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropas)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function ultimoid($especie){
        $sql="SELECT cantidad FROM ultimo where day(fecha)=day(curdate()) and  month(fecha)=month(curdate()) and year(fecha)=year(curdate()) and especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verificar_especie($id_ingreso){
        $sql="SELECT especie FROM `ingresos` WHERE id_ingresos=:clasificacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':clasificacion' => $id_ingreso)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function traerdatos($cantidad,$fecha,$tropas){
        $sql="SELECT id,max(ultimo) as ultimo FROM faenas where fecha=:fecha and ultimo=:ultimo and tropa=:tropa";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':ultimo'=>$cantidad,':tropa'=>$tropas)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife,$quedan,$corral,$promedio,$dte,$nombrematarife,$kilosenpie,$tci,$id_ingreso){
        $sql="SELECT id FROM faenas where id_ingreso=:id_ingreso";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_ingreso'=>$id_ingreso)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO faenas(fecha,cantidad,tropa,desde,hasta,clasificacion,estado,seleccionado,matarife,quedan,corral,Dte,kgenpie,id_matarife,kilosenpie,tci,id_ingreso) values (:fecha,:cantidad,:tropa,:desde,:hasta,:clasificacion,:estado,:seleccionado,:id_matarife,:quedan,:corral,:dte,:promedio,:nombrematarife,:kilosenpie,:tci,:id_ingreso);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':cantidad'=>$cantidad,':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta,':clasificacion'=>$clasificacion,':estado'=>$estado,':seleccionado'=>$seleccionado,':id_matarife'=>$id_matarife,':quedan'=>$quedan,':corral'=>$corral,':promedio'=>$promedio,':dte'=>$dte,':nombrematarife'=>$nombrematarife,':kilosenpie'=>$kilosenpie,':tci'=>$tci,':id_ingreso'=>$id_ingreso));
  
          echo 'add';
        }
    }
    function crearvolver($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife){
        $sql="SELECT id FROM faenas WHERE tropa=:tropa and matarife=:id_matarife and year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa,':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE reducir SET etapa='I' WHERE tropa=:tropa and year(fecha)=year(curdate())" ;
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa));
            $sql="UPDATE ingresos SET etapa=:etapa WHERE matarife=:id_matarife and numtropas=:tropa and year(fecha)=year(curdate());";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':id_matarife'=>$id_matarife,':etapa'=>'FAENA_REDUCCION'));
            echo 'add';
        }
        else{
          
          echo 'noadd';
        }
    }
    function consultarsiexiste($tropa){
        $sql="SELECT id FROM faenas WHERE tropa=:tropa and year(fecha)=year(curdate()) and estado='PARCIAL'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'add';
        }
        else{
          echo 'noadd';
        }
    }
    
    function reemplazar($id,$cantidad,$fecha){
            $sql="UPDATE ultimo SET fecha=:fecha,cantidad=:cantidad where id=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':fecha'=>$fecha,':cantidad'=>$cantidad));
        }
        function reemplazarfaenas($id){
            $sql="UPDATE faenas SET etapa='I' where id=:id and year(fecha)=year(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
        }
        function añadirproceso($tropa,$id_matarife,$fecha,$ano,$estado){
            $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':matarife'=>$id_matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>$estado));
        }
        function reemplazarestado($id_ingreso){
            $sql="UPDATE ingresos SET etapa='FAENA' where id_ingresos=:id_ingresos";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_ingresos'=>$id_ingreso));
        echo 'reemplazado1';
        }

        function reemplazarestadoparcial($tropa){
            $sql="UPDATE ingresos SET etapa=:etapa where numtropas=:numtropas and ano=year(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':numtropas'=>$tropa,':etapa'=>'FAENA_PARCIAL'));
        echo 'reemplazado';
        }
        function reemplazarestadototalingreso($tropa){
            $sql="UPDATE ingresos SET etapa=:etapa where numtropas=:numtropas and ano=year(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':numtropas'=>$tropa,':etapa'=>'FAENA_PARCIAL'));
        echo 'reemplazado';
        }


        function reemplazarestadototal($tropa){
            $sql="UPDATE faenas SET etapa=:etapa where tropa=:tropa and year(fecha)=year(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':etapa'=>'I'));
        echo 'reemplazado';
        }
        function reemplazarestadofaenas($tropa){
            $sql="UPDATE ingresos SET etapa=:etapa where numtropas=:numtropas and year(fecha)=year(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':numtropas'=>$tropa,':etapa'=>'FAENA'));
        echo 'reemplazado';
        }


        function verificarromaneos(){
            $sql="SELECT COUNT(etapa)as cantidad FROM `ingresos` WHERE etapa='INGRESO' and ano=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function verificarcorrales(){
            $sql="SELECT corral.nombre as corral,enpie as cantidad, especies.nombre as especie,subespeces.nombre as subespecie FROM `ingresos` 
            JOIN corral on corral=id_corral
            JOIN especies on especie=id_especies_sub
            JOIN subespeces on subespecie=id_subespecies
            WHERE etapa='INGRESO' order by corral asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function verificardatosreduccion(){
            $sql="SELECT corral.nombre as corral,enpie-faenas.seleccionado as cantidad, especies.nombre as especie,subespeces.nombre as subespecie FROM `ingresos` 
            JOIN corral on corral=id_corral
            JOIN especies on especie=id_especies_sub
            JOIN subespeces on subespecie=id_subespecies
            JOIN faenas on numtropas=tropa
            WHERE ingresos.etapa='FAENA_PARCIAL' order by corral asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
            }
            else{
              echo 'noadd';
            }
        }
        function verificarcorralesreducidos(){
            $sql="SELECT corral.nombre as corral,faenas.quedan as cantidad, especies.nombre as especie,subespeces.nombre as subespecie FROM `ingresos` 
            JOIN corral on corral=id_corral
            JOIN especies on especie=id_especies_sub
            JOIN subespeces on subespecie=id_subespecies
            JOIN faenas on numtropas=tropa
            WHERE ingresos.etapa='FAENA_PARCIAL' and faenas.etapa='A' order by corral asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;            
        }

        function verificarcorralreduccion(){
            $sql="SELECT corral.nombre as corral,reduccion as cantidad,clasificacion as subespecie FROM reducir 
            JOIN corral on corral=id_corral
            order by corral asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function verificarparcialparaestado($tropa){
            $sql="SELECT * FROM ingresos WHERE numtropas=23 and ano=year(curdate()) and etapa='FAENA_PARCIAL'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
            }
            else{
              echo 'noadd';
            }
        }
      
}
?>