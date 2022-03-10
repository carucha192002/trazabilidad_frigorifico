<?php
session_start();
if($_SESSION['us_tipo']==3){
 include_once 'layouts/header.php'
?>

  <title>Municipalidad de Malargüe</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__fadeIn">GESTION BACKUP</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Backup</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      
    </section>

    <!-- Main content -->

    <section class="content">
    <div class="lockscreen-wrapper">
	<form method="POST" action="../controlador/Backup.php">
	<div class="form-group row">
					     	
					      	<div class="col-sm-9">
					        	<input type="hidden" class="form-control" id="server" name="server" value="localhost" required>
					      	</div>
					    </div>
					    <div class="form-group row">
					      	
					      	<div class="col-sm-9">
					        	<input type="hidden" class="form-control" id="username" name="username" value="user_matadero" required>
					      	</div>
					    </div>
					    <div class="form-group row">
					     
					      	<div class="col-sm-9">
					        	<input type="hidden" class="form-control" id="password" name="password" value="fobU=abro+u6oVow#stl" >
					      	</div>
					    </div>
					    <div class="form-group row">
					
					      	<div class="col-sm-9">
					        	<input type="hidden" class="form-control" id="dbname" name="dbname"value="muni_matadero" required>
					      	</div>
							  </div>
      <div class="lockscreen-logo">
        <a><b id="us_tipo"></b></a>
      </div>
      <input type="hidden"id="id_usuario" value="<?php echo $_SESSION['usuario']?>">
      <!-- User name -->
      <div id="nombre_us" class="lockscreen-name"></div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img id="avatar1" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->
      
        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials">
          <div class="input-group">
            <input type="password" class="form-control text-center" placeholder="    GENERAR BACKUP"disabled>

            <div class="input-group-append">
              <button id="enviarpass" type="submit" class="btn" name="backup"><i class="fas fa-arrow-right text-muted"></i></button>
            </div>
          </div>
	  
    </form>
    <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
 
  
</div>   
    </section>
    <!-- /.content -->
    <section>
  <form  id="form_listado"> 
       <div class="container-fluid">
       <div>
           <div class="card card-success">
               <div class="card-header">
               <h3 class="card-title">BACKUP</h3>             
               </div>
               </div>
               <div class="card-body table-responsive">               
               <div class="container-fluid">
               <table id="tabla_listado" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
        <th>Id</th>
                  <th>Fecha</th>
                 <th>Dia</th>
                 <th>Nombre</th>
                <th>Usuario</th>
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
  </section>
  </div>
  <!-- /.content-wrapper -->



<?php
include_once 'layouts/footer.php';
 }
 else{
     header('Location:../index.php');
 }
?>
<script src="../js/datatables.js"></script>
<script src="../js/Backup.js"></script>


