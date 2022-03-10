$(document).ready(function(){
    $('#quedan_garron').hide();
    $('#finalzado').hide();
    $('#siguiente').hide();
    $('#reducir').hide();
    $('#matanza').hide();
    $('#clasificacioncorralreduccion').hide();
    $('#clasificacioncorralreduccion1').hide();
    $('#clasificacioncorralreduccion2').hide();
    $('#camaraelegir').hide();
    $('#alerta').hide();
    buscar_producto();
    cantidadcorrales();
    rellenar_corrales();
    botonaparecer();
    cantidadcorralesreduccion();
    rellenar_camaras();
    function rellenar_camaras() {
        funcion="rellenar_camaras";
        $.post('../controlador/camaraController.php',{funcion},(response)=>{
            const camaras = JSON.parse(response);
            let template='';
            camaras.forEach(camara => {
  
                template+=`
                    <option value="${camara.id}">${camara.nombre}</option>
                `;
            });
            $('#elegir_camara').html(template);
          
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
    function botonaparecer(){
        $('#siguiente').hide();
        $('#reducir').hide();
        $('#pesogarron').val('');
       
    }
    function rellenar_corrales() {
        funcion="rellenar_corrales";
        $.post('../controlador/corralController.php',{funcion},(response)=>{
            const corrales = JSON.parse(response);
            let template='';
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
        $('#clasificacion').html(template);

    })

    }
    function buscar_producto() {
        let funcion="buscar";  
        $.post('../controlador/ParcialController.php',{funcion},(response)=>{ 
            let datatable = $('#tabla_listados').DataTable( {
              "ajax":{
                  "url":"../controlador/ParcialController.php",
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
              { "data": "corral" },
              { "data": "destino" },
              { "data": "matarife" },
              { "data": "productor" },
              { "data": "guia" },
              { "data": "totalidad" },

                          
                  { "defaultContent": `<button class="procesar btn btn-success" data-toggle="modal" data-target="#garrones" type="button">PROCESAR</button>
                                      `}
              ],
              "language": espanol
          });
          $('#tabla_listados tbody').on('click','.imprimir',function(){
            Mostrar_Loader('Generando_Pdf');
            let datos = datatable.row($(this).parents()).data();
            let id = datos.identificador;
           
            $.post('../controlador/PDFParcialController.php',{id},(response)=>{
                if(response==''){
                    cerrar_loader('exito_generar');  
                    window.open('../pdf/Parcial/pdf-'+id+'.pdf','_blank');
                   }else{
                    cerrar_loader('error_generar');  
                   }
                   
              
            })       
        }) 
        $('#tabla_listados tbody').on('click','.procesar',function(){
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;
            let tropas = datos.numtropas;
            let cantidad = datos.enpie;
            let clasificacion = datos.subespecies;
            let promedio = datos.promedio;
            let corral = datos.corral;
            let destino = datos.destino;
            let destinocodigo = datos.destinocodigo;
            let matarife = datos.matarife;
            let id_matarife = datos.id_matarife;
            let productor = datos.productor;
            let guia = datos.guia;
            let desde = datos.desde;
            let hasta = datos.hasta;
            let seleccionado = datos.seleccionado;
            let id_especies = datos.id_especies;
            let codigo = datos.codigo;
            funcion="buscarestadosfaenas";
            $.post('../controlador/ParcialController.php',{funcion,tropas},(response)=>{
                let cantidad='';
                const respuesta = JSON.parse(response);
                cantidad+=`${respuesta.total}`
                $('#cantidad1').val(cantidad);
            }) 
            funcion="cantidadbuscarestadosfaenas";
            $.post('../controlador/ParcialController.php',{funcion,tropas},(response)=>{
                let cantidad='';
                const respuesta = JSON.parse(response);
                cantidad+=`${respuesta.total}`
                $('#cantidad2').val(cantidad);
            })
            funcion="totalparafaenar";
            $.post('../controlador/ParcialController.php',{funcion,tropas},(response)=>{
            let cantidad='';
            const respuesta = JSON.parse(response);
            cantidad+=`${respuesta.total}`
            $('#quedandesdehasta').html('Quedan para Completar Faena:'+' '+cantidad);
            $('#quedanparafinalizar').val(cantidad);
            

            })

            $('#matanza').show();
            $('#titulo_matanza').html('Matanza'+' '+'Especie:'+' '+clasificacion+'-'+'Tropa Nº:'+' '+tropas+'-'+'Matarife:'+' '+matarife);
            $('#cantidad_cabezas').html('Cabezas:'+' '+cantidad);
            $('#garrondesdehasta').html('Garrones:'+' '+'Desde:'+' '+desde+'--'+'hasta:'+''+hasta);
            
            $('#maximo').val(hasta);
            $('#tropasnum').val(tropas);
            $('#productor').val(productor);
            $('#matarifeid').val(id_matarife);
            $('#desdeid').val(desde);
            $('#especiesid').val(id_especies);
            $('#codigo').val(codigo);
            $('#destinocsv').val(destinocodigo);
            botonaparecer();
            funcion="procesado";
            $.post('../controlador/ParcialController.php',{funcion,tropas},(response)=>{
               
                if(response=="noadd"){
                    $('#numgarron').val(desde);
                    $('#clasificaciongarron').val(clasificacion);
                }else{
                    $('#clasificaciongarron').val(clasificacion);
                    funcion="buscarmatanza";
                    $.post('../controlador/ListadoController.php',{funcion,tropas},(response)=>{
                       
                        let garron='';
                        const garrones=JSON.parse(response);
                        garron+=`${garrones.garron}`;
                        $('#numgarron').val(parseFloat(garron)+parseFloat(1));
                        let resultado=hasta-garron;
                        if(resultado<3){
                            $('#alerta').show();
                        $('#alertatexto').html('PELIGRO quedan para procesar'+' '+resultado+' '+'animales');
                        }
                        funcion="matanzaestado";
                        $.post('../controlador/ParcialController.php',{funcion,tropas,desde,hasta},(response)=>{
                          
                            if(response=='SI'){
                            let maximo=$('#maximo').val();
                            $('#siguiente').hide();
                            $('#reducir').hide();
                            $('#finalzado').show();
                            $('#estadodect').val('FINALIZADO');
                            $('#numgarron').val(maximo);
                            var titular = document.getElementById("tracking");
                            titular.style.width='100%'; 
                            $('#pesogarron').hide();
                            $('#pesogarron1').hide();
                        }else{
                            $('#siguiente').show();
                            $('#reducir').hide();
                            $('#finalzado').hide();
                            $('#estadodect').val('PARCIAL');
                            let cantidad=$('#numgarron').val();
                            let maximo=$('#maximo').val();
                            let valor=parseFloat(cantidad)+parseFloat(1);
                            
                            let promedio=valor*100/maximo;
                            var titular = document.getElementById("tracking");
                            titular.style.width=promedio + '%'; 
                        }

                            })   
                        
                    })
                }
            })    
            
            
      })
      $(document).on('click','#siguiente',(e)=>{
        let tropas= $('#tropasnum').val();
        let productor= $('#productor').val();
        let garron= $('#numgarron').val();
        let especie= $('#clasificaciongarron').val();
        let peso= $('#pesogarronguardar').val();
        let estado= $('#estadodect').val();
        let id_matarife=$('#matarifeid').val();
        let desde=$('#desdeid').val();
        let hasta=$('#maximo').val();
        let id_especies=$('#especiesid').val();
        let codigo=$('#codigo').val();
        let destinocsv=$('#destinocsv').val();
        let resultado1=$('#maximo').val();
        let resultado=resultado1-garron;
       
        if(resultado1-garron<3){
            $('#alerta').show();
        $('#alertatexto').html('PELIGRO quedan para procesar'+' '+resultado+' '+'animales');
        }

        funcion="buscarestadosfaenas";
        $.post('../controlador/ParcialController.php',{funcion,tropas},(response)=>{
           
        }) 

        funcion="guardarmatanza";
             $.post('../controlador/ParcialController.php',{funcion,tropas,productor,garron,especie,peso,estado,codigo,id_especies,destinocsv},(response)=>{
               
                if(response=='add'){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Guardado',
                      showConfirmButton: false,
                      timer: 3000
                    }) 
        
                }
            })
        let cantidad=$('#numgarron').val();
        let maximo=$('#maximo').val();
        let valor=parseFloat(cantidad)+parseFloat(1);
         $('#numgarron').val(valor);
         let promedio=valor*100/maximo;
         var titular = document.getElementById("tracking");
         titular.style.width=promedio + '%'; 
         botonaparecer();
         $.post("../controlador/ListadoController1.php",{ tropas,productor,garron,especie,peso,estado,maximo,id_matarife},(response) => {

        });
               
         if(valor>maximo){
             $('#siguiente').hide();
             $('#reducir').hide();
             $('#finalzado').show();
             $('#estadodect').val('FINALIZADO');
             $('#pesogarron').hide();
            $('#pesogarron1').hide();
            $('#camaraelegir').show();
            if(estado=='FINALIZADO'){
                funcion="guardardatosfinalizados";
                $.post('../controlador/ParcialController.php',{funcion,tropas,desde,hasta},(response)=>{
                       }) 
                       location.reload(true);
                       cantidadcorrales();   
                     
                
             }
               
         }else{
            $('#finalzado').hide();
           
         }
         if(estado=='FINALIZADO'&& $('#quedanparafinalizar').val()==0){
          
            funcion="estadomatanza";
            $.post('../controlador/ParcialController.php',{funcion,tropas},(response)=>{
                   }) 
                   funcion="estadomatanzaproceso";
                   $.post('../controlador/ParcialController.php',{funcion,tropas,id_matarife},(response)=>{
                          })
                  } 
            })
            $(document).on('click','#camaraelegir',(e)=>{
                let tropas=$('#tropasnum').val();
                let especie=$('#clasificaciongarron').val();
                let id_matarife=$('#matarifeid').val();
            $('#numero_tropa_camara').val(tropas);
            $('#clasificacion_garron_camara').val(especie);
            $('#matarife_camara').val(id_matarife);
            rellenar_camaras();
            })
            $('#form-camara-garron').submit(e=>{
                let tropas=$('#numero_tropa_camara').val();
                let especie=$('#clasificacion_garron_camara').val();
                let camara=$('#elegir_camara').val();
                let id_matarife=$('#matarife_camara').val();
                
                
                        funcion="estadomatanza";
                        $.post('../controlador/ListadoController.php',{funcion,tropas},(response)=>{
                               }) 
                               funcion="camarasdestino";
                               $.post('../controlador/ListadoController.php',{funcion,tropas,camara},(response)=>{
                                  
                                      })
                               funcion="estadomatanzaproceso";
                               $.post('../controlador/ListadoController.php',{funcion,tropas,id_matarife},(response)=>{
                                
                                      })
                                      funcion="camaraproceso";
                                      $.post('../controlador/ListadoController.php',{funcion,tropas,id_matarife,camara},(response)=>{
                                        location.reload(true);
                                             })
                                      
                e.preventDefault();
            })

            $(document).on('keyup','#pesogarron',function(){
                let valor = $(this).val();
                $('#pesogarronguardar').val(valor);
                let tropas= $('#tropasnum').val();
                let ultimo=$('#maximo').val();
                let cantidad=$('#numgarron').val();
                let maximo=$('#maximo').val();
                let valor1=parseFloat(cantidad)+parseFloat(1);
                if(cantidad==maximo){
                    $('#estadodect').val('FINALIZADO');
                }else{
                   $('#finalzado').hide();
                }

                if(valor==''){
                    $('#siguiente').hide();
                    $('#reducir').hide();
                }else{
                    $('#siguiente').show();
                    $('#reducir').hide();
                }
                
            })


    })
    
    }

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