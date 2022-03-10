$(document).ready(function(){
    verificar_email();

function verificar_email(){
    funcion="email";
    $.post('../controlador/UsuarioController.php',{funcion},(response)=>{ 
        if(response.trim()=='1'){
            Swal.fire({
                title: 'Debe registrar un email para la recuperacion de contraseña',
                input: 'text',
                inputAttributes: {
                  autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    funcion="cambiar_email";
                    $.post('../controlador/UsuarioController.php',{funcion,login},(response)=>{
                        if(response.trim()=='cambiado'){                  
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'center',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                  toast.addEventListener('mouseenter', Swal.stopTimer)
                                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                              })
                              
                              Toast.fire({
                                icon: 'success',
                                title: 'Email Agregado!'
                              })
                          setTimeout('document.location.reload()',2000);
                        }                
                    })            
                },
                allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
             
              })

        }else{
            
        }
    })            
}
  
  })
  