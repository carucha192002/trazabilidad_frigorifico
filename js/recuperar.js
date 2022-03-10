$(document).ready(function(){
    $('#aviso').hide();
    $('#aviso1').hide();
    $('#form-recuperar').submit(e=>{
        Mostrar_Loader('Recuperar_Contraseña');
        let email = $('#email-recuperar').val();
        let dni = $('#dni-recuperar').val();
        if(email==''||dni==''){
            $('#aviso').show();
            $('#aviso').text('Rellene todos los Campos');
            cerrar_loader("");
        }
        else{
            $('#aviso').hide();
            let funcion ='verificar';
            $.post('../controlador/RecuperarController.php',{funcion,email,dni},(response)=>{
             
                if(response.trim()=='encontrado'){
                    let funcion ='recuperar';
                    $('#aviso').hide();
                    $.post('../controlador/RecuperarController.php',{funcion,email,dni},(response2)=>{
                      

                        $('#aviso').hide();
                        $('#aviso1').hide();
                       if(response2.trim()=='enviado'){
                        cerrar_loader('exito_envio');
                            $('#aviso1').show();
                            $('#aviso1').text('Se restablecio la contraseña');
                            $('#form-recuperar').trigger('reset');
                        }
                        else{
                            cerrar_loader('error_envio');
                            $('#aviso').show();
                            $('#aviso1').text('No se pudo restablecer la contraseña');
                            $('#form-recuperar').trigger('reset');
                        }
                    })
                }
                else{
                    cerrar_loader('error_usuario');
                    $('#aviso').hide();
                    $('#aviso1').hide();
                    $('#aviso').show();
                    $('#aviso').text('El Email y Dni no se encuentran asociados o no estan registrados');
                }
            })
        }
        e.preventDefault();
    })
    function Mostrar_Loader(Mensaje){
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
            case 'Recuperar_Contraseña':
                texto=' Se esta enviando el correo. Por favor espere...';
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
                            texto=' El usuario perteneciente a estos datos no fue encontrados';
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
})