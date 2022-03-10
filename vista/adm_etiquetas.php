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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__fadeIn">GESTION DE ETIQUETAS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Etiquetas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      
    </section>

    <!-- Main content -->

    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <ul class="nav nav-pills">
              <li class="nav-item"><a href="#vtropas" class="nav-link active" data-toggle="tab">Buscar por Tropas</a></li>
            
            </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" >
                <div class="tab-pane active" id="vtropas">
                  <div class="card card-success">
                    <div class="card-header">
                      <div class="card-title">Buscar por Topas</div>
                      <div class="input-group">
                   <input type="number" id="buscar-producto" class="form-control float-left" placeholder="Ingese Numero de Tropas">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
                  </div>
                    </div>
                    <div class="card-footer"> 
                    
                  <div id="productos" class="row d-flex align-items-stretch">
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
<script src="../js/Etiqueta.js"></script>
