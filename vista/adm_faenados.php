<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
 include_once 'layouts/header.php'
?>
<?php
 include_once 'layouts/nav.php'
 
?>

      <div class="modal fade col-md-12" id="editargarron" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editar Peso Garron</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
              <form id="form-datos" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="numero_tropa_editar">Nº de Tropa</label>
                        <input id="numero_tropa_editar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="especie_tropa_editar">Especie</label>
                        <input id="especie_tropa_editar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="productor_tropa_editar">Productor</label>
                        <input id="productor_tropa_editar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="matarife_tropa_editar">Matarife</label>
                        <input id="matarife_tropa_editar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="dte_tropa_editar">DT-e</label>
                        <input id="dte_tropa_editar" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="garron_id">Garron</label>
                        <input id="garron_id" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="peso_garron">Peso</label>
                        <input id="peso_garron" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                       
                        <input id="id_editar" type="hidden" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    
                    <div class="form-group">
                        <label for="editar_peso">Peso</label>
                        <input class="form-control select2"  id="editar_peso" type="float" style="width: 100%" value="0">
                    </div>
                    <div class="form-group">
                        <label for="observacion">Observacion</label>
                        <textarea class="form-control"  name="observacion_decomiso" id="observacion_decomiso" type="text" style="width: 100%"></textarea>
                    </div>
                    
                     <div class="form-group">
        
                    <label for="exampleInputFile">Imagen</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar_mod" id="avatar_mod">
                        <label class="custom-file-label" for="exampleInputFile">Seleccione una imagen</label>
                      </div>
                    </div>
                  </div>
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="button"  id="guardargarronpeso" class="btn btn-outline-light">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
           
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade col-md-12" id="vista_observacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">OBSERVACIONES</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="edit-lote" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div> 
             
              <form id="form-observaciones"> 
                    <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>TROPA</label>
                        <input type="number" id="tropamodal"class="form-control" placeholder="TROPA---" disabled>
                      </div>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha y Hora</label>
                        <?php $datos= date_default_timezone_set('America/Argentina/Mendoza');
                        $fecha = date("Y-m-d H:i:s");
                        ?>     
                        <div class="input-group-append">                 
                        <input type="text" id="fechamodal"class="form-control" style="text-transform:uppercase"placeholder="Fecha" value="<?php echo date("d/m/Y H:i:s")?>"disabled>
                      
                        </div>
                      </div>    
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Garron:</label>
                        <input type="text" id="garron_observacion"class="form-control" style="text-transform:uppercase"disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Peso:</label>
                        <input type="text" id="peso_observacion"class="form-control"disabled>
                      </div>
                    </div>
                  
              
              </div>
              <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Observaciones</h3>

  </div>
  <div class="card-body">
      <div id="productos" class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                 
                  <div class="col-sm-12">
                    <span class="text-muted float-left">Marca</span></br>
                    <span class="badge bg-success">Envio gratis</span></br>
                   
                    </br>
                  
                    </div>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
 
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
              </div>
          
              <div class="card-footer">
              <button type="button" id="guardar" class="btn bg-gradient-primary float-right m-1">Guardar</button>
              <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          
          </div>
      </div>
    </div>
  </div>
</div>
 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/estilosbotones.css">
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h4>MATADERO FRIGORIFICO REGIONAL MALARGÜE <?php echo date("Y")?></h4>
            <input id="añoactual" type="hidden"  value="<?php echo date("Y")?>">
            <div class="row">
          <div class="col-sm-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-calendar-alt"></i></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text text-center" >Fecha Actual</span>
                        <span class="info-box-text text-center"><?php echo date("d/m/Y")?></span>
                      </div>
              <!-- /.info-box-content -->
                  </div>
          </div>
          
           
          </div>
          </div>
          </div>
        
    </section>

  <title>Municipalidad de Malargüe</title>

</head>
<body>  
  
<form  id="form_listado_garron1"> 
       <div class="container-fluid">
       <div>
           <div class="card card-danger">
               <div class="card-header">
               <h3 class="card-title">Consultas de Garrones Procesados</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="form_listado_garron" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
                <th>ID</th>
                <th>Fecha Faena</th>
                 <th>Tropa</th>
                 <th>Garron</th>
                <th>Peso</th>
                 <th>Especie</th>
                 <th>Productor</th>
                 <th>Matarife</th>
                 <th>DT-e</th>
            
                <th>Observaciones</th>
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

        </div>

</body>

<footer>
<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location: ../index.php');
 }
?>
</footer>
<script src="../js/datatables.js"></script>
<script src="../js/faenados.js"></script>
<script src="../js/nav.js"></script>
