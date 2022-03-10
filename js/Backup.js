$(document).ready(function(){
    $('#gestion_backup1').addClass('active');
    buscar();
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
        if(usuario.tipo=='Administrador'){
            tipo+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
        }
        if(usuario.tipo=='Matarife'){
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
function buscar() {
    let funcion="buscar";  
      $.post('../controlador/BaseController.php',{funcion},(response)=>{ 
          let datatable = $('#tabla_listado').DataTable( {
            "order": [[ 0, "desc" ]],
            "ajax":{
                "url":"../controlador/BaseController.php",
                "method": "POST",
                "data":{funcion:funcion}
            },
            "columns": [
            { "data": "id_backup" },
            { "data": "fecha" },
            { "data": "dia" },
            { "data": "nombre" },
            { "data": "usuario" },

                        
                { "defaultContent": `
                                      <button class="ver btn btn-success" type="button"data-toggle="modal" data-target="#factura"><i class="fas fa-search"></i></button>
                                    `}
            ],
            "language": espanol
        });
  })
  }

})
$(document).on('click','#enviarpass1',(e)=>{
    Mostrar_Loader('Enviar_crear');
        funcion="enviarbackup";  
            $.post('../controlador/BackupenviarController.php',{funcion},(response)=>{ 

                if(response.trim()=='enviado'){
                    cerrar_loader('exito_envio');
                        
                    }
                    else{
                        cerrar_loader('error_envio');
                       
                    }
          
            })
    
    
});
function Mostrar_Loader(Mensaje){
    var texto=null;
    var mostrar=false;
    switch (Mensaje) {
        case 'Enviar_crear':
            texto=' Se esta enviando el correo y creando la Copia de Seguridad. Por favor espere...';
            mostrar=true;
            break;
    
    }
    if(mostrar){
        Swal.fire({
            title: 'Enviando Correo',
            text: texto,
            showConfirmButton:false
          })
    }
}
function cerrar_loader(Mensaje){
    var tipo=null;
    var texto=null;
    var mostrar=false;
    switch (Mensaje) {
        case 'exito_envio':
            tipo='success';
            texto=' El correo fue enviado correctamente...';
            mostrar=true;
            break;
                case 'error_envio':
                    tipo='error';
                    texto=' El correo no puede enviarse... Por favor intente de nuevo';
                    mostrar=true;
                    break;
                    case 'error_usuario':
                        tipo='error';
                        texto='No enviado';
                        mostrar=true;
                        break;
                    default:
                        swal.close();
                        break;
    
    }
    if(mostrar){
        Swal.fire({
            position:'center',
            icon:tipo,
            text: texto,
            showConfirmButton:false
          })
    }

}
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
