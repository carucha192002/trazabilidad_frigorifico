<?php
include_once 'Observacion.php';

function getHtml($id){
  
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
    $observacion = new Observacion();
    $observacion1 = new Observacion();
    $observacion->buscarpdf($id);
    $observacion1->buscardatos($id);
 
    $plantilla='

    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="250" height="80">
      </div>
      <h1>OBSERVACIONES</h1>
      <div id="company" class="clearfix">
      <h2 class="name">MATADERO FRIGORIFICO REGIONAL MALARGÜE</h2>
      <div>Ruta 40 Norte KM 2951/52-MALARGÜE-Mendoza-Argentina</div>
      <div>(0260) 4470152-4472424</div>
      <div><a href="mailto:frigorifico@malargue.gov.ar">www.malargue.gov.ar</a></div>
      <div><a href="mailto:">frigorifico@malargue.gov.ar</a></div>
    
      </div>';
      
      
      foreach ($observacion->objetos as $objeto) {
    
        $plantilla.='
        <div id="project">
          <div><span>Fecha y Hora: </span>'.$fecha.'</div>
          <div><span>MATARIFE: </span>'.$objeto->matarife.'</div>
          <div><span>PRODUCTOR:</span>'.$objeto->productor.'</div>
          <div><span>TROPA: </span>'.$objeto->tropa.'</div>
          <div><span>DTE Nº: </span>'.$objeto->dte.'</div>
          <div><span>Fecha Faena:</span>'.$objeto->fechafaena.'</div>
          <h1 style="text-transform:uppercase">ESPECIE: '.$objeto->especie.'</h1>
          </div>';
        
        }
        $plantilla.='
    </header>
    <main>';
 
        foreach ($observacion1->objetos as $objeto) {
         
          $plantilla.='          
          <div class="col-sm-12">
          <div class="card">
          <div class="card-body">
              <div class="row">
              <div align="center" class="col-sm-12">
                  <img src="../img/observacion/'.$objeto->foto.'" class="img-fluid" alt="">
                  <br></br>
              </div>
              <div align="center" class="col-sm-12">
                  <span align="center" class="text-muted">OBSERVACIONES: '.$objeto->descripcion.'</span></br>
                  <h6 align="center" class="badge bg-success">FECHA: '.$objeto->fecha.'</h6></br>
                  </br>
                
                  </div>
              </div>
          </div>
          </div>
      </div>';
        }
     
      $plantilla.='
      
        </tbody>
      </table>
     
    <footer>
    MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
    </footer>
  </body>';
    return $plantilla;
}