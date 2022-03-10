$(document).ready(function(){
    buscar_producto();
    cantidadcorrales();
    rellenar_corrales();
   
    function rellenar_corrales() {
        funcion="rellenar_corrales";
        $.post('../controlador/CorralController.php',{funcion},(response)=>{
            const corrales = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Nº Corral</option>`;
            corrales.forEach(corral => {

                template+=`
                    <option value="${corral.id}">${corral.nombre}</option>
                `;
            });
            $('#corral_garron').html(template);
        })
       
    }
    function cantidadcorrales(){
        funcion="verificarcorrales";
        $.post('../controlador/FinalizadoController.php',{funcion},(response)=>{
          
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
        $('#clasificacion').html(template);

    })

    }
    async function codigos_qr(id_ingresos){
        funcion="codigos_qr";
        let data=await fetch('../controlador/FinalizadoController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
            const id=JSON.parse(response);
            id.forEach(qr => {
                funcion="codigos";
                let id_qr = qr.id;
                let tropas = qr.tropa;
                let productor = qr.productor;
                let garron = qr.garron;
                let especie = qr.especie;
                let peso = qr.peso;
                let estado = qr.estado;
                let maximo = qr.maximo;
                let matarife = qr.matarife;
                $.post( "../controlador/ListadoController1.php",{funcion,id_qr,tropas,productor,garron,especie,peso,estado,maximo,matarife},(e)=>{
                } );
                
            });
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
      async function codigos_barras(id_ingresos){
        funcion="codigos_barras";
        let data=await fetch('../controlador/FinalizadoController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
              const id=JSON.parse(response);
              id.forEach(barras => {
                  $filepath="../etiquetas/barras/"+barras.id+".png";
                  $text=barras.id;
                  $.post( "../modelo/Codigobarras.php", { filepath:$filepath , text:$text} );
                  
              });
           
        } catch(error){
                //console.error(error);
                //console.log(response);
               
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
     
      }
      async function  etiquetas(id,ano,id_ingresos){
        funcion="tipo";
        let data=await fetch('../controlador/FinalizadoController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
               const especies=JSON.parse(response);
          
            if(especies.especie==4){
                $.post('../controlador/PDFEtiquetacaprinosController.php',{id,id_ingresos},(response)=>{
                    console.log(response);
                   if(response==''){
                    cerrar_loader('exito_generar');  
                    window.open('../pdf/etiquetas/pdf-'+id+'.pdf','_blank');
    
                    funcion = "buscarsiexisteetiqueta";
                    $.post("../controlador/etiquetasController.php",{ funcion, id, ano}, (response) => {
                
    
                let respuesta='';
                const respuestas=JSON.parse(response);
                respuesta+=respuestas.etiqueta
                      if(respuesta=='NO'){
                  funcion = "agregaretiqueta";
                  $.post("../controlador/etiquetasController.php",{ funcion, id, ano, guia, especie, subespecies, matarife },(response) => {
                   
                    if (response == "edit") {
                        Swal.fire({
                          title: "Se genero exitosamente la etiqueta",
                          showConfirmButton: false,
                        });
                        location.reload(true);
                      }
                    }
                  );
                  
                  $.post("../controlador/etiquetasController1.php",{ id, ano, guia, especie, subespecies, nombrematarife },(response) => {
                  
                }
                  );
                
                }else{
                  Swal.fire({
                    title: "Etiqueta Generada",
                    showConfirmButton: false,
                  });
                }
                          });
                   }else{
                    cerrar_loader('error_generar');  
                   }
                
                })
            }else{
                    $.post('../controlador/PDFEtiquetaovinosController.php',{id,id_ingresos},(response)=>{
                       if(response==''){
                        cerrar_loader('exito_generar');  
                        window.open('../pdf/etiquetas/pdf-'+id_ingresos+'.pdf','_blank');
        
                        funcion = "buscarsiexisteetiqueta";
                        $.post("../controlador/etiquetasController.php",{ funcion, id_ingresos}, (response) => {
     
                            let respuesta='';
                            const respuestas=JSON.parse(response);
                            respuesta+=respuestas.etiqueta
                                if(respuesta=='NO'){
                            funcion = "agregaretiqueta";
                            $.post("../controlador/etiquetasController.php",{ funcion, id,id_ingresos, ano, guia, especie, subespecies, matarife },(response) => {
                                if (response == "edit") {
                                    Swal.fire({
                                    title: "Se genero exitosamente la etiqueta",
                                    showConfirmButton: false,
                                    });
                                    location.reload(true);
                          }
                        }
                      );
                      $.post("../controlador/EtiquetasController1.php",{ id, ano, guia, especie, subespecies, nombrematarife },(response) => {
                    }
                      );
                    
                    }else{
                      Swal.fire({
                        title: "Etiqueta Generada",
                        showConfirmButton: false,
                      });
                    }
                              });
                       }else{
                        cerrar_loader('error_generar');  
                       }
                    
                    })
            }  
           
        } catch(error){
                //console.error(error);
                //console.log(response);
               
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
     
      }
    function buscar_producto() {
      let funcion="buscar";  
        $.post('../controlador/FinalizadoController.php',{funcion},(response)=>{ 

            let datatable = $('#tabla_finalizados').DataTable( {
                
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['etiqueta'] == "NO" )
                    {
                        $('td', nRow).css('background-color', '#f55454');
                    }
                    else if ( aData['etiqueta'] != "NO" )
                    {
                        $('td', nRow).css('background-color', '#4df030');
                    }
                },
              "ajax":{
                  "url":"../controlador/FinalizadoController.php",
                  "method": "POST",
                  "data":{funcion:funcion}
              },
              "columns": [
              { "data": "identificador" },
              { "data": "numtropas" },
              { "data": "enpie" },
              { "data": "garron" },
              { "data": "subespecies" },
              { "data": "promedio" },
              { "data": "conservacionnombre" },
              { "data": "destino" },
              { "data": "matarife" },
              { "data": "productor" },
              { "data": "guia" },
              { "data": "finalizado" },

                          
                  { "defaultContent": `
                                        <button class="ver btn btn-success" type="button"data-toggle="modal" data-target="#factura"><i class="fas fa-search"></i></button>
                                       <button class="imprimir btn btn-secondary" type="button"><i class="fas fa-file-pdf"></i></button>
                                       <button class="csvimprimir btn btn-info" type="button"><i class="fas fa-file-csv"></i></button>
                                       <button class="etiquetaimprimir btn btn-warning" type="button"><i class="fas fa-qrcode"></i></button>
                                       <br>
                                       
                                      </br>
                                       `}
              ],
              "language": espanol
          });

          $('#tabla_finalizados tbody').on('click','.whatsapp',function(){
            let datos = datatable.row($(this).parents()).data();
            let id = datos.identificador;
            funcion="datoswhatsapp"
            $.post('../controlador/WhatsappController.php',{funcion,id},(response)=>{
          
            let id='';
            let especie='';
            let subespecies='';
            let matarife='';
            let guia='';
            let numtropas='';
            let cantidad='';
            let numtropas1='';
            let telefono='';
            const respuestas=JSON.parse(response);
            id+=respuestas.id;
            especie+=respuestas.especie;
            subespecies+=respuestas.subespecies;
            matarife+=respuestas.matarife;
            guia+=respuestas.guia;
            numtropas1+=respuestas.numtropas;
            cantidad+=respuestas.cantidad;
            telefono+=respuestas.telefono;
            let datos=new Date()
            if(telefono=='null'){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'NO EXISTE NUMERO PARA ESTE MATARIFE',
                    showConfirmButton: false,
                    timer: 1500
                  })
              
            }else{
               Mostrar_Loaderwhatsapp('Enviando_Whatsapp');
                const urlDesktop = 'https://web.whatsapp.com/';
            const urlMobile = 'whatsapp://';
            const phone = telefono;
                setTimeout(() => {
                    let name = matarife;
                    let lastname = especie;
                    let email = guia;
                    let message = 'send?phone=' + phone + '&text=MATADERO FRIGORIFICO REGIONAL MALARGÜE LE INFORMA:%0A '+datos+' %0A  Sr/a: ' +matarife+' la faena de la especie: '  + especie + '%0A perteniciente a la Tropa Nº: ' + numtropas1 + ' con numero de Dt-e: ' + guia+ '%0A ha finalizado*%0A GRACIAS'
                    if (isMobile()) {
                        window.open(urlMobile + message, '_blank')
                    } else {
                        window.open(urlDesktop + message, '_blank')
                   }
    
                }, 4000);
                cerrar_loaderwhatsapp('exito_generar'); 
            }
           
            
              
            })       
        })  

          $('#tabla_finalizados tbody').on('click','.etiquetaimprimir',function(){
            Mostrar_Loader('Generando_Pdf');
            let datos = datatable.row($(this).parents()).data();
            let tropas = datos.numtropas;
            let id = datos.numtropas;
            var ano = new Date().getFullYear();
            let especie = datos.especie;
            let guia = datos.guia;
            let subespecies = datos.subespecies;
            let matarife = datos.id_matarife;
            let nombrematarife=datos.matarife;
            let id_ingresos=datos.identificador;
            codigos_qr(id_ingresos);
            codigos_barras(id_ingresos);
            etiquetas(id,ano,id_ingresos);
        })
          $('#tabla_finalizados tbody').on('click','.imprimir',function(){
            Mostrar_Loader('Generando_Pdf');
            let datos = datatable.row($(this).parents()).data();
            let id = datos.identificador;
            let tropas = datos.numtropas;
            $.post('../controlador/PDFFinalizadoController.php',{id,tropas},(response)=>{
               if(response==''){
                cerrar_loader('exito_generar');  
                window.open('../pdf/finalizados/pdf-finalizados.pdf','_blank');
               }else{
                cerrar_loader('error_generar');  
               }
            })       
        })      
    
        $('#tabla_finalizados tbody').on('click','.ver',function(){
            let datos = datatable.row($(this).parents()).data();
            let id = datos.identificador;
           let destinatario=datos.matarife;
           let guia=datos.guia;
           let tropa=datos.numtropas;
           let especie=datos.especie;
           let subespecie=datos.subespecies;
           let enpie=datos.enpie;
           $('#idpdf').val(id);
           $('#destinatario').html(destinatario);
           $('#guia').html('DTE:'+' '+guia);
           $('#tropa').html('Numero de Tropa:'+' '+tropa);
           $('#especie').html('Especie:'+' '+especie);
           $('#subespecie').html('Subespecie:'+' '+subespecie);
           $('#enpie').html(enpie);

        funcion="facturacion";
        $.post('../controlador/FinalizadoController.php',{funcion,id},(response)=>{
            const tipos = JSON.parse(response);
            let template='';
            tipos.forEach(tipo => {
                template+=`
                    <tr  clasId="${tipo.id}"clasAno="${tipo.ano}"clasGarron="${tipo.garron}"clasPeso="${tipo.peso}"clasDestino="${tipo.destino}">                                              
                        <td>${tipo.id}</td>
                        <td>${tipo.ano}</td>
                        <td>${tipo.garron}</td>
                        <td>${tipo.peso}</td>
                        <td>${tipo.destino}</td>
                    </tr>
                `;
                $('#kilosenpie').html(tipo.kilos); 
        });
        $('#facturacion').html(template);   
    })         
        })      
        $('#tabla_finalizados tbody').on('click','.csvimprimir',function(){
            Mostrar_Loadercsv('Generando_Csv');
            let datos = datatable.row($(this).parents()).data();
            let id = datos.identificador;
            let conservacion = datos.conservacion;
            let tropa = datos.numtropas;
            let especie = datos.especie;

            if(conservacion==4){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'NO SE REALIZA CSV. GRACIAS',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                
            funcion="verificardatos";
            $.post('../controlador/FinalizadoController.php',{funcion,id},(response)=>{
                let despiece='';
                const respuestas=JSON.parse(response);
                despiece+=respuestas.despiece
                if(despiece=='null'){
                    funcion="buscarconservacion";
                    $.post('../controlador/FinalizadoController.php',{funcion,especie},(response)=>{
                        if(response=='add'){
                        funcion="buscarconservacion1";
                        $.post('../controlador/FinalizadoController.php',{funcion,especie},(response)=>{
                        let respuesta='';
                        const respuestas=JSON.parse(response);
                        respuesta+=respuestas.codigo
                        funcion="agregarconservacion";
                        $.post('../controlador/FinalizadoController.php',{funcion,id,respuesta},(response)=>{
                        })
                    })
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'VERIFIQUE EL DESPIECE... POR FAVOR',
                            showConfirmButton: false,
                            timer: 1500
                          })
                    }
                    })    

                }else{
                    let funcion1="reporte_excel";
                    $.post('../controlador/ExcelController.php',{funcion1,id},(response)=>{
                       if(response==''){
                        cerrar_loadercsv('exito_generar');  
                        window.open('../csv/reporte_matanza-'+id+'.Csv','_blank');
                       }else{
                        cerrar_loadercsv('error_generar');  
                       }
                    })
                

                }

            })
               



            }
            
           
            
        })    
    })
    }

})



$(document).on('click','#imprimirpdf',(e)=>{
    Mostrar_Loader('Generando_Pdf');
    let id=$('#idpdf').val();
    let tropas=$('#tropa').html();
            $.post('../controlador/PDFFinalizadoController.php',{id,tropas},(response)=>{
               if(response==''){
                cerrar_loader('exito_generar');  
                window.open('../pdf/finalizados/pdf-finalizados.pdf','_blank');
               }else{
                cerrar_loader('error_generar');  
               }
            })

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

    function Mostrar_Loadercsv(Mensaje){
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
                case 'Generando_Csv':
                texto=' Generando Csv. Por favor espere...';
                mostrar=true;
                break;
        
        }
        if(mostrar){
            Swal.fire({
                title: 'Generando Csv',
                text: texto,
                showConfirmButton:false
              })
        }
    }
    function cerrar_loadercsv(Mensaje){
        var tipo=null;
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
            case 'exito_generar':
                tipo='success';
                texto=' El Csv se genero correctamente...';
                mostrar=true;
                break;
                    case 'error_generar':
                        tipo='error';
                        texto=' El Csv no puede generarse... Por favor intente de nuevo';
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
    function Mostrar_Loaderwhatsapp(Mensaje){
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
                case 'Enviando_Whatsapp':
                texto=' Enviando Whatsapp. Por favor espere...';
                mostrar=true;
                break;
        
        }
        if(mostrar){
            Swal.fire({
                title: 'Enviando Whatsapp',
                text: texto,
                showConfirmButton:false
              })
        }
    }
    function cerrar_loaderwhatsapp(Mensaje){
        var tipo=null;
        var texto=null;
        var mostrar=false;
        switch (Mensaje) {
            case 'exito_generar':
                tipo='success';
                texto=' El  Whatsapp se envio correctamente...';
                mostrar=true;
                break;
                    case 'error_generar':
                        tipo='error';
                        texto=' El Whatsapp no puede generarse... Por favor intente de nuevo';
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