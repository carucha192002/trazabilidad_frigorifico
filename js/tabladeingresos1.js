$(document).ready(function(){
  moment.locale('es');
  $('#parte1').hide();
  $('#parte2').hide();
  $('#verciclos').hide();
  $('#clasificacioncorralreduccion').hide();
  $('#clasificacioncorralreduccion1').hide();
  $('#clasificacioncorralreduccion2').hide();
  cantidadcorralesreduccion();
  cantidadcorrales();
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
                <form id="form_pregunta">
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
  async function verificar_producto_ver(id_ingresos){
    funcion="verificar_producto_ver";
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
                <form id="form_pregunta">
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
                                    class="form-control respuesta_ver" required>
                                    <input type="hidden" value="${pregunta.id}" class="id_pregunta_ver">
                                    <input type="hidden" value="${id_ingresos}" class="id_ingresos_ver">
                                    <span class="input-group-append">
                                    <button class="btn btn-danger enviar_respuesta_ver">Enviar</button>
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
  $(document).on('click','.enviar_respuesta_ver',(e)=>{
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let respuesta=$(elemento).children('input.respuesta_ver').val();
    let id_pregunta=$(elemento).children('input.id_pregunta_ver').val();
    let id_ingresos=$(elemento).children('input.id_ingresos_ver').val();

    if(respuesta!=''){
       realizar_respuesta_ver(respuesta,id_pregunta,id_ingresos);
    }else{
        toastr.error('La respuesta esta vacia');
    }
    
   e.preventDefault();
})
async function realizar_respuesta_ver(respuesta,id_pregunta,id_ingresos){
  funcion="realizar_respuesta_ver";
  let data=await fetch('../controlador/RespuestaController.php',{
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body:'funcion='+funcion+'&&respuesta='+respuesta+'&&id_pregunta='+id_pregunta+'&&id_ingresos='+id_ingresos
  })
  if(data.ok){
      let response=await data.text();
     try{
        let respuesta=JSON.parse(response);
        verificar_producto_ver(id_ingresos);
     
      } catch(error){
          
         /* if(response=='error'){
              location.href='../index.php';
          }*/
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
      body:'funcion='+funcion+'&&respuesta='+respuesta+'&&id_pregunta='+id_pregunta
  })
  if(data.ok){
      let response=await data.text();
     try{
        let respuesta=JSON.parse(response);
        verificar_producto(id_ingresos);
     
      } catch(error){
          
         /* if(response=='error'){
              location.href='../index.php';
          }*/
      }
  }else{
      Swal.fire({
          icon: 'error',
          title: data.statusText,
         text: 'Hubo conflicto de codigo: '+data.status,
      })
  }

}
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
    let funcion="verificarcorrales";
    $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
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
  function cantidadcorralesreduccion(){
    let funcion="verificardatosreduccion";
    $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
      
      if(response=='add'){
        $('#clasificacioncorralreduccion').show();
        $('#clasificacioncorralreduccion1').show();
        $('#clasificacioncorralreduccion2').show();
        let funcion="verificarcorralesreducidos";
    $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
     
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
    $('#clasificacioncorralreduccion').html(template);
})

      }
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


    let funcion="listartropas";  
          $.post('../controlador/TropasController.php',{funcion},(response)=>{ 
 
                $('#tabla_ingresos thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tabla_ingresos thead');
                let datatable = $('#tabla_ingresos').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function () {
                    var api = this.api();
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();
          
              
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; 
          
                                    var cursorPosition = this.selectionStart;
                                 
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
          
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                "order": [[ 1, "desc" ]],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                  if ( aData['etapa'] == "FINALIZADO" )
                  {
                      $('td', nRow).css('background-color', '#f55454');
                  }
                  else if ( aData['etapa'] == "INGRESO" )
                  {
                      $('td', nRow).css('background-color', '#4df030');
                  }
                  else if ( aData['etapa'] == "EN_FAENA" )
                  {
                      $('td', nRow).css('background-color', '#e0f030');
                  }
              },
         
                "ajax":{
                    "url":"../controlador/TropasController.php",
                    "method": "POST",
                    "data":{funcion:funcion}
                },
                
                "columns": [
                  
                { "data": "fecha" },
                { "data": "matarife" },
                { "data": "tropa" },
                { "data": "procedencia" },
                { "data": "especie" },
                { "data": "subespecie" },
                { "data": "productor" },
                { "data": "guia" },
                { "data": "tci" },  
                            
                    { "defaultContent": `<button class="editar btn btn-secondary" type="button"data-toggle="modal" data-target="#editaringresos"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="ver btn btn-success" type="button"><i class="fas fa-search"></i></button>
                                        <button class="borrar btn btn-danger" type="button"data-toggle="modal" data-target="#vista_legajo"><i class="fas fa-trash"></i></button>
                                        <button class="imprimir btn btn-secondary" type="button"><i class="fas fa-print"></i></button>
                                        `}
                ],
                "language": espanol
            });
            $('#tabla_ingresos tbody').on('click','.imprimir',function(){
              Mostrar_Loader('Generando_Pdf');
                let datos = datatable.row($(this).parents()).data();
                let id = datos.id;
                $.post('../controlador/PDFIngresosController.php',{id},(response)=>{
                  if(response==''){
                    cerrar_loader('exito_generar');  
                    window.open('../pdf/ingresos/pdf-ingreso.pdf','_blank');
                   }else{
                    cerrar_loader('error_generar');  
                   }

                   
                })       
            })      

            $('#tabla_ingresos tbody').on('click','.borrar',function(){
                let datos = datatable.row($(this).parents()).data();
                let id = datos.id;
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success m-1',
              cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Estas seguro que deseas eliminar la ficha: '+id+'?',
            text: "No podras revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Borrar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              funcion="borrartropa";
              let prioridad=$('#prioridad').val();
              if(prioridad==3){
                $.post('../controlador/BorrarController.php',{funcion,id,prioridad},(response)=>{
                    if(response=='borrado'){
                      $('#tabla_ingresos').DataTable().ajax.reload(); 
                      swalWithBootstrapButtons.fire(
                        'Borrado!',
                        'El Registro: '+id+' ha sido eliminado.',
                        'success'
                      )
                      location.reload(true);
                      cantidadcorrales();
                    }
                
                   
                })            
            }else{
                swalWithBootstrapButtons.fire(
                    'No tienes prioridad para eliminar este Registrado ',
                    'El Registro: '+id+' no se elimino',
                    'error'
                  )
            }
            }  else if(response=='no borrado'){
                swalWithBootstrapButtons.fire(
                  'No tienes prioridad para eliminar este Regstro ',
                  'El Registro: '+id+' no se elimino',
                  'error'
                )
              }
          })  
                
        })
            $('#tabla_ingresos tbody').on('click','.editar',function(){
                let datos = datatable.row($(this).parents()).data();
                let id = datos.id;
                funcion="verprincipal";
                $.post('../controlador/TropasController.php',{funcion,id},(response)=>{
                   
                  const respuestasconsola = JSON.parse(response);
                    $('#ideditar').val(respuestasconsola.id_ingresos);
                    $('#anoeditar').val(respuestasconsola.ano);
                    $('#fechaeditar').val(respuestasconsola.fecha);
                    $('#libromodaleditar').val(respuestasconsola.libro); 
                    $('#foliomodaleditar').val(respuestasconsola.folio);   
                    $('#destinoselecteditartitulo').html('DESTINO:'+' '+respuestasconsola.destino); 
                    $('#especieselecteditartitulo').html('ESPECIE:'+' '+respuestasconsola.especie);  
                    $('#cantidadmodaleditar').val(respuestasconsola.cantidad); 
                    $('#kilosmodaleditar').val(respuestasconsola.kilos); 
                    $('#muertosmodaleditar').val(respuestasconsola.muertos); 
                    $('#caidosmodaleditar').val(respuestasconsola.caidos); 
                    $('#enpiemodaleditar').val(respuestasconsola.enpie); 
                    $('#kilospiemodaleditar').val(respuestasconsola.kilosenpie); 
                    $('#conservaciontituloeditar').html('CONSERVACION:'+' '+respuestasconsola.conservacion); 
                    $('#vencimientomodaleditar').val(respuestasconsola.vencimiento); 
                    $('#corralmodaleditartitulo').html('CORRAL Nº:'+' '+respuestasconsola.corral); 
                    $('#corraleromodaleditartitulo').html('CORRALERO:'+' '+respuestasconsola.corralero); 
                    $('#matarifeeditartitulo').html('MATARIFE:'+' '+respuestasconsola.matarife); 
                    $('#productorselecteditartitulo').html('PRODUCTOR:'+' '+respuestasconsola.productor); 
                    $('#guiamodaleditar').val(respuestasconsola.guia); 
                    $('#fechaguiamodaleditar').val(respuestasconsola.fechaguia); 
                    $('#dtamodaleditar').val(respuestasconsola.dtamodal); 
                    $('#fechadtamodaleditar').val(respuestasconsola.fechadtamodal); 
                    $('#llenarprocedenciaeditartitulo').html('PROCEDENCIA:'+' '+respuestasconsola.llenarprocedencia); 
                    $('#provinciamodaleditartitulo').html('PROVINCIA:'+' '+respuestasconsola.provinciamodal); 
                    $('#localidadmodaleditartitulo').html('LOCALIDAD:'+' '+respuestasconsola.localidadmodal); 
                    $('#CPmodaleditar').val(respuestasconsola.CPmodal); 
                    $('#llenartransporteeditartitulo').html('TRANSPORTE:'+' '+respuestasconsola.llenartransporte); 
                    $('#llenarchofereditartitulo').html('CHOFER:'+' '+respuestasconsola.llenarchofer); 
                    $('#dnimodaleditar').val(respuestasconsola.dnimodal); 
                    $('#habilitacionmodaleditar').val(respuestasconsola.habilitacionmodal); 
                    $('#horasdeviajemodaleditar').val(respuestasconsola.horasdeviajemodal); 
                    $('#lavadomodaleditar').val(respuestasconsola.lavadomodal); 
                    $('#prescintomodaleditar').val(respuestasconsola.prescintomodal); 
                    $('#prescintomodalacopladoeditar').val(respuestasconsola.prescintomodalacoplado); 
                    $('#observacionmodaleditar').val(respuestasconsola.observacionmodal); 
                    $('#kiloscuerosmodaleditar').val(respuestasconsola.kiloscuerosmodal); 
                    $('#tropamodaleditar').val(respuestasconsola.numtropas);
                    $('#subespecietitulo').html('SUB-ESPECIES:'+' '+respuestasconsola.subespecie); 
                    $('#digestormuertoseditar').val(respuestasconsola.digestormuertos); 
                    $('#digestorcaidoseditar').val(respuestasconsola.digestorcaidos);
                    $('#tci').val(respuestasconsola.tci);
                    cantidadcorrales();
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
                  let tci = '';
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
                tci+=`${respuestasconsola.tci}`;
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
                  $('#tci_principal').val(tci);
                  llenar_clasificacion();
                  llenar_corral();
                  llenar_foto();
                  cantidadcorrales();
                  verificar_producto_ver(id_ingresos);
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
                      $('#primero').show();
                      $('#segundo').hide();
                      $('#tercero').hide();
                      $('#imprimirpdf').hide();
                      $('#imprimircsv').hide();
                      $('#imprimirreduccion').hide();

                    }
                    if(estado=='REDUCCION'){
                      var titular = document.getElementById("tracking");
                      titular.style.width="33%"; 
                      $('#etapa').html(estado);
                      $('#pasos').html('REDUCCION DE FAENA');
                      var box = document.getElementById("infobox");
                      box.class="info-box bg-danger";
                      var box = document.getElementById("infobox");
                      box.className="info-box bg-danger";
                      $('#primero').hide();
                      $('#segundo').hide();
                      $('#tercero').hide();
                      $('#imprimirpdf').hide();
                      $('#imprimircsv').hide();
                      $('#imprimirreduccion').show();


                    }
                    if(estado=='FAENA'){
                      var titular = document.getElementById("tracking");
                      titular.style.width="66%"; 
                      $('#etapa').html(estado);
                      $('#pasos').html('2/3');
                      var box = document.getElementById("infobox");
                      box.className="info-box bg-warning";
                      $('#primero').hide();
                      $('#segundo').show();
                      $('#tercero').hide();
                      $('#imprimirpdf').hide();
                      $('#imprimircsv').hide();
                      $('#imprimirreduccion').hide();

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
                      $('#imprimircsv').show();
                      $('#imprimirreduccion').hide();

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
    })

    $(document).on('click','#imprimirreduccion',(e)=>{
     let tropa=$('#tropa').val();
 
     funcion="verreduccion";
     $.post('../controlador/ListadoController.php',{funcion,tropa},(response)=>{
       
      let numtropa='';
      let clasificacion='';
      let cantidad='';
      let desde='';
      let hasta='';
      let reduccion='';
      let motivo='';
      let estado='';
      let corral='';
      let fecha='';
      let fechaingreso='';
      const resultado = JSON.parse(response);
      numtropa+=`${resultado.tropa}`
      clasificacion+=`${resultado.clasificacion}`
      cantidad+=`${resultado.cantidad}`
      desde+=`${resultado.desde}`
      hasta+=`${resultado.hasta}`
      reduccion+=`${resultado.reduccion}`
      motivo+=`${resultado.motivo}`
      estado+=`${resultado.estado}`
      corral+=`${resultado.corral}`
      fecha+=`${resultado.fecha}`
      fechaingreso+=`${resultado.fechaingreso}`

      $('#numero_tropa').val(numtropa);
      $('#clasificacion_garron').val(clasificacion);
      $('#cantidad_garron').val(cantidad);
      $('#desde_garron').val(desde);
      $('#hasta_garron_guardar').val(hasta);
      $('#quedan_garron').val(reduccion);
      $('#estado_garron').val(motivo);
      $('#numero_tropa').val(numtropa);
      $('#total_garron').val(estado);
      $('#corral_garron').val(corral);
      $('#fecha_ingreso').val(fecha);
      $('#fecha_reduccion').val(fechaingreso);
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