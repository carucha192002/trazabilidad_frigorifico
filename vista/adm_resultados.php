<?php
session_start();
if(($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==3)){
 include_once 'layouts/header.php'
?>

  <title>Gestion Resultados</title>
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
            <h1>Gestion Resultados</h1>               
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Resultados</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
   
    <section>
       <div class="container-fluid">
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">Estadisticas</h3>
               
               </div>
               </div>
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
  </div>
<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location: ../index.php');
 }
?>
<script src="../js/Chart.min.js"></script>
<script src="../js/Resultados.js"></script>
