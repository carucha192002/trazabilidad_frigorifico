<?php
session_start();
if($_SESSION['us_tipo']==3){
 include_once 'layouts/header.php'
?>

  <title>Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
    <!-- Button trigger modal -->
<!-- Modal -->
<div class="animate__animated animate__bounceInDown modal fade" id="cambiologo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="logoactual"src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
            <b id="nombre_logo">
            </b>
        </div>
        <div class="alert alert-success text-center" id="edit" style='display:none;'>
            <span><i class="fas fa-check m-1"></i>Se cambio el logo</span>
        </div>
        <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
            <span><i class="fas fa-times m-1"></i>formato no soportado</span>
        </div>
        <form id="form-logo" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-5 mt-2">
                <input type="file" name="photo"class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id_logo_prod" id="id_logo_prod">
                <input type="hidden" name="avatar" id="avatar">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="animate__animated animate__bounceInDown modal fade" id="creartransporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear transporte</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El transporte ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-crear-transporte">
               
                    <div class="form-group">
                        <label for="nombre_transporte">Dominio del Transporte</label>
                        <input id="nombre_transporte" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese el dominio transporte" required>
                    </div>
                    <div class="form-group">
                        <label for="habilitacion_transporte">Habilitacion del Transporte</label>
                        <input id="habilitacion_transporte" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese la habilitacion del transporte" required>
                    </div>
                    
                    <input type="hidden" id="id_edit_prod">
                    
          </div>
          <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
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
            <h1>Gestion Transporte<button id="button-crear" type="button" data-toggle="modal" data-target="#creartransporte" class="btn bg-gradient-primary ml-2">Crear Transporte</button></h1>               
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Transporte</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
       <div class="container-fluid">
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Buscar Transporte</h3>
               <div class="input-group">
                   <input type="text" id="buscar-transporte" class="form-control float-left" placeholder="Ingese Nombre del Transporte">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
               </div>
               </div>
               <div class="card-body">
                    <div id="transporte" class="row d-flex align-items-stretch">
               
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
<script src="../js/transporte.js"></script>