$(document).ready(function(){
  $('#gestion_despiece1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
   
    buscar_datos();

  $('#form-editar-despecies').submit(e=>{
    let id=$('#id_despiece').val();
    let nombre = $('#nombre_despieceeditar').val();
    let codigo = $('#codigo_despiece').val();
    let despiece = $('#despecie').val();
    funcion="editar";
    
    $.post('../controlador/DespeciesController.php',{funcion,id,nombre,codigo,despiece},(response)=>{
        if(response=='add'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Editado',
                showConfirmButton: false,
                timer: 1500
              })
              $('#form-editar-despecies').trigger('reset');
              location.reload(true);
           
        }
        if(response=='edit'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Editado',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-crear-subespecies').trigger('reset');
        }
        if(response=='noadd'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'La Subespecie ya existe',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-crear-subespecies').trigger('reset');
        }
        if(response=='noedit'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'La Subespecie no se edito',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-crear-subespecies').trigger('reset');
        }
        edit=false;
    });
    e.preventDefault();
});

    function buscar_datos() {
      let funcion="buscardatos";  
      $.post('../controlador/DespeciesController.php',{funcion},(response)=>{ 
          let datatable = $('#tabla_listados').DataTable( {
            "ajax":{
                "url":"../controlador/DespeciesController.php",
                "method": "POST",
                "data":{funcion:funcion}
            },
            "columns": [
              { "data": "id" },
            { "data": "codigo" },
            { "data": "espeice" },
            { "data": "despiece" },

                        
                { "defaultContent": `<button class="editar btn btn-success" data-toggle="modal" data-target="#editar" type="button">EDITAR</button>
                                    `}
            ],
            "language": espanol
        }); 
        $('#tabla_listados tbody').on('click','.editar',function(){
          let datos = datatable.row($(this).parents()).data();
          let id = datos.idreal;
         let codigo=datos.codigo;
         let despiece=datos.despiece;
         let espeice=datos.espeice;
        $('#id_despiece').val(id);
         $('#nombre_despieceeditar').val(espeice);
         $('#codigo_despiece').val(codigo);
         $('#despecie').val(despiece);
        })   

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
