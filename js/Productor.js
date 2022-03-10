$(document).ready(function(){
  $('#gestion_productor1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_productor();

    $('#form-crear-productor').submit(e=>{
        let id=$('#id_edit_prod').val();
        let nombre = $('#nombre_productor').val();
        let cuit = $('#cuit_productor').val();
        let establecimiento = $('#establecimiento_productor').val();
       
        if(edit==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
        $.post('../controlador/ProductorController.php',{funcion,id,nombre,cuit,establecimiento},(response)=>{
            
          if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-productor').trigger('reset');
                buscar_productor();
            }
            if(response=='edit'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-productor').trigger('reset');
                buscar_productor();
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'La productor ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-productor').trigger('reset');
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'La productor no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-productor').trigger('reset');
            }
            edit=false;
        });
        e.preventDefault();
    });
    function buscar_productor(consulta) {
        funcion="buscar";
        $.post('../controlador/ProductorController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"prodAvatar="${producto.avatar}"prodCuit="${producto.cuit}"prodEstablecimiento="${producto.establecimiento}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
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
                      <img src="${producto.avatar}" alt="" class="avatar_productor">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearproductor">
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
            $('#productores').html(template);
        });
    }
    $(document).on('keyup','#buscar-productor',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_productor(valor);
        }
        else{
            buscar_productor();
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
            url:'../controlador/ProductorController.php',
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
                buscar_productor();
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
        const cuit=$(elemento).attr('prodcuit'); 
        const establecimiento=$(elemento).attr('prodEstablecimiento');       
        $('#id_edit_prod').val(id);
        $('#nombre_productor').val(nombre);
        $('#cuit_productor').val(cuit);
        $('#establecimiento_productor').val(establecimiento);
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
                $.post('../controlador/ProductorController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La productor '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_productor();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'La productor '+nombre+' no fue borrado porque esta siendo usado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'La productor '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
 
})
