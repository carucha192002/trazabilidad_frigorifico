$(document).ready(function(){
  $('#gestion_faenados_obs1').addClass('active');
    rellenar_faenados();

      function rellenar_faenados() {
        let funcion = "buscargarronfaenadostropas";
        $.post('../controlador/ObservacionController.php',{funcion},(response)=>{  
          $('#form_listado_garron').DataTable().clear().destroy();
        let datatable = $("#form_listado_garron").DataTable({
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
         
            if ( aData['observacion_garron'] == "SI" )
            {
                $('td', nRow).css('background-color', '#f55454');
                $('#hide',nRow).css( 'display', 'block' );
                
            }
            else if ( aData['observacion_garron'] == "NO" )
            {
                $('td', nRow).css('background-color', '#4df030');
                $('#hide',nRow).css( 'display', 'none' );
            }
           
        },
          ajax: {
            url: "../controlador/ObservacionController.php",
            method: "POST",
            data: {funcion: funcion }
          },
          columns: [
            { data: "id_faenados" },
            { data: "fechafaena" },
            { data: "tropa" },
            { data: "especie" },
            { data: "productor" },
            { data: "matarife" },
            { data: "dte" },
            { data: "garron" },
            { data: "peso" },
            { data: "observacion_garron" },
      
            {
              defaultContent: `
              <button id="hide" class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_observacion">Ver Observaciones</button>     
                                          `,
            },
          ],
          language: espanol,
        });
       

        $("#form_listado_garron tbody").on("click", "#hide", function () {
          let datos = datatable.row($(this).parents()).data();
          let id = datos.id_faenados;
          let tropas = datos.tropa;
          let observacion = datos.observacion_garron;
          let productor = datos.productor;
          let matarife = datos.matarife;
          let dte = datos.dte;
          let garron = datos.garron;
          let peso = datos.peso;
          $("#tropamodal").val(tropas);
          $("#garron_observacion").val(garron);
          $("#id_observacion").val(id);
          $("#peso_observacion").val(peso);
          verificar(id);
      
        
        });
        async function verificar(id){
          funcion="observacion_foto";
          let data=await fetch('../controlador/ObservacionController.php',{
              method: 'POST',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              body:'funcion='+funcion+'&&id='+id
          })
              if(data.ok){
              let response=await data.text();
                
              try{
                let productos=JSON.parse(response);
                  let template=``;
                  productos.forEach(producto => {
                      template+=`
                      <div class="col-sm-12">
                          <div class="card">
                          <div class="card-body">
                              <div class="row">
                              <div align="center" class="col-sm-12">
                                  <img src="../img/observacion/${producto.foto}" class="img-fluid" alt="">
                              </div>
                              <div align="center" class="col-sm-12">
                                  <span align="center" class="text-muted">OBSERVACIONES: ${producto.descripcion}</span></br>
                                  <h1 class="badge bg-success">FECHA: ${producto.fecha}</h1></br>`;
                                template+=`  
                                  </br>
                                
                                  </div>
                              </div>
                          </div>
                          </div>
                      </div>
                      `;
                  });
                  $('#productos').html(template);
              } catch(error){
              
              }
          }else{
              Swal.fire({
                  icon: 'error',
                  title: data.statusText,
                 text: 'Hubo conflicto de codigo: '+data.status,
              })
          }
        
        }
        $(document).on('click','#imprimir',(e) => {
           Mostrar_Loader('Generando_Pdf');
           let id=$('#id_observacion').val();           
            $.post('../controlador/PDFObservacionController.php',{id},(response)=>{
                if(response!=''){
                    cerrar_loader('exito_generar');  
                    window.open('../pdf/Observacion/pdf-Observacion.pdf','_blank');
                   }else{
                    cerrar_loader('error_generar');  
                   }
                  
              
            })     
        })
        function Mostrar_Loader(Mensaje) {
            var texto = null;
            var mostrar = false;
            switch (Mensaje) {
              case "Generando_Pdf":
                texto = " Generando PDF. Por favor espere...";
                mostrar = true;
                break;
            }
            if (mostrar) {
              Swal.fire({
                title: "Generando PDF",
                text: texto,
                showConfirmButton: false,
              });
            }
          }
          function cerrar_loader(Mensaje) {
            var tipo = null;
            var texto = null;
            var mostrar = false;
            switch (Mensaje) {
              case "exito_generar":
                tipo = "success";
                texto = " El PDF se genero correctamente...";
                mostrar = true;
                break;
              case "error_generar":
                tipo = "error";
                texto = " El PDF no puede generarse... Por favor intente de nuevo";
                mostrar = true;
                break;
              default:
                swal.close();
                break;
            }
            if (mostrar) {
              Swal.fire({
                position: "center",
                icon: tipo,
                text: texto,
                showConfirmButton: false,
              });
            }
            
          } 
      })
      }
  

  })
        
  
 
  
  
  
  
  let espanol= {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidad"
      }
  };