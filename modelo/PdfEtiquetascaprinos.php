<?php
include_once 'Etiquetas.php';

require_once('../vendor/autoload.php');

function getHtml($id){
  
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha = date("Y-m-d H:i:s");
    $etiquetas = new etiquetas();
    $etiquetas_observacion = new etiquetas();
      $etiquetas->Etiqueta_refrigerado($id);
      foreach ($etiquetas->objetos as $objeto) {
        $plantilla='
        <body>';
        foreach ($etiquetas->objetos as $objeto) {
          $plantilla.=' 
                  <section>
                  <address>
                      <span></span><b> MATADERO FRIGORIFICO REGIONAL MALARGÜE</b> </font></font></strong><br><span> </span> Ruta Nacional 40 Km 2951/52 
                      <span> </span> Malargüe, CP: 5613   </font></font>                
                    </font></font>
                    <div></div>
                    <span></span> <b> SENASA Nº 3703/95659/1 INDUSTRIA ARGENTINA</b>
                    </address>
                  </div>
                  </div>
                  </section>
                  <section>
                    <span>FROZEN SHEEP CARCASS</span> <h2>CARNE CAPRINA CONGELADA CARCASA</h2>
                    <span>PRODUCT OF ARGENTINA</span><h2>INDUSTRIA ARGENTINA</h2>
                    <span>KEEP FROZEN AT -18ºC: </span><h2>Conservar Congelado a -18ºC una vez descongelado no volver a congelar</h2>
                    <span>PRODUCTION DATE </span><h2>FECHA DE ELABORACION: <b>'.$objeto->fechafaena.'</b></h2>
                    <span>EXPIRY DATE </span><h2>FECHA DE VENCIMIENTO: <b>'.$objeto->fechaetiqueta.'</b></h2>
    
             
                
                  </section>
                  <section>
                  <div class="row">
                  <div class="col-12 table-responsive">
                  <table  class="table table" style="width:100%">
          <thead>
          <tr class="text-center">
                    <th class="service">PESO NETO NET WEIGHT</th>
                   <th class="service">Lot TROPA</th>
                   <th class="service">ANIMAL GARRON</th>
                
              </tr>
          </thead>
          <tbody>
          <tbody id="facturacion" class="table-active text-center"style="text-transform:uppercase">
          
             
            <tr>
    
              <td class="servic"><b>'.$objeto->peso.'</b></td>
              <td class="servic"><b>'.$objeto->numtropas.'</b></td>
              <td class="servic"><b>'.$objeto->garron.'</b></td>
             
              
              
            </tr>
          
    
            </tbody>
                </table>
                   </div>
                   <div id="logo">
                   <img src="../etiquetas/faenados/'.$objeto->etiqueta.'"width="75" height="75"></img><br>
                   <img src="../etiquetas/barras/'.$objeto->codigobarras.'"width="100" height="50"></img>
                   </br>
                   </div>
                  </section>
                <footer>
                MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
                
                </footer>';
              }
              
              $plantilla.='
      </body>';
      
      return $plantilla;
        
    }

}
