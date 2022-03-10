<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==4){
 include_once 'layouts/header.php'
?>

  <title>Municipalidad de Malargüe</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>

<div class="modal fade col-md-12" id="Barras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-warning">
          <div class="card-header">
              <h3 class="card-title">Ingresar por Codigo de Barras</h3>
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
              
                <form action="#" id="form-carrito_barras">
                <div class="input-group">
                   <input type="text" id="buscar-barras" class="form-control float-left" onkeypress="recuperar(event)">
                   <div class="input-group-append">
                        <button class="btn btn-default" id="boton"><i class="fas fa-search"></i></button>
                   </div>
                   </div>
                    <div class="form-group">
                        <label for="tropa_carrito_barras">NUMERO DE TROPA</label>
                        <input id="tropa_carrito_barras" type="number" style="text-transform:uppercase" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="especie_carrito_barras">ESPECIE</label>
                        <input id="especie_carrito_barras" type="text" style="text-transform:uppercase" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="despiece_carrito_barras">CUARTEADO</label>
                        <input id="despiece_carrito_barras1" type="text" style="text-transform:uppercase" class="form-control"  disabled>
                        <input id="despiece_carrito_barras" type="hidden" style="text-transform:uppercase" class="form-control" placeholder="Nombre del cuarteado" disabled>
                    </div>
                    <b><h3 id="contador1"class="text-center">GARRONES</h3></b>
                    
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                       
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Tropa</th>
                        <th>Especie</th>
                        <th>Cuarteado</th>
                        <th>Garron</th>
                        <th>Peso</th>
                        <th>Productor</th>
                        <th>Matarife</th>
                        <th>Eliminar</th>
                        <th style="visibility: hidden">Precio</th> 
                              
                        </tr>
                        <tbody id="garroncarritobarras" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                        
                      </thead>
                      
                    </table> 
                    
                        
                    <br>     
                </div>
                </div>
                   
                   
                    
                    <input type="hidden" id="id_edit_prod_barras">
                    
          </div>
          <div class="card-footer">
        
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          <button id="eliminartodo" type="button"  class="btn btn-danger float-right m-1">Vaciar Todo</button>
          <button id="procesartodo" type="button"  class="btn btn-success float-right m-1">Ingresar todo</button>
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
            <h1 class="animate__animated animate__fadeIn">Matadero Frigorifico Malargüe</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Despacho</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      
    </section>

    <!-- Main content -->
    <section>
       <div class="container-fluid">
          
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Lotes en riesgo</h3>               
               </div>
               <div class="modal-content">
               <div class="card-body p-0 table table-responsive nowrap">
                    <table class="animate__animated animate__fadeIn table table-responsive nowrap">
                      <thead class="table-success text-center">
                        <tr class="text-center">
                              <th>Codigo</th>
                              <th>Tropa</th>
                              <th>Especie</th>
                              <th>Cuarteado</th>
                              <th>Productor</th>
                              <th>Camara</th>
                              <th>Conservacion</th>
                              <th>Fecha Faena</th>
                              <th>Vida Util</th>
                              <th>Mes</th>
                              <th>Dia</th>
                        </tr>
                        <tbody id="lotes" class="table-active text-center">  
                        </tbody>
                      </thead>
                    </table>               
               </div>
               <div class="card-footer">              
               </div>
           </div>
       </div>
    </section>

    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <ul class="nav nav-pills">
           
              <li class="nav-item"><a href="#vbarras" class="nav-link active" data-toggle="modal" data-target="#Barras">Ingresar por Barras</a></li>
             
            </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" >
               
                <div class="tab-pane" id="vbarras">
                  <div class="card card-info">
                    <div class="card-header">
                      <div class="card-title">Buscar por Codigo de Barras</div>
                      <div class="input-group">
                   <button  id="buscar-obras" class="btn btn-default" > </button>
                   <div class="input-group-append">
                      
                   </div>
                  </div>
                    </div>
                    <div class="card-footer"></div>
                    <div id="obras" class="row d-flex align-items-stretch">
                  </div>
                  </div>
                </div>
                <div class="tab-pane" id="vdirecciones">
                  <div class="card card-success">
                    <div class="card-header">
                      <div class="card-title">Buscar por Direcciones</div>
                      <div class="input-group">
                   <input type="text" id="buscar-direcciones" class="form-control float-left" placeholder="Ingese Nombre de la Direccion o Area">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
                  </div>
                    </div>
                    </div>
                    <div class="card-footer">
                    <div id="direcciones" class="row d-flex align-items-stretch">
                  </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="vexpedientes">
                  <div class="card card-success">
                    <div class="card-header">
                      <div class="card-title">Buscar por Expedientes</div>
                      <div class="input-group">
                   <input type="number" id="buscar-expedientes" class="form-control float-left" placeholder="Ingese Numero de Expediente">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
                  </div>
                    </div>
                    </div>
                    <div class="card-footer">
                    <div id="expedientes" class="row d-flex align-items-stretch">
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
            
            </div>
          </div>
        </div>
      </div>
    </div>    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location:../index.php');
 }
?>

<script src="../js/ingresoporbarras.js"></script>
<script src="../js/Despacho.js"></script>

