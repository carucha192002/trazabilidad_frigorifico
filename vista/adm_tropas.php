<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==3){
 include_once 'layouts/header.php'
?>

  <title>Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
    <!-- Button trigger modal -->
<!-- Modal -->
<div class="animate__animated animate__bounceInDown modal fade" id="borrados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tropas Borradas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-hover text-nowrap card-body p-0 table-responsive text-center">
                <thead class="table-success">
                    <tr>
                    <th>Cantidad</th>   
                    <th>Nombre</th>  
                    <th>Procedencia</th>  
                    <th>Especie</th> 
                    <th>Desde</th>  
                    <th>Cantidad</th>  
                    <th>Hasta</th>   
                    <th >Accion</th>    
                    </tr>                
                </thead>  
                <tbody class="table-warning" id="registros">
                </tbody>          
            </table> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
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

<div class="animate__animated animate__bounceInDown modal fade" id="creartropas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear Tropas</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>La tropa ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-crear-tropas">
               
                    <div class="form-group">
                        <label id="usuario_tropas1">USUARIO</label>
                        <select id="usuario_tropas" type="text" style="width: 100%" class="form-control select2" placeholder="Ingrese Usuario Tropas"  required></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="usuarioagregarmodal" class="dropdown-item" href="adm_matarife.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarusuariomodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                    </div>
                    <div class="form-group">
                        <label id="procedencia_tropas1">PROCEDENCIA</label>
                        <select id="procedencia_tropas" type="text" style="width: 100%" class="form-control select2" placeholder="Ingrese Procedencia" required></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="procedenciaagregarmodal" class="dropdown-item" href="adm_procedencia.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarprocedenciamodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                    </div>
                    <div class="form-group">
                        <label for="especie_tropas">ESPECIE</label>
                        <select id="especie_tropas" type="text" style="width: 100%" class="form-control select2" placeholder="Ingrese Procedencia" required></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="espoecieagregarmodal" class="dropdown-item" href="adm_especies.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarespeciemodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                    </div>
                    <div class="form-group">
                        <label for="vigencia_tropas">VIGENCIA HASTA:</label>
                        <select id="vigencia_tropas" name="year" style="width: 100%"  class="form-control select2">
                      <option value="0">Año</option>
                      <?php  for($i=2021;$i<=2100;$i++) { echo "<option value='".$i."'>".$i."</option>"; } ?>
                    </select>
                    </div>        
                
                    <div class="form-group">
                        <label for="asignacion_tropas">ASIGNACION</label>
                        <input id="asignacion_tropas" type="number" style="text-transform:uppercase" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="desde_tropas">DESDE</label>
                        <input id="desde_tropas" type="number" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="hasta_tropas">HASTA</label>
                        <input id="hasta_tropas" type="number" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    
                    <input type="hidden" id="id_edit_prod">
                    <input  type="hidden" id="ano" value="<?php echo date("Y")?>">
                    
          </div>
          <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" id="buscar_borrado" class="btn bg-gradient-success float-right m-1">Habilitar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="animate__animated animate__bounceInDown modal fade" id="comenzar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">COMENZAR TROPA EN</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                  <span><i class="fas fa-times m-1"></i>La tropa ya existe</span>
              </div>
              <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
              </div>
              
                <form id="form-cambiar-tropas">
               
                    
                    <div class="form-group">
                        <label for="vigencia_tropas_cambiar">VIGENCIA HASTA:</label>
                        <input id="vigencia_tropas_cambiar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>        
                
                    <div class="form-group">
                        <label for="comenzar_tropas_cambiar">COMENZAR DESDE</label>
                        <input id="comenzar_tropas_cambiar" type="number" style="width: 100%" class="form-control " placeholder="Ingrese donde comenzara" required>
                    </div>
                    <div class="form-group">
                        <label for="desde_tropas_cambiar">DESDE</label>
                        <input id="desde_tropas_cambiar" type="number" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="hasta_tropas_cambiar">HASTA</label>
                        <input id="hasta_tropas_cambiar" type="number" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    
                    <input type="hidden" id="id_edit_prod_cambiar">
                    <input type="hidden" id="usados">
                    <input type="hidden" id="usados1">
                    <input type="hidden" id="usados2">
                    
                    
          </div>
          <div class="card-footer">
          <button id="guardarhasta"type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
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
            <h1>Gestion tropas<button id="button-crear" type="button" data-toggle="modal" data-target="#creartropas" class="btn bg-gradient-primary ml-2">Crear tropas</button>
            <button id="button-imprimir" type="button" data-toggle="modal" data-target="#imprimirtropas" class="btn bg-gradient-success ml-2">Imprimir Tropas</button> <button id="button-recuperar" type="button" data-toggle="modal" data-target="#borrados" class="btn bg-gradient-danger ml-2">Recuperar Borrados</button></h1>  
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Tropas</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    <form  id="form_listado"> 
       <div class="container-fluid">
       <div>
           <div class="card card-info">
               <div class="card-header">
               <h3 class="card-title">Consultas de Ingresos</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_tropas" class="table table" style="text-transform:uppercase">
        <thead>
            <tr class="text-center" >
                <th style="text-transform:uppercase">Id</th>
                <th style="text-transform:uppercase">Matarife</th>
                <th style="text-transform:uppercase">Procedencia</th>
                <th style="text-transform:uppercase">Especie</th>
                <th style="text-transform:uppercase">Vigencia</th>
                <th style="text-transform:uppercase">Desde</th>
                <th style="text-transform:uppercase">Cantidad</th>
                <th style="text-transform:uppercase">Hasta</th>  
                <th style="text-transform:uppercase">Quedan</th>            
                <th style="text-transform:uppercase">Accion</th>
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
               <h3 class="card-title">Buscar Tropas</h3>
               <div class="input-group">
                   <input type="text" id="buscar-tropas" class="form-control float-left" placeholder="Ingese Nombre del tropas">
                   <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                   </div>
               </div>
               </div>
               <div class="card-body">
                    <div id="tropasbuscar" class="row d-flex align-items-stretch">
               
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
<script src="../js/datatables.js"></script>
<script src="../js/tropas.js"></script>
<script src="../js/resultadostropas.js"></script>
