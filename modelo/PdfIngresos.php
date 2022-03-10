<?php
include_once 'tropas.php';

function getHtml($id){
  
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
    $tropas = new tropas();
    $tropas->vertropas($id);
    $plantilla='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="250" height="80">
      </div>
      <h1>INGRESOS DE TROPAS</h1>
      <div id="company" class="clearfix">
        <div id="negocio">Municipalidad de Malargüe</div>
        <div>Ruta 40 Norte Km 2951/52-MALARGÜE,<br /> Mendoza, Argentina</div>
        <div>(0260) 4470152-4472424</div>
        <div><a href="mailto:frigorifico@malargue.gov.ar">frigorifico@malargue.gov.ar</a></div>
        <div><a href="mailto:www.malargue.gov.ar">www.malargue.gov.ar</a></div>
      </div>';

      
      foreach ($tropas->objetos as $objeto) {
    
        $plantilla.='
        <div id="project">
          <div><span>Fecha y Hora: </span>'.$fecha.'</div>
          <div><span>Procedencia: </span>'.$objeto->procedencia.'</div>
          <div><span>Matarife:</span>'.$objeto->matarife.' '.'('.$objeto->submatarife.')'.'</div>
          <div><span>Especie: </span>'.$objeto->especie.'</div>
          <div><span>Productor: </span>'.$objeto->productor.'</div>
          <div><span>Guia:</span>'.$objeto->guia.'</div>
          <div><span>DTA: </span>'.$objeto->dta.'</div>
        </div>';
        }
        $plantilla.='
    </header>
    <main>
      <table>
        <thead>
        <tr>
           
        <th class="service">Cantidad</th>
        <th class="service">Muertos</th>
        <th class="service">Caidos</th>
        <th class="service">En Pie</th>
        <th class="service">Kilos en pie</th>
        <th class="service">Corral</th>
        <th class="service">Corralero</th>
        
      </tr>
    </thead>
    <tbody>';
    foreach ($tropas->objetos as $objeto) {
     
      $plantilla.='<tr>
        <td class="servic">'.$objeto->cantidad.'</td>
        <td class="servic">'.$objeto->muertos.'</td>
        <td class="servic">'.$objeto->caidos.'</td>
        <td class="servic">'.$objeto->enpie.'</td>
        <td class="servic">'.$objeto->kilosenpie.'</td>
        <td class="servic">'.$objeto->corral.'</td>
        <td class="servic">'.$objeto->corralero.'</td>
        
      </tr>';


        }
       $plantilla.='
        </tbody>
      </table>
    </main>';
    $plantilla.='
    </header>
    <main>
      <table>
        <thead>
        <tr>
           
            <th class="service">Transporte</th>
            <th class="service">Chofer</th>
            
            <th class="service">Habilitacion</th>
            <th class="service">Observacion</th>
  
            
          </tr>
        </thead>
        <tbody>';
        foreach ($tropas->objetos as $objeto) {
         
          $plantilla.='<tr>
            <td class="servic">'.$objeto->transporte.'</td>
            <td class="servic">'.$objeto->chofer.'</td>
            <td class="servic">'.$objeto->habilitacion.'</td>
            <td class="servic">'.$objeto->observacion.'</td>

            
          </tr>';



        }
       $plantilla.='
        </tbody>
      </table>
    </main>';
    
    $plantilla.='

    <footer>
    MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
    </footer>
  </body>';
    return $plantilla;
}