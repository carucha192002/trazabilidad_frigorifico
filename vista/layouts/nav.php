<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../img/logo.png" type="image/png">
<link rel="stylesheet" href="../css/animate.min.css">
<link rel="stylesheet" href="../css/datatables.css">
<link rel="stylesheet" href="../css/compra.css">
<link rel="stylesheet" href="../css/main.css">
 <!-- Select2 -->
 <link rel="stylesheet" href="../css/select2.css">
  <!-- sweetAlert2 -->
  <link rel="stylesheet" href="../css/sweetalert2.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <link rel="stylesheet" href="../css/toastr.min.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      
      <li class="nav-item dropdown"id="cat-carrito" style="display:none">
        <img src="../img/carrito.png" class="imagen-carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span id="contador" class="contador badge badge-danger"></span>
        </img>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <table class="carro table table-hover text nowrap p-0">
            <thead class="table-success">
              <tr>
                <th>Codigo</th>
                <th>Tropa</th>
                <th>Especie</th>
                <th>Cuarteado</th>
                <th>Garron</th>
                <th>Cantidad</th>
                <th>Eliminar</th>
                <th style="visibility: hidden">Precio</th>                
              </tr>
            </thead>
            <tbody id="lista">
            
            </tbody>
          </table>
          <a href="#" id="procesar-pedido" class="btn btn-success btn-block">Procesar Pedido</a>
          <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
        </div>
      </li>
      
    </ul>
    <ul class="navbar-nav ml-auto">
    <li id="notificacion" class="nav-item dropdown">
        <a id="numero_notificacion" class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div id="notificaciones"class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
     
    </ul>
    

    <!-- SEARCH FORM -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   <a href="../controlador/logout.php">Cerrar Sesion</a>    
      
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a href="../vista/adm_catalogo.php" class="brand-link">
      <img src="../img/logo.png"
           alt="AdminLTE Logo"
           class="brand-image elevation-1"
           style="opacity: .8">
      <span class="brand-text ">M.PRINCIPAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="mt-3 pb-3 d-flex">
        <div class="image">

          <img id="avatar4" src="../img/avatar.png" class="imagen_nav" alt="User Image">
        </div>
        <div class="info_nombre">
          <a href="#" class="d-block">
          <?php
          echo $_SESSION['nombre_us'];
          ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">USUARIO</li>
          <li class="nav-item">
            <a id="gestion_usuario1" href="editar_datos_personales.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
               Datos Personales
              </p>
            </a>
          </li>
          <li id="gestion_usuario" class="nav-item">
            <a  id="gestion_usuario2"href="adm_usuario.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Gestion Usuarios
              </p>
            </a>
          </li>
          <li id="gestion_agenda" class="nav-item">
            <a id="gestion_agenda1" href="agenda.php" class="nav-link">
              <i class="far fa-calendar-alt"></i>
              <p id="agenda_titulo">
               Agenda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a id="active_nav_notificaciones" href="adm_notificaciones_todas.php" class="nav-link">
              <i class="nav-icon far fa-bell"></i>
              <p id="nav_cont_noti">
               Notificaciones
              </p>
            </a>
           
          </li>
          <li id="importantever"class="nav-header">IMPORTANTE</li>
          
        <a class="nav-link"  id="ingresover1"  href="adm_ingresoroot.php"aria-expanded="false">
          <i id="ingresover">Ingresos</i>
          <span id="ingresos_cuantas" class="badge badge-success "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
        </a> 
      <!-- Notifications Dropdown Menu -->
      
      <a class="nav-link"  href="adm_faenas.php" aria-expanded="false">
          <i id="faenasver">Para Faenar</i>
          <span  id="matanza_cuantas" class="badge badge-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
        </a>
        
        <a class="nav-link"  href="adm_listadofaenas.php" aria-expanded="false">
          <i id="procesarfaenasver">Procesar Faena</i>
          <span  id="procesar_cuantas" class="badge badge-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
        </a>
        
        <a class="nav-link"  href="adm_listadofinalizados.php" aria-expanded="false">
          <i id="finalizadosver">Finalizados</i>
          <span  id="finalizados_cuantas" class="badge badge-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
        </a>
      
  
          <li id="gestion_movcamara" class="nav-item">
            <a id="gestion_movcamara1"href="adm_movcamara.php" class="nav-link">
            <i class="fas fa-temperature-low"></i>
              <p>
                MOV. CAMARAS
              </p>
            </a>
          </li>
          <li id="gestion_despacho" class="nav-item">
            <a id="gestion_despacho1"href="adm_despacho.php" class="nav-link">
            <i class="fas fa-shipping-fast"></i>
              <p>
              PEDIDO DESPACHO
              </p>
            </a>
          </li>
          <li id="gestion_reportes" class="nav-item">
            <a id="gestion_reportes1"href="adm_reportes.php" class="nav-link">
            <i class="fas fa-flag"></i>
              <p>
               REPORTES DE SALIDAS
               <span  id="salidas_cuantas" class="badge badge-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
              </p>
            </a>
          </li>
          <li id="gestion_salidas" class="nav-item">
            <a id="gestion_salidas1" href="adm_salidas.php" class="nav-link">
            <i class="fas fa-file-invoice"></i>
              <p>
               RESUMEN DE SALIDAS
             
              </p>
            </a>
          </li>
          <li id="gestion_reportes_diarios" class="nav-item">
            <a id="gestion_reportes_diarios1"href="adm_reportes_diarios.php" class="nav-link">
              <i class="fas fa-calendar-day"></i>
              <p>
               SALIDA DE MATANZAS
              </p>
            </a>
          </li>
          
          <li id="listar"class="nav-header">GESTION ATRIBUTOS</li>
          <li id="gestion_clasificacion" class="nav-item">
            <a id="gestion_clasificacion1"href="adm_clasificacion.php" class="nav-link">
            <i class="fas fa-paw"></i>
              <p>
                CLASIFICACION
              </p>
            </a>
          </li>
          
          <li id="gestion_camara" class="nav-item">
            <a id="gestion_camara1"href="adm_camaras.php" class="nav-link">
            <i class="fas fa-temperature-low"></i>
              <p>
                CAMARAS
              </p>
            </a>
          </li>
          <li id="gestion_productor" class="nav-item">
            <a id="gestion_productor1" href="adm_productor.php" class="nav-link">
            <i class="fab fa-product-hunt"></i>
              <p>
                PRODUCTOR
              </p>
            </a>
          </li>
          <li id="gestion_especies" class="nav-item">
            <a id="gestion_especies1" href="adm_especies.php" class="nav-link">
            <i class="fas fa-paw"></i>
              <p>
                ESPECIES DE ANIMALES
                </p>
            </a>
          </li>
          <li id="gestion_despiece" class="nav-item">
            <a id="gestion_despiece1"href="adm_despiece.php" class="nav-link">
            <i class="fab fa-cuttlefish"></i>
              <p>
                DESPIECE
                </p>
            </a>
          </li>
          <li id="gestion_corraleros" class="nav-item">
            <a id="gestion_corraleros1" href="adm_corraleros.php" class="nav-link">
            <i class="fas fa-user-shield"></i>
              <p>
                CORRALEROS
              </p>
            </a>
          </li>
          
          <li id="gestion_corral" class="nav-item">
            <a id="gestion_corral1"href="adm_corral.php" class="nav-link">
            <i class="fas fa-circle-notch"></i>
              <p>
                CORRALES
              </p>
            </a>
          </li>
         
          <li id="gestion_procedencia" class="nav-item">
            <a id="gestion_procedencia1" href="adm_procedencia.php" class="nav-link">
            <i class="fas fa-laptop-house"></i>
              <p>
                PROCEDENCIA
              </p>
            </a>
          </li>
         
          <li id="gestion_destino" class="nav-item">
            <a id="gestion_destino1" href="adm_destinos.php" class="nav-link">
            <i class="fas fa-map-signs"></i>
              <p>
                DESTINO
              </p>
            </a>
          </li>
          <li id="gestion_chofer" class="nav-item">
            <a id="gestion_chofer1"  href="adm_chofer.php" class="nav-link">
            <i class="fas fa-taxi"></i>
              <p>
                CHOFER
              </p>
            </a>
          </li>
          <li id="gestion_matarife" class="nav-item">
            <a id="gestion_matarife1"href="adm_matarife.php" class="nav-link">
            <i class="fas fa-user-clock"></i>
              <p>
                MATARIFE
              </p>
            </a>
          </li>
          <li id="gestion_transporte" class="nav-item">
            <a id="gestion_transporte1" href="adm_transporte.php" class="nav-link">
            <i class="fas fa-bus"></i>
              <p>
                TRANSPORTE
              </p>
            </a>
          </li>
          <li id="gestion_conservacion" class="nav-item">
            <a id="gestion_conservacion1" href="adm_conservacion.php" class="nav-link">
            <i class="fas fa-pager"></i>
              <p>
                CONSERVACION
              </p>
            </a>
          </li>
          <li id="gestion_tropas" class="nav-item">
            <a id="gestion_tropas1" href="adm_tropas.php" class="nav-link">
            <i class="fas fa-award"></i>
              <p>
                GESTION TROPAS
              </p>
            </a>
          </li>     
          <li id="tituloresultadoproductor"class="nav-header">RESULTADOS</li>
          <li id="gestion_resultadosproductor"class="nav-item">
            <a id="gestion_resultadosproductor1" href="adm_resultadosproductor.php" class="nav-link">
              <i class=" nav-icon fas fa-poll"></i>
              <p>              
                Gestion Resultados
                </p>
            </a>
          </li>     
                <li id="tituloresultado"class="nav-header">RESULTADOS</li>
                <li id="gestion_resultados"class="nav-item">
             <a id="gestion_resultados1" href="adm_resultados.php" class="nav-link">
              <i class=" nav-icon fas fa-poll"></i>
              <p>              
                Gestion Resultados

              </p>
            </a>
          </li>              
          <li id="etiquetasresultado"class="nav-header">ETIQUETAS</li>
                <li id="gestion_etiquetas"class="nav-item">
             <a id="gestion_etiquetas1"href="adm_etiquetas.php" class="nav-link">
             <i class="fas fa-barcode"></i>
              <p>              
                Gestion Etiquetas

              </p>
            </a>
          </li>     
          <li id="backup"class="nav-header">BACKUP</li>
                <li id="gestion_backup"class="nav-item">
             <a id="gestion_backup1" href="adm_backup.php" class="nav-link">
             <i class="fas fa-upload"></i>
              <p>              
                Gestion BACKUP

              </p>
            </a>
          </li>           
          <li id="faenados"class="nav-header">FAENADOS</li>
                <li id="gestion_faenados"class="nav-item">
             <a id="gestion_faenados1"href="adm_faenados.php" class="nav-link">
             <i class="fas fa-drumstick-bite"></i>
              <p>              
                Gestion FAENADOS

              </p>
            </a>
          </li>    
          <li id="gestion_faenados_obs"class="nav-item">
             <a id="gestion_faenados_obs1"href="adm_observados.php" class="nav-link">
             <i class="fas fa-binoculars"></i>
              <p>              
                Gestion OBSERVADOS

              </p>
            </a>
          </li> 
          <li id="informes"class="nav-header">INFORMES</li>
                <li id="gestion_informe"class="nav-item">
             <a id="gestion_informe1" href="adm_informe.php" class="nav-link">
             <i class="fas fa-paste"></i>
              <p>              
                Gestion INFORMES

              </p>
            </a>
          </li>          
          <li id="devolucion"class="nav-header">DEVOLUCION</li>
                <li id="gestion_devolucion"class="nav-item">
             <a id="gestion_devolucion1" href="adm_devolucion.php" class="nav-link">
             <i class="fas fa-undo"></i>
              <p>     
                       
                Gestion DEVOLUCION

              </p>
            </a>
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>  

  
