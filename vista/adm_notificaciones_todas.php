<?php
session_start();
if($_SESSION['us_tipo']==3||$_SESSION['us_tipo']==4){
 include_once 'layouts/header.php'
?>
  <title>Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
    <!-- Button trigger modal -->
<!-- Modal -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notificaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notificaciones</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="card">
        <div class="card-body">
          <table id="noti" class="table table-hover">

            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
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
 <script src="../js/notificaciones.js"></script>
 <script src="../js/datatables.js"></script>
 

