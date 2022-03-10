<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
 include_once 'layouts/header.php'
?>

  <title>Municipalidad de Malargüe</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Matadero Frigorifico Municipal</h1>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                    </div>
                    <div class="card-body p-0">
                        <header>
                            <div class="logo_cp">
                                <img src="../img/logo.png" width="200" height="50">
                            </div>
                            <h1 class="titulo_cp">SOLICITUD DE PEDIDO</h1>
                            <div class="datos_cp">
                            <div class="form-group row">
                                    <span id="titulo-select-retira">RETIRA: </span>
                                    <div class="input-group-append col-md-6">
                                    <select  class="form-control select2" style="width:60%" id="cliente1" placeholder="Ingresa nombre"></select>
                                    <div class="input-group-append">  
                                    <button style="width:100%" class="btn btn-success" id="desbloquear"> Mas clientes</i></a>
                                    <button class="btn btn-info" id="actualizar">Actualizar</i></button>
                                        </div>
                                       
                                       
                                    </div>
                                  
                                </div>
                              
                                <div class="form-group row">
                                    <span id="titulofude">FUDEPEN: </span>
                                    <div class="input-group-append col-md-6">
                                    <select class="form-control select2"id="clientefudepen" placeholder="Ingresa nombre" required></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span id="titulonombre">RETIRA: </span>
                                    <div class="input-group-append col-md-6">
                                    <input  type="" style="text-transform:uppercase" class="form-control" id="cliente" placeholder="Ingresa nombre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>DNI o CUIT: </span>
                                    <div class="input-group-append col-md-6">
                                        
                                    <input type="" style="text-transform:uppercase" class="form-control" id="dni" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>DESTINO: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" style="text-transform:uppercase" class="form-control" id="destino" placeholder="Ingresa Destino" require>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>ESTADO: </span>
                                    <div class="input-group-append col-md-6">
                                        <input  style="text-transform:uppercase" class="form-control" name="estado" id="estado" value="EN PROCESO"  disabled>
                                    </div>
                                </div>
                            
                                
                        </header>
                        <button id="actualizar" class="btn btn-success">Actualizar</button>
                        
                        <div id="cp"class="card-body p-0">
                            <table class="compra table table-hover text-nowrap table-responsive">
                                <thead class='table-success'>
                                    <tr>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Especie</th>
                                        <th scope="col">Cuarteado</th>
                                        <th scope="col">Garron</th>
                                        <th scope="col">Tropa</th>
                                        <th scope="col">Vencimiento</th>
                                        <th scope="col">Cantidad</th>                                        
                                        <th scope="col">Eliminar</th>                                        
                                        <th scope="col">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-compra" class='table-active'>
                                    
                                </tbody>
                            </table>
                            <div class="row " style="visibility: hidden">
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-dollar-sign"></i>
                                            Calculo 1
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="info-box mb-3 bg-warning p-0">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">SUB TOTAL</span>
                                                    <span class="info-box-number" id="subtotal"></span>
                                                </div>
                                            </div>
                                            <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">IGV</span>
                                                    <span class="info-box-number"id="con_igv">21%</span>
                                                </div>
                                            </div>
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">SIN DESCUENTO</span>
                                                    <span class="info-box-number" id="total_sin_descuento"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-bullhorn"></i>
                                            Calculo 2
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="info-box mb-3 bg-danger">
                                                <span class="info-box-icon"><i class="fas fa-comment-dollar"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">DESCUENTO</span>
                                                    <input id="descuento"type="number" min="1" placeholder="Ingrese descuento" class="form-control">
                                                </div>
                                            </div>
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">TOTAL</span>
                                                    <span class="info-box-number" id="total"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-cash-register"></i>
                                            Cambio
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                        <div class="info-box mb-3 bg-success">
                                            <span class="info-box-icon"><i class="fas fa-money-bill-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text text-left ">INGRESO</span>
                                                <input type="number" id="pago" min="1" placeholder="Ingresa Dinero" class="form-control">
                                               
                                            </div>
                                        </div>
                                        <div class="info-box mb-3 bg-info">
                                            <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text text-left ">VUELTO</span>
                                                <span class="info-box-number" id="vuelto">3</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="../vista/adm_despacho.php" class="btn btn-primary btn-block">Seguir viendo</a>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <a href="#" class="btn btn-success btn-block" id="procesar-compra">Realizar Pedido</a>
                            </div>
                        </div>
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
<script src="../js/Carrito.js"></script>