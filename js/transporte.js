$(document).ready(function(){
  $('#gestion_transporte1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_transporte();

    $('#form-crear-transporte').submit(e=>{
        let id=$('#id_edit_prod').val();
        let nombre = $('#nombre_transporte').val();
        let habilitacion = $('#habilitacion_transporte').val();
        if(edit==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
        $.post('../controlador/TransporteController.php',{funcion,id,nombre,habilitacion},(response)=>{
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-transporte').trigger('reset');
                buscar_transporte();
            }
            if(response=='edit'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-transporte').trigger('reset');
                buscar_transporte();
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El nombre del transporte ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-transporte').trigger('reset');
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El transporte no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-transporte').trigger('reset');
            }
            edit=false;
        });
        e.preventDefault();
    });
    function buscar_transporte(consulta) {
        funcion="buscar";
        $.post('../controlador/TransporteController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"prodHabilitacion="${producto.habilitacion}"prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead">Nombre: <br> <b>${producto.nombre}</b></h2> 
                      <h2 class="lead">Habilitacion: <br> <b>${producto.habilitacion}</b></h2> 
                      <h4 class="lead  text-success"><b></b></h4>   
                      <ul class="ml-4 mb-0 fa-ul text-primary">
                    
                    </ul>                  
                    </div>
                    <div class="text-center">
                      <img src="${producto.avatar}" alt="" class="avatar_transporte">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#creartransporte">
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
            $('#transporte').html(template);
        });
    }
    $(document).on('keyup','#buscar-transporte',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_transporte(valor);
        }
        else{
            buscar_transporte();
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
            url:'../controlador/TransporteController.php',
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
                buscar_transporte();
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
        const habilitacion=$(elemento).attr('prodHabilitacion');        
        $('#id_edit_prod').val(id);
        $('#nombre_transporte').val(nombre);
        $('#cuit_transporte').val(cuit);
        $('#establecimiento_transporte').val(establecimiento);
        $('#habilitacion_transporte').val(habilitacion);
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
                $.post('../controlador/TransporteController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El transporte '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_transporte();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El transporte '+nombre+' no fue borrado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El transporte '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
 
})
