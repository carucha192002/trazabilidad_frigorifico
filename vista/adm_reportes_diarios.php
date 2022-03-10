<?php
session_start();
if($_SESSION['us_tipo']==3||$_SESSION['us_tipo']==1||$_SESSION['us_tipo']==6){
 include_once 'layouts/header.php'
?>

  <title>Gestion Facturas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>

<div class="animate__animated animate__bounceInDown modal fade" id="vista_reporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Reportes</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
            <input type="hidden" id="fecha_faena">
            <table class="table table-hover text-nowrap card-body p-0 table-responsive text-center">
                <thead class="table-success">
                    <tr>
                    <th>Fecha</th> 
                    <th>Matarife</th>   
                    <th>Tropa</th>  
                    <th>TCI</th>
                    <th>Cantidad</th>  
                    <th>#</th>  
                    <th>Categoria</th>  
                    <th>Garron</th> 
                    <th>Corral</th>  
                    <th>DT-e</th>  
                    <th>Kg en pie</th>   
                    <th >PROMEDIO</th>  
                    <th >Kg limpio</th>  
                    <th >Acciones</th>     
                    </tr>                
                </thead>  
                <tbody class="table-warning" id="registros">
                </tbody>          
            </table> 
       
                   
          </div>
          
          <div class="card-footer">    
      
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>    
          <button type="button" id="imprimir_caprinos" class="btn btn-outline-success float-right m-1">Imprimir Caprinos</button> 
          <button type="button" id="imprimir_ovinos" class="btn btn-outline-danger float-right m-1">Imprimir Ovinos</button>     
          </div>
      </div>
    </div>
  </div>
</div>
<div class="animate__animated animate__bounceInDown modal fade" id="vista_reporte1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Reportes</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
          <input type="hidden" id="fecha_imprimir">
          <input type="hidden" id="tropa_imprimir">
          <input type="hidden" id="ingreso_imprimir">
          <table class="table table-hover text-nowrap card-body p-0 table-responsive text-center">
                <thead class="table-success">
                    <tr>
                    <th>Garron</th> 
                    <th>Tropa</th>   
                    <th>Especie</th>  
                    <th>Peso</th>  
                    <th>Productor</th>  
                    <th>establecimiento</th> 
               
                    </tr>                
                </thead>  
                <tbody class="table-warning" id="registros2">
                </tbody>          
            </table>       
                   
          </div>
          
          <div class="card-footer">    
          <button type="button" id="imprimir" class="btn btn-outline-info float-right m-1">Imprimir</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>          
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
            <h1>Gestion Reportes</h1>               
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Reportes</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
       <div class="container-fluid">
         
            
               <div class="card-body">
              
               </div>                        
               
               <div class="card-footer">   
               <table id="tabla_reportes" class="display table table-striped table-dark table-responsive text-nowrap" style="width:100%">              
                  <thead>
                      <tr class="text-center">
                          <th>Codigo</th>
                          <th>Fecha</th>
                          <th>Accion</th>
                      </tr>
                  </thead>
                <tbody class="text-center">
                </tbody>
                    </table>            
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
<script src="../js/Reportes_diarios.js"></script>

