<?php
session_start();
if($_SESSION['us_tipo']==3||$_SESSION['us_tipo']==1){
 include_once 'layouts/header.php'
?>

  <title>Gestion Facturas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
<div class="animate__animated animate__bounceInDown modal fade" id="vista_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Registro de Facturas</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
            <div class="form-group">
                <label for="codigo_venta">N° Pedido:</label>
                <span id="codigo_venta"></span>
            </div> 
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <span id="fecha"></span>
            </div> 
            <div class="form-group">
                <label for="cliente">Retira:</label>
                <span id="cliente"></span>
            </div>             
            <div class="form-group">
                <label for="dni">Dni:</label>
                <span id="dni"></span>
            </div>    
            <div class="form-group">
                <label for="vendedor">Autoriza:</label>
                <span id="vendedor"></span>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <span id="estado"></span>
            </div>
            <table class="table table-hover text-nowrap card-body p-0 table-responsive text-center">
                <thead class="table-success">
                    <tr>
                    <th>Cantidad</th>   
                    <th>Especie</th>  
                    <th>Cuarteado</th>  
                    <th>Garron</th> 
                    <th>Tropa</th>  
                    <th>Camara</th>  
                    <th>Vencimiento</th>   
                    <th >Sumas</th>  
                    <th style="visibility: hidden">Precio</th>     
                    </tr>                
                </thead>  
                <tbody class="table-warning" id="registros">
                </tbody>          
            </table> 
            <div class="float-right input-group-append">
                <h3 class="m-3">Total</h3>
                <h3 class="m-3" id="total"></h3>
            </div>               
          </div>
          <div class="card-footer">          
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
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Consultas</h3>
              
               </div>
               <div class="card-body">
               <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3 id="venta_dia_vendedor">o</h3>

                        <p>Cantidad requerida por dia</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-user"></i>
                      </div>
                      
                    </div>
                  </div>
                  <!-- ./col -->
                  
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3 id="venta_mensual">0</h3>

                        <p>Cantidad Mensual Requerida</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-calendar-alt"></i>
                      </div>
                     
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3 id="venta_anual">0</h3>

                        <p>Cantidad Anual Requerida</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-signal"></i>
                      </div>
                      
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
               </div>                        
               </div>
               <div class="card-footer">   
               <table id="tabla_venta" class="display table table-striped table-dark table-responsive text-nowrap" style="width:100%">              
                  <thead>
                      <tr class="text-center">
                          <th>Codigo</th>
                          <th>Fecha</th>
                          <th>Retira</th>
                          <th>Destino</th>
                          <th>DNI</th>
                          <th>Total</th>                
                          <th>Autoriza</th>
                          <th>Resultado</th>
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
<script src="../js/Reportes.js"></script>
