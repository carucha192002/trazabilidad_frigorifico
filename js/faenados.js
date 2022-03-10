$(document).ready(function(){
  $('#gestion_faenados1').addClass('active');
  rellenar_faenados();
    $("#guardargarronpeso").hide();

    $(document).on("keyup", "#editar_peso", function () {
      let valor = $(this).val();
      if (valor == ""||0) {
          $("#guardargarronpeso").hide();
      } else {
          $("#guardargarronpeso").show();
      }
    });

    $('#guardargarronpeso').on('click',function(){
      let tropa=$('#numero_tropa_editar').val();
      let garron=$('#garron_id').val();
      let peso=$('#peso_garron').val();
      let id_editar=$('#id_editar').val();
      let editar_peso=$('#editar_peso').val();
      let observacion_decomiso=$('#observacion_decomiso').val();
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Se han editado sus datos correctamente',
        showConfirmButton: false,
        timer: 1500
      }).then(function(){
        rellenar_faenados();
    })
      funcion="editargarronpeso";
      let datos=new FormData($('#form-datos')[0]);
      datos.append("funcion",funcion);
      datos.append("tropa",tropa);
      datos.append("garron",garron);
      datos.append("peso",peso);
      datos.append("id_editar",id_editar);
      datos.append("editar_peso",editar_peso);
      datos.append("observacion_decomiso",observacion_decomiso);
      $.ajax({
        type: "POST",
        url:'../controlador/ListadoController.php',
        data: datos,
        cache: false,
        processData:false,
        contentType:false,
        success:function(response){
      
        }
      })
  });
})
          $(document).on('keyup','#pesogarron',function(){
            let valor = $(this).val();
            $('#pesogarronguardar').val(valor);
            let tropas= $('#tropasnum').val();
            let ultimo=$('#maximo').val();
            let cantidad=$('#numgarron').val();
            let maximo=$('#maximo').val();
            let valor1=parseFloat(cantidad)+parseFloat(1);
            if(cantidad==maximo){
                $('#estadodect').val('FINALIZADO');
            }else{
               $('#finalzado').hide();
            }

            if(valor==''){
                $('#siguiente').hide();
                $('#reducir').hide();
            }else{
                $('#siguiente').show();
                $('#reducir').hide();
            }
            
        })


function rellenar_faenados() {
  let funcion = "buscargarronfaenadostropas";
  $.post('../controlador/ListadoController.php',{funcion},(response)=>{  
    $('#form_listado_garron').DataTable().clear().destroy();
    $('#form_listado_garron thead tr')
    .clone(true)
    .addClass('filters')
    .appendTo('#form_listado_garron thead');
  let datatable = $("#form_listado_garron").DataTable({
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function () {
        var api = this.api();
        api
            .columns()
            .eq(0)
            .each(function (colIdx) {
                var cell = $('.filters th').eq(
                    $(api.column(colIdx).header()).index()
                );
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                $(
                    'input',
                    $('.filters th').eq($(api.column(colIdx).header()).index())
                )
                    .off('keyup change')
                    .on('keyup change', function (e) {
                        e.stopPropagation();

  
                        $(this).attr('title', $(this).val());
                        var regexr = '({search})'; 

                        var cursorPosition = this.selectionStart;
                     
                        api
                            .column(colIdx)
                            .search(
                                this.value != ''
                                    ? regexr.replace('{search}', '(((' + this.value + ')))')
                                    : '',
                                this.value != '',
                                this.value == ''
                            )
                            .draw();

                        $(this)
                            .focus()[0]
                            .setSelectionRange(cursorPosition, cursorPosition);
                    });
            });
    },
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
      url: "../controlador/ListadoController.php",
      method: "POST",
      data: {funcion: funcion }
    },
    columns: [
      { data: "id_faenados" },
      { data: "fechafaena" },
      { data: "tropa" },
      { data: "garron" },
      { data: "peso" },
      { data: "especie" },
      { data: "productor" },
      { data: "matarife" },
      { data: "dte" },
     
      
      { data: "observacion_garron" },

      {
        defaultContent: `<button class="editar btn btn-warning" data-toggle="modal" data-target="#editargarron" type="button">Editar</button>
        <button id="hide" class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_observacion">Ver Observaciones</button>     
                                    `,
      },
    ],
    language: espanol,
  });
 
  $("#form_listado_garron tbody").on("click", ".editar", function () {
    let datos = datatable.row($(this).parents()).data();
    let id = datos.id_faenados;
    let tropas = datos.tropa;
    let especie = datos.especie;
    let productor = datos.productor;
    let matarife = datos.matarife;
    let dte = datos.dte;
    let garron = datos.garron;
    let peso = datos.peso;
    $("#numero_tropa_editar").val(tropas);
    $("#especie_tropa_editar").val(especie);
    $("#productor_tropa_editar").val(productor);
    $("#matarife_tropa_editar").val(matarife);
    $("#dte_tropa_editar").val(dte);
    $("#garron_id").val(garron);
    $("#peso_garron").val(peso);
    $("#id_editar").val(id);
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
    $("#peso_observacion").val(peso);
    verificar(id);

  
  });
  async function verificar(id){
    funcion="observacion_foto";
    let data=await fetch('../controlador/ListadoController.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&id='+id
    })
        if(data.ok){
        let response=await data.text();
        console.log(response);
          
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
})
}




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