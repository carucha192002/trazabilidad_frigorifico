$(document).ready(function(){
  $('#gestion_especies1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_especies();
    buscar_datos();
 
    $(document).on('click','#guardar_crear_especies',(e)=>{
        let nombre = $('#nombre_especies').val();
        funcion="crear";
        $.post('../controlador/EspeciesController.php',{funcion,nombre},(response)=>{
    
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-especies').trigger('reset');
                buscar_especies();
            }
    
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'La especies ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-especies').trigger('reset');
            }
        });
        e.preventDefault();
    });
    $('#form-crear-subespecies').submit(e=>{
      let id=$('#id_especies').val();
      let nombre = $('#nombre_subespeciescrear').val();
      let codigo = $('#codigo_especies').val();
      let diente = $('#diente_especies').val();
      
      funcion="crearsubcategoria";
      $.post('../controlador/EspeciesController.php',{funcion,id,nombre,codigo,diente},(response)=>{
      
          if(response=='add'){
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Guardado',
                  showConfirmButton: false,
                  timer: 1500
                })
                $('#form-crear-subespecies').trigger('reset');
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
  $('#form-editar-subespecies').submit(e=>{
    let id=$('#id_especieseditar').val();
    let nombre = $('#nombre_subespecieseditar').val();
    let codigo = $('#codigo_especieseditar').val();
    let diente = $('#diente_especieseditar').val();
    funcion="editarsubcategoria";
    
    $.post('../controlador/EspeciesController.php',{funcion,id,nombre,codigo,diente},(response)=>{
        if(response=='add'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Editado',
                showConfirmButton: false,
                timer: 1500
              })
              $('#form-editar-subespecies').trigger('reset');
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
    function buscar_especies(consulta) {
        funcion="buscar";
        $.post('../controlador/EspeciesController.php',{consulta,funcion},(response)=>{
         
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre}</b></h2> 
                      <h4 class="lead  text-success"><b></b></h4>                 
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="avatar_especies">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                      </button>
                    <button class="ver btn btn-sm btn-success type="button" data-toggle="modal" data-target="#verespecies">
                    <i class="fas fa-search"></i> 
                    </button>
                    <button class="subespecie btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#agregarsubespecies">
                  AGREGAR SUBESPECIES
                </button>
                  </div>
                </div>
              </div>
            </div>
                `;
            });
            $('#especies').html(template);
        });
    }
    $(document).on('keyup','#buscar-especies',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_especies(valor);
        }
        else{
            buscar_especies();
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
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/EspeciesController.php',
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
                buscar_especies();
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
        $('#id_edit_prod').val(id);
        $('#nombre_especies').val(nombre);
        edit=true;     
    });
    $(document).on('click','.subespecie',(e)=>{
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('prodId');
      const nombre=$(elemento).attr('prodNombre');        
      $('#id_especies').val(id);
      $('#nombre_subespecies1').html('NOMBRE DE LA ESPECIE:'+''+nombre);
        
  });
  $(document).on('click','.ver',(e)=>{
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');
    const nombre=$(elemento).attr('prodNombre');
   
      funcion="codigos";
      $.post('../controlador/EspeciesController.php',{funcion,id},(response)=>{
          const codigos = JSON.parse(response);
          let template='';
          codigos.forEach(codigoanimal => {
              template+=`
                  <tr clasCodigo="${codigoanimal.codigo}"clasDiente="${codigoanimal.diente}"clasCategoria="${codigoanimal.categoria}">                                              
                      <td> 
                      ${codigoanimal.codigo}                          
                      </td>
                      <td>${codigoanimal.diente}</td>
                      <td>${codigoanimal.categoria}</td>
                  </tr>
              `;
      });
      $('#codigos').html(template);
      $('#titulo').html('CODIGOS DE ANIMALES ESPECIE:'+' '+nombre);
  })

  
  })
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
                $.post('../controlador/EspeciesController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La especies '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_especies();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'La especies '+nombre+' no fue borrado porque esta siendo usado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'La especies '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
    function buscar_datos() {
      let funcion="buscardatos";  
      $.post('../controlador/EspeciesController.php',{funcion},(response)=>{ 
          let datatable = $('#tabla_listados').DataTable( {
            "ajax":{
                "url":"../controlador/EspeciesController.php",
                "method": "POST",
                "data":{funcion:funcion}
            },
            "columns": [
              { "data": "id" },
            { "data": "codigo" },
            { "data": "diente" },
            { "data": "categoria" },
            { "data": "especies" },

                        
                { "defaultContent": `<button class="editar btn btn-success" data-toggle="modal" data-target="#editarsubespecies" type="button">EDITAR</button>
                                    `}
            ],
            "language": espanol
        }); 
        $('#tabla_listados tbody').on('click','.editar',function(){
          let datos = datatable.row($(this).parents()).data();
          let id = datos.idreal;
         let codigo=datos.codigo;
         let diente=datos.diente;
         let categoria=datos.categoria;
        $('#id_especieseditar').val(id);
         $('#nombre_subespecieseditar').val(categoria);
         $('#codigo_especieseditar').val(codigo);
         $('#diente_especieseditar').val(diente);
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
