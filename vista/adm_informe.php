<?php
session_start();
if($_SESSION['us_tipo']==3){
 include_once 'layouts/header.php'
?>

  <title>Gestion Resultados Personales</title>
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
          <div class="col-sm-12">
            <h1>Gestion Resultados Globales</h1> 
            <button  id="matarife_fudepem" class="btn btn-success">Buscar Matarife FUDEPEM</button>
            <button  id="matarife_comun" class="btn btn-info">Buscar Matarife</button>
            <div class="callout callout-info">
                  <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Seleccione un Usuario de FUDEPEM</font></font></h5>
                  <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <select name="usuario" id="usuario" class="form-control select2" style="width:100%"></select>                        
                    <input type="hidden" id="usuariseleccionado" value="1">
                    <input type="hidden" id="usuariseleccionado1">
                    <div class="form-group">
                        <label for="desdefaenas">Desde </label>
                        <input id="desdefaenas" type="date" style="text-transform:uppercase" class="form-control">
                        
                       
                    </div>
                    <div class="form-group">
                        <label for="hastafaenas">Hasta </label>
                        <input id="hastafaenas" type="date" style="text-transform:uppercase" class="form-control">
                       
                       
                    </div>

                    
                    <button  id="guardarfaenas" class="btn btn-success">Buscar</button>
                    <button  id="guardarfaenastodas" class="btn btn-info">VER TODOS LOS RESULTADOS</button>
                    <button  id="imprimirfaenas" class="btn btn-warning">IMPRIMIR INFORME</button>
                    <button  id="imprimirfaenastodas" class="btn btn-success">IMPRIMIR INFORME TOTAL</button>
                   
                    </div> 
                 </div>    
                  
          </div>
          
    </section>

    <section>
    
    </section>
    <form>
    <div>
       <div class="container-fluid">
       <div>
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Consultas</h3>               
               </div>
               </div>
               <div class="card-body table-responsive">  
               <div class="container-fluid">
               <table id="tabla_pendientes" class="table table" style="width:100%">
        <thead >
            <tr class=text-center>
                <th>ID</th>
                <th>Fecha</th>
                <th>Tropa</th>
                <th>Matarife</th>
                <th>DT-e</th>
                <th>Cantidad</th>
                <th>Desde</th>
                <th>Hasta</th>                
                <th>Clasificacion</th>
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
  <section>
  <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Estadisticas Matanzas por mes año actual</h2>
                            <div class="chart-responsive">
                            <canvas id="grafico1" style="min-height:250px; height:250px; max-height: 250px; max-width: 100%"></canvas>

                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        
                            <h2>Comparativa de faenas de meses con el año anterior</h2>
                            <div class="chart-responsive">
                                <canvas id="grafico2" style="min-height:250px; height:250px; max-height: 250px; max-width: 100%"></canvas>
                            </div>
                        </div>
               </div>
               <div class="card-footer">
               
               </div>
           </div>
       </div>
  </section>
<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location:../index.php');
 }
?>
<script src="../js/datatables.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/informe.js"></script>
