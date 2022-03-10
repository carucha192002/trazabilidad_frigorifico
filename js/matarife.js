$(document).ready(function(){
  $('#gestion_matarife1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_matarife();

    $(document).on('click','#guardar_crear_matarife',(e)=>{
        let id=$('#id_edit_prod').val();
        let nombre = $('#nombre_matarife').val();  
        let cuit = $('#cuit_matarife').val(); 
        let establecimiento = $('#establecimiento_matarife').val(); 
        let email = $('#email_matarife').val(); 
        let ultimo=$('#id_matarife').val();
        if(edit==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
  
        $.post('../controlador/MatarifeController.php',{funcion,id,nombre,cuit,establecimiento,email,ultimo},(response)=>{          
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-matarife').trigger('reset');
                buscar_matarife();
            }
            if(response=='edit'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-matarife').trigger('reset');
                buscar_matarife();
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El nombre del matarife ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-matarife').trigger('reset');
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El matarife no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-matarife').trigger('reset');
            }
            edit=false;
        });
        e.preventDefault();
    });

    
    function buscar_matarife(consulta) {
        funcion="buscar";
        $.post('../controlador/MatarifeController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"prodCantidad="${producto.cantidad}"prodAvatar="${producto.avatar}"prodCuit="${producto.cuit}"prodEstablecimiento="${producto.establecimiento}"prodEmail="${producto.email}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                <h2 class="lead"><b>CANTIDAD SUB-ITEM:(${producto.cantidad})</b></h2> 
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre}</b></h2> 
                      <h4 class="lead  text-success"><b></b></h4>   
                      <ul class="ml-4 mb-0 fa-ul text-primary">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> CUIT: ${producto.cuit}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> ESTABLECIMIENTO: ${producto.establecimiento}</li>
                    </ul>                  
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="avatar_matarife">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                 
                  <button class="agregar btn btn-sm btn-danger type="button" data-toggle="modal" data-target="#agregaritem">AGREGAR SUB-ITEM</button>
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearmatarife">
                      <i class="fas fa-pencil-alt"></i> 
                    </button>
                    <button class="borrar btn btn-sm btn-danger">
                      <i class="fas fa-trash-alt"></i> 
                    </button>
                  </div>
                </div>
              </div>
            </div>
                `;
            });
            $('#matarife').html(template);
        });
    }
    $(document).on('keyup','#buscar-matarife',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_matarife(valor);
        }
        else{
            buscar_matarife();
        }
    });
    $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const avatar=$(elemento).attr('prodAvatar');
        const nombre=$(elemento).attr('prodNombre');
        $('#funcion').val(funcion);
        $('#id_logo_prod').val(id);
        $('#avatar').val(avatar);
        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
    });
    $(document).on('click','#button-crear',(e)=>{
      funcion="ultimo_matarife";
      $.post('../controlador/MatarifeController.php',{funcion},(response)=>{
        let ultimo='';
        const ultimos = JSON.parse(response);
        ultimo+=`${ultimos.ultimo}`;
        $('#id_matarife').val(ultimo);
      })
            
     
  });
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/MatarifeController.php',
            type:'POST',
            data:formData,
            cache:false,
            processData: false,
            contentType:false
        }).done(function(response){
            const json = JSON.parse(response);
            if(json.alert=='edit'){
                $('#logoactual').attr('src',json.ruta);
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-logo').trigger('reset');
                buscar_matarife();
            }
            else{
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
                $('#form-logo').trigger('reset');
            }
        });
        e.preventDefault();
    });
    $(document).on('click','.editar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre=$(elemento).attr('prodNombre');  
        const cuit=$(elemento).attr('prodCuit');  
        const establecimiento=$(elemento).attr('prodEstablecimiento');   
        const email=$(elemento).attr('prodEmail');       
        $('#id_edit_prod').val(id);
        $('#nombre_matarife').val(nombre);
        $('#cuit_matarife').val(cuit);
        $('#establecimiento_matarife').val(establecimiento);
        $('#email_matarife').val(email);
        edit=true;     
    });
    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodnombre');
        const avatar = $(elemento).attr('prodAvatar');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea Eliminar '+nombre+'?',
            text: "No podras volver atras!",
            imageUrl:''+avatar+'', 
            imageWidth:100,
            imageHeight:100,           
            showCancelButton: true,
            confirmButtonText: 'Si, Borrar!',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.post('../controlador/MatarifeController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El matarife '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_matarife();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El matarife '+nombre+' no fue borrado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El matarife '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
    $(document).on('click','.agregar',(e)=>{
      funcion="agregar_item";
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('prodId');
      $('#id_matarife_agregar').val(funcion);
      $('#id_edit_prod_agregar').val(id);
  });
  $('#form-agregar-matarife').submit(e=>{
    let id=$('#id_edit_prod_agregar').val();
    let nombre = $('#nombre_matarife_agregar').val();  
    let cuit = $('#cuit_matarife_agregar').val(); 
    let identificador = $('#identificador_matarife').val(); 
    funcion="crear_subitem";
    $.post('../controlador/MatarifeController.php',{funcion,id,nombre,cuit,identificador},(response)=>{
        if(response=='add'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Guardado',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-agregar-matarife').trigger('reset');
            buscar_matarife();
        }
        if(response=='edit'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Editado',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-agregar-matarife').trigger('reset');
            buscar_matarife();
        }
        if(response=='noadd'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'El nombre del matarife ya existe',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-agregar-matarife').trigger('reset');
        }
        if(response=='noedit'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'El matarife no se edito',
                showConfirmButton: false,
                timer: 1500
              })
            $('#form-agregar-matarife').trigger('reset');
        }
        edit=false;
    });
    e.preventDefault();
});


funcion="cantidad_item";  
$.post('../controlador/MatarifeController.php',{funcion},(response)=>{ 
    let datatable = $('#tabla_subitem').DataTable( { 
      "order": [[ 1, "desc" ]],

      "ajax":{
          "url":"../controlador/MatarifeController.php",
          "method": "POST",
          "data":{funcion:funcion}
      },
      
      "columns": [
        
      { "data": "id_submatarife" },
      { "data": "matarife" },
      { "data": "nombre" },
      { "data": "cuit" },
      { "data": "identificador" },
                  
          { "defaultContent": `<button class="editaritem btn btn-secondary" type="button"data-toggle="modal" data-target="#editaritem"><i class="fas fa-pencil-alt"></i></button>
                             
                              <button class="borraritem btn btn-danger" type="button"data-toggle="modal" data-target="#vista_legajo"><i class="fas fa-trash"></i></button>
                             
                              `}
      ],
      "language": espanol
  });
  $('#tabla_subitem tbody').on('click','.borraritem',function(){
    let datos = datatable.row($(this).parents()).data();
    let id = datos.id_submatarife;
    let nombre = datos.nombre;
    let identificador=datos.id_datos;
const swalWithBootstrapButtons = Swal.mixin({
customClass: {
  confirmButton: 'btn btn-success m-1',
  cancelButton: 'btn btn-danger m-1'
},
buttonsStyling: false
})

swalWithBootstrapButtons.fire({
title: 'Estas seguro que deseas eliminar el Subitem: '+nombre+'?',
text: "No podras revertir esto!",
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Si, Borrar!',
cancelButtonText: 'No, cancelar!',
reverseButtons: true
}).then((result) => {
if (result.value) {
  funcion="borraritem";
  let prioridad=$('#prioridad').val();
  if(prioridad==3){
    $.post('../controlador/MatarifeController.php',{funcion,id,identificador},(response)=>{
    
        if(response=='borrado'){
          $('#tabla_ingresos').DataTable().ajax.reload(); 
          swalWithBootstrapButtons.fire(
            'Borrado!',
            'El Registro: '+nombre+' ha sido eliminado.',
            'success'
          )
         
        }
    
       
    })            
}else{
    swalWithBootstrapButtons.fire(
        'No tienes prioridad para eliminar este Registrado ',
        'El Registro: '+nombre+' no se elimino',
        'error'
      )
}
}  else if(response=='no borrado'){
    swalWithBootstrapButtons.fire(
      'No tienes prioridad para eliminar este Regstro ',
      'El Registro: '+id+' no se elimino',
      'error'
    )
  }
})  

})
$('#tabla_subitem tbody').on('click','.editaritem',function(){
  let datos = datatable.row($(this).parents()).data();
  let id = datos.id_submatarife;
  let nombre=datos.nombre;
  let cuit=datos.cuit;
  let identificador=datos.identificador;
  $('#nombre_matarife_editar').val(nombre);
  $('#cuit_matarife_editar').val(cuit);
  $('#identificador_editar').val(identificador);
  $('#id_matarife_editar').val(id); 
}) 
$('#form-editar-matarife').submit(e=>{
  let id=$('#id_matarife_editar').val();
  let nombre = $('#nombre_matarife_editar').val();  
  let cuit = $('#cuit_matarife_editar').val(); 
  let identificador = $('#identificador_editar').val(); 
  funcion="editar_subitem";
  $.post('../controlador/MatarifeController.php',{funcion,id,nombre,cuit,identificador},(response)=>{
      if(response=='add'){
          Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Editado',
              showConfirmButton: false,
              timer: 1500
            })
          $('#form-editar-matarife').trigger('reset');
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
          $('#form-editar-matarife').trigger('reset');
          buscar_matarife();
      }
      if(response=='noadd'){
          Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'El nombre del matarife ya existe',
              showConfirmButton: false,
              timer: 1500
            })
          $('#form-editar-matarife').trigger('reset');
      }
      if(response=='noedit'){
          Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'El matarife no se edito',
              showConfirmButton: false,
              timer: 1500
            })
          $('#form-agregar-matarife').trigger('reset');
      }
      edit=false;
  });
  e.preventDefault();
});
})
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
