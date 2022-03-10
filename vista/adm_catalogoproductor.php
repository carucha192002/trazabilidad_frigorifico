<?php
session_start();
if($_SESSION['us_tipo']==4){
 include_once 'layouts/header.php'
?>
<?php
 include_once 'layouts/nav.php'
 
?>
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
            <input id="productorid" type="hidden"value="<?php echo $_SESSION['usuario'] ?>">
            <input id="productormatarife" type="hidden">
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
    <br></br>
  <title>Municipalidad de Malargüe</title>

</head>
<body>
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
               <table id="tabla_ingresos" class="table table" style="width:100%">
        <thead>
        <tr class="text-center">
                 <th>Fecha</th>
                 <th>Año</th>
                <th>Tropa</th>
                <th>Procedencia</th>
                <th>Especie</th>
                <th>Matarife</th>
                <th>Productor</th>
                <th>Cantidad</th>     
                <th>Dte</th>         
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
   


  <section id="parte1">
     <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
             
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Descripcion</a>
                <a class="nav-item nav-link" id="product-pre-tab" data-toggle="tab" href="#product-pre" role="tab" aria-controls="product-pre" aria-selected="true">Preguntas</a>
                <a class="nav-item nav-link" id="product-caract-tab" data-toggle="tab" href="#product-caract" role="tab" aria-controls="product-caract" aria-selected="true">Historial</a>
                
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade" id="product-caract" role="tabpanel" aria-labelledby="product-caract-tab"> 
              <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div id="historiales" class="timeline timeline-inverse">
                      
                    </div>
                  </div>
            </div>
            <div class="tab-pane fade show" id="product-pre" role="tabpanel" aria-labelledby="product-pre-tab"> 
                <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                      <img class="direct-chat-img mr-1" src="" alt="Message User Image">
                        <input type="text" name="message" placeholder="Escribir pregunta" class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
            
            <div class="direct-chat-messages direct-chat-danger preguntas">
                
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    
                    <img class="direct-chat-img" src="" alt="Message User Image">
                   
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                      <img class="direct-chat-img mr-1" src="../img/avatar.png" alt="Message User Image">
                        <input type="text" name="message" placeholder="Responder pregunta" class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger">Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  </div>
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <img class="direct-chat-img" src="../img/616198c9e7663-brune.jpeg" alt="Message User Image">
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                  
                  </div>
            
                </div>
                </div>
                </div>

               <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
              <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
            <div class="col-md-12 col-sm-12 col-12">
            <div id="infobox" class="info-box bg-info">
            <button id="cerrarficha"type="button" class="btn btn-outline-light"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">X Cerrar</font></font></button>
            
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pasos</font></font></span>
                <span id="pasos" class="info-box-number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0/0</font></font></span>

                <div class="progress">
                  <div id="tracking" class="progress-bar" style="width: 0%"></div>
                </div>

                <span id="etapa" class="progress-description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  
                </font></font></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            
              <div class="card-header">
              <div class="row">
                  <div class="col-sm-4">
                  <a href="adm_faenas.php" id="primero" class="btn btn-block btn-outline-primary">En Faenas</a>
                  </div>
                  <div class="col-sm-4">
                  <a href="adm_listadofaenas.php" id="segundo"  class="btn btn-block btn-outline-primary">Procesar Faenas</a>
                  </div>
                  <div class="col-sm-4">
                  <a href="adm_listadofinalizados.php" id="tercero" class="btn btn-block btn-outline-primary">Finalizado</a>
                  </div>
                  <div class="col-sm-12">
                  <p></p>
                  </div>
                  <div class="col-sm-6">
                  <a id="imprimircsv" class="btn btn-block btn-outline-primary"><i class="fas fa-file-csv"></i>Imprimir Csv</a>
                  </div>
                  <div class="col-sm-6">
                  <a id="imprimirpdf" class="btn btn-block btn-outline-primary"><i class="fas fa-file-pdf"></i>Imprimir PDF</a>
                  </div>
              
              </div>
              
              <div class="row">
                    <div class="col-sm-12">
                    
                    

            <!-- small box -->
              <h3 class="text-center font-weight-bolder">CARGO LOS DATOS </h3>  
              <h3 id="nombrepersonal"class="text-center font-weight-bolder"style="text-transform:uppercase">NOMBRE Y APELLIDO </h3> 
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                <div class="col-sm-12">
                <div class="text-center">
                      <img id='avatar2'src="../img/avatar.png" class="profile-user-img img-fluid"></img>
                      <input type="hidden" id="perfil">
                      <input type="hidden" id="licencia1">
                      <input type="hidden" id="riesgo1">
                 </div>
                
                    </div>
                  
                  <div class="col-sm-4">
                      <div class="form-group">
                    </div>
                    </div>
                    <div class="callout callout-info">
                  <h5 id="edicion" class="text-center"></h5>
                </div>
               
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>TROPA</label>
                        <input type="number" id="tropa"class="form-control" placeholder="TROPA---"disabled>
                      </div>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha y Hora</label>
                        
                        <input type="text" id="fecha"class="form-control is-valid" style="text-transform:uppercase"placeholder="Fecha"disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Libro Nro:</label>
                        <input type="text" id="libro"class="form-control is-valid" style="text-transform:uppercase" placeholder="Libro Nro:"disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Libro Folio:</label>
                        <input type="text" id="folio"class="form-control is-valid" placeholder="Libro Folio"disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>DESTINO</label>
                        <input id="destino" type="text" style="text-transform:uppercase" class="form-control"  disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>ESPECIE</label>
                        <input type="text"id="especie" style="text-transform:uppercase" class="form-control" disabled="">
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidad" style="text-transform:uppercase;" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="text" id="kilos" style="text-transform:uppercase;" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>MUERTOS</label>
                        <input type="text" id="muertos" style="text-transform:uppercase;" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>CAIDOS</label>
                        <input type="number" id="Caidos" style="text-transform:uppercase;" class="form-control"disabled></input>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpie" style="text-transform:uppercase" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospie" style="text-transform:uppercase" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>CONSERVACION</label>
                        <input type="text" id="conservacion" style="text-transform:uppercase;"class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>DIAS DE VENCIMIENTO</label>
                        <input type="number" id="vencimiento" class="form-control"disabled></input>
                        <input type="hidden" id="id_ingresos" style="text-transform:uppercase" class="form-control"disabled></input>
                      </div>
                    </div>
                  </div>
                
  </section>
   <section id="parte2">
  <div class="col-md-12">
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
              <div class="col-lg-12">
            <!-- small box -->
              
            
              </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
              <div class="alert alert-info alert-dismissible">
                  <div class="row">
                    <div class="small-box bg-info col-sm-6">
                    <h6 class="text-center">CLASIFICACION DE ANIMALES EN PIE</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>CLASIFICACION</th>
                              <th>CANTIDAD</th>
                              <th>KILOS</th>
                        </tr>
                        <tbody id="clasificacion" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                      </thead>
                    </table>               
                </div>
                </div>
                </div>
                    <div class="small-box bg-info col-sm-6">
                    <h6 class="text-center">CORRALES</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>DESCRIPCION</th>
                              <th>CANTIDAD</th>
                              <th>CORRALERO</th>
                              
                        </tr>
                        <tbody id="corrales" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                      </thead>
                    </table>               
                </div>
                </div>
                </div>
                <div class="small-box bg-info col-sm-12">
                    <h6 class="text-center">ENTIDADES</h6>
                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>USUARIO:</p>
                  <input id="usuariomatarife" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                  
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRODUCTOR:</p>
                  <input id="productorusuario" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                  
                </div>              
                </div>
                </div>
                </div>
                
                <div class="small-box bg-info col-sm-6">
                    <h6 class="text-center">DATOS DE TRASLADO</h6>
                    <div class="row">
                  <div class="col-12">
                  <div class="input-group mb-3">
                  <p>Nº GUIA:</p>
                  <input id="usuarioguia"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>FECHA EMISION GUIA:</p>
                  <input id="fechaguiausuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-12">
                  <div class="input-group mb-3">
                  <p>DTE:</p>
                  <input id="dtausuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>FECHA EMISION DTE:</p>
                  <input id="fechadtausuario" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
              
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PROCEDENCIA:</p>
                  <input id="procedenciausuario" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PROVINCIA:</p>
                  <input id="provinciausuario" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>LOCALIDAD:</p>
                  <input id="localidadusuario" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>CP:</p>
                  <input id="cpusuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
                
                </div>    
                <div class="small-box bg-info col-sm-6">
                    <h6 class="text-center">MAS DATOS</h6>

                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>TRANSPORTE:</p>
                  <input id="transporteusuario" style="text-transform:uppercase" type="text" class="form-control rounded-1 ml-3"disabled>
                  
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>CHOFER:</p>
                  <input id="choferusuario" style="text-transform:uppercase" type="text" class="form-control rounded-1 ml-3"disabled>
                 
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>DNI:</p>
                  <input id="dniusuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>HABILITACION:</p>
                  <input id="habilitacionusuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>HORAS VIAJE:</p>
                  <input id="horasviajeusuario" type="number" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>Nº LAVADO:</p>
                  <input id="lavadousuario" type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRESCINTOS CAMION:</p>
                  <input id="prescintousuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRESCINTOS ACOPLADO:</p>
                  <input id="prescintoacopladousuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
                   
                </div>     
               
                <div class="small-box bg-success col-sm-12">
                <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>  
                    <h6 class="text-center">OBSERVACIONES</h6>
                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>OBSERVACION:</p>
                  <textarea id="observacionusuario"type="text" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled> </textarea>               
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>KILOS CUERO:</p>
                  <input id="kiloscuerousuario"type="number" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled> 
                  <input id="prioridad" type="hidden" value="<?php  echo $_SESSION['us_tipo']?>">  
                  <input id="cargodatos" type="hidden">             
                </div>              
                </div>
                </div>     
                </div>
                
                  
  </section>
  <section>
<div class="small-box bg-info col-sm-12">
                    <h6 class="text-center">CANTIDAD EN CORRALES</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>CORRAL Nº</th>
                              <th>CANTIDAD</th>
                              <th>ESPECIE</th>
                              <th>SUB-ESPECIE</th>
                              
                        </tr>
                        <tbody id="clasificacioncorral" class="table-active text-center"style="text-transform:uppercase">  
                        </tbody>
                      </thead>
                    </table>               
                </div>
                </div>
                </div>


</section>
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
<script src="../js/tablaingresoproductor.js"></script> 
<script src="../js/verificarmail.js"></script>
