$(document).ready(function(){
    var funcion;
    $('#gestion_camara1').addClass('active');
    var edit=false;
    $('.select2').select2();
    buscar_camara();

    $('#form-crear-Camara').submit(e=>{
        let id=$('#id_edit_prod').val();
        let camara = $('#Camara').val();  
        let nombre = $('#nombre_camara').val();
        let nombre1= camara+''+nombre;   
        if(edit==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
        $.post('../controlador/camaraController.php',{funcion,id,nombre1,nombre},(response)=>{
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-Camara').trigger('reset');
                buscar_camara();
               
            }
            if(response=='edit'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-camara').trigger('reset');
                buscar_camara();
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El nombre del camara ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-camara').trigger('reset');
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El camara no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-crear-camara').trigger('reset');
            }
            edit=false;
            
        });
        e.preventDefault();
    });
    function buscar_camara(consulta) {
        funcion="buscar";
        $.post('../controlador/camaraController.php',{consulta,funcion},(response)=>{
            const camaras = JSON.parse(response);
            let template='';
            camaras.forEach(camara => {
                template+=`
                <div prodId="${camara.id}" prodNombre="${camara.nombre}"prodAvatar="${camara.avatar}"prodNumero="${camara.numero}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light ">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${camara.nombre}</b></h2> 
                      <h4 class="lead  text-success"><b></b></h4>   
                      <ul class="ml-4 mb-0 fa-ul text-primary">
                      
                    </ul>                  
                    </div>
                    <div class="col-5 text-center">
                      <img src="${camara.avatar}" alt="" class="avatar_camara">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearcamara">
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
            $('#camaras').html(template);
        });
    }
    $(document).on('keyup','#buscar-camara',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_camara(valor);
        }
        else{
            buscar_camara();
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
            url:'../controlador/camaraController.php',
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
                buscar_camara();
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
        $('#nombre_camara').val(numero);
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
                $.post('../controlador/camaraController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_camara();
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
