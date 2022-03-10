$(document).ready(function(){
  $('#gestion_corral1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_corral();

    $('#form-crear-corral').submit(e=>{
        let id=$('#id_edit_prod').val();
        let corral = $('#corral').val();  
        let nombre = $('#nombre_corral').val();
        let nombre1= corral+''+nombre;   
        if(edit==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
        $.post('../controlador/CorralController.php',{funcion,id,nombre1,nombre},(response)=>{
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-corral').trigger('reset');
                buscar_corral();
            }
            if(response=='edit'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-corral').trigger('reset');
                buscar_corral();
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El nombre del corral ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-corral').trigger('reset');
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El corral no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-corral').trigger('reset');
            }
            edit=false;
        });
        e.preventDefault();
    });
    function buscar_corral(consulta) {
        funcion="buscar";
        $.post('../controlador/CorralController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"prodAvatar="${producto.avatar}"prodNumero="${producto.numero}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
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
                      <img src="${producto.avatar}" alt="" class="avatar_corral">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearcorral">
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
            $('#corrales').html(template);
        });
    }
    $(document).on('keyup','#buscar-corral',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_corral(valor);
        }
        else{
            buscar_corral();
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
            url:'../controlador/CorralController.php',
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
                buscar_corral();
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
        const numero=$(elemento).attr('prodNumero');         
        $('#id_edit_prod').val(id);
        $('#nombre_corral').val(numero);
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
                $.post('../controlador/CorralController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_corral();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El '+nombre+' no fue borrado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                ' El '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
 
})
