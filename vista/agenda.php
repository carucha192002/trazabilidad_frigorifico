<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==5){
 include_once 'layouts/header.php'
?>
<?php
 include_once 'layouts/nav.php'
 
?>
<div class="animate__animated animate__bounceInDown modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
      
              <h4 class="modal-title" id="tituloevento">Agregar Eventos</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				
			  </div>
       
			  <div class="modal-body">
        <div class="form-group">
					<label for="semana" class="col-sm-2 control-label">Dia</label>
					  <input type="text" name="semana" class="form-control" id="semana" disabled>
				  </div>
              <div class="form-group">
					<label for="fecha" class="col-sm-2 control-label">Fecha</label>
					  <input type="text" name="fecha" class="form-control" id="fecha" disabled>
				  </div>
				  <div class="form-group">
					<label for="titulo" class="col-sm-2 control-label">Titulo</label>
					  <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo">
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					  <select name="color" class="form-control" id="color">
                      <option value="0">Seleccionar</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
						  <option style="color:#008000;" value="#008000">&#9724; Verde</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
						  <option style="color:#000;" value="#000">&#9724; Negro</option>
						  
                      </select>
					</div>
          <div class="form-group">
					<label for="textcolor" class="control-label">Color de Texto</label>
					 <input type="color"  class="form-control" value="#ffffff"  id="textcolor">
					</div>
				  <div class="form-group">

					<label for="start" class="col-sm-2 control-label">Hora Inicial</label>
              <div class="input-group clockpicker" data-autoclose="true">
					      <input type="text" name="start" class="form-control" id="start"onkeydown="return false"autocomplete="off">
                <div class="input-group-append">
                        <button class="btn btn-success"><i class="far fa-clock"></i></button>
                   </div>
              </div>
					</div>
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">Hora Final</label>
              <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" name="end" class="form-control" id="end"onkeydown="return false"autocomplete="off">
                <div class="input-group-append">
                        <button class="btn btn-success"><i class="far fa-clock"></i></button>
                   </div>
              </div>
          </div>
          
          <div class="form-group">
				
					  <input type="hidden" name="intervalos1" class="form-control" id="intervalos1">
					</div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger"  data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
				<button type="button" id="guardarturnos"class="btn btn-success">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    <div class="animate__animated animate__bounceInDown modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title" id="tituloevento">EDITAR BORRAR EVENTOS</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				
			  </div>
			  <div class="modal-body">
        <div style="text-align:center;">
              </div>
        <div class="form-group">
					<label for="fecha" class="col-sm-2 control-label">Fecha</label>
					  <input type="date" name="fecha" class="form-control" id="fechaeditar">
				  </div>
				  <div class="form-group">
					<label for="titulo" class="col-sm-2 control-label">Titulo</label>
					  <input type="text" name="titulo" class="form-control" id="tituloeditar" placeholder="Titulo">
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					  <select name="color" class="form-control" id="coloreditar">
                      <option value="0">Seleccionar</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
						  <option style="color:#008000;" value="#008000">&#9724; Verde</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
						  <option style="color:#000;" value="#000">&#9724; Negro</option>
						  
                      </select>
					</div>
          <div class="form-group">
					<label for="textcolor" class="control-label">Color de Texto</label>
					 <input type="color" value="#ffffff" style="width:100%" id="textcoloreditar">
					</div>
				  <div class="form-group">
          
					<label for="start" class="control-label">Hora Inicial</label>
          <div class="input-group clockpicker" data-autoclose="true">
					  <input type="text" name="start" class="form-control" id="starteditar"onkeydown="return false"autocomplete="off" >
            <div class="input-group-append">
                        <button class="btn btn-success"><i class="far fa-clock"></i></button>
                   </div>
                   </div>
					</div>
				  <div class="form-group">
					<label for="end" class="control-label">Hora Final</label>
          <div class="input-group clockpicker" data-autoclose="true">
					  <input type="text" name="end" class="form-control" id="endeditar"onkeydown="return false" autocomplete="off" >
            <div class="input-group-append">
                        <button class="btn btn-success"><i class="far fa-clock"></i></button>
                   </div>
                   </div>
					</div>
          <div class="form-group">
             <input type="hidden" name="intervalos1" class="form-control" id="id_editar">
					
					</div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-warning" id="modificar">Modificar Evento</button>
				<button type="button" class="btn btn-danger" id="borrar">Borrar Evento</button>      
				<button type="button" class="btn btn-info"  data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/estilocalendario.css">
  <link rel="stylesheet" href="../css/estilosbotones.css"> 
  <link rel="stylesheet" href="../css/fullcalendar.min.css">
  <link rel="stylesheet" href="../css/bootstrap-clockpicker.css">
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <h4>MATADERO FRIGORIFICO REGIONAL MALARGÜE <?php echo date("Y")?></h4>
            <input id="añoactual" type="hidden"  value="<?php echo date("Y")?>">
            
            <div id="calendar"></div>
        
        
    </section>

  <title>Municipalidad de Malargüe</title>

</head>
<body>


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
<script src='../js/js/moment.min.js'></script>
	<script src='../js/js/fullcalendar.min.js'></script>
	<script src='../js/js/fullcalendar.js'></script>
	<script src='../js/js/es.js'></script>
  <script src='../js/js/bootstrap-clockpicker.js'></script>
  <script src='../js/agenda.js'></script>