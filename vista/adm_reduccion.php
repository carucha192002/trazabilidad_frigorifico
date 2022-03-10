<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
 include_once 'layouts/header.php'
?>
<?php
 include_once 'layouts/nav.php'
 
?>
<div class="modal fade col-md-12" id="garrones" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mandar a Faena</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
            <form id="form-crear-garron">
                    <div class="form-group">
                        <label for="numero_tropa">Nº de Tropa</label>
                        <input id="numero_tropa" type="text" style="text-transform:uppercase" class="form-control"disabled>
                        <input id="numero_matarife" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>	
                    <div class="form-group">
                        <label for="clasificacion_garron">Clasificacion</label>
                        <input id="clasificacion_garron" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_garron">CANTIDAD EN PIE</label>
                        <input id="cantidad_garron" type="text" style="text-transform:uppercase" class="form-control"disabled>
                       
                    </div>
                    <div class="form-group">
                        <label for="desde_garron">Desde</label>
                        <input class="form-control" id="desde_garron" type="text">
                    </div>
                    <div class="form-group">
                        <label for="hasta_garron">Cantidad a Seleccionar</label>
                        <select class="form-control select2" id="hasta_garron" type="text" style="width: 100%"></select>
                    </div>
                    <div class="form-group">
                        <label for="hasta_garron_guardar">Hasta</label>
                        <input class="form-control" id="hasta_garron_guardar" type="text" disabled>
                    </div>
                    <div class="form-group">
                        <label for="estado_garron">Estado:</label>
                        <input class="form-control" id="estado_garron" type="text" disabled>
                    </div>
                   
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="submit"  id="guardargarron" class="btn btn-outline-light">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade col-md-12" id="volver" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mandar a Faena</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
            <form id="form-crear-garron_volver">
                    <div class="form-group">
                        <label for="numero_tropa">Nº de Tropa</label>
                        <input id="numero_tropa_volver" type="text" style="text-transform:uppercase" class="form-control"disabled>
                        <input id="numero_matarife_volver" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>	
                    <div class="form-group">
                        <label for="clasificacion_garron">Clasificacion</label>
                        <input id="clasificacion_garron_volver" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_garron">CANTIDAD EN PIE</label>
                        <input id="cantidad_garron_volver" type="text" style="text-transform:uppercase" class="form-control"disabled>
                        <input id="cantidad_garron_id" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="desde_garron">Desde</label>
                        <input class="form-control" id="desde_garron_volver" type="text">
                    </div>
                    <div class="form-group">
                        <label for="hasta_garron">Cantidad a Seleccionar</label>
                        <select class="form-control select2" id="hasta_garron_volver" type="text" style="width: 100%"></select>
                    </div>
                    <div class="form-group">
                        <label for="hasta_garron_guardar">Hasta</label>
                        <input class="form-control" id="hasta_garron_guardar_volver" type="text" disabled>
                        <input class="form-control" id="id_garron_volver" type="hidden" disabled>
                    </div>
                    <div class="form-group">
                        <label for="estado_garron">Estado:</label>
                        <input class="form-control" id="estado_garron_volver" type="text" disabled>
                    </div>
                   
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="submit"  id="guardargarron_volver" class="btn btn-outline-light">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
           
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade col-md-12" id="elegircamara" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Enviar a Camara</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
            <form id="form-camara-garron">
                    <div class="form-group">
                        <label for="numero_tropa_camara">Nº de Tropa</label>
                        <input id="numero_tropa_camara" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>	
                    <div class="form-group">
                        <label for="clasificacion_garron_camara">Clasificacion</label>
                        <input id="clasificacion_garron_camara" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
       
                    
                    <div class="form-group">
                        <label for="elegir_camara">Elija la Camara</label>
                        <select class="form-control select2"  id="elegir_camara" type="text" style="width: 100%"></select>
                    </div>
                    <div class="form-group">
                    
                        <input id="matarife_camara" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="submit"  id="guardargarroncamara" class="btn btn-outline-light">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
           
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade col-md-12" id="editargarron" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editar Peso Garron</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
            <form id="form-editar-garron">
                    <div class="form-group">
                        <label for="numero_tropa_editar">Nº de Tropa</label>
                        <input id="numero_tropa_editar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="garron_id">Garron</label>
                        <input id="garron_id" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="peso_garron">Peso</label>
                        <input id="peso_garron" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                       
                        <input id="id_editar" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    
                    <div class="form-group">
                        <label for="editar_peso">Peso</label>
                        <input class="form-control select2"  id="editar_peso" type="float" style="width: 100%" value="0">
                    </div>
                    
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="submit"  id="guardargarronpeso" class="btn btn-outline-light">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
           
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/estilosbotones.css">
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <h4>MATADERO FRIGORIFICO REGIONAL MALARGÜE <?php echo date("Y")?></h4>
            <input id="añoactual" type="hidden"  value="<?php echo date("Y")?>">
            <div class="row">
          <div class="col-sm-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-calendar-alt"></i></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text text-center" >Fecha Actual</span>
                        <span class="info-box-text text-center"><?php echo date("d/m/Y")?></span>
                      </div>
              <!-- /.info-box-content -->
                  </div>
          </div>
          
           
          </div>
          </div>
          </div>
        
    </section>

  <title>Municipalidad de Malargüe</title>

