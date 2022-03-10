$(document).ready(function(){
  $('#gestion_destino1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_destino();

    $('#form-crear-destino').submit(e=>{
        let id=$('#id_edit_prod').val();
        let nombre = $('#nombre_destino').val();  
        let codigo = $('#codigo_destino').val(); 
        if(edit==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
        $.post('../controlador/DestinoController.php',{funcion,id,nombre,codigo},(response)=>{
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-destino').trigger('reset');
                buscar_destino();
            }
            if(response=='edit'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-destino').trigger('reset');
                buscar_destino();
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El nombre del destino ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-destino').trigger('reset');
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El destino no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-destino').trigger('reset');
            }
            edit=false;
        });
        e.preventDefault();
    });
    function buscar_destino(consulta) {
        funcion="buscar";
        $.post('../controlador/DestinoController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"prodCodigo="${producto.codigo}"prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1"></i>Codigo:${producto.codigo}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre}</b></h2> 
                      <h4 class="lead  text-success"><b></b></h4>   
                      <ul class="ml-4 mb-0 fa-ul text-primary">
                      
                    </ul>                  
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="avatar_destino">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#creardestino">
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
            $('#destino').html(template);
        });
    }
    $(document).on('keyup','#buscar-destino',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_destino(valor);
        }
        else{
            buscar_destino();
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
            url:'../controlador/DestinoController.php',
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
                buscar_destino();
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
        const codigo=$(elemento).attr('prodCodigo');       
        $('#id_edit_prod').val(id);
        $('#nombre_destino').val(nombre);
        $('#codigo_destino').val(codigo);
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
                $.post('../controlador/DestinoController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El destino '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_destino();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El destino '+nombre+' no fue borrado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El destino '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
  })

 

