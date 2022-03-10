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
                        <input class="form-control" id="corral_garron" type="hidden" disabled>
                        <input class="form-control" id="dte_garron" type="hidden" disabled>
                        <input class="form-control" id="promedio_garron" type="hidden" disabled>
                        <input class="form-control" id="matarife_garron" type="hidden" disabled>
                        <input class="form-control" id="kilosenpie_garron" type="hidden" disabled>
                        <input class="form-control" id="tci_garron" type="hidden" disabled>
                        <input class="form-control" id="id_ingreso_garron" type="hidden" disabled>
                    </div>
                   
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="button"  id="guardargarron" class="btn btn-outline-light">Guardar</button>
            
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
                        <label for="numero_tropa_volver">Nº de Tropa</label>
                        <input id="numero_tropa_volver" type="text" style="text-transform:uppercase" class="form-control"disabled>
                        <input id="numero_matarife_volver" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                        <input id="quedan_volver" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>	
                    <div class="form-group">
                        <label for="clasificacion_garron">Clasificacion</label>
                        <input id="clasificacion_garron_volver" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_garron">CANTIDAD EN PIE</label>
                        <input id="cantidad_garron_volver" type="text" style="text-transform:uppercase" class="form-control"disabled>
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
<form  id="form_listado"> 
       <div class="container-fluid">
       <div>
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">PASAR A FAENA</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_faenas" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
        <th>ID</th>
                 <th>Matarife</th>
                 <th>Tropa</th>
                 <th>TCI</th>
                <th>Cantidad</th>
                <th>Especie</th>
                <th>Subespecie</th>
                <th>Guia</th>
                <th>PRO. Kg</th>       
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
  
   
<div class="small-box bg-info col-sm-12">
                    <h6 class="text-center">CANTIDAD EN CORRALES</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>CORRAL Nº</th>
                              <th>CANTIDAD</th>
                              <th>ESPECIE</th>
                              <th>SUB-ESPECIE</th>
                              
                        </tr>
                        <tbody id="clasificacion" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                      </thead>
                    </table>               
                </div>
                </div>
                </div>

                <div class="small-box bg-warning col-sm-12">
                    <h6 id="clasificacioncorralreduccion2"class="text-center">REDUCCION DE ANIMALES</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table id="clasificacioncorralreduccion1"class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>CORRAL Nº</th>
                              <th>CANTIDAD</th>
                              <th>ESPECIE</th>
                              <th>SUB-ESPECIE</th>
                              
                        </tr>
                        <tbody id="clasificacioncorralreduccion" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                      </thead>
                    </table>               
                </div>
                </div>
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
<script src="../js/Catalogo.js"></script>
<script src="../js/nav.js"></script>
