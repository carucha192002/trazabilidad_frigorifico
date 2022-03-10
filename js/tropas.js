$(document).ready(function(){
    $('#gestion_tropas1').addClass('active');
    var funcion;
    var edit=false;
    $('.select2').select2();
    buscar_tropas();
    rellenar_matarifes();
    rellenar_procedencia();
    rellenar_especies();
    rellenar_desdetropas();
    $('#guardarhasta').hide();
    function rellenar_desdetropas() {
        funcion="rellenar_desdetropas";
        $.post('../controlador/TropasController.php',{funcion},(response)=>{
            let desde='';
            const empieza = JSON.parse(response);
            desde+=`${empieza.id}`;
            if(desde=='null'){
                $('#desde_tropas').val(1);
            }else{
                $('#desde_tropas').val(parseFloat(desde)+parseFloat(1));
            }
        })
       
    }
    function rellenar_especies() {
        funcion="rellenar_especies";
        $.post('../controlador/EspeciesController.php',{funcion},(response)=>{
            const especies = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Especie</option>`;
            especies.forEach(especie => {

                template+=`
                    <option value="${especie.id}">${especie.nombre}</option>
                `;
            });
            $('#especie_tropas').html(template);
        })
       
    }
    function rellenar_procedencia() {
        funcion="rellenar_procedencia";
        $.post('../controlador/ProcedenciaController.php',{funcion},(response)=>{
            const procedencias = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Procedencia</option>`;
            procedencias.forEach(procedencia => {

                template+=`
                    <option value="${procedencia.id}">${procedencia.nombre}</option>
                `;
            });
            $('#procedencia_tropas').html(template);
        })
       
    }
  
    function rellenar_matarifes() {
        funcion="matarife_rellenar";
        $.post('../controlador/MatarifeController.php',{funcion},(response)=>{
            const matarifes = JSON.parse(response);
            let template='';
            
            template+=`
            <option value="0"> Seleccione Usuario</option>`;
            matarifes.forEach(matarife => {
                template+=`
                
                    <option value="${matarife.id}">${matarife.nombre}</option>
                `;
            });
            $('#usuario_tropas').html(template);
            
        })
        $("#usuario_tropas").change(function(){  
            $("#usuario_tropas option:selected").each(function (){
            numeromatarife = $(this).val();
            let id=numeromatarife;
            funcion="matarifecuit_rellenar";
             $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
                 let cuit='';
                 const numerocuit = JSON.parse(response);
                 cuit+=`${numerocuit.cuit}`;
                 $('#usuario_tropas1').html('USUARIO CUIT Nº'+' '+cuit);
        })
                             
            })  
         }) 
    }
 
    $('#form-crear-tropas').submit(e=>{
        let id=$('#id_edit_prod').val();
        let matarife = $('#usuario_tropas').val();
        let procedencia = $('#procedencia_tropas').val();
        let especie = $('#especie_tropas').val();
        let vigencia = $('#vigencia_tropas').val();
        let cantidad = $('#asignacion_tropas').val();
        let desde = $('#desde_tropas').val();
        let hasta = $('#hasta_tropas').val();
        let ano = $('#ano').val();
        funcion="verificar_datos_minimo";
        $.post('../controlador/TropasController.php',{funcion,id,matarife,procedencia,especie,vigencia,cantidad,desde,hasta,ano},(response)=>{
            if(response=="no"){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'No se puede asignar ese rango... Ya lo esta ocupando otro Productor',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                if(edit==true){
                    funcion="editar";
                }
                else{
                    funcion="crear";
                }
                $.post('../controlador/TropasController.php',{funcion,id,matarife,procedencia,especie,vigencia,cantidad,desde,hasta,ano},(response)=>{
                    if(response=='add'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Guardado',
                            showConfirmButton: false,
                            timer: 1500
                          })
                        $('#form-crear-tropas').trigger('reset');
        
                        buscar_tropas();
                        rellenar_desdetropas();
                        setTimeout('document.location.reload()',2000);
                    }
                    if(response=='edit'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Editado',
                            showConfirmButton: false,
                            timer: 1500
                          })
                        $('#form-crear-tropas').trigger('reset');
                        buscar_tropas();
                        
                    }
                    if(response=='noadd'){
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El nombre del tropas ya existe',
                            showConfirmButton: false,
                            timer: 1500
                          })
                        $('#form-crear-tropas').trigger('reset');
                        rellenar_desdetropas();
                    }
                    if(response=='noedit'){
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El tropas no se edito',
                            showConfirmButton: false,
                            timer: 1500
                          })
                        $('#form-crear-tropas').trigger('reset');
                    }
                    edit=false;
                });
            }
        })

     
        e.preventDefault();
    });
    function buscar_tropas(consulta) {
        funcion="buscar";
        $.post('../controlador/TropasController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}"prodMatarife="${producto.matarife}"prodProcedencia="${producto.procedencia}"prodEspecie="${producto.especiesanimal}"prodVigencia="${producto.vigencia}"prodDesde="${producto.desde}"prodCantidad="${producto.cantidad}"prodHasta="${producto.hasta}"prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 style="text-transform:uppercase" class="lead"><b>${producto.matarife}</b></h2>
                      <h4 class="lead  text-success"><b></b></h4>   
                      <ul class="ml-4 mb-0 fa-ul text-primary">
                      <li style="text-transform:uppercase" class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span > PROCEDENCIA: ${producto.procedencia}</li>
                      <li style="text-transform:uppercase" class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> ESPECIES: ${producto.especiesanimal}</li>
                      <li  style="text-transform:uppercase" class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> VIGENCIA: ${producto.vigencia}</li>
                      <li style="text-transform:uppercase" class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> DESDE: ${producto.desde}</li>
                      <li style="text-transform:uppercase" class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> CANTIDAD: ${producto.cantidad}</li>
                      <li style="text-transform:uppercase" class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> HASTA: ${producto.hasta}</li>
                    </ul>                  
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="avatar_tropas">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  <button class="comenzar btn btn-sm  btn-info" type="button" data-toggle="modal" data-target="#comenzar">COMENZAR EN:
                  
                </button>
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#creartropas">
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
            $('#tropasbuscar').html(template);
        });
    }
    $(document).on('keyup','#buscar-tropas',function(){
        let valor = $(this).val();
        if(valor.trim()!=""){
            buscar_tropas(valor);
        }
        else{
            buscar_tropas();
        }
    });
    $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const avatar=$(elemento).attr('prodAvatar');
        const nombre=$(elemento).attr('prodMatarife');
        $('#funcion').val(funcion);
        $('#id_logo_prod').val(id);
        $('#avatar').val(avatar);
        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
    });
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/TropasController.php',
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
                buscar_tropas();
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
        const matarife=$(elemento).attr('prodMatarife');  
        const procedencia=$(elemento).attr('prodProcedencia');  
        const especie=$(elemento).attr('prodEspecie');   
        const vigencia=$(elemento).attr('prodvigencia');   
        const cantidad=$(elemento).attr('prodCantidad');   
        const desde=$(elemento).attr('prodDesde');   
        const hasta=$(elemento).attr('prodHasta'); 
        
        $('#id_edit_prod').val(id);
        $('#usuario_tropas').val(matarife);
        $('#procedencia_tropas').val(procedencia);
        $('#especie_tropas').val(especie);
        $('#vigencia_tropas').val(vigencia);
        $('#asignacion_tropas').val(cantidad);
        $('#desde_tropas').val(desde);
        $('#hasta_tropas').val(hasta);
        edit=true;     
    });
    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodMatarife');
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
                $.post('../controlador/TropasController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La tropa '+nombre+' ha sido borrado',
                            'success'
                        )
                        buscar_tropas();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'La tropa '+nombre+' no fue borrado',
                            'error'
                        )
                    }
                })
             
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'La tropa '+nombre+' no fue borrado',
                'error'
              )
            }
          })
    })
    $(document).on('click','#actualizarusuariomodal',(e)=>{
        rellenar_matarifes();
    });
    $(document).on('click','#actualizarprocedenciamodal',(e)=>{
        rellenar_procedencia();
    });
    $(document).on('click','#actualizarespeciemodal',(e)=>{
        rellenar_especies();
    });
    $(document).on('keyup','#asignacion_tropas',function(){
        let valor = $(this).val();
        let comienzo=$('#desde_tropas').val();
       $('#hasta_tropas').val(parseFloat(comienzo)+parseFloat(valor)-1);
    });
    $(document).on('keyup','#comenzar_tropas_cambiar',function(){
        let valor = $(this).val();
        let final=$('#hasta_tropas_cambiar').val();
        let comienzo=$('#desde_tropas_cambiar').val();
        let quedan=parseFloat(final)-parseFloat(comienzo)+1;
         
        let quedan1=parseFloat(final)-parseFloat(valor)+1;
    let comienzo1=valor-comienzo;
       $('#usados').val(parseFloat(quedan)-parseFloat(quedan1)+1);

   
    if(quedan1<0){
        $('#guardarhasta').hide();
        toastr.error('*Valores incorrectos');
    } else if(comienzo1<0){
        $('#guardarhasta').hide();
        toastr.error('*Valores incorrectos');
    } else{
        $('#guardarhasta').show();
        toastr.success('*Valor Correcto... Puede Guardar los datos');
    }
    });

    $(document).on('click','#button-imprimir',(e)=>{
        Mostrar_Loader('Generando_Pdf');
        $.post('../controlador/PDFControllertropastodas.php',{},(response)=>{
            
            if(response==''){
                cerrar_loader('exito_generar');
        window.open('../pdf/tropas/pdf-registros.pdf','_blank');
    }else{
        cerrar_loader('error_generar');  
       }
        })
    });
    $(document).on('click','#button-recuperar',(e)=>{
        funcion="ver_borrados"
        $.post('../controlador/TropasController.php',{funcion},(response)=>{
            let registros = JSON.parse(response);
            let template="";
            $('#registros').html(template);
            registros.forEach(registro => {
                template+=`
                    <tr>
                        <td prodId="${registro.id}">${registro.id}</td>                        
                        <td>${registro.matarife}</td>
                        <td>${registro.procedencia}</td>
                        <td>${registro.especie}</td>
                        <td>${registro.desde}</td>
                        <td>${registro.cantidad}</td>
                        <td>${registro.hasta}</td>
                        <td><button id_cancelar="${registro.id}" class="agregar_nuevo btn btn-primary">Agregar</button></td>
                    </tr>
                `;
                $('#registros').html(template);                
            });
        })
        
        
    });
    $(document).on('click','.agregar_nuevo',(e)=>{
        let elemento=$(this)[0].activeElement;
        let id= $(elemento).attr('id_cancelar')
        funcion="agregar_nuevo";
        $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
            if(response=="agregado"){
                toastr.success('*Agregado nuevamente. Gracias');
                setTimeout('document.location.reload()',2000);
            }else{
                toastr.error('*No se pudo volver a agregar');
            }

        })
    })
    $(document).on('click','.comenzar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId'); 
        const vigencia=$(elemento).attr('prodvigencia');      
        const desde=$(elemento).attr('prodDesde');   
        const hasta=$(elemento).attr('prodHasta'); 
        $('#id_edit_prod_cambiar').val(id);
        $('#vigencia_tropas_cambiar').val(vigencia);
        $('#desde_tropas_cambiar').val(desde);
        $('#hasta_tropas_cambiar').val(hasta);   
        
 
    });
    $('#form-cambiar-tropas').submit(e=>{
        let id=$('#id_edit_prod_cambiar').val();
        let comenzar=$('#usados').val();
       
            funcion="crear_comienzo";
        
        $.post('../controlador/TropasController.php',{funcion,id,comenzar},(response)=>{
            
            if(response=='add'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-cambiar-tropas').trigger('reset');

                buscar_tropas();
                rellenar_desdetropas();
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
                $('#form-cambiar-tropas').trigger('reset');
                buscar_tropas();
                
            }
            if(response=='noadd'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El nombre del tropas ya existe',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-cambiar-tropas').trigger('reset');
                rellenar_desdetropas();
            }
            if(response=='noedit'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'El tropas no se edito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                $('#form-cambiar-tropas').trigger('reset');
            }
            
        });
        e.preventDefault();
    });
    $(document).on('click','#buscar_borrado',(e)=>{
        document.getElementById("desde_tropas").disabled = false;
       
    })
    $(document).on('keyup','#desde_tropas',function(){
        let valor = $(this).val();
        let comienzo=$('#asignacion_tropas').val();
        $('#hasta_tropas').val(parseFloat(comienzo)+parseFloat(valor)-1);
        funcion="verificar_datos";
        $.post('../controlador/TropasController.php', {funcion,valor},(response)=>{
            if(response=="si"){
                toastr.success('*Valor Correcto');
            }else{
                toastr.error('*Valor Incorrecto');
            }
        })
        
    });
})

