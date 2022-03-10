<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3 || $_SESSION['us_tipo'] == 2) {
  include_once 'layouts/header.php'
?>
  <?php
  include_once 'layouts/nav.php'
  ?>

  <div class="modal fade col-md-12" id="factura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">INFORME DE MATANZA</font>
            </font>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
            <span aria-hidden="true">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">×</font>
              </font>
            </span></button>
        </div>
        <div class="modal-body">
          <form>
            <?php $datos = date_default_timezone_set('America/Argentina/Mendoza');
            $fecha = date("Y-m-d H:i:s");
            ?>
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;"> MATADERO FRIGORIFICO REGIONAL MALARGÜE
                      </font>
                    </font><small class="float-right">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;"><?php echo $fecha ?></font>
                      </font>
                    </small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      De
                    </font>
                  </font>
                  <address>
                    <strong>
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">MATADERO FRIGORIFICO REGIONAL MALARGÜE</font>
                      </font>
                    </strong><br>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Ruta Nacional 40 Km 2951/52 </font>
                    </font><br>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Malargüe, CP: 5613 </font>
                    </font><br>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Teléfono: (0260) 4471060 TeleFax: (0260)4470369 </font>
                    </font><br>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Correo electrónico: frigorificosistema@gmail.com Web: www.malargue.gov.ar
                      </font>
                    </font>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      <input type="hidden" id="idpdf">
                      A

                    </font>
                  </font>
                  <address>
                    <strong id="destinatario">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">John Doe</font>
                      </font>
                    </strong><br>
                    <p id="guia">Guia:</p>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                      </font>
                    </font><br>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                      </font>
                    </font><br>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">

                      </font>
                    </font>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b id="tropa">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Número de Tropa </font>
                    </font>
                  </b><br>
                  <br>
                  <b id="especie">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;"></font>
                    </font>
                  </b>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> </font>
                  </font><br>
                  <b id="subespecie">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;"></font>
                    </font>
                  </b>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> </font><b>
                      <font style="vertical-align: inherit;"></font>
                    </b>
                    <font style="vertical-align: inherit;"> </font>
                  </font><br>

                  </font>
                  </font>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table" style="width:100%">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>AÑO</th>
                        <th>Garron</th>
                        <th>Peso</th>
                        <th>Destino</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tbody id="facturacion" class="table-active text-center" style="text-transform:uppercase">
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">

                </div>
              </div>

              <!-- /.col -->
              <div class="col-6">
                <p class="lead">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Totales</font>
                  </font>
                </p>

                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th style="width:50%">
                          <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Animal en pie:</font>
                          </font>
                        </th>
                        <td id="enpie">
                          <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"></font>
                          </font>
                        </td>
                      </tr>
                      <tr>
                        <th>
                          <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Kilos en Pie</font>
                          </font>
                        </th>
                        <td id="kilosenpie">
                          <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"></font>
                          </font>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">

                <button id="imprimirpdf" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> Generar PDF
                    </font>
                  </font>
                </button>
              </div>
            </div>
        </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        </form>
      </div>

    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  <div class="modal fade col-md-12" id="elegircodigo" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ELEGIR CUARTEADO</font></font></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerca">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
            </div>
            <div class="modal-body">
              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
            
            <form id="form-camara-garron">
                    <div class="form-group">
                        <label for="numero_tropa_cuarteado">Nº de Tropa</label>
                        <input id="numero_tropa_cuarteado" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>	
                    <div class="form-group">
                        <label for="clasificacion_garron_cuarteado">Clasificacion</label>
                        <input id="clasificacion_garron_cuarteado" type="text" style="text-transform:uppercase" class="form-control"disabled>
                    </div>
                                      
                    <div class="form-group">
                        <label for="elegir_cuarteado">Elija Cuarteado</label>
                        <select class="form-control select2"  id="elegir_cuarteado" type="text" style="width: 100%"></select>
                    </div>
                    
                    </div>
         
            <div class="modal-footer justify-content-between">
            <button type="submit"  id="guardarcuarteado" class="btn btn-outline-light">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-light">Cerrar</button>
          </form>
            </div>
           
          </div>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
              <h4>MATADERO FRIGORIFICO MALARGÜE <?php echo date("Y") ?></h4>
              <input id="añoactual" type="hidden" value="<?php echo date("Y") ?>">
              <div class="row">
                <div class="col-sm-6">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-calendar-alt"></i></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text text-center">Fecha Actual</span>
                      <span class="info-box-text text-center"><?php echo date("d/m/Y") ?></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>

                <!-- /.info-box-content -->
              </div>
            </div>
          </div>
        </div>

      </section>

      <title>Municipalidad de Malargüe</title>

  </head>

  <body>
    <form id="form_listado">
      <div class="container-fluid">
        <div>
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Consultas</h3>
            </div>
          </div>
          <div class="card-body table-responsive">
            <div class="container-fluid">
              <table id="tabla_finalizados" class="table table" style="width:100%">
                <thead>
                  <tr class="text-center">
                    <th>ID</th>
                    <th>Tropa</th>
                    <th>Cantidad</th>
                    <th>Des/Has</th>
                    <th>Clasificacion</th>
                    <th>Kg PRO.</th>
                    <th>Cuarteado</th>
                    <th>Destino</th>
                    <th>Matarife</th>
                    <th>Productor</th>
                    <th>DTE</th>
                    <th>Estado</th>
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
              <tbody id="clasificacion" class="table-active text-center" style="text-transform:uppercase">
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
} else {
  header('Location: ../index.php');
}
  ?>
  </footer>
  <script src="../js/datatables.js"></script>
  <script src="../js/Finalizado.js"></script>
  <script src="../js/nav.js"></script>
  <script src="../js/helpers.js"></script> 