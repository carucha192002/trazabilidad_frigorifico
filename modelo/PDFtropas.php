<?php
include_once 'tropas.php';
function getHtml($id){
  
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
    $tropas = new Tropas();
    $tropas->buscar_tropas($id);
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
      </div>
    </header>
    <h1>INFORME DE TROPAS</h1>
    <main>';
 
    $plantilla.='
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">Id</th>
            <th class="no">Matarife</th>
            <th class="no">Procedencia</th>
            <th class="no">Especie</th>
            <th class="no">Vigencia</th>
            <th class="no">Desde</th>
            <th class="no">Cantidad</th>
            <th class="no">Hasta</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($tropas->objetos as $objeto) {
         
            $plantilla.='<tr text-center>
              <td class="no">'.$objeto->id_tropas.'</td>
              <td class="no">'.$objeto->matarife.'</td>
              <td class="no">'.$objeto->procedencia.'</td>
              <td class="no">'.$objeto->especies.'</td>
              <td class="no">'.$objeto->vigencia.'</td>
              <td class="no">'.$objeto->desde.'</td>
              <td class="no">'.$objeto->cantidad.'</td>
              <td class="no">'.$objeto->hasta.'</td>
              
            </tr>';
  
  
          }
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