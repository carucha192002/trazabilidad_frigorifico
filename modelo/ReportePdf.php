<?php
include_once 'Venta.php';
include_once 'Detalle_venta.php';
function getHtml($id){
    $venta=new Venta();
    $detalle_venta=new DetalleVenta();
    $venta->buscar_id($id);
    $detalle_venta->ver($id);
    $plantilla='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="250" height="80">
      </div>
      <h1>COMPROBANTE DE ENTREGA</h1>
      <div id="company" class="clearfix">
      <h2 class="name">MATADERO FRIGORIFICO REGIONAL MALARGÜE</h2>
      <div>Ruta 40 Norte KM 2951/52-MALARGÜE-Mendoza-Argentina</div>
      <div>CUIT: 30-67215520-3</div>        
      <div>ONCCA EST N° 00738</div> 
      <div>SENASA EST N° 3703</div> 
      <div>(0260) 4470152-4472424</div>
      <div><a href="mailto:frigorifico@malargue.gov.ar">www.malargue.gov.ar</a></div>
      <div><a href="mailto:">frigorifico@malargue.gov.ar</a></div>
    
      </div>';
      foreach ($venta->objetos as $objeto) {
    
      $plantilla.='
    
      <div id="project">
        <div><span>Codigo de Entrega: </span>'.$objeto->id_venta.'</div>
        <div><span>Retira: </span>'.$objeto->cliente.'</div>
        <div><span>DNI O CUIT: </span>'.$objeto->dni.'</div>
        <div><span>Fecha y Hora: </span>'.$objeto->fecha.'</div>
        <div><span>Autoriza: </span>'.$objeto->vendedor.'</div>
        <div><span></span></div>
      </div>';
      }
    $plantilla.='
    </header>
    <main>
      <table>
        <thead>
          <tr>
           
            <th class="service">ID</th>
            <th class="service">Tropa</th>
            <th class="service">Garron</th>
            <th class="service">Camara</th>
            <th class="service">Especie</th>
            <th class="service">Cuarteado</th>
            <th class="service">Cantidad</th>
            <th class="service"></th>
            <th class="service">Subtotal</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($detalle_venta->objetos as $objeto) {
         
          $plantilla.='<tr>
            
            <td class="servic">'.$objeto->id_detalle.'</td>
            <td class="servic">'.$objeto->tropa.'</td>
            <td class="servic">'.$objeto->garron.'</td>
            <td class="servic">'.$objeto->camara.'</td>
            <td class="servic">'.$objeto->especie.'</td>
            <td class="servic">'.$objeto->despiece.'</td>            
            <td class="servic">'.$objeto->det_cantidad.'</td>
            <td class="servic"></td>
            <td class="servic">'.$objeto->det_cantidad.'</td>
          </tr>';
        }
        $calculos= new Venta();
        $calculos->buscar_id_total($id);
        foreach ($calculos->objetos as $objeto) {
          $igv=$objeto->total*1;
          $sub=$objeto->total-$igv;
          
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
            <td colspan="8" class="grand total">TOTAL DE PRODUCTOS</td>
            <td class="grand total">'.$objeto->total.'</td>
          </tr>';

        }
       $plantilla.='
        </tbody>
      </table>
      <div id="notices">
        
        
      </div>
    </main>
    <div class="linea">..........................................</div>
    <div class="firma">Entregue conforme</div>
        <div class="linea1">..........................................</div>   
        <div class="firma1">Recibi conforme</div> 
        <div class="firma2"><span> </span>'.$objeto->cliente.'</div>
        <div class="firma3"><span>DNI O CUIT: </span>'.$objeto->dni.'</div>
    <footer>
      MATADERO FRIGORIFICO REGIONAL MALARGÜE
      
    </footer>
  </body>';
    return $plantilla;
}