 $(document).ready(function(){
     
    $('#gestion_usuario1').addClass('active');

    $('#datos_pers_edit').hide(); 
    var funcion='';
    var id_usuario = $('#id_usuario').val();

    buscar_usuario(id_usuario);
    var edit=false;


function buscar_usuario(dato) {
    funcion='buscar_usuario';
    $.post('../controlador/UsuarioController.php',{dato,funcion},(response)=>{
        let nombre='';
        let apellidos='';
        let edad='';
        let dni='';
        let tipo='';
        let telefono='';
        let domicilio='';
        let email='';
        let sexo='';
        let adicional='';
        const usuario = JSON.parse(response);
        nombre+=`${usuario.nombre}`;
        apellidos+=`${usuario.apellidos}`;
        edad+=`${usuario.edad}`;
        dni+=`${usuario.dni}`;
        if(usuario.tipo=='Root'){
            tipo+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
        }
        if(usuario.tipo=='Palco'){
            tipo+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
        }
        if(usuario.tipo=='Camara'){
             tipo+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
        } 
        if(usuario.tipo=='Corralero'){
            tipo+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
       }
        
        telefono+=`${usuario.telefono}`;
        domicilio+=`${usuario.domicilio}`;
        email+=`${usuario.email}`;
        sexo+=`${usuario.sexo}`;
        adicional+=`${usuario.adicional}`;
        $('#nombre_us').html(nombre);
        $('#apellidos_us').html(apellidos);
        $('#edad').html(edad);
        $('#dni_us').html(dni);
        $('#us_tipo').html(tipo);
        $('#telefono_us').html(telefono);
        $('#domicilio_us').html(domicilio);
        $('#email_us').html(email);
        $('#sexo_us').html(sexo);
        $('#adicional_us').html(adicional);
        $('#avatar2').attr('src',usuario.avatar);
        $('#avatar1').attr('src',usuario.avatar);
        $('#avatar3').attr('src',usuario.avatar);
        $('#avatar4').attr('src',usuario.avatar);
    }) 
}
$(document).on('click','.edit',(e)=>{
    funcion='capturar_datos';
    edit=true;
    $.post('../controlador/UsuarioController.php',{funcion,id_usuario},(response)=>{
        
        const usuario = JSON.parse(response);
        $('#telefono').val(usuario.telefono);
        $('#domicilio').val(usuario.domicilio);
        $('#email').val(usuario.email);
        $('#sexo').val(usuario.sexo);
        $('#adicional').val(usuario.adicional);
        $('#secretaria').val(usuario.secretaria);
        $('#nacimientofecha').val(usuario.edadfecha);
        $('#datos_pers_edit').show();
    })
});
$('#form-usuario').submit(e=>{
    if(edit==true){        
        let telefono=$('#telefono').val();
        let domicilio=$('#domicilio').val();
        let email=$('#email').val();
        let sexo=$('#sexo').val();
        let adicional=$('#adicional').val();
        let secretaria=$('#secretaria').val();
        let fnacimiento=$('#nacimientofecha').val();
        
        funcion='editar_usuario';
        $.post('../controlador/UsuarioController.php',{id_usuario,funcion,telefono,domicilio,email,sexo,adicional,secretaria,fnacimiento},(response)=>{
          
            if(response.trim()=='editado'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Datos Editados',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  $('#form-usuario').trigger('reset');
                  $('#datos_pers_edit').hide();
            }
            edit=false;
            buscar_usuario(id_usuario);
        })
    }
    else{
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'No se puede editar los datos',
            showConfirmButton: false,
            timer: 1500
          })
        $('#form-usuario').trigger('reset');

    }
    e.preventDefault();
});
$('#form-pass').submit(e=>{
    let oldpass=$('#oldpass').val();
    let newpass=$('#newpass').val();
    funcion='cambiar_contra';
    $.post('../controlador/UsuarioController.php',{id_usuario,funcion,oldpass,newpass},(response)=>{ 
        if(response.trim()=='update'){
            $('#update').hide('slow');
            $('#update').show(1000);
            $('#update').hide(2000);
            $('#form-pass').trigger('reset');
            buscar_usuario(id_usuario);

        }
        else{
            $('#noupdate').hide('slow');
            $('#noupdate').show(1000);
            $('#noupdate').hide(2000);
            $('#form-pass').trigger('reset');
            
        }
    })
    e.preventDefault();
})
$('#form-photo').submit(e=>{
    let formData = new FormData($('#form-photo')[0]);
    $.ajax({
        url:'../controlador/UsuarioController.php',
        type:'POST',
        data:formData,
        cache:false,
        processData: false,
        contentType:false
    }).done(function(response){
        const json = JSON.parse(response);
        if(json.alert=='edit'){
            $('#avatar1').attr('src',json.ruta);
            $('#edit').hide('slow');
            $('#edit').show(1000);
            $('#edit').hide(2000);
            $('#form-photo').trigger('reset');
            buscar_usuario(id_usuario);
        }
        else{
            $('#noedit').hide('slow');
            $('#noedit').show(1000);
            $('#noedit').hide(2000);
            $('#form-photo').trigger('reset');
        }
        
        
    });
    e.preventDefault();
})
$(document).on('keyup','#telefono',function(){
    let valor = $(this).val();
    if(valor.trim()!=""){
        contadorcaracteres()
    }
   
});
})
function contadorcaracteres(){
    var input=  document.getElementById('telefono');
    input.addEventListener('input',function(){
      if (this.value.length > 10) 
         this.value = this.value.slice(0,10); 
    })
}