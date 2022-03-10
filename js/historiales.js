$(document).ready(function(){
    moment.locale('es');
  
  
      llenar_historial();
      function llenar_historial() {
        funcion='llenar_historial';
        $.post('../controlador/HistorialController.php',{funcion},(response)=>{
          let historiales=JSON.parse(response);
          let template='';
          historiales.forEach(historial => {
             let fecha_moment=moment(historial[0].fecha,'DD/MM/YY');
            template+=`
            <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-danger">
                            ${fecha_moment.format('ll')}
                          </span>
                        </div>
                        
            `;
            historial.forEach(cambio => {
              let fecha1_moment=moment(cambio.fecha+' '+cambio.hora,'DD/MM/YYYY HH:mm:ss');
              let hora_moment;
              if(cambio.bandera==1){
                hora_moment=fecha1_moment.fromNow();
              }else{
                hora_moment=fecha1_moment.format('LLLL');
              }
              template+=`
                        <div>
                          ${cambio.m_icono}
  
                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> ${hora_moment}</span>
  
                            <h3 class="timeline-header">${cambio.th_icono} Se realizo la accion ${cambio.tipo_historial} en ${cambio.modulo}</h3>
  
                            <div class="timeline-body">
                              ${cambio.descripcion}
                            </div>
                          </div>
                        </div>
                                    `;
              
            });
          });
          template+=`
          <div>
                <i class="far fa-clock bg-gray"></i>
          </div>
          `;
          $('#historiales').html(template);
  
        })
      }

  })