</head>
<body>    

    <form  id="reducido"> 
       <div class="container-fluid">
       <div>
           <div class="card card-danger">
               <div class="card-header">
               <h3 class="card-title">Consultas de Reduccion de Tropas</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_reduccion_faenas" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
        <th>ID</th>
                 <th>Tropa</th>
                 <th>Cantidad</th>
                <th>Clasificacion</th>
                <th>Kg PRO.</th>
                <th>Corral</th>
                <th>Destino</th>
                <th>Matarife</th>
                <th>Productor</th>     
                <th>DTE</th>         
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
            </table>
               </div>
               <div class="card-footer">
               
               </div>
           </div>
       </div>
      </div>
    </form>     
   
<section>

<div class="small-box bg-info col-sm-12">
                    <h6 class="text-center">CANTIDAD EN CORRALES</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>CORRAL Nº</th>
                              <th>CANTIDAD</th>
                              <th>SUB-ESPECIE</th>
                              
                        </tr>
                        <tbody id="clasificacion" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                      </thead>
                    </table>               
                </div>
                </div>
                </div>


</section>
<section>
<form  id="form_reducido_vuelta"> 
       <div class="container-fluid">
       <div>
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">PROCESAR REDUCCION DE TROPAS</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_reduccion_faenas_vuelve" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
        <th>ID</th>
                 <th>Tropa</th>
                 <th>Cantidad</th>
                <th>Clasificacion</th>
                <th>Kg PRO.</th>
                <th>Corral</th>
                <th>Destino</th>
                <th>Matarife</th>
                <th>Productor</th>     
                <th>DTE</th>         
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
            </table>
               </div>
               <div class="card-footer">
               
               </div>
           </div>
       </div>
      </div>
    </form> 
</section>
<section id="matanza">
<div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 id="titulo_matanza" class="card-title" style="text-transform:uppercase"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Matanza</font></font></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Colapso">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            
            <div class="card-body">
            <div class="callout callout-info">
                  <h5 id="cantidad_cabezas" style="text-transform:uppercase"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></h5>
                  <p id="garrondesdehasta" style="text-transform:uppercase"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
                </div>
              <div class="form-group">
                <label for="inputEstimatedBudget"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nº DE GARRON:</font></font></label>
                <input type="number" id="numgarron" class="form-control" disabled>
                <input type="number" id="maximo" class="form-control" disabled>
                <input type="hidden" id="tropasnum" class="form-control" disabled>
                <input type="hidden" id="productor" class="form-control" disabled>
                <input type="hidden" id="matarifeid" class="form-control" disabled>
                <input type="hidden" id="especiesid" class="form-control" disabled>
                <input type="hidden" id="codigo" class="form-control" disabled>
                <input type="hidden" id="destinocsv" class="form-control" disabled>
                <input type="hidden" id="estadodect" class="form-control" value="PARCIAL" disabled>
                <input type="text" id="nombrematarife" class="form-control" disabled>
                <input type="text" id="ultimoid" class="form-control" disabled>
              </div>

              <div id="alerta" class="alert alert-danger alert-dismissible">
                  <h5><i class="icon fas fa-ban"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  </font><font id="alertatexto" style="vertical-align: inherit;">
                </font></font></div>
              <div class="form-group">
                <label for="inputSpentBudget"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CLASIFICACION:</font></font></label>
                <input type="text" id="clasificaciongarron" style="text-transform:uppercase" class="form-control"disabled>
              </div>
              <div class="form-group">
                <label id="pesogarron1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">PESO:</font></font></label>
                <input type="float" id="pesogarron" class="form-control"require onkeypress="recuperar(event)">
                <input type="hidden" id="pesogarronguardar" class="form-control"require>
              </div>
              
              <div class="progress">
                  <div id="tracking" class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                  
                    <span class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">40% completo (éxito)</font></font></span>
                  </div>
                </div>
                <div id="finalzado" class="callout callout-info">
                  <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FAENA FINALIZADA</font></font></h5>

                  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">GRACIAS</font></font></p>
                  </div>
              <button id="siguiente" type="button" class="btn btn-block btn-outline-success btn-flat"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">GUARDAR Y SIGUIENTE</font></font>
              <button id="reducir" type="button" class="btn btn-block btn-outline-danger btn-flat" data-toggle="modal" data-target="#reducciongarrones"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">REDUCIR</font></font>
              <button id="camaraelegir" type="button" class="btn btn-block btn-outline-info btn-flat" data-toggle="modal" data-target="#elegircamara"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ELEGIR CAMARA</font></font>  
                </div>
            </div>
            
            <!-- /.card-body -->
          </div>
          <section>
<form  id="form_listado_garron1"> 
       <div class="container-fluid">
       <div>
           <div class="card card-danger">
               <div class="card-header">
               <h3 class="card-title">Consultas de Garrones Procesados</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="form_listado_garron" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
       
                 <th>Tropa</th>
                 <th>Especie</th>
                 <th>Garron</th>
                <th>Peso</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
            </table>
               </div>
               <div class="card-footer">
               
               </div>
           </div>
       </div>
      </div>
    </form>   
</section>
        </div>
</section>
</body>

<footer>
<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location: ../index.php');
 }
?>
</footer>
<script src="../js/datatables.js"></script>
<script src="../js/Reducir.js"></script>
<script src="../js/nav.js"></script>
