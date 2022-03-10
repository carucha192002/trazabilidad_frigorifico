$(document).ready(function(){

    $('#parte1').hide();
    $('#parte2').hide();
    mostrar_consultas();
    async function verificar_producto(id_ingresos){
      funcion="verificar_producto";
      let data=await fetch('../controlador/PreguntaProductorController.php',{
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
                  <form id="form_pregunta">
                    <div class="input-group">
                    <img class="direct-chat-img mr-1" src="../img/${producto.avatar_sesion}" alt="Message User Image">
                      <input type="text" id="pregunta" name="message" placeholder="Escribir pregunta" class="form-control" required>
                      <input type="hidden" value="${id_ingresos}" class="id_ingresos_pregunta">
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
    async function realizar_pregunta(pregunta,id_ingresos){
      funcion="realizar_pregunta";
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
    $(document).on('submit','#form_pregunta',(e)=>{
      let pregunta=$('#pregunta').val();
      let id_ingresos=$('.id_ingresos_pregunta').val();
      realizar_pregunta(pregunta,id_ingresos);
      e.preventDefault();
     
  })
    function llenar_historial(id) {
      funcion='llenar_historial';
      $.post('../controlador/HistorialController.php',{funcion,id},(response)=>{
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
    function cantidadcorrales(){
      let id=$('#productormatarife').val();
      let funcion="verificarcorrales";
      $.post('../controlador/TropasControllerProductor.php',{funcion,id},(response)=>{
          const tipos = JSON.parse(response);
          let template='';
          tipos.forEach(tipo => {
              template+=`
                  <tr clasCorral="${tipo.corral}"clasCantidad="${tipo.cantidad}"clasEspecie="${tipo.especie}"clasSubespcie="${tipo.subespecie}">                                              
                      <td> 
                      ${tipo.corral}                          
                      </td>
                      <td>${tipo.cantidad}</td>
                      <td>${tipo.especie}</td>
                      <td>${tipo.subespecie}</td>
                  </tr>
              `;
      });
      $('#clasificacioncorral').html(template);
  
  })
  
  }
    function llenar_clasificacion(){
      let id=$('#id_ingresos').val();
      funcion='verclasificacion';
      $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
        const tipos = JSON.parse(response);
          let template='';
          tipos.forEach(tipo => {
              template+=`
                  <tr clasespecie="${tipo.subspecie}"clascantidad="${tipo.cantidad}"claskilos="${tipo.kilos}">                                              
                      <td> 
                      ${tipo.subespecie}                          
                      </td>
                      <td>${tipo.cantidad}</td>
                      <td>${tipo.kilos}</td>
                  </tr>
              `;
          });
          $('#clasificacion').html(template);
  
      })
  }
  function llenar_corral(){
    let id=$('#id_ingresos').val();
    funcion='vercorral';
    $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
      const tipos = JSON.parse(response);
        let template='';
        tipos.forEach(tipo => {
            template+=`
                <tr clascorral="${tipo.corral}"clascorralero="${tipo.corralero}"claskilos="${tipo.enpie}">                                              
                    <td> 
                    ${tipo.corral}                          
                    </td>
                    <td>${tipo.enpie}</td>
                    <td>${tipo.corralero}</td>
                </tr>
            `;
        });
        $('#corrales').html(template);
    })
  }
  function llenar_foto(){
    let id=$('#id_ingresos').val();
    funcion='verfoto';
    $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
      let nombre='';
      const datos = JSON.parse(response);
      nombre+=`${datos.nombre}`;
      $('#nombrepersonal').html(nombre);
      $('#avatar2').attr('src',datos.avatar); 
    })
    funcion='datos';
    $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
      if(response==1){
        funcion='datosvalidos';
    $.post('../controlador/TropasController.php',{funcion,id},(response)=>{ 
      let nombre='';
      let fecha='';
      const datos = JSON.parse(response);
      nombre+=`${datos.edito}`;
      fecha+=`${datos.fecha}`;
      $('#edicion').html('Los Datos se editaron por:'+' '+nombre+' '+'el dia:'+' '+fecha);
    })
      }else{
        $('#edicion').html('No hay edicion para esta ficha');
      } 
    })
  
  }

  function mostrar_consultas(){
    funcion="id_matarife";
    let identificador=$('#productorid').val();
    $.post('../controlador/TropasControllerProductor.php',{funcion,identificador},(response)=>{ 
      let identificador='';
      const id = JSON.parse(response);
      identificador+=`${id.identificador}`;
      $('#productormatarife').val(identificador);
      tablas();
      cantidadcorrales();
      if($('#prioridad').val()==4){
        document.getElementById('tercero').disabled=true;
        document.getElementById('tercero').removeAttribute('href');    
        document.getElementById('tercero').style.textDecoration = 'none';
        document.getElementById('tercero').style.cursor = 'default';
      }
    })
  }
    function tablas(){
      funcion="listartropas"; 
       let id=$('#productormatarife').val();
            $.post('../controlador/TropasControllerProductor.php',{funcion,id},(response)=>{ 
                let datatable = $('#tabla_ingresos').DataTable( {
                  
                  "ajax":{
                      "url":"../controlador/TropasControllerProductor.php",
                      "method": "POST",
                      "data":{
                        'funcion':funcion,
                        'id'   : id
                }
                  }, 
                  "columns": [
                  { "data": "fecha" },
                  { "data": "ano" },
                  { "data": "tropa" },
                  { "data": "procedencia" },
                  { "data": "especie" },
                  { "data": "matarife" },
                  { "data": "productor" },
                  { "data": "cantidad" },
                  { "data": "dta" },
    
                              
                      { "defaultContent": `
                                          <button class="ver btn btn-success" type="button"><i class="fas fa-search"></i></button>
                                          <button class="imprimir btn btn-secondary" type="button"><i class="fas fa-print"></i></button>
                                          `}
                  ],
                  "language": espanol
              });
              $('#tabla_ingresos tbody').on('click','.imprimir',function(){
                Mostrar_Loader('Generando_Pdf');
                  let datos = datatable.row($(this).parents()).data();
                  let id = datos.id;
                  $.post('../controlador/PDFfinalizadosmatarifeController.php',{id},(response)=>{
                    if(response==''){
                      
                      cerrar_loader('exito_generar');  
                      window.open('../pdf/finalizadosproductor/pdf-productor.pdf','_blank');
                     }else{
                      cerrar_loader('error_generar');  
                     }
                    
                  })       
              })      
              
              $('#tabla_ingresos tbody').on('click','.ver',function(){
                let datos = datatable.row($(this).parents()).data();
                let id = datos.id;
                llenar_historial(id);
                funcion="verprincipal";
                $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
                    let cargo='';
                    let ano='';
                    let fecha = '';
                    let libro = ''; 
                    let folio = '';   
                    let destino = ''; 
                    let especie = '';  
                    let cantidad = ''; 
                    let kilos = ''; 
                    let muertos = ''; 
                    let caidos = ''; 
                    let enpie = ''; 
                    let kilosenpie = ''; 
                    let conservacion = ''; 
                    let vencimiento = ''; 
                    let corral = ''; 
                    let corralero = ''; 
                    let matarife = ''; 
                    let productor = ''; 
                    let guia = ''; 
                    let fechaguia = ''; 
                    let dtamodal = ''; 
                    let fechadtamodal = ''; 
                    let llenarprocedencia = ''; 
                    let provinciamodal = ''; 
                    let localidadmodal = ''; 
                    let CPmodal = ''; 
                    let llenartransporte = ''; 
                    let llenarchofer = ''; 
                    let dnimodal = ''; 
                    let habilitacionmodal = ''; 
                    let horasdeviajemodal = ''; 
                    let lavadomodal = ''; 
                    let prescintomodal = ''; 
                    let prescintomodalacoplado = ''; 
                    let observacionmodal = ''; 
                    let kiloscuerosmodal = ''; 
                    let numtropas = '';
                    let id_ingresos = '';
                  const respuestasconsola = JSON.parse(response);
                  id_ingresos+=`${respuestasconsola.id_ingresos}`;
                  cargo+=`${respuestasconsola.cargo}`;
                  ano+=`${respuestasconsola.ano}`;
                  fecha+=`${respuestasconsola.fecha}`;
                  libro+=`${respuestasconsola.libro}`;
                  folio+=`${respuestasconsola.folio}`;
                  destino+=`${respuestasconsola.destino}`;
                  especie+=`${respuestasconsola.especie}`;
                  cantidad+=`${respuestasconsola.cantidad}`;
                  kilos+=`${respuestasconsola.kilos}`;
                  muertos+=`${respuestasconsola.muertos}`;
                  caidos+=`${respuestasconsola.caidos}`;
                  enpie+=`${respuestasconsola.enpie}`;
                  kilosenpie+=`${respuestasconsola.kilosenpie}`;
                  conservacion+=`${respuestasconsola.conservacion}`;
                  vencimiento+=`${respuestasconsola.vencimiento}`;
                  corral+=`${respuestasconsola.corral}`;
                  corralero+=`${respuestasconsola.corralero}`;
                  matarife+=`${respuestasconsola.matarife}`;
                  productor+=`${respuestasconsola.productor}`;
                  guia+=`${respuestasconsola.guia}`;
                  fechaguia+=`${respuestasconsola.fechaguia}`;
                  dtamodal+=`${respuestasconsola.dtamodal}`;
                  fechadtamodal+=`${respuestasconsola.fechadtamodal}`;
                  llenarprocedencia+=`${respuestasconsola.llenarprocedencia}`;
                  provinciamodal+=`${respuestasconsola.provinciamodal}`;
                  localidadmodal+=`${respuestasconsola.localidadmodal}`;
                  CPmodal+=`${respuestasconsola.CPmodal}`;
                  llenartransporte+=`${respuestasconsola.llenartransporte}`;
                  llenarchofer+=`${respuestasconsola.llenarchofer}`;
                  dnimodal+=`${respuestasconsola.dnimodal}`;
                  habilitacionmodal+=`${respuestasconsola.habilitacionmodal}`;
                  horasdeviajemodal+=`${respuestasconsola.horasdeviajemodal}`;
                  lavadomodal+=`${respuestasconsola.lavadomodal}`;
                  prescintomodal+=`${respuestasconsola.prescintomodal}`;
                  prescintomodalacoplado+=`${respuestasconsola.prescintomodalacoplado}`;
                  observacionmodal+=`${respuestasconsola.observacionmodal}`;
                  kiloscuerosmodal+=`${respuestasconsola.kiloscueromodal}`;
                  numtropas+=`${respuestasconsola.numtropas}`;
                  
                    $('#id_ingresos').val(id_ingresos);
                    $('#ano').val(ano);
                    $('#cargodatos').val(cargo);
                    $('#fecha').val(fecha);
                    $('#libro').val(libro); 
                    $('#folio').val(folio);   
                    $('#destino').val(destino); 
                    $('#especie').val(especie);   
                    $('#cantidad').val(cantidad); 
                    $('#kilos').val(kilos); 
                    $('#muertos').val(muertos); 
                    $('#Caidos').val(caidos); 
                    $('#enpie').val(enpie); 
                    $('#kilospie').val(kilosenpie); 
                    $('#conservacion').val(conservacion); 
                    $('#vencimiento').val(vencimiento); 
                    $('#corral').val(corral); 
                    $('#corralero').val(corralero); 
                    $('#usuariomatarife').val(matarife); 
                    $('#productorusuario').val(productor); 
                    $('#usuarioguia').val(guia); 
                    $('#fechaguiausuario').val(fechaguia); 
                    $('#dtausuario').val(dtamodal); 
                    $('#fechadtausuario').val(fechadtamodal); 
                    $('#procedenciausuario').val(llenarprocedencia); 
                    $('#provinciausuario').val(provinciamodal); 
                    $('#localidadusuario').val(localidadmodal); 
                    $('#cpusuario').val(CPmodal); 
                    $('#transporteusuario').val(llenartransporte); 
                    $('#choferusuario').val(llenarchofer); 
                    $('#dniusuario').val(dnimodal); 
                    $('#habilitacionusuario').val(habilitacionmodal); 
                    $('#horasviajeusuario').val(horasdeviajemodal); 
                    $('#lavadousuario').val(lavadomodal); 
                    $('#prescintousuario').val(prescintomodal); 
                    $('#prescintoacopladousuario').val(prescintomodalacoplado); 
                    $('#observacionusuario').val(observacionmodal); 
                    $('#kiloscuerousuario').val(kiloscuerosmodal); 
                    $('#tropa').val(numtropas);
                    llenar_clasificacion();
                    llenar_corral();
                    llenar_foto();
                    cantidadcorrales();
                    cantidadcorrales();
                    verificar_producto(id_ingresos);
                    funcion="marcador";
                    $.post('../controlador/TropasController.php',{funcion,id_ingresos},(response)=>{
                      let estado='';
                      const resultado = JSON.parse(response);
                      estado+=`${resultado.marcador}`
                      
                      if(estado=='INGRESO'){
                        var titular = document.getElementById("tracking");
                        titular.style.width="33%"; 
                        $('#etapa').html(estado);
                        $('#pasos').html('1/3');
                        var box = document.getElementById("infobox");
                        box.class="info-box bg-success";
                        var box = document.getElementById("infobox");
                        box.className="info-box bg-info";
                        $('#primero').hide();
                        $('#segundo').hide();
                        $('#tercero').hide();
                        $('#imprimirpdf').hide();
                        $('#imprimircsv').hide();
  
                      }
                      if(estado=='FAENA'){
                        var titular = document.getElementById("tracking");
                        titular.style.width="66%"; 
                        $('#etapa').html(estado);
                        $('#pasos').html('2/3');
                        var box = document.getElementById("infobox");
                        box.className="info-box bg-warning";
                        $('#primero').hide();
                        $('#segundo').hide();
                        $('#tercero').hide();
                        $('#imprimirpdf').hide();
                        $('#imprimircsv').hide();
  
                      }
                      if(estado=='FINALIZADO'){
                        var titular = document.getElementById("tracking");
                        titular.style.width="99%"; 
                        $('#etapa').html(estado);
                        $('#pasos').html('3/3');
                        var box = document.getElementById("infobox");
                        box.className="info-box bg-success";
                        $('#primero').hide();
                        $('#segundo').hide();
                        $('#tercero').show();
                        $('#imprimirpdf').show();
                        $('#imprimircsv').hide();
  
                      }
                      $('#parte1').show();
                      $('#parte2').show();
                      $('html, body').animate({
                        scrollTop: $("#edicion").offset().top
                        }, 1000);
                    })
                  })
                  
              })  
            
            })  
          }
          $(document).on('click','#imprimirpdf',(e)=>{
            Mostrar_Loader('Generando_Pdf');
            let id =  $('#id_ingresos').val();
            $.post('../controlador/PDFfinalizadosmatarifeController.php',{id},(response)=>{
              if(response==''){
                cerrar_loader('exito_generar');  
                window.open('../pdf/finalizadosproductor/pdf-'+id+'.pdf','_blank');
               }else{
                cerrar_loader('error_generar');  
               }
              
            })  
          })
      
    
    
      $(document).on('click','#cerrarficha',(e)=>{
        $('#parte1').hide();
        $('#parte2').hide();
         })
         function Mostrar_Loader(Mensaje){
          var texto=null;
          var mostrar=false;
          switch (Mensaje) {
              case 'Generando_Pdf':
                  texto=' Generando PDF. Por favor espere...';
                  mostrar=true;
                  break;
          
          }
          if(mostrar){
              Swal.fire({
                  title: 'Generando PDF',
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
              case 'exito_generar':
                  tipo='success';
                  texto=' El PDF se genero correctamente...';
                  mostrar=true;
                  break;
                      case 'error_generar':
                          tipo='error';
                          texto=' El PDF no puede generarse... Por favor intente de nuevo';
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
})