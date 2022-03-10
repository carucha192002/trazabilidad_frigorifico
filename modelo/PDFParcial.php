<?php
include_once 'Parcial.php';

function getHtml($id){
  
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
    $Parcial = new Parcial();
    $Parcial->buscarpdf($id);
    $plantilla='

    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="250" height="80">
      </div>
      <h1>Parcial INTERNO DE MATANZA</h1>
      <div id="company" class="clearfix">
      <h2 class="name">MATADERO FRIGORIFICO MALARGÜE</h2>
      <div>Ruta 40 Norte KM 2951/52-MALARGÜE-Mendoza-Argentina</div>
      <div>(0260) 4470152-4472424</div>
      <div><a href="mailto:frigorifico@malargue.gov.ar">www.malargue.gov.ar</a></div>
      <div><a href="mailto:">frigorifico@malargue.gov.ar</a></div>
      
      </div>';
      
      foreach ($Parcial->objetos as $objeto) {
    
        $plantilla.='
        <div id="project">
          <div><span>Fecha y Hora: </span>'.$fecha.'</div>
          <div><span>MATARIFE: </span>'.$objeto->matarife.'</div>
          <div><span>PRODUCTOR:</span>'.$objeto->productor.'</div>
          <div><span>TROPA: </span>'.$objeto->numtropas.'</div>
          <div><span>DTE Nº: </span>'.$objeto->guia.'</div>
          <div><span>DESTINO:</span>'.$objeto->destino.'</div>
          <h1 style="text-transform:uppercase">ESPECIE: '.$objeto->especie.'</h1>
          </div>';
        
        }
        $plantilla.='
    </header>
    <main>
      <table>
        <thead>
          <tr>
           
            <th class="service">Id</th>
            <th class="service">Clsificacion</th>
            <th class="service">Cantidad</th>
            <th class="service">DES/HAS</th>
            <th class="service">Corral</th>
            <th class="service">Promedio</th>
            <th class="service">Estado</th>
            
          </tr>
        </thead>
        <tbody>';
        foreach ($Parcial->objetos as $objeto) {
         
          $plantilla.='<tr>
            <td class="servic">'.$objeto->id_ingresos.'</td>
            <td class="servic">'.$objeto->subespecies.'</td>
            <td class="servic">'.$objeto->enpie.'</td>
            <td class="servic">'.$objeto->garron.'</td>
            <td class="servic">'.$objeto->corral.'</td>
            <td class="servic">'.$objeto->promedio.'</td>
            <td class="servic">'.$objeto->totalidad.'</td>
            
          </tr>';


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