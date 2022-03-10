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
<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Accion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar3" src="../img/avatar.png" class="avatar3">
        </div>
        <div class="text-center">
            <b>
                <?php
                    echo $_SESSION['nombre_us'];
                 ?>
            </b>
            
        </div>
            <div class="input-group mb-3">
               <select name="categoria" id="categoria1" class="form-control select2" style="width:100%"></select> 
               <input id="categoriamodal" type="hidden" class="form-control">    
                <input id="categoriamodalnombre" type="hidden" class="form-control">   
            </div> 
        <span>Necesitamos su Contraseña para Continuar</span>
        <div class="alert alert-success text-center" id="confirmado" style='display:none;'>
            <span><i class="fas fa-check m-1"></i>Se modifico el Usuario</span>
        </div>
        <div class="alert alert-danger text-center" id="rechazado" style='display:none;'>
            <span><i class="fas fa-times m-1"></i>Contraseña no es correcta</span>
        </div>
        <form id="form-confirmar">
                       
            <div class="input-group mb-3">            
                <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                 </div>
                 <input id="oldpass"type="password" class="form-control" placeholder="Ingrese contraseña actual">
                 <input type="hidden" id="id_user">
                 <input type="hidden" id="funcion">              
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button id="guardarascender"type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="animate__animated animate__bounceInDown modal fade" id="crearusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear Usuario</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El DNI existe</span>
              </div>
                <form id="form-crear">
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input id="nombre" type="text" class="form-control"placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" type="text" class="form-control"placeholder="Ingrese Apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Nacimiento</label>
                        <input id="edad" type="date" class="form-control"placeholder="Ingrese Nacimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input id="dni" type="text" class="form-control"placeholder="Ingrese DNI" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input id="pass" type="password" class="form-control"placeholder="Ingrese Contraseña" required>
                    </div>         
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control select2" style="width:100%"></select> 
                        <input id="rolmodal" type="hidden" class="form-control">    
                        <input id="rolmodalnombre" type="hidden" class="form-control">                    
                    </div>         
          </div>
          <div class="card-footer">
          <button id="guardar" type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
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
            <h1>Gestion usuarios<button id="button-crear" type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear Usuario</button></h1>
            <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['us_tipo']?>">    
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion usuarios</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
       <div class="container-fluid">
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Buscar usuario</h3>
               <div class="input-group">
                   <input type="text" id="buscar" class="form-control float-left" placeholder="Ingese Nombre de Usuario">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
               </div>
               </div>
               <div class="card-body">
                    <div id="usuarios" class="row d-flex align-items-stretch">
               
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
     header('Location: ../index.php');
 }
?>
<script src="../js/Gestion_usuario.js"></script>