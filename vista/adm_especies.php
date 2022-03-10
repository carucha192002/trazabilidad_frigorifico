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

<div class="animate__animated animate__bounceInDown modal fade" id="crearespecies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear especies</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>El especies ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-crear-especies">
                    <div class="form-group">
                        <label for="nombre_especies">Nombre</label>
                        <input id="nombre_especies" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre" required>
                    </div>
                              
                    <input type="hidden" id="id_edit_prod">
                    
          </div>
          <div class="card-footer">
          <button type="button" id="guardar_crear_especies" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="animate__animated animate__bounceInDown modal fade" id="verespecies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-info">
          <div class="card-header">
              <h3 class="card-title">Ver Codigo de especies</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
         <section>
         <div class="small-box bg-info col-sm-12">
        <h6 id="titulo" style="text-transform:uppercase"class="text-center">CODIGOS DE ANIMALES</h6>
        <div class="row justify-content-center">
          <div class="col-auto">
            <table class="table table-responsive">
              <thead class="table">
                <tr class="text-center">
                  <th>CODIGO Nº</th>
                  <th>DIENTE</th>
                  <th>CATEGORIA</th>

                </tr>
              <tbody id="codigos" class="table-active text-center" style="text-transform:uppercase">
              </tbody>
              </thead>
            </table>
          </div>
        </div>
      </div>

         
         </section>
              
               
          <div class="card-footer">
         
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
         
          </div>
      </div>
    </div>
  </div>
</div>
<div class="animate__animated animate__bounceInDown modal fade" id="agregarsubespecies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear Subespecies</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>La Sub especie ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-crear-subespecies">
                    <div class="form-group">
                        <label id="nombre" style="text-transform:uppercase">Nombre</label>
                        <input id="nombre_subespeciescrear" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_especies">Codigo</label>
                        <input id="codigo_especies" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Codigo" required>
                    </div>
                    <div class="form-group">
                        <label for="Diente_especies">Diente</label>
                        <input id="diente_especies" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Dientes">
                    </div>
                    <input type="hidden" id="id_especies">
                    
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
<div class="animate__animated animate__bounceInDown modal fade" id="editarsubespecies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Editar Subespecies</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>La Sub especie ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-editar-subespecies">
                    <div class="form-group">
                        <label id="nombre_subespecies1" style="text-transform:uppercase">Nombre</label>
                        <input id="nombre_subespecieseditar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_especies1">Codigo</label>
                        <input id="codigo_especieseditar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Codigo" required>
                    </div>
                    <div class="form-group">
                        <label for="Diente_especies1">Diente</label>
                        <input id="diente_especieseditar" type="text" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Dientes">
                    </div>
                    <input type="hidden" id="id_especieseditar">
                    
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
            <h1>Gestion especies<button id="button-crear" type="button" data-toggle="modal" data-target="#crearespecies" class="btn bg-gradient-primary ml-2">Crear especies</button></h1>               
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion especies</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
       <div class="container-fluid">
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Buscar especies</h3>
               <div class="input-group">
                   <input type="text" id="buscar-especies" class="form-control float-left" placeholder="Ingese Nombre del Animal">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
               </div>
               </div>
               <div class="card-body">
                    <div id="especies" class="row d-flex align-items-stretch">
               
                    </div>               
               </div>
               <div class="card-footer">
               
               </div>
           </div>
       </div>
    </section>
    <section>
    <form  id="form_listado"> 
       <div class="container-fluid">
       <div>
           <div class="card card-info">
               <div class="card-header">
               <h3 class="card-title">Consultas</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_listados" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
                  <th>ID</th>
                 <th>CODIGO</th>
                 <th>DIENTE</th>
                 <th>CATEGORIA</th>
                <th>ESPECIE</th>
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
<script src="../js/Especies.js"></script>