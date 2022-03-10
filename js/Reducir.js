$(document).ready(function(){
    buscar_reduccion();
    buscar_reduccion_vuelta();
    cantidadcorrales();
    rellenar_camaras();
    $('#guardargarron_volver').hide();
    $('#form_reducido_vuelta').hide();
    $('#reducido').hide();
    $('#matanza').hide();
    $('#finalzado').hide();
    botonaparecer();
    $('#alerta').hide();
    $('#camaraelegir').hide();
    $("#guardargarronpeso").hide();
    

    $(document).on("keyup", "#editar_peso", function () {
      let valor = $(this).val();
      if (valor == ""||0) {
          $("#guardargarronpeso").hide();
      } else {
          $("#guardargarronpeso").show();
      }
    });


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
    function cantidadcorrales(){
        funcion="verificarcorralreducciontropa";
        $.post('../controlador/ReducirController.php',{funcion},(response)=>{
            const tipos = JSON.parse(response);
            let template='';
            tipos.forEach(tipo => {
                template+=`
                    <tr clasCorral="${tipo.corral}"clasCantidad="${tipo.cantidad}"clasEspecie="${tipo.especie}"clasSubespcie="${tipo.subespecie}">                                              
                        <td> 
                        ${tipo.corral}                          
                        </td>
                        <td>${tipo.cantidad}</td>
                        <td>${tipo.subespecie}</td>
                    </tr>
                `;
        });
        $('#clasificacion').html(template);

    })
    }
    


function buscar_reduccion() {
funcion="buscar_reduccion_existe";
$.post('../controlador/ReducirController.php',{funcion},(response)=>{ 

    if(response=='add'){
        $('#reducido').show();
        let funcion="buscar_reduccion";  
        $.post('../controlador/ReducirController.php',{funcion},(response)=>{  
    
            let datatable = $('#tabla_reduccion_faenas').DataTable( {
              "ajax":{
                  "url":"../controlador/ReducirController.php",
                  "method": "POST",
                  "data":{funcion:funcion}
              },
              "columns": [
              { "data": "id" },
              { "data": "numtropas" },
              { "data": "enpie" },
              { "data": "subespecies" },
              { "data": "promedio" },
              { "data": "corral" },
              { "data": "destino" },
              { "data": "matarife" },
              { "data": "productor" },
              { "data": "guia" },
    
                          
                  { "defaultContent": `<button class="agregar_faena btn btn-danger" data-toggle="modal" data-target="#volver" type="button">PASAR A FAENA</button>
                                      
                                      `}
              ],
              
              "language": espanol
          });
          $('#tabla_reduccion_faenas tbody').on('click','.agregar_faena',function(){
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
            let productor = datos.productor;
            let guia = datos.guia;
            let reducir = datos.id_reducir;
            let id_matarife = datos.id_matarife;
            let id_especies = datos.id_especies;
            let codigo = datos.codigo;
            $('#numero_tropa_volver').val(tropas);
            $('#clasificacion_garron_volver').val(clasificacion);
            $('#cantidad_garron_volver').val(cantidad);
            $('#numero_matarife_volver').val(id_matarife);
            $('#id_garron_volver').val(reducir);

            funcion="verificarreduccion";//comprueba la tropa reducida para procesar
            $.post('../controlador/ReducirController.php',{funcion,tropas},(response)=>{
                if(response=='noadd'){
                    funcion="reduccionfaena";
                    $.post('../controlador/ReducirController.php',{funcion,tropas,reducir},(response1)=>{
                        let desde = '';
                        let hasta = '';
                          const respuestasconsola = JSON.parse(response1);
                          desde+=`${respuestasconsola.desde}`;
                          hasta+=`${respuestasconsola.hasta}`;

                        $('#desde_garron_volver').val(desde);
                        $('#cantidad_garron_id').val(hasta);
                          let selector= document.getElementById('hasta_garron_volver');
                          let limite= (parseFloat(hasta)-parseFloat(desde))+parseFloat(1);
                          
                          for (let i = 0; i < limite; i++) {
                              selector.options[i] = new Option(i,+i); 
       }
    
                    })
    
                }else{
                  $('#desde_garron_volver').val(1);
                  let selector= document.getElementById('hasta_garron_volver');
                  let limite= parseFloat($('#cantidad_garron_volver').val())+parseFloat(1);
                  for (let i = 0; i < limite; i++) {
                      selector.options[i] = new Option(i,+i); 
    }
                }
            })     
      })
    })
    }else{
        $('#form_reducido').hide();
    }

})
}
function buscar_reduccion_vuelta() {
    funcion="buscar_reduccion_existe_vuelta";
    $.post('../controlador/ReducirController.php',{funcion},(response)=>{ 
        if(response=='add'){
            $('#form_reducido_vuelta').show();
            $('#form_reducido').hide();
            let funcion="buscar_reduccionfaena";  
            $.post('../controlador/ReducirController.php',{funcion},(response)=>{ 
                let datatable = $('#tabla_reduccion_faenas_vuelve').DataTable( {
                  "ajax":{
                      "url":"../controlador/ReducirController.php",
                      "method": "POST",
                      "data":{funcion:funcion}
                  },
                  "columns": [
                  { "data": "id" },
                  { "data": "numtropas" },
                  { "data": "enpie" },
                  { "data": "subespecies" },
                  { "data": "promedio" },
                  { "data": "corral" },
                  { "data": "destino" },
                  { "data": "matarife" },
                  { "data": "productor" },
                  { "data": "guia" },
        
                              
                      { "defaultContent": `<button class="agregar_faena_vuelta btn btn-success" type="button">PROCESAR FAENA</button>
                                          
                                          `}
                  ],
                  
                  "language": espanol
              });
              $('#tabla_reduccion_faenas_vuelve tbody').on('click','.agregar_faena_vuelta',function(){
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
                $('#nombrematarife').val(matarife);
                $('#matanza').show();
                $('#titulo_matanza').html('Matanza'+' '+'Especie:'+' '+clasificacion+'-'+'Tropa Nº:'+' '+tropas+'-'+'Matarife:'+' '+matarife);
                $('#cantidad_cabezas').html('Cabezas:'+' '+cantidad);
                $('#garrondesdehasta').html('Garrones:'+' '+'Desde:'+' '+desde+'--'+'hasta:'+''+hasta);
                $('#numgarron').val(desde);
                $('#maximo').val(hasta);
                $('#tropasnum').val(tropas);
                $('#productor').val(productor);
                $('#matarifeid').val(id_matarife);
                $('#clasificaciongarron').val(clasificacion);
                $('#especiesid').val(id_especies);
                $('#codigo').val(codigo);
                $('#destinocsv').val(destinocodigo);
    funcion="vercamaraprocesado";
            $.post('../controlador/ListadoController.php',{funcion,tropas},(response)=>{
            
                if(response=='SI'){
                    $('#camaraelegir').show();
                    rellenar_faenados();
                }else{
                    $('#camaraelegir').hide();
                    rellenar_faenados();
                }
            })
                funcion="procesado";
                $.post('../controlador/ListadoController.php',{funcion,tropas},(response)=>{
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
                                $.post('../controlador/ListadoController.php',{funcion,tropas},(response)=>{
                                if(response=='FINALIZADO'){
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
              })
        }
      })
    }
    $(document).on('click','#siguiente',(e)=>{

      let tropas= $('#tropasnum').val();
      let productor= $('#productor').val();
      let garron= $('#numgarron').val();
      let especie= $('#clasificaciongarron').val();
      let peso= $('#pesogarronguardar').val();
      let estado= $('#estadodect').val();
      let id_matarife=$('#matarifeid').val();
      let id_especies=$('#especiesid').val();
      let codigo=$('#codigo').val();
      let destinocsv=$('#destinocsv').val();
      let resultado1=$('#maximo').val();
      let nombrematarife=$('#nombrematarife').val();
      let resultado=resultado1-garron;
      let idultimo=$('#ultimoid').val();
 
      if(resultado1-garron<3){
        $('#alerta').show();
    $('#alertatexto').html('PELIGRO quedan para procesar'+' '+resultado+' '+'animales');
    }
      funcion="guardarmatanza";
     
      $.post('../controlador/ParcialController.php',{funcion,tropas,productor,garron,especie,peso,estado,codigo,id_especies,destinocsv,idultimo},(response)=>{
             
            if(response=='add'){
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 3000
                  }) 
              }
              rellenar_faenados();
          })
          
      botonaparecer();
      let cantidad=$('#numgarron').val();
      let maximo=$('#maximo').val();
      let valor=parseFloat(cantidad)+parseFloat(1);
       $('#numgarron').val(valor);
       let promedio=valor*100/maximo;
       var titular = document.getElementById("tracking");
       titular.style.width=promedio + '%'; 
       botonaparecer();
       $.post("../controlador/ListadoController1.php",{ tropas,productor,garron,especie,peso,estado,maximo,nombrematarife},(response) => {
       
                });
                let id=$('#ultimoid').val();
                $.post( "../modelo/Codigobarras.php", { filepath: "../etiquetas/barras/"+id+".png", text:id } );
       if(valor>maximo){
           $('#siguiente').hide();
           $('#reducir').hide();
           $('#finalzado').show();
           $('#estadodect').val('FINALIZADO');
           $('#pesogarron').hide();
          $('#pesogarron1').hide();
          $('#camaraelegir').show();
         
                 funcion="estadomatanzaproceso";
                 $.post('../controlador/ListadoController.php',{funcion,tropas,id_matarife},(response)=>{
                        })
       }else{
          $('#finalzado').hide();
         
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
                funcion="ultimoidfaenados";
                $.post("../controlador/ListadoController.php",{funcion},(response)=>{
                
                  let idultimo='';
                  const respuesta=JSON.parse(response);
                  idultimo+=`${respuesta.id}`;
                  $('#ultimoid').val(idultimo);
        
                })
            }
            
        })
$(document).on('click','#hasta_garron_volver',(e)=>{
let cantidad=$('#cantidad_garron_volver').val();
$("#hasta_garron_volver").change(function(){  
  $("#hasta_garron_volver option:selected").each(function (){
    valor = $(this).val();
  let valornominal=$('#hasta_garron_guardar_volver').val();

    if(valor>= 0){
   var desde=$('#desde_garron_volver').val();
  $('#hasta_garron_guardar_volver').val(parseFloat(desde)+parseFloat(valor));
  }   
  if($('#cantidad_garron_id').val()==$('#hasta_garron_guardar_volver').val()){
      $('#estado_garron_volver').val('TOTALIDAD');
      $('#guardargarron_volver').show();
  }else{
      $('#estado_garron_volver').val('PARCIAL');
      $('#guardargarron_volver').hide();
  }

        })
      })
  })

$('#form-crear-garron_volver').submit(e=>{
let tropa = $('#numero_tropa_volver').val();
let clasificacion = $('#clasificacion_garron_volver').val();
let cantidad = $('#cantidad_garron_volver').val();
let desde = $('#desde_garron_volver').val();
let hasta = $('#hasta_garron_guardar_volver').val();
let estado = $('#estado_garron_volver').val();
let seleccionado = $('#hasta_garron_volver').val();
let id_matarife =  $('#numero_matarife_volver').val();

funcion="agregar";
$.post('../controlador/ReducirController.php',{funcion,cantidad},(response)=>{

})
e.preventDefault();
if(estado=='TOTALIDAD'){

funcion="crearvolver";
$.post('../controlador/ReducirController.php',{funcion,tropa,id_matarife},(response)=>{
    if(response=='add'){
    funcion="buscarid";
    $.post('../controlador/ReducirController.php',{funcion},(response)=>{
        let id='';
        const idultimo = JSON.parse(response);
        id+=`${idultimo.id}`;
              funcion="reemplazar";
              $.post('../controlador/ReducirController.php',{funcion,id,hasta},(response)=>{
              })
              funcion="reemplazarestado";
              $.post('../controlador/ReducirController.php',{funcion,tropa},(response1)=>{
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'ENVIADO A FAENA',
                  showConfirmButton: false,
                  timer: 3000
                }) 
                funcion="crearvolverparcial";
                $.post('../controlador/ReducirController.php',{funcion,tropa,clasificacion,cantidad,desde,hasta,estado,seleccionado,id_matarife},(response)=>{
                })
                
              })
             
    })
  $('#form-crear-garron_volver').trigger('reset');
  location.reload(true);
}
if(response=='noadd'){
  
  Swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'La Especificacion ya existe',
      showConfirmButton: false,
      timer: 1500
      
    })
  $('#form-crear-garron_volver').trigger('reset');
  location.reload(true);
}
})

} else{

  funcion="crearvolverparcial";
$.post('../controlador/ReducirController.php',{funcion,tropa,clasificacion,cantidad,desde,hasta,estado,seleccionado,id_matarife},(response)=>{

    if(response=='add'){
      let id=$('#id_garron_volver').val();
      funcion="reemplazarestadoreducir";
      $.post('../controlador/ReducirController.php',{funcion,id},(response)=>{
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Guardado',
          showConfirmButton: false,
          timer: 3000
        }) 
        location.reload(true);
        
      }) 
    
  $('#form-crear-garron_volver').trigger('reset');
}
if(response=='noadd'){
  
  Swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'La Especificacion ya existe',
      showConfirmButton: false,
      timer: 1500
      
    })
  $('#form-crear-garron_volver').trigger('reset');
  location.reload(true);
}

})
}
e.preventDefault();
});

