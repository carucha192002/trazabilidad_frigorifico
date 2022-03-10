$(document).ready(function() {
    moment.locale('es');
    read_notificaciones();
   
    var id_ingresos=$('#id_ingresos').val();
    verificar_producto(id_ingresos); 
    async function verificar_producto(id_ingresos){
        funcion="verificar_producto";
        let data=await fetch('../controlador/PreguntaController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
              let producto=JSON.parse(response);
            
                let template5='';
                if(producto.bandera=='2'){
                    template5 += `
                    <div class="card-footer">
                    <form id="form_pregunta1">
                      <div class="input-group">
                      <img class="direct-chat-img mr-1" src="../img/${producto.avatar_sesion}" alt="Message User Image">
                        <input type="text" id="pregunta" name="message" placeholder="Escribir pregunta" class="form-control" required>
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
                    `;
                }
                template5+=`
                <div class="direct-chat-messages direct-chat-danger preguntas">`;
                    producto.preguntas.forEach(pregunta => {
                        template5+=`
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">${pregunta.username}</span>
                                 <span class="direct-chat-timestamp float-right">${pregunta.fecha_creacion}</span>
                            </div>
                        
                            <img class="direct-chat-img" src="../img/${pregunta.avatar}" alt="Message User Image">
                       
                            <div class="direct-chat-text">
                                ${pregunta.contenido}
                            </div>`;
                        if(pregunta.estado_respuesta=='0'){
                            if(producto.bandera=='1'){
                            template5 += `
                            <div class="card-footer">
                                <form>
                                    <div class="input-group">
                                    <img class="direct-chat-img mr-1" src="../img/${producto.avatar}" alt="Message User Image">
                                        <input type="text" placeholder="Responder pregunta" 
                                        class="form-control respuesta" required>
                                        <input type="hidden" value="${pregunta.id}" class="id_pregunta">
                                        <input type="hidden" value="${id_ingresos}" class="id_ingresos">
                                        <span class="input-group-append">
                                        <button class="btn btn-danger enviar_respuesta">Enviar</button>
                                        </span>
                                    </div>
                                </form>
                          </div>
                            `;
                            }
                        }else{
                            template5+=`
                        <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">${pregunta.respuesta.nombre_usuario}</span>
                                <span class="direct-chat-timestamp float-left">${pregunta.respuesta.fecha_creacion}</span>
                                </div>
                                <img class="direct-chat-img" src="../img/${producto.avatar}" alt="Message User Image">
                            <div class="direct-chat-text">
                              ${pregunta.respuesta.contenido}
                            </div>
                          
                        </div>
                            `;
                        }
                        template5+=`
                        </div>
                        `;
                    });
                template5+=`
                </div>`;
                $('#product-pre').html(template5);
            } catch(error){
       
                if(response=='error'){
                    location.href='../index.php';
                }
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
     
      }
      $(document).on('click','.enviar_respuesta',(e)=>{
        let elemento=$(this)[0].activeElement.parentElement.parentElement;
        let respuesta=$(elemento).children('input.respuesta').val();
        let id_pregunta=$(elemento).children('input.id_pregunta').val();
        let id_ingresos=$(elemento).children('input.id_ingresos').val();
        if(respuesta!=''){
           realizar_respuesta(respuesta,id_pregunta,id_ingresos);
        }else{
            toastr.error('La respuesta esta vacia');
        }
        
       e.preventDefault();
    })
    async function realizar_respuesta(respuesta,id_pregunta,id_ingresos){
        funcion="realizar_respuesta";
        let data=await fetch('../controlador/RespuestaController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&respuesta='+respuesta+'&&id_pregunta='+id_pregunta+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
              let respuesta=JSON.parse(response);
              verificar_producto(id_ingresos);
           
            } catch(error){
               //if(response=='error'){
               //     location.href='../index.php';
               // }
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
      
      }
      async function realizar_pregunta1(pregunta,id_ingresos){
        funcion="realizar_pregunta_encryptada";
        let data=await fetch('../controlador/PreguntaController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&pregunta='+pregunta+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
              let respuesta=JSON.parse(response);
              verificar_producto(id_ingresos);
              $('#form_pregunta').trigger('reset');
            } catch(error){
                verificar_producto(id_ingresos);
              $('#form_pregunta').trigger('reset');
           
              if(response=='error'){
                location.href='../index.php';
              }
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
     
      }
      $(document).on('submit','#form_pregunta1',(e)=>{
        let pregunta=$('#pregunta').val();
        let id_ingresos=$('#id_ingresos').val();
        realizar_pregunta1(pregunta,id_ingresos);
        e.preventDefault();
       
    })
    async function read_notificaciones(){
        funcion="read_notificaciones";
        let data=await fetch('../controlador/NotificacionController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
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
                    <a href="../vista/adm_notificaciones.php?name=Tropa N°: ${notificacion.tropas}&&id=${notificacion.ingresos}" class="dropdown-item">
                        <div class="media">
                            <img src="../img/${notificacion.imagen}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                Tropa N°: ${notificacion.tropas}
                                </h3>
                                <p class="text-sm">${notificacion.titulo}</p>
                                <p class="text-sm text-muted">${notificacion.contenido}</p>
                                <span class="float-right text-muted text-sm">${notificacion.fecha_creacion}</span>
                            </div>
                        </div>
                    </a>
                <div class="dropdown-divider"></div>
                `; 
              });
              template+=`
              <a href="../vista/adm_notificaciones_todas.php" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
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
       
    })