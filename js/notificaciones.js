$(document).ready(function() {
    moment.locale('es');
    read_notificaciones();
    read_all_notificaciones();
    $('#active_nav_notificaciones').addClass('active');
 

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
        async function read_all_notificaciones(){
            funcion="read_all_notificaciones";
            let data=await fetch('../controlador/NotificacionController.php',{
                method: 'POST', 
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body:'funcion='+funcion
            })
            if(data.ok){
                let response=await data.text();
               try{
                let notificaciones=JSON.parse(response);
                let template='';
                let notification=[];
                notificaciones.forEach(notificacion => {
                    template='';
                    template+=`
                        <a href="../${notificacion.url_1}&&noti=${notificacion.id}" class="dropdown-item">
                            <div class="media">
                                <img src="../img/matarife/${notificacion.imagen}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                    ${notificacion.titulo}
                                    `;
                                    if(notificacion.estado_abierto=='0'){
                                        template+=`<span class="badge badge-success">Cerrado</span>`;

                                    }else{
                                        template+=`<span class="badge badge-danger">Abierto</span>`;
                                    }
                                    template+=`
                                    </h3>
                                    <p class="text-sm">${notificacion.asunto}</p>
                                    <p class="text-sm text-muted">${notificacion.contenido}</p>
                                    <span class="float-right text-muted text-sm">${notificacion.fecha_creacion}</span>
                                </div>
                            </div>
                        </a>
                    `; 
                    notification.push({celda:template})
                });
                let datatables= $('#noti').DataTable( {
                    data: notification,
                    "aaSorting":[],
                    "searching": true,
                    "scrollX":true,
                    "autpWidth":false,
                    columns: [
                        { data: 'celda' },
                    ],
                    "destroy":true,
                    "language": espanol
                } );

                } catch(error){
                    console.error(error);
                   console.log(response);
                   
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: data.statusText,
                   text: 'Hubo conflicto de codigo: '+data.status,
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
    })