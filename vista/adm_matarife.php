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
<div class="animate__animated animate__bounceInDown modal fade" id="crearmatarife" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear Matarife</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El matarife ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-crear-matarife">
               
                    <div class="form-group">
                        <label for="nombre_matarife">Matarife</label>
                        <input id="nombre_matarife" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="cuit_matarife">CUIT</label>
                        <input id="cuit_matarife" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese CUIT Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="establecimiento_matarife">Establecimiento</label>
                        <input id="establecimiento_matarife" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Establecimiento Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="email_matarife">Email</label>
                        <input id="email_matarife" type="email"  class="form-control" placeholder="Ingrese Email Matarife" required>
                    </div>
                    
                    <input type="hidden" id="id_edit_prod">
                    <input type="hidden" id="id_matarife">
                    
          </div>
          <div class="card-footer">
          <button type="button" id="guardar_crear_matarife" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          </div>
      </div>
    </div>
    </div>
    </div>
 

<div class="animate__animated animate__bounceInDown modal fade" id="agregaritem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-danger">
          <div class="card-header">
              <h3 class="card-title">Agregar SUB ITEM</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El matarife ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-agregar-matarife">
               
                    <div class="form-group">
                        <label for="nombre_matarife_agregar">Matarife</label>
                        <input id="nombre_matarife_agregar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="cuit_matarife_agregar">CUIT</label>
                        <input id="cuit_matarife_agregar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese CUIT Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="identificador_matarife">Nº IDENTIF</label>
                        <input id="identificador_matarife" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Identificador del Matarife" required>
                    </div>
                    
                    <input type="hidden" id="id_edit_prod_agregar">
                    <input type="hidden" id="id_matarife_agregar">
                    
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
<div class="animate__animated animate__bounceInDown modal fade" id="editaritem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-danger">
          <div class="card-header">
              <h3 class="card-title">EDITAR SUB ITEM</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El matarife ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-editar-matarife">
               
                    <div class="form-group">
                        <label for="nombre_matarife_editar">Matarife</label>
                        <input id="nombre_matarife_editar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="cuit_matarife_editar">CUIT</label>
                        <input id="cuit_matarife_editar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese CUIT Matarife" required>
                    </div>
                    <div class="form-group">
                        <label for="identificador_editar">Nº IDENTIF</label>
                        <input id="identificador_editar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Identificador del Matarife" required>
                    </div>
                    
                    <input type="hidden" id="id_edit_prod_editar">
                    <input type="hidden" id="id_matarife_editar">
                    
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
            <h1>Gestion Matarife<button id="button-crear" type="button" data-toggle="modal" data-target="#crearmatarife" class="btn bg-gradient-primary ml-2">Crear Matarife</button></h1>               
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Matarife</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    <input id="prioridad" type="hidden" value="<?php  echo $_SESSION['us_tipo']?>">
    <form  id="form_listado"> 
       <div class="container-fluid">
       <div>
           <div class="card card-info">
               <div class="card-header">
               <h3 class="card-title">SUB ITEM</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_subitem" class="table table" style="width:100%">
               
        <thead>
        <tr class="text-center">
                 <th>ID</th>
                 <th>MATARIFE</th>
                 <th>Nombre</th>
                <th>CUIT Nº</th>
                <th>Nº Identificador</th>  
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
  
       <div class="container-fluid">
           <div class="card card-success">
               <div class="card-header">
               
               <h3 class="card-title">Buscar Matarife</h3>
               <div class="input-group">
                   <input type="text" id="buscar-matarife" class="form-control float-left" placeholder="Ingese Nombre del matarife">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
               </div>
               </div>
               <div class="card-body">
                    <div id="matarife" class="row d-flex align-items-stretch">
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
<script src="../js/matarife.js"></script>
<script src="../js/datatables.js"></script>
