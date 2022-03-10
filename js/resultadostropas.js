$(document).ready(function(){
    let funcion="listar";  
          $.post('../controlador/TropasController.php',{funcion},(response)=>{  
             
              let datatable = $('#tabla_tropas').DataTable( {
                
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                  if ( aData['limite'] < 5 )
                  {
                      $('td', nRow).css('background-color', '#f55454');
                  }
                  else if ( aData['limite'] >= 11 )
                  {
                      $('td', nRow).css('background-color', '#4df030');
                  }
                  else if ( aData['limite'] <= 10 )
                  {
                      $('td', nRow).css('background-color', '#e0f030');
                  }
              },
                "ajax":{
                    "url":"../controlador/TropasController.php",
                    "method": "POST",
                    "data":{funcion:funcion}
                },
                "columns": [
                    { "data": "id_tropas" },
                    { "data": "matarife" },
                    { "data": "procedencia" },
                    { "data": "especies" },
                    { "data": "vigencia" }, 
                    { "data": "desde" },
                    { "data": "cantidad" },           
                    { "data": "hasta" }, 
                    { "data": "limite" },  
                            
                    { "defaultContent": `<button class="imprimir btn btn-warning" type="button"data-toggle="modal" data-target=""><i class="fas fa-print"></i></button>
                                       `}
                ],
                "language": espanol
            });

            $('#tabla_tropas tbody').on('click','.imprimir',function(){
                Mostrar_Loader('Generando_Pdf');
                let datos = datatable.row($(this).parents()).data();
                let id = datos.id_tropas;
                $.post('../controlador/PDFControllertropas.php',{id},(response)=>{
                    if(response==''){
                        cerrar_loader('exito_generar');
                window.open('../pdf/tropas/pdf-'+id+'.pdf','_blank');
                  $('#tabla_ficha').DataTable().ajax.reload(); 
                }else{
                    cerrar_loader('error_generar');  
                   }

              })    
                
        })
           
        })
    })
    function Mostrar_Loader(Mensaje){
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
            case 'Generando_Pdf':
                texto=' Generando PDF. Por favor espere...';
                mostrar=true;
                break;
        
        }
        if(mostrar){
            Swal.fire({
                title: 'Generando PDF',
                text: texto,
                showConfirmButton:false
              })
        }
    }
    function cerrar_loader(Mensaje){
        var tipo=null;
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
            case 'exito_generar':
                tipo='success';
                texto=' El PDF se genero correctamente...';
                mostrar=true;
                break;
                    case 'error_generar':
                        tipo='error';
                        texto=' El PDF no puede generarse... Por favor intente de nuevo';
                        mostrar=true;
                        break;
                        default:
                            swal.close();
                            break;
        
        }
        if(mostrar){
            Swal.fire({
                position:'center',
                icon:tipo,
                text: texto,
                showConfirmButton:false
              })
        }
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