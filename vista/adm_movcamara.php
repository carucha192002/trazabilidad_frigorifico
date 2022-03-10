<?php
session_start();
if($_SESSION['us_tipo']==3||$_SESSION['us_tipo']==1){
 include_once 'layouts/header.php'
?>

  <title>Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
    <!-- Button trigger modal -->
<!-- Modal -->

<div class="animate__animated animate__bounceInDown modal fade" id="crearcamara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Mover a Camara</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El Camara ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-mover-Camara">
                
                    <div class="form-group">
                        <label for="tropa_camara">NUMERO DE TROPA</label>
                        <input id="tropa_camara" type="number" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Numero de Tropa" disabled>
                    </div>
                    <div class="form-group">
                        <label for="especie_camara">ESPECIE</label>
                        <input id="especie_camara" type="text" style="text-transform:uppercase" class="form-control" placeholder="Nombre Especie" disabled>
                    </div>
                    <div class="form-group">
                        <label for="despiece_camara">CUARTEADO</label>
                        <input id="despiece_camara" type="text" style="text-transform:uppercase" class="form-control" placeholder="Nombre del cuarteado" disabled>
                    </div>
                    <div class="form-group">
                        <label for="garron_camara">GARRONES</label>
                        <input id="garron_camara" type="number" style="text-transform:uppercase" class="form-control" placeholder="Numero de Garrones" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nombre_camara_origen">NUMERO DE LA CAMARA ORIGEN</label>
                        <input id="nombre_camara_origen1" type="text" style="text-transform:uppercase" class="form-control" placeholder="Numero de la Camara Origen" disabled>
                        <input id="nombre_camara_origen" type="hidden" style="text-transform:uppercase" class="form-control" placeholder="Numero de la Camara Origen" disabled>
                        <input type="hidden" id="id_edit_cam">
                    </div>
                    <div class="form-group">
                        <label for="elegir_cuarteado">NUMERO DE LA CAMARA DESTINO</label>
                        <select class="form-control select2"  id="nombre_camara_destino" type="text" style="width: 100%"></select>
                        <input id="nombre_camara_destino1" type="hidden" style="text-transform:uppercase" class="form-control" placeholder="Numero de la Camara Origen" disabled>
                    </div
                   
                    
                    <input type="hidden" id="id_edit_prod">
                    
          </div>
          <div class="card-footer">
          <button id="guardar1" type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="animate__animated animate__bounceInDown modal fade" id="todatropa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-warning">
          <div class="card-header">
              <h3 class="card-title">Mover toda la tropa a Camara</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El Camara ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form action="#" id="form-mover-Camara_toda">
                
                    <div class="form-group">
                        <label for="tropa_camara_toda">NUMERO DE TROPA</label>
                        <input id="tropa_camara_toda" type="number" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Numero de Tropa" disabled>
                    </div>
                    <div class="form-group">
                        <label for="especie_camara_toda">ESPECIE</label>
                        <input id="especie_camara_toda" type="text" style="text-transform:uppercase" class="form-control" placeholder="Nombre Especie" disabled>
                      
                    </div>
                    <div class="form-group">
                        <label for="despiece_camara_toda">CUARTEADO</label>
                        <input id="despiece_camara_toda" type="text" style="text-transform:uppercase" class="form-control" placeholder="Nombre del cuarteado" disabled>
                    </div>
                    <h6 class="text-center">GARRONES</h6>
                    
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>OPCION</th>
                              <th>GARRON</th>
                              <th>PESO</th>
                              <th>CAMARA</th>
                              
                        </tr>
                        <tbody id="garroncamara" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                        <style>
                        .error{
                          color: red;
                          padding-left: 12px;
                        }
                        
                        </style>
                       <span class="error" id="obligatorio">Debe Seleccionar al menos una opcion</span>
                      </thead>
                      
                    </table> 
                    
                        <input type="checkbox" id="marcartodas"> Marcar Todas
                        
                    <p id="resultado"></p>  
                    <br>     
                </div>
                </div>
                    <div class="form-group">
                        <label for="nombre_camara_origen_toda">NUMERO DE LA CAMARA ORIGEN</label>
                        <input id="nombre_camara_origen1_toda" type="text" style="text-transform:uppercase" class="form-control" placeholder="Numero de la Camara Origen" disabled>
                        <input id="nombre_camara_origen_toda" type="hidden" style="text-transform:uppercase" class="form-control" placeholder="Numero de la Camara Origen" disabled>
                        <input type="hidden" id="id_edit_cam_toda">
                        <input type="hidden" id="id_ingreso_toda">
                    </div>
                    <div class="form-group">
                        <label for="elegir_cuarteado_toda">NUMERO DE LA CAMARA DESTINO</label>
                        <select class="form-control select2"  id="nombre_camara_destino_toda" type="text" style="width: 100%"></select>
                        <input id="nombre_camara_destino1_toda" type="hidden" style="text-transform:uppercase" class="form-control" placeholder="Numero de la Camara Origen" disabled>
                    
                    </div
                   
                    
                    <input type="hidden" id="id_edit_prod_toda">
                    
          </div>
          <div class="card-footer">
          <button id="guardarcamaratoda"type="button" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CONTROL MOVIMIENTO DE CAMARA</h1>               
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Camara</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    <form  id="form_listado"> 
       <div class="container-fluid">
       <div>
           <div class="card card-info">
               <div class="card-header">
               <h3 class="card-title">Consultas de Movimiento de Camaras</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_ingresos" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
                 <th>Fecha</th>
                 <th>Tropa</th>
                <th>Garron</th>
                <th>Especie</th>
                <th>Cam Origen</th>
                <th>Cam Destino</th>
                <th>Vencimiento</th>    
                <th>Quedan</th>  
                <th>Estado</th>  
               
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
    <section>
       <div class="container-fluid">
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Buscar por Tropa</h3>
               <div class="input-group">
                   <input type="text" id="buscar-camara" class="form-control float-left" placeholder="Ingese Numero de la Tropa">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
               </div>
               </div>
               <div class="card-body">
                    <div id="camaras" class="row d-flex align-items-stretch">
               
                    </div>               
               </div>
               <div class="card-footer">
               
               </div>
           </div>
       </div>
    </section>
  </div>
<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location:../index.php');
 }
?>
<script src="../js/datatables.js"></script>
<script src="../js/camarasmov.js"></script>