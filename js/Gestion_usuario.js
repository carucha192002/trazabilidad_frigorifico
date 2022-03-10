$(document).ready(function(){
    $('#gestion_usuario2').addClass('active');
    rellenar_rol();
    rellenar_rol1();
    var tipo_usuario = $('#tipo_usuario').val();
    $('#guardar').hide();
    $('#guardarascender').hide();
    if(tipo_usuario==2){
        $('#button-crear').hide();
    }
    buscar_datos();
    var funcion;
    function rellenar_rol() {
        funcion="rellenar_rol";
        $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
            const calidades = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Rol</option>`;
            calidades.forEach(calidad => {
                template+=`

                    <option value="${calidad.id}">${calidad.nombre}</option>
                `;
            });
            $('#rol').html(template);
        })
        $("#rol").change(function(){  
            $("#rol option:selected").each(function (){
                numerorol = $(this).val();
                
                
                     if(numerorol==0){
                        $('#guardar').hide();
                     }else{
                        $('#guardar').show();
                        let id=numerorol;
                funcion="rellenar_rol_modal";
                 $.post('../controlador/UsuarioController.php',{funcion,id},(response)=>{
                    
                     let rol='';
                     let nombre='';
                     const datos = JSON.parse(response);
                     rol+=`${datos.id}`;
                     nombre+=`${datos.nombre}`;
                     $('#rolmodal').val(rol);
                     $('#rolmodalnombre').val(nombre);
                 })
                     }

            
        })                
                }) 
    }
    function rellenar_rol1() {
        funcion="rellenar_rol1";
        $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
        
            const calidades = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Rol</option>`;
            calidades.forEach(calidad => {
                template+=`
                    <option value="${calidad.id}">${calidad.nombre}</option>
                `;
            });
            $('#categoria1').html(template);
        })
        $("#categoria1").change(function(){  
            $("#categoria1 option:selected").each(function (){
                numerorol = $(this).val();
                
                     if(numerorol==0){
                        $('#guardarascender').hide();
                     }else{
                        $('#guardarascender').show();
                        let id=numerorol;
                funcion="rellenar_rol_modal";
                 $.post('../controlador/UsuarioController.php',{funcion,id},(response)=>{
                    
                     let rol='';
                     let nombre='';
                     const datos = JSON.parse(response);
                     rol+=`${datos.id}`;
                     nombre+=`${datos.nombre}`;
                     $('#categoriamodal').val(rol);
                     $('#categoriamodalnombre').val(nombre);
                 })
                     }

            
        })                
                }) 
    }
    function buscar_datos(consulta) {
        funcion='buscar_usuarios_adm';
        $.post('../controlador/UsuarioController.php',{consulta,funcion},(response)=>{
           
            const usuarios = JSON.parse(response);
            let template='';
            usuarios.forEach(usuario=> {
                template+=`
                <div usuarioId="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">`;
                if(usuario.tipo_usuario==3){
                    template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
                }
                if(usuario.tipo_usuario==1){
                    template+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
                }
                if(usuario.tipo_usuario==2){
                     template+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
                } 
                if(usuario.tipo_usuario==4){
                    template+=`<h1 class="badge badge-success">${usuario.tipo}</h1>`;
               }   
               if(usuario.tipo_usuario==5){
                template+=`<h1 class="badge badge-success">${usuario.tipo}</h1>`;
           }              
                template+=`</div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b> ${usuario.adicional} </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> DNI: ${usuario.dni}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Direccion: ${usuario.domicilio}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono: ${usuario.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email: ${usuario.email}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Sexo: ${usuario.sexo}</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.avatar}" alt="" class="avatar_js">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">`;
                if(tipo_usuario==3){
                    if(usuario.tipo_usuario!=3){
                        template+=`
                        <button class="borrar-usuario btn btn-danger mr-1 type="button" data-toggle="modal" data-target="#confirmar"">
                        <i class="fas fa-window-close mr-1"></i>Eliminar
                        </button>
                        `;
                    }
                    if(usuario.tipo_usuario==2){
                        template+=`
                        <button class="descender btn btn-secondary ml-2" type="button" data-toggle="modal" data-target="#confirmar">
                        <i class="fas fa-sort-amount-down mr-1"></i>Descender
                        </button>
                        <button class="ascender btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#confirmar">
                        <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                        </button>
                        `;
                    }
                    if(usuario.tipo_usuario==5){
                        template+=`
                        <button class="descender btn btn-secondary ml-2" type="button" data-toggle="modal" data-target="#confirmar">
                        <i class="fas fa-sort-amount-down mr-1"></i>Descender
                        </button>
                        <button class="ascender btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#confirmar">
                        <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                        </button>
                        `;
                    }
                    if(usuario.tipo_usuario==1){
                        template+=`
                        <button class="descender btn btn-secondary ml-2" type="button" data-toggle="modal" data-target="#confirmar">
                        <i class="fas fa-sort-amount-down mr-1"></i>Descender
                        </button>
                        `;
                    }
                    if(usuario.tipo_usuario==4){
                        template+=`
                       
                        `;
                    }
                }
                else{
                    if(tipo_usuario==1 && usuario.tipo_usuario!=1 && usuario.tipo_usuario!=4){
                        template+=`
                        <button class="borrar-usuario btn btn-danger type="button" data-toggle="modal" data-target="#confirmar"">
                        <i class="fas fa-window-close mr-1"></i>Eliminar
                        </button>
                        `;
                    }
                }
            template+=`
                  </div>
                </div>
              </div>
            </div>
                `;                
            })
            $('#usuarios').html(template);
        });        
    }
    $(document).on('keyup','#buscar',function(){
        let valor = $(this).val();
        if(valor!=""){
            buscar_datos(valor);
        }
        else{
            buscar_datos();
        }
    });
    $('#form-crear').submit(e=>{
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let edad = $('#edad').val();
        let dni = $('#dni').val();
        let pass = $('#pass').val();
        let rol = $('#rolmodal').val();
        let rolnombre = $('#rolmodalnombre').val();
        funcion='crear_usuario';
        
        $.post('../controlador/UsuarioController.php',{nombre,apellido,edad,dni,pass,rol,rolnombre,funcion},(response)=>{
            if(response.trim()=='add'){
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear').trigger('reset');
                buscar_datos();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
            else{
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear').trigger('reset');
            }
        });
        e.preventDefault();    
    });
    $(document).on('click','.ascender',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('usuarioId');
        funcion='ascender';
        $('#id_user').val(id);
        $('#categoriamodal').val();
        $('#categoriamodalnombre').val();
        $('#funcion').val(funcion);

        
    });
    $(document).on('click','.descender',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('usuarioId');
        funcion='descender';
        $('#id_user').val(id);
        $('#categoriamodal').val();
        $('#categoriamodalnombre').val();
        $('#funcion').val(funcion);
    });
    $(document).on('click','.borrar-usuario',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('usuarioId');
        funcion='borrar-usuario';
        $('#id_user').val(id);
        $('#funcion').val(funcion);
    });
    $('#form-confirmar').submit(e=>{
        let pass=$('#oldpass').val();
        let id_usuario=$('#id_user').val();
        let rol= $('#categoriamodal').val();
        let rolnombre=  $('#categoriamodalnombre').val();
        funcion=$('#funcion').val();

        $.post('../controlador/UsuarioController.php',{pass,id_usuario,rol,rolnombre,funcion},(response)=>{
          
            if(response.trim()=='ascendido'||response.trim()=='descendido'||response.trim()=='borrado'){
                $('#confirmado').hide('slow');
                $('#confirmado').show(1000);
                $('#confirmado').hide(2000);
                $('#form-confirmar').trigger('reset');
            }
            else{
                $('#rechazado').hide('slow');
                $('#rechazado').show(1000);
                $('#rechazado').hide(2000);
                $('#form-confirmar').trigger('reset');

            }
            buscar_datos();
        });
        e.preventDefault(); 
        
    });
})