function botonaparecer(){
  $('#siguiente').hide();
  $('#reducir').hide();
  $('#pesogarron').val('');
 
}
$("#form-editar-garron").submit((e) => {
  let tropas = $("#numero_tropa_editar").val();
  let garron = $("#garron_id").val();
  let peso = $("#peso_garron").val();
  let peso_editar = $("#editar_peso").val();
  let id = $("#id_editar").val();

  funcion = "editargarronpeso";
  $.post(
    "../controlador/ListadoController.php",
    { funcion, tropas, garron, peso, peso_editar, id },
    (response) => {
      
      if (response == "SI") {
        Swal.fire({
          icon: "success",
          title: "Editado",
          text: "Se ha editado el peso con exito",
        });
        $("#form-editar-garron").trigger("reset");
      }
      location.reload(true);
    }
  );

  e.preventDefault();
});

function rellenar_faenados() {
  let tropas = $("#tropasnum").val();

  let funcion = "buscargarronfaenados";


  let datatable = $("#form_listado_garron").DataTable({
    destroy: true,
    ajax: {
      url: "../controlador/ListadoController.php",
      method: "POST",
      data: {
        funcion: funcion,
        tropas: tropas,
      },
    },
    columns: [
      { data: "tropa" },
      { data: "especie" },
      { data: "garron" },
      { data: "peso" },

      {
        defaultContent: `<button class="editar btn btn-warning" data-toggle="modal" data-target="#editargarron" type="button">Editar</button>
                                     
                                    `,
      },
    ],
    language: espanol,
  });

  $("#form_listado_garron tbody").on("click", ".editar", function () {
    let datos = datatable.row($(this).parents()).data();
    let id = datos.id_faenados;
    let tropas = datos.tropa;
    let garron = datos.garron;
    let peso = datos.peso;
    $("#numero_tropa_editar").val(tropas);
    $("#garron_id").val(garron);
    $("#peso_garron").val(peso);
    $("#id_editar").val(id);
  });
}
function recuperar(e) {
  if (e.keyCode == 13) {
      var tb = document.getElementById("pesogarronguardar");
      eval(tb.value);
      let peso=tb.value;
      
      let tropas = $("#tropasnum").val();
      let productor = $("#productor").val();
      let garron = $("#numgarron").val();
      let especie = $("#clasificaciongarron").val();
     
      let estado = $("#estadodect").val();
      let id_matarife = $("#matarifeid").val();
      let id_especies = $("#especiesid").val();
      let codigo = $("#codigo").val();
      let destinocsv = $("#destinocsv").val();
      let resultado1 = $("#maximo").val();
      let nombrematarife = $("#nombrematarife").val();
      let idultimo=$('#ultimoid').val();

      let resultado = resultado1 - garron;

      if (resultado1 - garron < 3) {
        $("#alerta").show();

        $("#alertatexto").html(
          "PELIGRO quedan para procesar" + " " + resultado + " " + "animales"
        );
      }
      funcion = "guardarmatanza";
      $.post(
        "../controlador/ListadoController.php",
        {
          funcion,
          tropas,
          productor,
          garron,
          especie,
          peso,
          estado,
          id_especies,
          codigo,
          destinocsv,
          idultimo,
        },
        (response) => {
          if (response == "add") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Guardado",
              showConfirmButton: false,
              timer: 1500,
            });
            let tropas = $("#tropasnum").val();

            let funcion = "buscargarronfaenados";
         
        
            let datatable = $("#form_listado_garron").DataTable({
              destroy: true,
              ajax: {
                url: "../controlador/ListadoController.php",
                method: "POST",
                data: {
                  funcion: funcion,
                  tropas: tropas,
                },
              },
              columns: [
                { data: "tropa" },
                { data: "especie" },
                { data: "garron" },
                { data: "peso" },
        
                {
                  defaultContent: `<button class="editar btn btn-warning" data-toggle="modal" data-target="#editargarron" type="button">Editar</button>
                                               
                                              `,
                },
              ],
              language: espanol,
            });
        
            $("#form_listado_garron tbody").on("click", ".editar", function () {
              let datos = datatable.row($(this).parents()).data();
              let id = datos.id_faenados;
              let tropas = datos.tropa;
              let garron = datos.garron;
              let peso = datos.peso;
              $("#numero_tropa_editar").val(tropas);
              $("#garron_id").val(garron);
              $("#peso_garron").val(peso);
              $("#id_editar").val(id);
            });
          }
        }
      );

      let cantidad = $("#numgarron").val();
      let maximo = $("#maximo").val();
      let valor = parseFloat(cantidad) + parseFloat(1);
      $("#numgarron").val(valor);
      let promedio = (valor * 100) / maximo;
      var titular = document.getElementById("tracking");
      titular.style.width = promedio + "%";
      $("#siguiente").hide();
    $("#reducir").hide();
    $("#pesogarron").val("");
      $.post(
        "../controlador/ListadoController1.php",
        {
          
          tropas,
          productor,
          garron,
          especie,
          peso,
          estado,
          maximo,
          nombrematarife,
        },
        (response) => {
         
        }
        
      );
      let id=$('#ultimoid').val();
      $.post( "../modelo/Codigobarras.php", { filepath: "../etiquetas/barras/"+id+".png", text:id } );

      

      if (valor > maximo) {
        $("#siguiente").hide();
        $("#reducir").hide();
        $("#finalzado").show();
        $("#estadodect").val("FINALIZADO");
        $("#pesogarron").hide();
        $("#pesogarron1").hide();
        $("#camaraelegir").show();
      } else {
        $("#finalzado").hide();
      }



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