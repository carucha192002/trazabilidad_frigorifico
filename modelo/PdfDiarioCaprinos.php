<?php

include_once 'diario.php';

function getHtml($fecha,$especie){
    $reporte = new Diarios();
    $sumas = new Diarios();
    $reporte->ver_todo_caprinos($fecha,$especie);
    $sumas->sumas($fecha,$especie);
    $cantidad_animales=$sumas->objetos[0]->cantidad_animales;
    $kilosenpie_animales=$sumas->objetos[0]->kilosenpie_animales;
  $plantilla='
    <body>
    <header class="clearfix">
    <div id="logo">
      <img src="../img/logo.png" width="250" height="80">
    </div>
    
    </div>
    </header>
            <form >
            <div class="invoice">
              
              <div class="row">
                <div class="col-12">
                  <h1>
                    <i class="fas fa-globe"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> MATADERO FRIGORIFICO REGIONAL MALARGÜE
                    </font></font><small id="small1"class="float-right"><font style="vertical-align: inherit; "><font style="vertical-align: inherit;">'.$fecha.'</font></font></small>
                  </h1>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  De
                  </font></font><address>
                    <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MATADERO FRIGORIFICO REGIONAL MALARGÜE</font></font></strong><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 
                    Ruta Nacional 40 Km 2951/52 </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Malargüe, CP: 5613 </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Teléfono: (0260) 4471060 TeleFax: (0260)4470369 </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Correo electrónico: frigorificosistema@gmail.com Web: www.malargue.gov.ar
                  </font></font></address>
                </div>';
                
              $plantilla.='
            
                </div>
              </div>
              <br></br>';
              if($especie==4){
                $plantilla.='
                <h1>CAPRINOS</h1>';
              }else{
                $plantilla.='
                <h1>OVINOS</h1>';
              }
              $plantilla.='
              

              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                <table  class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
                <th class="service">#</th>
                  <th class="service">Matarife</th>
                 <th class="service">Tropa</th>
                 <th class="service">Cantidad</th>
                 <th class="service">Clasificacion</th>
                 <th class="service">garron</th>
                 <th class="service">Dte</th>
                 <th class="service">Corral</th>
                 <th class="service">Kgrs</th>
                 <th class="service">Tci</th>
                 <th class="service">Promedio</th>
                 <th class="service">Kgrs</th>
                 
            </tr>
        </thead>
        <tbody>
        <tbody  class="table-active text-center"style="text-transform:uppercase">'; 
        $contador=1;
        foreach ($reporte->objetos as $objeto) {
            $reporte->promedios($objeto->id_ingreso);
            foreach ($reporte->objetos as $obj) {
                $promedio = $obj->promedio;
                $kgcarne = $obj->kgcarne;
                $total = $obj->cantidad;
           
         $plantilla.='<tr>
            <td class="servic">'.$contador++.'</td>
            <td class="servic">'.$objeto->id_matarife.'</td>
            <td class="servic">'.$objeto->tropa.'</td>
            <td class="servic">'.$objeto->cantidad.'</td>
            <td class="servic">'.$objeto->clasificacion.'</td>
            <td class="servic">'.$objeto->garron.'</td>
            <td class="servic">'.$objeto->dte.'</td>
            <td class="servic">'.$objeto->corral.'</td>
            <td class="servic">'.$objeto->kilosenpie.'</td>
            <td class="servic">'.$objeto->tci.'</td>
            <td class="servic">'.$promedio.'</td>
            <td class="servic">'.$kgcarne.'</td>
            </tr>';
          }
        }
    
         $plantilla.='
         <tr>
         <td colspan="8" class="grand total"></td>
         <td class="grand total"></td>
       </tr>
       <tr>
       <td colspan="8" class="grand total">TOTAL KGRS EN PIE</td>
       <td class="grand total">'.$kilosenpie_animales.'</td>
       </tr>
       <tr>
         <td colspan="8" class="grand total">TOTAL DE ANIMALES</td>
         <td class="grand total">'.$cantidad_animales.'</td>
       </tr>';
       $plantilla.='
          </tbody>
        
            </table>
               </div>
               <div class="card-footer">
               
               </div>
               </div>
                
                <!-- /.col -->
                <div class="col-6">
                
               
                  </br>';
           
                 $plantilla.='
                  
                  
                  
            </form>
            <footer>
            MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
            </footer>
  </body>';
  return $plantilla;
    
}
