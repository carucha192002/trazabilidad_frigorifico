$(document).ready(function() {
    moment.locale('es');
    
    async function read_notificaciones(id_usuario){
        funcion="read_notificaciones";
        let data=await fetch('../controlador/NotificacionController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&id_usuario='+id_usuario
        })
        if(data.ok){
            let response=await data.text();
         
           try{
              let notificaciones=JSON.parse(response);
 
              let template1='';
              let template2='';
                  if(notificaciones.length==0){
                    template1+=`
                    <i class="far fa-bell"></i>
                    `;
                    template2+=`
                        Notificaciones
                    `;
                  }else{
                    template1+=`
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">${notificaciones.length}</span>
                    `;
                    template2+=`
                    Notificaciones <span class="badge badge-warning right">${notificaciones.length}</span>
                    `;
                  }
                  $('#numero_notificacion').html(template1);
                  $('#nav_cont_noti').html(template2);
              let template='';
              template+=`
              <span class="dropdown-item dropdown-header">${notificaciones.length} Notificaciones</span>
              `;
              notificaciones.forEach(notificacion => {
                template+=`
                <div class="dropdown-divider"></div>
                    <a href="../${notificacion.url_1}&&noti=${notificacion.id}" class="dropdown-item">
                        <div class="media">
                            <img src="../util/img/producto/${notificacion.imagen}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ${notificacion.titulo}
                                </h3>
                                <p class="text-sm">${notificacion.asunto}</p>
                                <p class="text-sm text-muted">${notificacion.contenido}</p>
                                <span class="float-right text-muted text-sm">${notificacion.fecha_creacion}</span>
                            </div>
                        </div>
                    </a>
                <div class="dropdown-divider"></div>
                `; 
              });
              template+=`
              <a href="../vista/notificaciones.php" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
              `;
              $('#notificaciones').html(template);
            } catch(error){
                
               
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
     
      }
         
          $(document).on('submit','#form_pregunta',(e)=>{
            let pregunta=$('#pregunta').val();
            realizar_pregunta(pregunta);
            e.preventDefault();
           
        })


    })