<?php
include_once 'informe.php';
include_once 'Venta.php';

function getHtml($id,$desde,$hasta){
 
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
  $informe = new Informe();
  $submatarife= new Venta();
  $calculos= new Venta();
    $submatarife->submatarife($id);

    
    $calculos->buscardatostodos1($id,$desde,$hasta);

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
        <h1>FECHA: '.$fecha.'</h1>
    </header>
    <main>
      <table>
        <thead>
          <tr>
           
            <th class="service">Id</th>
            <th class="service">Matarife</th>
            <th class="service">Cantidad</th>

      
            
          </tr>
        </thead>
        <tbody>';
        foreach ($submatarife->objetos as $obj) {
          $sub=$obj->id_submatarife;
          $informe->buscardatostodos($id,$desde,$hasta,$sub);
        
          foreach ($informe->objetos as $obj) {
    
          

          $plantilla.='<tr>
            <td class="servic">'.$obj->id.'</td>
            <td class="servic">'.$obj->matarife.'</td>
            <td class="servic">'.$obj->total.'</td>
            
          </tr>';
        }
        }
         $plantilla.='
      
        </tbody>
      </table>';
      foreach ($calculos->objetos as $objeto) {
        
        $plantilla.='
       
        <td colspan="8" class="grand total"></td>
        <td class="grand total"></td>
      </tr>
      <tr>
        <td colspan="8" class="grand total"></td>
        <td class="grand total"></td>
      </tr>
      <tr>
        <td colspan="8" class="grand total">TOTAL DE ANIMALES:</td>
        <td class="grand total">'.$objeto->total.'</td>
      </tr>';

      }
      
      $plantilla.='
    <footer>
    MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
    </footer>
  </body>';
    return $plantilla;
}