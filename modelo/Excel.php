<?php
include 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class Excel{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function reporte_excel($id){
        $sql="SELECT faenados.garron as garron,faenados.peso as peso,faenados.ano as ano,destino.nombre as destino,numtropas,faenados.fechacsv as fechacsv,faenados.numespecie, faenados.codigocsv as codigocsv,faenados.camara as camara,faenados.despiece as despiece,faenados.destinocsv as destinocsv FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on id_ingresos=faenas.id_ingreso
         JOIN faenados on id_ingresos=faenados.id_ingreso
        WHERE ingresos.etapa='FINALIZADO' and id_ingresos=:id GROUP by(faenados.garron)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }


       
}
?>