<?php
include_once 'finalizado.php';
include_once 'Venta.php';
function getHtml($id,$fecha,$id_ingreso){
  $datos= date_default_timezone_set('America/Argentina/Mendoza');
  $fecha1 = date("Y-m-d H:i:s");
    $finalizado = new finalizado();
    $calculos= new Venta();
    $finalizado->facturacion11($id,$fecha,$id_ingreso);
 
    $calculos->facturacion22($id,$fecha,$id_ingreso);
    $cantidad3="0";
    
    
   
    foreach ($finalizado->objetos as $objeto) {
    
    $plantilla='
    <body>
    <header class="clearfix">
    <div id="logo">
      <img src="../img/logo.png" width="250" height="80">
    </div>
  
    </div>';
    $plantilla.='
    </header>
            <form >
            <div class="invoice">
              
              <div class="row">
                <div class="col-12">
                  <h1>
                    <i class="fas fa-globe"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> MATADERO FRIGORIFICO REGIONAL MALARGÜE
                    </font></font><small id="small1"class="float-right"><font style="vertical-align: inherit; "><font style="vertical-align: inherit;">'.$fecha1.'</font></font></small>
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
                <!-- /.col -->
                <div class="col-sm-4 invoice-col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                <div id="company" class="clearfix">
                PARA:
                  </font></font><address>
                    <strong id="destinatario"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><span>MATARIFE: </span>'.$objeto->matarife.'</font></font></strong><br><span>DT-e: </span>'.$objeto->guia.'<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 
                      </font></font><br><span>Transporte: </span>'.$objeto->transporte.'<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      </font></font><br><span>Chofer: </span>'.$objeto->chofer.'<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      </font></font><br><font style="vertical-align: inherit;"><span>Corral: </span>'.$objeto->corral.'<font style="vertical-align: inherit;">
                    
                  </font></font></address>
                
                </div>';
              }
              $plantilla.='
                </div>
              </div>
              <h1>FAENA: </span>'.$objeto->faenafecha. '<b style="text-transform:uppercase"> Especie: '.$objeto->especie.'</b>
              <br> Correlativos del:'.$objeto->desde.' hasta el número'.$objeto->hasta.' </br> </h1>

              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                <table  class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
                  <th class="service">GARRON</th>
                  <th class="service">Tropa</th>
                  <th class="service">TCI</th>
                 <th class="service">Clasificacion</th>
                 <th class="service">Peso</th>
                 <th class="service">Productor</th>
                 <th class="service">Establecimiento</th>
                 
            </tr>
        </thead>
        <tbody>
        <tbody id="facturacion" class="table-active text-center"style="text-transform:uppercase">'; 
        foreach ($finalizado->objetos as $objeto) {
         
          $plantilla.='<tr>

            <td class="servic">'.$objeto->garron.'</td>
            <td class="servic">'.$objeto->numtropas.'</td>
            <td class="servic">'.$objeto->tci.'</td>
            <td class="servic">'.$objeto->subespecies.'</td>
            <td class="servic">'.$objeto->peso.'</td>
            <td class="servic">'.$objeto->productor.'</td>
            <td class="servic">'.$objeto->establecimiento.'</td>
            </tr>';
          }
       
    
         $plantilla.='
          </tbody>
        
            </table>
               </div>
               <div class="card-footer">
               
               </div>
               </div>
                
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><span>TOTAL EN PIE: </span>'.$objeto->enpie.'</font></font></p>
                  <span>KILOS EN PIE: </span>'.$objeto->kilosenpie.'<br>
                  </br>';
                  foreach ($calculos->objetos as $objeto) {
        
            
                    $plantilla.='
                    <h1>
                    <span> RESES: </span>'.$objeto->reses.' <br>
                    <span>PESO: </span>'.$objeto->peso.' Kgrs. <br>
                    <span>RENDIMIENTO: </span>'.$objeto->rendimiento.' Kgrs. <br> </h1>';

          
                  }
                 $plantilla.='
                  
                  
                  
            </form>
            <footer>
            MUNICIPALIDAD DE MALARGÜE-CIUDAD AMIGABLE
            </footer>
  </body>';
  
  return $plantilla;
    
}
