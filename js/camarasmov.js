$(document).ready(function () {
  $('#gestion_movcamara1').addClass('active');
  var funcion;
  var edit = false;
  $(".select2").select2();
  buscar_camara();
  rellenar_camaras();
  $("#guardarcamaratoda").hide();
  $("#guardar1").hide();
  function rellenar_camaras() {
    funcion = "rellenar_camaras";
    $.post("../controlador/camaraController.php", { funcion }, (response) => {
      const camaras = JSON.parse(response);
      let template = "";
      template += `
            <option value="0"> Seleccione una Camara</option>`;
      camaras.forEach((camara) => {
        template += `
                    <option value="${camara.id}">${camara.nombre}</option>
                `;
      });
      $("#nombre_camara_destino").html(template);
      $("#nombre_camara_destino_toda").html(template);
    });
    $("#nombre_camara_destino_toda").change(function () {
      $("#nombre_camara_destino_toda option:selected").each(function () {
        numerocamara = $(this).val();
        let id = numerocamara;

        funcion = "datoscamara_rellenar";
        $.post(
          "../controlador/camaraController.php",
          { funcion, id },
          (response) => {
            let nombrecamara = "";
            const datos = JSON.parse(response);
            nombrecamara += `${datos.camara}`;

            $("#nombre_camara_destino1_toda").val(nombrecamara);
            if ($("#nombre_camara_destino1_toda").val() == "") {
              $("#guardarcamaratoda").hide();
            } else {
              $("#guardarcamaratoda").show();
            }
          }
        );
      });
    });
    $("#nombre_camara_destino").change(function () {
      $("#nombre_camara_destino option:selected").each(function () {
        numerocamara = $(this).val();
        let id = numerocamara;

        funcion = "datoscamara_rellenar";
        $.post(
          "../controlador/camaraController.php",
          { funcion, id },
          (response) => {
            let nombrecamara = "";
            const datos = JSON.parse(response);
            nombrecamara += `${datos.camara}`;

            $("#nombre_camara_destino1").val(nombrecamara);
            if ($("#nombre_camara_destino1").val() == "") {
              $("#guardar1").hide();
            } else {
              $("#guardar1").show();
            }
          }
        );
      });
    });
  }

  function buscar_camara(consulta) {
    funcion = "buscarmov";
    $.post("../controlador/camaraController.php", { consulta, funcion },(response) => {
        const camaras = JSON.parse(response);
        let template = "";
        camaras.forEach((camara) => {
          template += `
                <div CamId="${camara.id}" CamIngreso="${camara.id_ingreso}" CamCodigo="${camara.codigo}"CamTropa="${camara.tropa}"CamEspecie="${camara.especie}"camDespecie="${camara.despiece}"Camcamara="${camara.camara}"Camgarron="${camara.garron}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
               
                <i class="fas fa-lg fa-cubes mr-1"></i>CAMARA:${camara.camara}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h6 class="lead"><b>${camara.especie}</b></h6> 
                      <h4 class="lead  text-success">GARRON:<b>${camara.garron}</b></h4>   
                      <ul class="ml-4 mb-0 fa-ul text-primary">
                      <li class="small"><span class="fa-li"><i class="fas fa-paw"></i></span> TROPA: ${camara.tropa}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span><h6> CUARTEADO: ${camara.despiece}</h6> </li>
                    </ul>                  
                    </div>
                
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="cambiar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#crearcamara">
                      <i class="fas fa-image"> MOVER GARRON A:</i>
                    </button>
                    <button class="cambiartropa btn btn-sm bg-warning" type="button" data-toggle="modal" data-target="#todatropa">
                    <i class="fas fa-image"> MOVER TROPA A:</i>
                  </button>
                   
                  </div>
                </div>
              </div>
            </div>
                `;
        });
        $("#camaras").html(template);
      }
    );
  }
  $(document).on("keyup", "#buscar-camara", function () {
    let valor = $(this).val();
    if (valor.trim() != "") {
      buscar_camara(valor);
    } else {
      buscar_camara();
    }
  });

  $(document).on("click", ".cambiar", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const tropa = $(elemento).attr("CamTropa");
    const especie = $(elemento).attr("CamEspecie");
    const despiece = $(elemento).attr("camDespecie");
    const camara = $(elemento).attr("Camcamara");
    const garron = $(elemento).attr("Camgarron");
    const id = $(elemento).attr("CamId");
    $("#tropa_camara").val(tropa);
    $("#garron_camara").val(garron);
    $("#nombre_camara_origen").val(camara);
    $("#nombre_camara_origen1").val("CAMARA Nº:" + camara);
    $("#despiece_camara").val(despiece);
    $("#especie_camara").val(especie);
    $("#id_edit_cam").val(id);
  });
  $("#form-mover-Camara").submit((e) => {
    let tropa = $("#tropa_camara").val();
    let garron = $("#garron_camara").val();
    let camaraorigen = $("#nombre_camara_origen").val();
    let camaradestino = $("#nombre_camara_destino1").val();
    let camaradestino1 = $("#nombre_camara_destino").val();
    let despiece = $("#despiece_camara").val();
    let especie = $("#especie_camara").val();
    let id = $("#id_edit_cam").val();

    funcion = "movergarroncamara";
    $.post("../controlador/camaraController.php", {funcion, tropa,garron,camaraorigen,camaradestino,despiece,especie,},(response) => {

      if (response == "add") {
        funcion = "modificarcamara";
          $.post("../controlador/camaraController.php",{ funcion,id,camaradestino1,garron },(response) => {
              if (response == "edit") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Editado",
                  showConfirmButton: false,
                  timer: 1500,
                });
                $("#form-mover-Camara").trigger("reset");
                buscar_camara();
              }
            }
          );

          funcion = "mover";
          $.post(
            "../controlador/camaraController.php",
            {
              funcion,
              tropa,
              garron,
              camaraorigen,
              camaradestino,
              despiece,
              especie,
              id,
            },
            (response) => {
              if (response == "agregado") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Se realizo el movimiento exitosamente",
                  showConfirmButton: false,
                  timer: 1500,
                });
                $("#form-mover-Camara").trigger("reset");
                buscar_camara();
              }
            }
          );
        } else {
          funcion = "buscarultimoid";
          $.post("../controlador/camaraController.php",{ funcion, tropa, id },(response) => {
              let ultimo = "";
              const respuesta = JSON.parse(response);
              ultimo += `${respuesta.id}`;
              funcion = "cambiarestado";
              $.post("../controlador/camaraController.php",{ funcion, ultimo },(response) => {
                  if (response == "modificado") {
                    funcion = "mover";
                    $.post("../controlador/camaraController.php",
                      {
                        funcion,
                        tropa,
                        garron,
                        camaraorigen,
                        camaradestino,
                        despiece,
                        especie,
                        id,
                      },
                      (response) => {
                        if (response == "agregado") {
                          funcion = "modificarcamara";

                          $.post(
                            "../controlador/camaraController.php",
                            {funcion,id,camaradestino1,garron },
                            (response) => {
                              if (response == "edit") {
                                Swal.fire({
                                  position: "center",
                                  icon: "success",
                                  title:
                                    "Se realizo el movimiento exitosamente",
                                  showConfirmButton: false,
                                  timer: 1500,
                                });
                                $("#form-mover-Camara").trigger("reset");
                                buscar_camara();
                              }
                            }
                          );
                          $("#form-mover-Camara").trigger("reset");
                          buscar_camara();
                        }
                      }
                    );
                  }
                }
              );
            }
          );
        }
      }
    );
    e.preventDefault();
  });
  $(document).on("click", ".cambiartropa", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const tropa = $(elemento).attr("CamTropa");
    const especie = $(elemento).attr("CamEspecie");
    const despiece = $(elemento).attr("camDespecie");
    const camara = $(elemento).attr("Camcamara");
    const garron = $(elemento).attr("Camgarron");
    const id = $(elemento).attr("CamId");
    const id_ingreso = $(elemento).attr("CamIngreso");
    $("#tropa_camara_toda").val(tropa);
    $("#nombre_camara_origen_toda").val(camara);
    $("#nombre_camara_origen1_toda").val("CAMARA Nº:" + camara);

    $("#despiece_camara_toda").val(despiece);
    $("#especie_camara_toda").val(especie);

    $("#id_edit_cam_toda").val(id);
    $("#id_ingreso_toda").val(id_ingreso);
    let funcion = "verificartropas";
    $.post(
      "../controlador/camaraController.php",
      { funcion, tropa },
      (response) => {
        const tipos = JSON.parse(response);
        let template = "";
        tipos.forEach((tipo) => {
          template += `
                  <tr clasId="${tipo.id}"clasCamara="${tipo.camara}"clasGarron="${tipo.garron}"clasPeso="${tipo.peso}"clasEspecie="${tipo.especie}"clasDespieces="${tipo.despieces}"clasDespieces="${tipo.despieces}">  
                      <td> 
                      <input type="checkbox" name="${tipo.garron}" value="${tipo.id}" class="opcion">                         
                      </td>                                             
                      <td> 
                      ${tipo.garron}                          
                      </td>
                      <td>${tipo.peso}</td>
                      <td>${tipo.camara}</td>

                  </tr>
              `;
        });
        $("#garroncamara").html(template);
      }
    );
  });
  $(document).on("click", "#guardarcamaratoda", (e) => {
    let tropa = $("#tropa_camara_toda").val();
    let camaraorigen = $("#nombre_camara_origen_toda").val();
    let camaradestino = $("#nombre_camara_destino_toda").val();
    let despiece = $("#despiece_camara_toda").val();
    let especie = $("#especie_camara_toda").val();
    let id = $("#id_edit_cam_toda").val();
    let camaradestino1 = $("#nombre_camara_destino1_toda").val();
    let id_ingresos = $("#id_ingreso_toda").val();
    var checked = [];
    $("#obligatorio").hide();
    let contador = $("input:checked").length;
    if (!contador) {
      $("#obligatorio").show();
      $("#resultado").text("");
      return;
    }
    $("#guardarcamaratoda").hide();
    Swal.fire({
      position: "center",
      icon: "success",
      title: "PROCESANDO SUS DATOS. ESPERE POR FAVOR",
      showConfirmButton: false,
    })
    let resultado = "";
    $(".opcion").each(function (indice, opcion) {
      if ($(opcion).is(":checked")) {
        resultado += $(opcion).attr("name") + ", ";
        checked.push({
          id: $(this).attr("value"),
          dato: $("#nombre_camara_destino_toda").val(),
          camaraorigen: $("#nombre_camara_origen_toda").val(),
          camaradestino: $("#nombre_camara_destino_toda").val(),
          despieces: $("#despiece_camara_toda").val(),
          especie: $("#especie_camara_toda").val(),
          tropa: $("#tropa_camara_toda").val(),
          garron: $(this).attr("name"),
        });
      }
    });
    $("#resultado").text(`Usted ha Seleccionado: ${resultado}.`);

    let json = JSON.stringify(checked);
    funcion = "bucaridcamaratoda";
    $.post("../controlador/camaraController.php",{ funcion, json },(response) => {
        funcion = "crearcamaratoda";
        $.post( "../controlador/camaraController.php",{funcion,json,tropa,camaraorigen,camaradestino1,despiece,especie },(response) => {

            });
       
        funcion = "modificarcamaratoda";
        $.post("../controlador/camaraController.php",{ funcion, json, camaradestino,tropa,id_ingresos },(response) => {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Se realizo el movimiento exitosamente",
              showConfirmButton: false,
              timer: 1500,
            });
            $("#form-mover-Camara_toda").trigger("reset");
            buscar_camara();
          }
        );

        $("#form-mover-Camara_toda").trigger("reset");
        buscar_camara();
      }
    );
   

    setTimeout('document.location.reload()',2000);
  });
});
$(document).ready(() => {
  $("#frmdatos").submit(function (evento) {
    evento.preventDefault();
  });
  $("#marcartodas").click(function () {
    $('input[type="checkbox"]').attr(
      "checked",
      $("#marcartodas").is(":checked")
    );
    $("#frmdatos").trigger("reset");
  });
  let funcion = "listarcamaras";
  $.post("../controlador/camaraController.php", { funcion }, (response) => {
    let datatable = $("#tabla_ingresos").DataTable({
      order: [[1, "desc"]],
      fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        if (aData["quedan"] <= 30) {
          $("td", nRow).css("background-color", "#f55454");
        } else if (aData["quedan"] >= 200) {
          $("td", nRow).css("background-color", "#4df030");
        } else if (aData["quedan"] <= 199) {
          $("td", nRow).css("background-color", "#e0f030");
        }
      },

      ajax: {
        url: "../controlador/camaraController.php",
        method: "POST",
        data: { funcion: funcion },
      },

      columns: [
        { data: "fecha" },
        { data: "tropa" },
        { data: "garron" },
        { data: "especie" },
        { data: "camaraorigen" },
        { data: "camaradestino" },
        { data: "vencimiento" },
        { data: "quedan" },
        { data: "estado" },
      ],
      language: espanol,
    });
  });
});

let espanol = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ningún dato disponible en esta tabla",
  sInfo:
    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
    sSortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    copy: "Copiar",
    colvis: "Visibilidad",
  },
};
