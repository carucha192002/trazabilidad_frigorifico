<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==4||$_SESSION['us_tipo']==5||$_SESSION['us_tipo']==6){

?>
<?php
 include_once 'layouts/navinicio.php'
 
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/parallax.css">
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper1">
    <!-- Content Header (Page header) -->
    <section class="">
    
          
</head>
<body>

<section class="sect1">

    <div class="ingreso">
<div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user"height="3000">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info" >
              <input id="us_tipo" type="hidden" value="<?php  echo $_SESSION['usuario']?>" ></input>
              <input id="root" type="hidden" value="<?php  echo $_SESSION['us_tipo']?>" ></input>

                <a id="cerrarsesion" href="../controlador/logout.php">Cerrar Sesion</a>    
      
    
                <h3 class="widget-user-username"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nombre: <?php  echo $_SESSION['nombre_us']?></font></font></h3>
                <h5 id="categoria" class="widget-user-desc"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Categoria:</font></font></h5>
              </div>
              <div class="div_imagen">
                
                <img id="avatar" class="circulo_imagen mb-5" src="../img/leg-default.png" alt="Avatar de usuario">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 id="dni" class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></h5>
                      <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">DNI</font></font></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 id="email" class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></h5>
                      <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">EMAIL</font></font></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 id="telefono"class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></h5>
                      <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TELEFONO</font></font></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <div id="menu" class="col-sm-12">
                    <span id="procesando"><b>CONECTANDO  A SERVIDOR</b></span>
                    <div id="loader1" class="overlay">
                      <i class="fa fa-refresh fa-spin"></i>
            </div>
               
                  <!-- /.col -->
                </div>
                
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          </div>

        

</section>
<section class="sect2">

<h2>MUNICIPALIDAD DE MALARGUE</h2>
<P class="texto2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam amet atque eum minima tempore doloribus eius reprehenderit iure? Vitae velit itaque autem repudiandae at veniam quas deserunt dolorem cumque!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam amet atque eum minima tempore doloribus eius reprehenderit iure? Vitae velit itaque autem repudiandae at veniam quas deserunt dolorem cumque!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam amet atque eum minima tempore doloribus eius reprehenderit iure? Vitae velit itaque autem repudiandae at veniam quas deserunt dolorem cumque!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam amet atque eum minima tempore doloribus eius reprehenderit iure? Vitae velit itaque autem repudiandae at veniam quas deserunt dolorem cumque!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam amet atque eum minima tempore doloribus eius reprehenderit iure? Vitae velit itaque autem repudiandae at veniam quas deserunt dolorem cumque!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam amet atque eum minima tempore doloribus eius reprehenderit iure? Vitae velit itaque autem repudiandae at veniam quas deserunt dolorem cumque!</P>

</section>
<section class="sect3">
<h2 class="sect1h2">CIUDAD AMIGABLE</h2>

</section>
</section>
<section class="sect4">
<h2 class="sect1h3">Diseñado Y Programado por Franco Cara</h2>
</section>
</body>
<footer>
<?php
include_once 'layouts/footer1.php';
 }
 else{
     header('Location: ../index.php');
 }
?> 
</footer>
<script src="../js/datatables.js"></script>
<script src="../js/ingresoroot.js"></script> 