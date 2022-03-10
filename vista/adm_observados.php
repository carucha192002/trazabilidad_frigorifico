<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
 include_once 'layouts/header.php'
?>
<?php
 include_once 'layouts/nav.php'
 
?>

     
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
                        <input type="hidden" id="id_observacion"class="form-control"disabled>
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
                    <span class="text-muted float-left"></span></br>
                    <span class="badge bg-success"></span></br>
                   
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
              <button type="button" id="imprimir" class="btn bg-gradient-success float-right m-1">Imprimir</button>
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
               <h3 class="card-title">Consultas de Garrones Procesados Observados</h3>             
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
                 <th>Especie</th>
                 <th>Productor</th>
                 <th>Matarife</th>
                 <th>DT-e</th>
                 <th>Garron</th>
                <th>Peso</th>
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
<script src="../js/observados.js"></script>
<script src="../js/nav.js"></script>
