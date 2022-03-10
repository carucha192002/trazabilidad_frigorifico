<?php
include_once 'tropas.php';

function getHtml($checked,$especie){
$tropas = new Tropas();
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
 $contador=0;
$plantilla='

    <body>
    <header class="clearfix">
      <div id="logo">
      <img src="../img/logo.png" width="250" height="80">
      </div>
      <div id="company">
        <h2 class="name">MATADERO FRIGORIFICO REGIONAL MALARGÜE</h2>
        <div>Ruta 40 Norte KM 2951/52-MALARGÜE-Mendoza-Argentina</div>
        <div>(0260) 4470152-4472424</div>
        <div><a href="mailto:frigorifico@malargue.gov.ar">www.malargue.gov.ar</a></div>
        <div><a href="mailto:">frigorifico@malargue.gov.ar</a></div>
      </div>
      
    
    <h1>LISTADO DE MATANZA OVINOS</h1>';
       
    
      $plantilla.='
      <h4><span>Fecha y Hora: </span>'.$fecha.'</h4>
  </header>
    <main>';
    
    
    $plantilla.='
    
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">Id</th>
            <th class="no">MATARIFE</th>
            <th class="no">TROPA</th>
            <th class="no">CANT</th>
            <th class="no">CATEGORIA</th>
            <th class="no">GARRON</th>
            <th class="no">CORRAL</th>
            <th class="no">DT-e</th>
            <th class="no">KG EN PIE</th>
            <th class="no">PROMEDIO</th>
            <th class="no">KG CARNE</th>
        
          </tr>
        </thead>
        <tbody>';
        $contador=1;
        $i = 1;
        $cantidad2=0;
        $cantidad3=0;
        foreach ($checked as $prod) {
            $cantidad = $prod->id; 
            $tropas->buscarlistado($cantidad,$especie);
        foreach ($tropas->objetos as $objeto) {
          $cantidad2=$objeto->seleccionado;
          $cantidad3+=$cantidad2;
          
            $plantilla.='<tr text-center>
            <td class="no">'.$contador++.'</td>
              <td class="no">'.$objeto->id_matarife.'</td>
              <td class="no">'.$objeto->tropa.'</td>
              <td class="no">'.$objeto->seleccionado.'</td>
              <td class="no">'.$objeto->clasificacion.'</td>
              <td class="no">'.$objeto->garron.'</td>
              <td class="no">'.$objeto->corral.'</td>
              <td class="no">'.$objeto->dta.'</td>
              <td class="no">'.$objeto->kilosenpie.'</td>
              <td class="no"></td>
              <td class="no"></td>
                          
              
            </tr>';
      }
    }
        $plantilla.='
        
        <tr>
          <td colspan="8" class="grand total"></td>
          <td class="grand total"></td>
        </tr>
        <tr>
          <td colspan="8" class="grand total"></td>
          <td class="grand total"></td>
        </tr>
        <tr>
          <td colspan="8" class="grand total">TOTAL DE ANIMALES</td>
          <td class="grand total">'.$cantidad3.'</td>
          
        </tr>';
         $plantilla.='
         </tbody>
         </table>
         <div id="thanks"></div>
    </main>
    <footer>
      MATADERO FRIGORIFICO REGIONAL MALARGÜE
    </footer>
  </body>';
    return $plantilla;
}
  

