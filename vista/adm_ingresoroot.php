<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==5){
 include_once 'layouts/header.php'
?>
<?php
 include_once 'layouts/nav.php'
 
?>
<div class="modal fade col-md-12" id="reducciongarrones" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reduccion de Faena</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
            <form id="form-reducir-garron">
            <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Fecha Ingreso</label>
                        <input type="text" id="fecha_reduccion" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Fecha de la Reduccion</label>
                        <input type="text" id="fecha_ingreso" class="form-control"disabled></input>
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="numero_tropa">Nº de Tropa</label>
                        <input id="numero_tropa" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>	
                    <div class="form-group">
                        <label for="clasificacion_garron">Clasificacion</label>
                        <input id="clasificacion_garron" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_garron">CANTIDAD EN PIE</label>
                        <input id="cantidad_garron" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>desde</label>
                        <input type="number" id="desde_garron" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Hasta</label>
                        <input type="number" id="hasta_garron_guardar" class="form-control"disabled></input>
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="quedan_garron">CANTIDAD REDUCIDA</label>
                        <input class="form-control" id="quedan_garron" type="text" disabled>
                        <input class="form-control" id="quedan_garron_mostrar" type="hidden" disabled>
                    </div>
                    <div class="form-group">
                        <label for="estado_garron">MOTIVO DE LA REDUCCION:</label>
                        <input class="form-control" id="estado_garron" type="text" disabled>
                    </div>
                    <div class="form-group">
                        <label id="corral_garron_titulo">Corral a Volver</label>
                        <input class="form-control"  id="corral_garron" type="text" disabled>
                    </div>

                    <div class="form-group">
                        <label for="estado_garron">ESTADO:</label>
                        <input class="form-control" id="total_garron" type="text" disabled>
                    </div>
                   
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="submit"  id="guardargarron" class="btn btn-outline-light">PROCESAR FAENA</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
           
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 
 <div class="modal fade col-md-12" id="editaringresos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-warning">
          <div class="card-header">
              <h3 class="card-title">EDITAR INGRESOS-MATADERO MUNICIPAL MALARGÜE</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="edit-lote" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div> 
             
              <form id="form-editar-ingreso"> 
              <div class="form-group">
                        <input id="anoeditar" type="hidden"  value="<?php echo date("Y") ?>" class="form-control">
                    </div> 
              
                    <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>TROPA</label>
                        <input type="number" id="tropamodaleditar"class="form-control" placeholder="TROPA---" disabled>
                        <input type="hidden" id="cargoeditar" class="form-control" value="<?php echo $_SESSION['usuario'] ?>" disabled>
                        <input type="hidden" id="ideditar" class="form-control" disabled>
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
                         <input type="text" id="fechaeditar"class="form-control" style="text-transform:uppercase"placeholder="Fecha" disabled>
                        <input type="hidden" id="fechamodaleditar"class="form-control" style="text-transform:uppercase"placeholder="Fecha" value="<?php echo $fecha?>"disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Libro Nro:</label>
                        <input type="text" id="libromodaleditar"class="form-control" style="text-transform:uppercase" placeholder="Libro Nro:"require>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Libro Folio:</label>
                        <input type="text" id="foliomodaleditar"class="form-control" placeholder="Libro Folio"require>
                      </div>
                 
                    </div>
              
                    <div class="col-sm-6">
                    <div class="form-group mt-4">
                    <p><b id="destinoselecteditartitulo"  style="text-transform:uppercase">DESTINO:</b></p>
                  <select id="destinoselecteditar" type="text" class="form-control select2 ml-3" style="width: 100%"require> </select>
                  
                  
                  
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group mt-4">
                        <p><b id="especieselecteditartitulo" style="text-transform:uppercase">ESPECIE:</b></p>
                        <select id="especieselecteditar" type="text" class="form-control select2 ml-3"style="width: 100%" require ></select>
                       
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                  <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label id="subespecietitulo">SUB-ESPECIE</label>
                        <select type="number" id="subespeciemodaleditar" style="width: 100%" value="0" class="form-control select2"></select>
                      
                  <input type="hidden" id="subespecieagregarideditar" style="text-transform:uppercase" class="form-control">
                  <input type="hidden" id="subespecieagregaridguardareditar" style="text-transform:uppercase" class="form-control">
                
                      </div>
                      
                      </div>
                      </div>
                      <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                        <label>TCI</label>
                        <input type="text" id="tci" style="width: 100%"class="form-control">
                      </div>
                      
                      </div>
                      </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidadmodaleditar" style="text-transform:uppercase;" value="0" class="form-control"require></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="number" id="kilosmodaleditar" style="text-transform:uppercase;" value="0" class="form-control"require></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="labelmuertoseditar">MUERTOS</label>
                        <input type="text" id="muertosmodaleditar" style="text-transform:uppercase;" value="0" class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarmuertoscantidadeditar"type="text"  class="form-control" placeholder="CANTIDAD"require></select>
                        <select id="agregarmuertoskiloseditar"type="text" placeholder="KILOS"class="form-control"></select>
                        <input id="digestormuertoseditar"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accionmuertoseditar"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarmuertoseditar">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarmuertoseditar">OCULTAR</a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="caidosmodal1editar">CAIDOS</label>
                        <input type="number" id="caidosmodaleditar" style="text-transform:uppercase;" value="0"class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarcaidoscantidadeditar"type="text"  class="form-control" placeholder="CANTIDAD"require></select>
                        <input type="hidden"id="agregarcaidoscantidadhiddeneditar" value="0">
                        <select id="agregarcaidoskiloseditar"type="text" placeholder="KILOS"class="form-control"require></select>
                        <input type="hidden"id="agregarcaidoskiloshiddeneditar" value="0">
                        <input id="digestorcaidoseditar"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accioncaidoseditar"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarcaidoseditar">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarcaidoseditar">OCULTAR</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpiemodaleditar" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospiemodaleditar" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="conservaciontituloeditar"style="text-transform:uppercase">CONSERVACION</label>
                        <select type="text" id="conservacionmodaleditar" class="form-control select2" style="width: 100%"require></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="conservacionagregarmodaleditar" class="dropdown-item" href="adm_conservacion.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarconservacionmodaleditar" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>DIAS DE VENCIMIENTO</label>
                        <input type="number" id="vencimientomodaleditar" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="corralmodaleditartitulo" style="text-transform:uppercase;">CORRALES</label>
                        <select type="text" id="corralmodaleditar" class="form-control select2" style="width: 100%"require></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="corralagregarmodaleditar" class="dropdown-item" href="adm_corral.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarcorralmodaleditar" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="corraleromodaleditartitulo"  style="text-transform:uppercase" >CORRALEROS</label>
                        <select type="text" id="corraleromodaleditar" class="form-control select2" style="width: 100%" require></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="corraleroagregarmodaleditar" class="dropdown-item" href="adm_corraleros.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarcorraleromodaleditar" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                      </div>
                    </div>
                  </div>

                    <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
                    
                    <div class="small-box bg-info col-sm-12">
                    <h6 class="text-center">ENTIDADES</h6>
                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <label type="text" class="mr-1" id="matarifeeditartitulo"style="text-transform:uppercase;" ></label>
                  <label type="text" class="mr-1" id="cuitusuarioeditar"></label>
                  <select type="text" id="matarifeeditar" class="form-control select2 mr-3"style="width: 100%" require></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="usuariomodaleditar" class="dropdown-item" href="adm_matarife.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarusuariomodaleditar" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                                    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <label type="text" class="mr-1" id="cuitusuariosubeditar">SUB-ITEM:</label>
                  <select type="text" id="matarifesub_itemeditar" class="form-control select2 mr-3"style="width: 100%" ></select>
                  </div>
                  </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <label class=" mr-1" id="productorselecteditartitulo"style="text-transform:uppercase;" ></label>
                  <label class=" mr-1" id="productorcuiteditar"></label>
                  <select type="text" id="productorselecteditar" class="form-control select2 mr-3"style="width: 100%" require></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="productormodaleditar" class="dropdown-item" href="adm_productor.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarproductormodaleditar" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                  
                </div>              
                </div>
                </div>
                </div>
                <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
                
                <div class="small-box bg-warning col-sm-12">
                    <h6 class="text-center">DATOS DE TRASLADO</h6>
                    <div class="row">
                  <div class="col-12">
                  <div class="input-group mb-3">
                  <p>Nº GUIA:</p>
                  <input id="guiamodaleditar"type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require >
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>FECHA EMISION GUIA:</p>
                  <input id="fechaguiamodaleditar" type="date" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require >
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-12">
                  <div class="input-group mb-3">
                  <p>DTE:</p>
                  <input id="dtamodaleditar" type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"disabled >
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>FECHA EMISION DTE:</p>
                  <input id="fechadtamodaleditar"type="date" class="form-control rounded-1 ml-3"style="text-transform:uppercase;" require>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="form-group mb-3">
                  <p id="llenarprocedenciaeditartitulo" style="text-transform:uppercase;" >PROCEDENCIA:</p>
                  <select id="llenarprocedenciaeditar" type="text" class="form-control select2 rounded-1 ml-3" style="width: 100%"require></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="procedenciamodaleditar" class="dropdown-item" href="adm_procedencia.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarprocedenciamodaleditar" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p id="provinciamodaleditartitulo" style="text-transform:uppercase;" >PROVINCIA:</p>
                  <select id="provinciamodaleditar" type="text" class="form-control rounded-1 select2 ml-3" style="width: 100%"require></select>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p id="localidadmodaleditartitulo" style="text-transform:uppercase;" >LOCALIDAD:</p>
                  <select id="localidadmodaleditar" type="text" class="form-control rounded-1 select2 ml-3"style="width: 100%"require></select>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>CP:</p>
                  <input id="CPmodaleditar" type="text" class="form-control rounded-1 ml-3"require>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p id="llenartransporteeditartitulo" style="text-transform:uppercase;" >TRANSPORTE:</p>
                  <select  id="llenartransporteeditar" type="text" class="form-control select2 rounded-1 ml-3" style="width: 100%"require></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="transportemodaleditar" class="dropdown-item" href="adm_transporte.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizartransportemodaleditar" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p id="llenarchofereditartitulo" style="text-transform:uppercase;" >CHOFER:</p>
                  <select id="llenarchofereditar" type="text" class="form-control select2 rounded-1 ml-3" style="width: 100%"require></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="chofermodaleditar" class="dropdown-item" href="adm_chofer.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarchofermodaleditar" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>DNI:</p>
                  <input id="dnimodaleditar"type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require disabled >
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>HABILITACION:</p>
                  <input id="habilitacionmodaleditar" type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require >
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>HORAS VIAJE:</p>
                  <input id="horasdeviajemodaleditar" type="number" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>Nº LAVADO:</p>
                  <input id="lavadomodaleditar"type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;" require>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRESCINTOS CAMION:</p>
                  <input id="prescintomodaleditar" value="0" type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require >
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRESCINTOS ACOPLADO:</p>
                  <input id="prescintomodalacopladoeditar" value="0"type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;"require >
    
                </div>              
                </div>
                </div>
                </div>    
                <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
                <div class="small-box bg-success col-sm-12">
                    <h6 class="text-center">OBSERVACIONES</h6>
                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>OBSERVACION:</p>
                  <textarea id="observacionmodaleditar"  type="text" class="form-control rounded-1 ml-3"style="text-transform:uppercase;" require>SIN NOVEDAD</textarea>               
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p type="hidden" >KILOS CUERO:</p>
                  <input id="kiloscuerosmodaleditar" value="0" type="hidden" class="form-control rounded-1 ml-3"require>              
                </div>              
                </div>
                </div>     
                </div>   
                   
                    
          </div>
          
          <div class="card-footer">
          <button type="submit" id="editar" class="btn bg-gradient-success float-right m-1">Editar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade col-md-12" id="crearingresos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Cargar Ingresos MATADERO MUNICIPAL MALARGÜE</h3>
              <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>              
              </button>
          </div>
          <div class="card-body">
              <div class="alert alert-success text-center" id="edit-lote" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
              </div> 
             
              <form id="form-crear-ingreso"> 
              <div class="form-group">
                        <input id="ano" type="hidden"  value="<?php echo date("Y") ?>" class="form-control">
                    </div> 
              
                    <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>TROPA</label>
                        <input type="number" id="tropamodal"class="form-control" placeholder="TROPA---" disabled>
                        <input type="hidden" id="cargo" class="form-control" value="<?php echo $_SESSION['usuario'] ?>" disabled>
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
                       <input id="sesion_desbloqueo" type="hidden" value=" <?php echo$_SESSION['us_tipo'] ?>">
                        <button class="btn btn-success" id="desbloquear"><i class="fas fa-unlock-alt"></i></i></button>
                      
                        </div>
                      </div>
                      
                     
                    </div>
                 
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Libro Nro:</label>
                        <input type="text" id="libromodal"class="form-control" style="text-transform:uppercase" placeholder="Libro Nro:">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Libro Folio:</label>
                        <input type="text" id="foliomodal"class="form-control" placeholder="Libro Folio">
                      </div>
                    </div>
                   
                  <div class="col-12">
                  <div class="form-group mt-4">
                  <p><b>TCI:</b></p>
                  <input id="tci_modal"type="text" class="form-control rounded-1" style="width: 100%"require>
                </div>              
                </div>

                    <div class="col-sm-12">
                    <div class="form-group mt-4">
                    <p><b>DESTINO:</b></p>
                  <select id="destinoselect" type="text" class="form-control select2 ml-3" style="width: 100%"> </select>
                    </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mt-4">
                        <p><b>ESPECIE:</b></p>
                        <select id="especieselect" type="text" class="form-control select2 ml-3"style="width: 100%"> ></select>
                      </div>
                    </div>
                  </div>  
              <div class="row" id="subespc">
                  <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>SUB-ESPECIE</label>
                        <select type="number" id="subespeciemodal" style="width: 100%" value="0" class="form-control select2"></select>
                      
                  <input type="hidden" id="subespecieagregarid" style="text-transform:uppercase" class="form-control">
                  <input type="hidden" id="subespecieagregaridguardar" style="text-transform:uppercase" class="form-control">
                </div>   
                </div>
                <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidadmodal" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="number" id="kilosmodal" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="labelmuertos">MUERTOS</label>
                        <input type="text" id="muertosmodal" style="text-transform:uppercase;" value="0" class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarmuertoscantidad"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <select id="agregarmuertoskilos"type="text" placeholder="KILOS"class="form-control"></select>
                        <input id="digestormuertos"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accionmuertos"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarmuertos">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarmuertos">OCULTAR</a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="caidosmodal1">CAIDOS</label>
                        <input type="number" id="caidosmodal" style="text-transform:uppercase;" value="0"class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarcaidoscantidad"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <input type="hidden"id="agregarcaidoscantidadhidden" value="0">
                        <select id="agregarcaidoskilos"type="text" placeholder="KILOS"class="form-control"></select>
                        <input type="hidden"id="agregarcaidoskiloshidden" value="0">
                        <input id="digestorcaidos"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accioncaidos"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarcaidos">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarcaidos">OCULTAR</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpiemodal" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospiemodal" class="form-control"disabled></input>
                      </div>
                    </div>

                    <button type="button" id="abrirsub1" class="mb-3 mr-3 ml-3 btn btn-block btn-outline-info"><b>AGREGAR MAS SUBESPECIES</b></button>           
                    </div>
                    <div class="row" id="subespc1">
                <div class="col-sm-12">
                
                      <div class="form-group">
                        <label class="mt-2">SUB-ESPECIE 1</label>
                        <select type="number" id="subespeciemodal1" style="width: 100%" value="0" class="form-control select2"></select>
                      
                  <input type="hidden" id="subespecieagregarid1" style="text-transform:uppercase" class="form-control">
                  <input type="hidden" id="subespecieagregaridguardar1" style="text-transform:uppercase" class="form-control">
                </div>   
                </div>
                <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidadmodal1" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="number" id="kilosmodal1" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="labelmuertos1">MUERTOS</label>
                        <input type="text" id="muertosmodal1" style="text-transform:uppercase;" value="0" class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarmuertoscantidad1"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <select id="agregarmuertoskilos1"type="text" placeholder="KILOS"class="form-control"></select>
                        <input id="digestormuertos1"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accionmuertos1"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarmuertos1">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarmuertos1">OCULTAR</a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="caidosmodalsub12">CAIDOS</label>
                        <input type="number" id="caidosmodalsub1" style="text-transform:uppercase;" value="0"class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarcaidoscantidad1"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <input type="hidden"id="agregarcaidoscantidadhidden1" value="0">
                        <select id="agregarcaidoskilos1"type="text" placeholder="KILOS"class="form-control"></select>
                        <input type="hidden"id="agregarcaidoskiloshidden1" value="0">
                        <input id="digestorcaidos1"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accioncaidos1"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarcaidos1">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarcaidos1">OCULTAR</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpiemodal1" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospiemodal1" class="form-control"disabled></input>
                      </div>
                    </div>
                    <button type="button" id="abrirsub2" class="mb-3 mr-3 ml-3 btn btn-block btn-outline-info"><b>AGREGAR MAS SUBESPECIES</b></button>         

                    </div>
                <div class="row" id="subespc2">
                      <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                              <label class="mt-2">SUB-ESPECIE 2</label>
                              <select type="number" id="subespeciemodal2" style="width: 100%" value="0" class="form-control select2"></select>
                            
                        <input type="hidden" id="subespecieagregarid2" style="text-transform:uppercase" class="form-control">
                        <input type="hidden" id="subespecieagregaridguardar2" style="text-transform:uppercase" class="form-control">
                      </div>   
                      </div>
                      <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidadmodal2" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="number" id="kilosmodal2" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="labelmuertos2">MUERTOS</label>
                        <input type="text" id="muertosmodal2" style="text-transform:uppercase;" value="0" class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarmuertoscantidad2"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <select id="agregarmuertoskilos2"type="text" placeholder="KILOS"class="form-control"></select>
                        <input id="digestormuertos2"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accionmuertos2"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarmuertos2">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarmuertos2">OCULTAR</a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="caidosmodal12">CAIDOS</label>
                        <input type="number" id="caidosmodal2" style="text-transform:uppercase;" value="0"class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarcaidoscantidad2"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <input type="hidden"id="agregarcaidoscantidadhidden2" value="0">
                        <select id="agregarcaidoskilos2"type="text" placeholder="KILOS"class="form-control"></select>
                        <input type="hidden"id="agregarcaidoskiloshidden2" value="0">
                        <input id="digestorcaidos2"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accioncaidos2"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarcaidos2">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarcaidos2">OCULTAR</a>
                          </div>
                        </div>
                      </div>
                    </div>
                 
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpiemodal2" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospiemodal2" class="form-control"disabled></input>
                      </div>
                    </div>
                    <button type="button" id="abrirsub3" class="mb-3 mr-3 ml-3 btn btn-block btn-outline-info"><b>AGREGAR MAS SUBESPECIES</b></button>
              </div>
              <div class="row" id="subespc3">
                      <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                              <label class="mt-2">SUB-ESPECIE 3</label>
                              <select type="number" id="subespeciemodal3" style="width: 100%" value="0" class="form-control select2"></select>
                            
                        <input type="hidden" id="subespecieagregarid3" style="text-transform:uppercase" class="form-control">
                        <input type="hidden" id="subespecieagregaridguardar3" style="text-transform:uppercase" class="form-control">
                      </div>   
                      </div>
                      <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidadmodal3" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="number" id="kilosmodal3" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="labelmuertos3">MUERTOS</label>
                        <input type="text" id="muertosmodal3" style="text-transform:uppercase;" value="0" class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarmuertoscantidad3"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <select id="agregarmuertoskilos3"type="text" placeholder="KILOS"class="form-control"></select>
                        <input id="digestormuertos3"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accionmuertos3"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarmuertos3">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarmuertos3">OCULTAR</a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="caidosmodal13">CAIDOS</label>
                        <input type="number" id="caidosmodal3" style="text-transform:uppercase;" value="0"class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarcaidoscantidad3"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <input type="hidden"id="agregarcaidoscantidadhidden3" value="0">
                        <select id="agregarcaidoskilos3"type="text" placeholder="KILOS"class="form-control"></select>
                        <input type="hidden"id="agregarcaidoskiloshidden3" value="0">
                        <input id="digestorcaidos3"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accioncaidos3"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarcaidos3">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarcaidos3">OCULTAR</a>
                          </div>
                        </div>
                      </div>
                    </div>
                 
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpiemodal3" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospiemodal3" class="form-control"disabled></input>
                      </div>
                    </div>
                    <button type="button" id="abrirsub4" class="mb-3 mr-3 ml-3 btn btn-block btn-outline-info"><b>AGREGAR MAS SUBESPECIES</b></button>

              </div>

              <div class="row" id="subespc4">
                      <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                              <label class="mt-2">SUB-ESPECIE 4</label>
                              <select type="number" id="subespeciemodal4" style="width: 100%" value="0" class="form-control select2"></select>
                            
                        <input type="hidden" id="subespecieagregarid4" style="text-transform:uppercase" class="form-control">
                        <input type="hidden" id="subespecieagregaridguardar4" style="text-transform:uppercase" class="form-control">
                      </div>   
                      </div>
                      <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>CANTIDAD</label>
                        <input type="number" id="cantidadmodal4" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS</label>
                        <input type="number" id="kilosmodal4" style="text-transform:uppercase;" value="0" class="form-control"></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="labelmuertos4">MUERTOS</label>
                        <input type="text" id="muertosmodal4" style="text-transform:uppercase;" value="0" class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarmuertoscantidad4"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <select id="agregarmuertoskilos4"type="text" placeholder="KILOS"class="form-control"></select>
                        <input id="digestormuertos4"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accionmuertos4"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarmuertos4">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarmuertos4">OCULTAR</a>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label id="caidosmodal14">CAIDOS</label>
                        <input type="number" id="caidosmodal4" style="text-transform:uppercase;" value="0"class="form-control" disabled></input>
                        <div class="input-group mt-1">
                        <select id="agregarcaidoscantidad4"type="text"  class="form-control" placeholder="CANTIDAD"></select>
                        <input type="hidden"id="agregarcaidoscantidadhidden4" value="0">
                        <select id="agregarcaidoskilos4"type="text" placeholder="KILOS"class="form-control"></select>
                        <input type="hidden"id="agregarcaidoskiloshidden4" value="0">
                        <input id="digestorcaidos4"type="text" placeholder="AGREGAR DESTINO "class="form-control" value="DIGESTOR"></input>
                        <button id="accioncaidos4"type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Accion
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" id="agregarcaidos4">Agregar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="cerrarcaidos4">OCULTAR</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>EN PIE</label>
                        <input type="number" id="enpiemodal4" class="form-control" disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>KILOS EN PIE</label>
                        <input type="number" id="kilospiemodal4" class="form-control"disabled></input>
                      </div>
                    </div>
              </div>
                  <div class="row">
                 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label id="conservaciontitulo"style="text-transform:uppercase">CONSERVACION</label>
                        <select type="text" id="conservacionmodal" class="form-control select2" style="width: 100%"></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="conservacionagregarmodal" class="dropdown-item" href="adm_conservacion.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarconservacionmodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>DIAS DE VENCIMIENTO</label>
                        <input type="number" id="vencimientomodal" class="form-control"disabled></input>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>CORRALES</label>
                        <select type="text" id="corralmodal" class="form-control select2" style="width: 100%"></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="corralagregarmodal" class="dropdown-item" href="adm_corral.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarcorralmodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>CORRALEROS</label>
                        <select type="text" id="corraleromodal" class="form-control select2" style="width: 100%"></select>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="corraleroagregarmodal" class="dropdown-item" href="adm_corraleros.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarcorraleromodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                      </div>
                    </div>
                  </div>

                    <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
                    
                    <div class="small-box bg-info col-sm-12">
                    <h6 class="text-center">ENTIDADES</h6>
                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <label type="text" class="mr-1" id="cuitusuario">USUARIO:</label>
                  <select type="text" id="matarife" class="form-control select2 mr-3"style="width: 100%" ></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="usuariomodal" class="dropdown-item" href="adm_matarife.php"target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarusuariomodal" class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                                    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <label type="text" class="mr-1" id="cuitusuariosub">SUB-ITEM:</label>
                  <select type="text" id="matarifesub_item" class="form-control select2 mr-3"style="width: 100%" ></select>
                  </div>
                  </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <label class=" mr-1" id="productorcuit">PRODUCTOR:</label>
                  <select type="text" id="productorselect" class="form-control select2 mr-3"style="width: 100%"></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="productormodal" class="dropdown-item" href="adm_productor.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarproductormodal" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                  
                </div>              
                </div>
                </div>
                </div>
                <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
                
                <div class="small-box bg-warning col-sm-12">
                    <h6 class="text-center">DATOS DE TRASLADO</h6>
                    <div class="row">
                  <div class="col-12">
                  <div class="input-group mb-3">
                  <p>Nº GUIA:</p>
                  <input id="guiamodal"type="text" class="form-control rounded-1 ml-3"require>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>FECHA EMISION GUIA:</p>
                  <input id="fechaguiamodal" type="date" class="form-control rounded-1 ml-3">
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-12">
                  <div class="input-group mb-3">
                  <p>DTE:</p>
                  <input id="dtamodal" type="text" class="form-control rounded-1 ml-3" disabled>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>FECHA EMISION DTE:</p>
                  <input id="fechadtamodal"type="text" class="form-control rounded-1 ml-3" disabled>
    
                </div>              
                </div>
                </div>
              
            
                <div class="row">
                  <div class="col-sm-12">
                  <div class="form-group mb-3">
                  <p>PROCEDENCIA:</p>
                  <select id="llenarprocedencia" type="text" class="form-control select2 rounded-1 ml-3" style="width: 100%"></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="procedenciamodal" class="dropdown-item" href="adm_procedencia.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarprocedenciamodal" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PROVINCIA:</p>
                  <select id="provinciamodal" type="text" class="form-control rounded-1 select2 ml-3" style="width: 100%"></select>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>LOCALIDAD:</p>
                  <select id="localidadmodal" type="text" class="form-control rounded-1 select2 ml-3"style="width: 100%"></select>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>CP:</p>
                  <input id="CPmodal" type="text" class="form-control rounded-1 ml-3">
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>TRANSPORTE:</p>
                  <select  id="llenartransporte" type="text" class="form-control select2 rounded-1 ml-3" style="width: 100%"></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="transportemodal" class="dropdown-item" href="adm_transporte.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizartransportemodal" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>CHOFER:</p>
                  <select id="llenarchofer" type="text" class="form-control select2 rounded-1 ml-3" style="width: 100%"></select>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button  type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                      Acción
                    </font></font></button>
                    <div class="dropdown-menu">
                      <a id="chofermodal" class="dropdown-item" href="adm_chofer.php" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Agregar o Editar</font></font></a>
                      <a id="actualizarchofermodal" class="dropdown-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualizar</font></font></a>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  
                </div>
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>DNI:</p>
                  <input id="dnimodal"type="text" class="form-control rounded-1 ml-3"disabled>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>HABILITACION:</p>
                  <input id="habilitacionmodal" type="text" class="form-control rounded-1 ml-3" disabled>
    
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>HORAS VIAJE:</p>
                  <input id="horasdeviajemodal" type="number" class="form-control rounded-1 ml-3">
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>Nº LAVADO:</p>
                  <input id="lavadomodal"type="text" class="form-control rounded-1 ml-3">
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRESCINTOS CAMION:</p>
                  <input id="prescintomodal" value="0" type="text" class="form-control rounded-1 ml-3">
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>PRESCINTOS ACOPLADO:</p>
                  <input id="prescintomodalacoplado" value="0"type="text" class="form-control rounded-1 ml-3">
    
                </div>              
                </div>
                </div>
                </div>    
                <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
                <div class="small-box bg-success col-sm-12">
                    <h6 class="text-center">OBSERVACIONES</h6>
                    <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  <p>OBSERVACION:</p>
                  <textarea id="observacionmodal"  type="text" class="form-control rounded-1 ml-3">SIN NOVEDAD</textarea>               
                </div>              
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="input-group mb-3">
                  
                  <input id="kiloscuerosmodal" value="0" type="hidden" class="form-control rounded-1 ml-3">              
                </div>              
                </div>
                </div>     
                </div>   
                   
                    
          </div>
          
          <div class="card-footer">
          <button type="button" id="Comprobartropas" class="btn bg-gradient-primary float-right m-1">Comprobar Tropas</button>
          <a type="button" href="adm_tropas.php"target="_blank" class="btn bg-gradient-success float-right m-1">Gestion Tropas</a>
          <a type="button" id="asignartropas" href="adm_tropas.php"target="_blank" class="btn bg-gradient-success float-right m-1">Asignar Tropas</a>
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
          <div class="callout callout-info">
                  <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Información IMPORTANTE!</font></font></h5>
                  <div class="row">
                  <div class="col-sm-3">
              <i class="nav-icon far fa-circle text-success"></i>
              <p class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">INGRESO</font></font></p>
                </div>
                <div class="col-sm-3">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">EN FAENA</font></font></p>
       
                </div>
                <div class="col-sm-3">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FINALIZADO</font></font></p>
       
                </div>
          </div>
          
          </div>
        
    </section>

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
                 <th>Matarife</th>
                <th>Tropa</th>
                <th>Procedencia</th>
                <th>Especie</th>
                <th>SubEspecie</th>
                <th>Productor</th>
                <th>Dte</th>     
                <th>TCI</th>         
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
    <button data-toggle="modal" data-target="#crearingresos" type="button" id="crear" class="btn btn-block btn-outline-success"><b>CREAR INGRESOS</b></button>           
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
                      <img class="direct-chat-img mr-1" src="../util/img/usuarios/user_default.png" alt="Message User Image">
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
                    
                    <img class="direct-chat-img" src="../util/img/usuarios/user_default.png" alt="Message User Image">
                   
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
              
                  <div class="col-sm-6">
                  <p></p> 
                  <a id="imprimirreduccion"  class="btn btn-block btn-outline-danger" data-toggle="modal" data-target="#reducciongarrones"><i class="fas fa-file-csv"></i>Ver Reduccion</a>
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
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>TCI</label>
                        <input type="text" id="tci_principal"class="form-control"disabled>
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
                        <button type="button" id="verciclos" class="btn btn-block btn-outline-success"><b>Hay mas SubEspecies</b></button>

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
                  
                  <input id="kiloscuerousuario"type="hidden" style="text-transform:uppercase" class="form-control rounded-1 ml-3"disabled> 
                  <input id="prioridad" type="hidden" value="<?php  echo $_SESSION['us_tipo']?>">  
                  <input id="cargodatos" type="hidden">             
                </div>              
                </div>
                </div>
              
            </div>
       
            </div>
            
          </div>
    
      
           
  </section>

   <section id="parte2">
     
  
                
                  
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
                <div class="small-box bg-warning col-sm-12">
                    <h6 id="clasificacioncorralreduccion2"class="text-center">REDUCCION DE ANIMALES</h6>
                    <div class="row justify-content-center">
                  <div class="col-auto">
                    <table id="clasificacioncorralreduccion1"class="table table-responsive">
                      <thead class="table">
                        <tr class="text-center">
                              <th>CORRAL Nº</th>
                              <th>CANTIDAD</th>
                              <th>ESPECIE</th>
                              <th>SUB-ESPECIE</th>
                              
                        </tr>
                        <tbody id="clasificacioncorralreduccion" class="table-active text-center"style="text-transform:uppercase">  
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
<script src="../js/crearingresos1.js"></script> 
<script src="../js/editaringresos1.js"></script> 
<script src="../js/botonesmodal.js"></script> 
<script src="../js/botonesmodaleditar1.js"></script> 
<script src="../js/tabladeingresos1.js"></script> 
<script src="../js/etapas.js"></script>
<script src="../js/nav.js"></script>
<script src="../js/preguntas.js"></script>
<script src="../js/verificarmail.js"></script>
