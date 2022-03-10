<?php
include_once 'informe.php';

function getHtmlinforme($id,$desde,$hasta){
  $informe = new Informe();
  $informe1 = new Informe();
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
   
    $informe->listar_busqueda_comun($id,$desde,$hasta);
    $informe1->sumas_comun($id,$desde,$hasta);
    $total=$informe1->objetos[0]->cantidad;
 
    $plantilla='

    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="250" height="80">
      </div>
      <h1>REPORTE DE MATANZA</h1>
      <div id="company" class="clearfix">
      <h2 class="name">MATADERO FRIGORIFICO REGIONAL MALARGÜE</h2>
      <div>Ruta 40 Norte KM 2951/52-MALARGÜE-Mendoza-Argentina</div>
      <div>(0260) 4470152-4472424</div>
      <div><a href="mailto:frigorifico@malargue.gov.ar">www.malargue.gov.ar</a></div>
      <div><a href="mailto:">frigorifico@malargue.gov.ar</a></div>
    
      </div>';
      
        $plantilla.='
    </header>
    <main>
      <table>
        <thead>
          <tr>
           
            <th class="service">Id</th>
            <th class="service">Fecha</th>
            <th class="service">Tropa</th>
            <th class="service">Dte</th>
            <th class="service">Matarife</th>
            <th class="service">Clasificacion</th>
            <th class="service">Desde</th>
            <th class="service">Hasta</th>
            <th class="service">Cantidad</th>
            
          </tr>
        </thead>
        <tbody>';
        foreach ($informe->objetos as $objeto) {
          $plantilla.='<tr>
            <td class="servic">'.$objeto->id.'</td>
            <td class="servic">'.$objeto->fecha.'</td>
            <td class="servic">'.$objeto->tropa.'</td>
            <td class="servic">'.$objeto->dte.'</td>
            <td class="servic">'.$objeto->id_matarife.'</td>
            <td class="servic">'.$objeto->clasificacion.'</td>
            <td class="servic">'.$objeto->desde.'</td>
            <td class="servic">'.$objeto->hasta.'</td>
            <td class="servic">'.$objeto->cantidad.'</td>
            
          </tr>';
        }
     
        $plantilla.='
        <tr>
        <td colspan="8" class="grand total"></td>
        <td class="grand total"></td>
      </tr>
      <tr>
      <td colspan="8" class="grand total">TOTAL FAENADOS</td>
      <td class="grand total">'.$total.'</td>
      </tr>';
      $plantilla.='
      
        </tbody>
      </table>
     
    <footer>
    MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
    </footer>
  </body>';

    return $plantilla;
}