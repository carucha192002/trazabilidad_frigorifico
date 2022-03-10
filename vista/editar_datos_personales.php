<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==4||$_SESSION['us_tipo']==5){
 include_once 'layouts/header.php'
?>
  <title>Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
    <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="cambiocontra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
            <b>
                <?php
                    echo $_SESSION['nombre_us'];
                 ?>
            </b>
        </div>
        <div class="alert alert-success text-center" id="update" style='display:none;'>
            <span><i class="fas fa-check m-1"></i>Se cambio contraseña exitosamente</span>
        </div>
        <div class="alert alert-danger text-center" id="noupdate" style='display:none;'>
            <span><i class="fas fa-times m-1"></i>Contraseña no es correcta</span>
        </div>
        <form id="form-pass">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                 </div>
                 <input id="oldpass"type="password" class="form-control" placeholder="Ingrese contraseña actual">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-lock"></i></span>
                 </div>
                 <input id="newpass" type="text" class="form-control"placeholder="Ingrese nueva contraseña">
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
<div class="animate__animated animate__bounceInDown modal fade" id="cambiophoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar1"src="" class="avatar1">
        </div>
        <div class="text-center">
            <b>
                <?php
                    echo $_SESSION['nombre_us'];
                ?>
            </b>
        </div>
        <div class="alert alert-success text-center" id="edit" style='display:none;'>
            <span><i class="fas fa-check m-1"></i>Se cambio la foto de perfil</span>
        </div>
        <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
            <span><i class="fas fa-times m-1"></i>formato no soportado</span>
        </div>
        <form id="form-photo" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-5 mt-2">
                <input type="file" name="photo"class="input-group">
                <input type="hidden" name="funcion" value="cambiar_foto">
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img id='avatar2'src="../img/avatar.png" class="imagen_cambiar_avatar">
                                </div>
                               <div class="text-center mt-1">
                                <button type='button' data-toggle="modal" data-target="#cambiophoto"class="btn btn-primary btn-sm">Cambiar Foto de Perfil</button>
                               </div>
                                <input id="id_usuario"type="hidden" value="<?php echo $_SESSION['usuario']?>">
                                <h3 id="nombre_us"class="profile-username text-center text-success">Nombre</h3>
                                <p id="apellidos_us"class="text-muted text-center">Apellidos</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">Edad</b><a id="edad" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">DNI o CUIL</b><a id="dni_us" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">Tipo Usuario</b>
                                        <span id="us_tipo"class="float-right">Administrador</span>
                                    </li>
                                    <button data-toggle="modal" data-target="#cambiocontra" type="button"class="btn btn-block btn-outline-warning btn-sm">Cambiar Contraseña</button>
                                </ul>
                            </div>
                        </div>
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class= "card-title">Sobre mi</h3>
                            </div>
                            <div class="card-body">
                                <strong style="color:#0B7300">
                                <i class="fas fa-phone mr-1"></i>Telefono
                                </strong>
                                <p id='telefono_us'class="text-muted">4234234</p>
                                <strong style="color:#0B7300">
                                <i class="fas fa-map-marker-alt mr-1"></i>Domicilio
                                </strong>
                                <p id="domicilio_us"class="text-muted">4234234</p>
                                <strong style="color:#0B7300">
                                <i class="fas fa-at mr-1"></i>Email
                                </strong>
                                <p id="email_us"class="text-muted">4234234</p>
                                <strong style="color:#0B7300">
                                <i class="fas fa-smile-wink mr-1"></i>sexo
                                </strong>
                                <p id="sexo_us"class="text-muted">4234234</p>
                                <strong style="color:#0B7300">
                                <i class="fas fa-pencil-alt mr-1"></i>Informacion Adicional
                                </strong>
                                <p id="adicional_us"class="text-muted">4234234</p>
                                <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                            </div>
                            <div class="card-footer">
                            <p class="text-muted">click en boton si desea editar</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                    <section id="datos_pers_edit">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Editar datos personales</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success text-center" id="editado" style='display:none;'>
                                    <span><i class="fas fa-check m-1"></i>Editado</span>
                                </div>
                                <div class="alert alert-danger text-center" id="noeditado" style='display:none;'>
                                    <span><i class="fas fa-times m-1"></i>Edicion deshabilitada</span>
                                </div>
                                <form id='form-usuario'class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                        <div class="col-sm-10">
                                        <input type="number" id="telefono" class="form-control"  placeholder="Sin 0 el cod de area 260 sin 15 el numero 4567890 Ej: 26044567890" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nacimientofecha" class="col-sm-2 col-form-label">F.Nacimiento</label>
                                        <div class="col-sm-10">
                                        <input type="date" id="nacimientofecha" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="domicilio" class="col-sm-2 col-form-label">Domicilio</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="domicilio" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                        <input type="email" id="email" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="sexo" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group row">
                                        <label for="adicional" class="col-sm-2 col-form-label">Informacion Adicional</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="adicional" cols="30" rows="10" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 float-right">
                                            <button class="btn btn-block btn-outline-success">Guardar</button>
                                        </div>
                                        <div class="form-group row">
                                        <label for="secretaria" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                        <input type="hidden" id="secretaria" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Cuidado con ingresar datos erroneos</p>
                            </div>
                        </div>
                    </div>
                    </section>
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
<script src="../js/Usuario1.js"></script>