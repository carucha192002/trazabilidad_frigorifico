$(document).ready(function(){
  $('#gestion_salidas1').addClass('active');
      let funcion="listar";
      let datatable = $('#tabla_venta').DataTable( {
          "ajax":{
              "url":"../controlador/SalidaController.php",
              "method": "POST",
              "data":{funcion:funcion}
          },
          "columns": [
              { "data": "id_venta" },
              { "data": "fecha" },
              { "data": "cliente" }, 
              { "data": "destino" },           
              { "data": "dni" },
              { "data": "total" },           
              { "data": "vendedor" },
              { "data": "estado" },
             
              { "defaultContent": `<button class="imprimir btn btn-secondary"><i class="fas fa-print"></i></button>
                                  <button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_venta"><i class="fas fa-search"></i></button>
                                  `}
          ],
          "language": espanol
      } );
      $('#tabla_venta tbody').on('click','.imprimir',function(){
        Mostrar_Loader('Generando_Pdf');
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        $.post('../controlador/PDFReporteController.php',{id},(response)=>{
          if(response==''){
            cerrar_loader('exito_generar');  
            window.open('../pdf/reportes/reportes.pdf','_blank');
           }else{
            cerrar_loader('error_generar');  
           }
          
        })      
        
    })


    
      $('#tabla_venta tbody').on('click','.borrar',function(){
          let datos = datatable.row($(this).parents()).data();
          let id = datos.id_venta;
          funcion="borrar_venta";
          const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1'
              },
              buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
              title: 'Estas seguro que deseas eliminar el pedido: '+id+'?',
              text: "No podras revertir esto!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Si, Borrar!',
              cancelButtonText: 'No, cancelar!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                  $.post('../controlador/DetalleReporteController.php',{funcion,id},(response)=>{

                      if(response=='delete'){
                        swalWithBootstrapButtons.fire(
                          'Borrado!',
                          'El pedido: '+id+' ha sido eliminado.',
                          'success'
                        )
                      }
                      else if(response=='nodelete'){
                        swalWithBootstrapButtons.fire(
                          'No tienes prioridad para eliminar este pedido',
                          'El pedido: '+id+' no se elimino',
                          'error'
                        )
                      }
                  })            
                
              } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                  'No Eliminado',
                  'El pedido: '+id+' no se elimino',
                  'error'
                )
              }
            })
      })    
      $('#tabla_venta tbody').on('click','.ver',function(){
          let datos = datatable.row($(this).parents()).data();
          let id = datos.id_venta;
          funcion="ver";
          $('#codigo_venta').html(datos.id_venta);
          $('#fecha').html(datos.fecha);
          $('#cliente').html(datos.cliente);       
          $('#dni').html(datos.dni);
          $('#vendedor').html(datos.vendedor);
          $('#estado').html(datos.estado);
          $('#total').html(datos.total);
          $.post('../controlador/VentaProductoController.php',{funcion,id},(response)=>{
              let registros = JSON.parse(response);
              let template="";
              $('#registros').html(template);
              registros.forEach(registro => {
                  template+=`
                      <tr>
                          <td>${registro.det_cantidad}</td>                        
                          <td>${registro.especie}</td>
                          <td>${registro.despiece}</td>
                          <td>${registro.garron}</td>
                          <td>${registro.tropa}</td>
                          <td>${registro.camara}</td>
                          <td>${registro.det_vencimiento}</td>
                          <td>${registro.det_cantidad}</td>
                          <td style="visibility: hidden">${registro.precio}</td>
  
                      </tr>
                  `;
                  $('#registros').html(template);                
              });
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