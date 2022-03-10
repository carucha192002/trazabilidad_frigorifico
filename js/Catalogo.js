$(document).ready(function(){
  $('#guardargarron').hide();
    buscar_producto();
    buscar_producto_volver();
    pararomaneos();
    cantidadcorrales();
    cantidadcorralesreduccion();
    $('#clasificacioncorralreduccion').hide();
    $('#clasificacioncorralreduccion1').hide();
    $('#clasificacioncorralreduccion2').hide();

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
    function pararomaneos(){
        funcion="verificarromaneos";
        $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
            let cantidad='';
            const verificar = JSON.parse(response);
            cantidad=+`${verificar.cantidad}`;
            $('#cuantasromaneo').html(cantidad);
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
        $.post('../controlador/CatalogoController.php',{funcion},(response)=>{ 
            let datatable = $('#tabla_faenas').DataTable( {
              "ajax":{
                  "url":"../controlador/CatalogoController.php",
                  "method": "POST",
                  "data":{funcion:funcion}
              },
              "columns": [
              { "data": "id" },
              { "data": "matarife" },
              { "data": "numtropas" },
              { "data": "tci" },
              { "data": "cantidad" },
              { "data": "especie" },
              { "data": "subespecies" },
              { "data": "guia" },
              { "data": "promedio" },
                          
                  { "defaultContent": `<button class="agregar btn btn-success" data-toggle="modal" data-target="#garrones" type="button">PASAR A FAENA</button>
                                      
                                      `}
              ],
              
              "language": espanol
              
          });
          $('#tabla_faenas tbody').on('click','.agregar',function(){
              let datos = datatable.row($(this).parents()).data();
              let id = datos.id;
              let id_ingresos = datos.id_ingresos;
              let tropas = datos.numtropas;
              let cantidad = datos.enpie;
              let clasificacion = datos.subespecies;
              let promedio = datos.promedio;
              let corral = datos.corral;
              let destino = datos.destino;
              let matarife = datos.matarife;
              let productor = datos.productor;
              let guia = datos.guia;
              let id_matarife=datos.id_matarife;
              let kilosenpie=datos.kilosenpie;
              let tci=datos.tci;
              $('#numero_tropa').val(tropas);
              $('#numero_matarife').val(id_matarife);
              $('#clasificacion_garron').val(clasificacion);
              $('#cantidad_garron').val(cantidad);
              $('#corral_garron').val(corral);
              $('#promedio_garron').val(promedio);
              $('#dte_garron').val(guia);
              $('#matarife_garron').val(matarife);
              $('#kilosenpie_garron').val(kilosenpie);
              $('#tci_garron').val(tci);
              $('#id_ingreso_garron').val(id_ingresos);
      
              funcion="verificar";
              $.post('../controlador/CatalogoController.php',{funcion,cantidad,clasificacion,id_ingresos},(response)=>{
                if(response=='noadd'){
                      funcion="ultimoid";
                      $.post('../controlador/CatalogoController.php',{funcion,clasificacion,id_ingresos},(response1)=>{
          
                        let cantidadgarron = '';
                            const respuestasconsola = JSON.parse(response1);
                            cantidadgarron+=`${respuestasconsola.cantidad}`;
                          $('#desde_garron').val(parseFloat(cantidadgarron)+1);
                            let selector= document.getElementById('hasta_garron');
                            let limite= parseFloat($('#cantidad_garron').val())+parseFloat(1);
                            for (let i = 0; i < limite; i++) {
                                selector.options[i] = new Option(i,+i); 
                          }
                      })
                  }else{
                    $('#desde_garron').val(1);
                    let selector= document.getElementById('hasta_garron');
                    let limite= parseFloat($('#cantidad_garron').val())+parseFloat(1);
                    for (let i = 0; i < limite; i++) {
                        selector.options[i] = new Option(i,+i); 
                    }
                  }
              })
   
        })
    
    })
    }
    function buscar_producto_volver() {
      let funcion="quedanencorral";  
      $.post('../controlador/CatalogoController.php',{funcion},(response)=>{ 
        
          let datatable = $('#tabla_faenas_volver').DataTable( {
            "ajax":{
                "url":"../controlador/CatalogoController.php",
                "method": "POST",
                "data":{funcion:funcion}
            },
            "columns": [
            { "data": "id" },
            { "data": "numtropas" },
            { "data": "enpie" },
            { "data": "subespecies" },
            { "data": "matarife" },
            { "data": "quedan" },
                        
                { "defaultContent": `<button class="agregar btn btn-success" data-toggle="modal" data-target="#volver" type="button">PASAR A FAENA</button>
                                    
                                    `}
            ],
            
            "language": espanol
        });
        $('#tabla_faenas_volver tbody').on('click','.agregar',function(){
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;
            let tropas = datos.numtropas;
            let cantidad = datos.enpie;
            let clasificacion = datos.subespecies;
            let promedio = datos.promedio;
            let corral = datos.corral;
            let destino = datos.destino;
            let matarife = datos.matarife;
            let productor = datos.productor;
            let guia = datos.guia;
            let id_matarife=datos.id_matarife;
            let quedan=datos.quedan;
            $('#numero_tropa_volver').val(tropas);
            $('#numero_matarife_volver').val(id_matarife);
            $('#clasificacion_garron_volver').val(clasificacion);
            $('#cantidad_garron_volver').val(cantidad);
            $('#numero_matarife_volver').val(id_matarife);
            $('#quedan_volver').val(quedan);

            funcion="verificar";
            $.post('../controlador/CatalogoController.php',{funcion,cantidad,id},(response)=>{
             
                if(response=='noadd'){
                    funcion="ultimoid";
                    $.post('../controlador/CatalogoController.php',{funcion},(response1)=>{
                        let cantidadgarron = '';
                          const respuestasconsola = JSON.parse(response1);
                          cantidadgarron+=`${respuestasconsola.cantidad}`;
                        $('#desde_garron_volver').val(parseFloat(cantidadgarron)+1);
                          let selector= document.getElementById('hasta_garron_volver');
                          let limite= parseFloat(quedan)+parseFloat(1);
                          for (let i = 0; i < limite; i++) {
                              selector.options[i] = new Option(i,+i); 
       }

                    })

                }else{
                  $('#desde_garron').val(1);
                  let selector= document.getElementById('hasta_garron');
                  let limite= parseFloat($('#cantidad_garron').val())+parseFloat(1);
                  for (let i = 0; i < limite; i++) {
                      selector.options[i] = new Option(i,+i); 
}
                }
            })



            
      })
  })
  }

})
$(document).on('click','#hasta_garron',(e)=>{
    let cantidad=$('#cantidad_garron').val();
     $("#hasta_garron").change(function(){  
        $("#hasta_garron option:selected").each(function (){
          valor = $(this).val();
          if(valor>= 0){
         var desde=$('#desde_garron').val();
        $('#hasta_garron_guardar').val(parseFloat(desde)+parseFloat(valor)-1);
        }   
        if(valor==$('#cantidad_garron').val()){
            $('#estado_garron').val('TOTALIDAD');
            $('#guardargarron').show();
        }else{
            $('#estado_garron').val('PARCIAL');
            $('#guardargarron').hide();
            
        }
      
              })
            })
        })

    $(document).on('click','#guardargarron',(e)=>{
    let tropa = $('#numero_tropa').val(); 
    let clasificacion = $('#clasificacion_garron').val();
    let cantidad = $('#cantidad_garron').val();
    let desde = $('#desde_garron').val();
    let hasta = $('#hasta_garron_guardar').val();
    let estado = $('#estado_garron').val();
    let seleccionado = $('#hasta_garron').val();
    let id_matarife =  $('#numero_matarife').val();
    let dte =  $('#dte_garron').val();
    let promedio =  $('#promedio_garron').val();
    let corral =  $('#corral_garron').val();
    let nombrematarife =  $('#matarife_garron').val();
    let kilosenpie =  $('#kilosenpie_garron').val();
    let tci =  $('#tci_garron').val();
    let id_ingreso= $('#id_ingreso_garron').val();

   if(estado=="TOTALIDAD"){
      funcion="agregar";
      $.post('../controlador/CatalogoController.php',{funcion,cantidad,clasificacion,hasta,id_ingreso},(response)=>{
      })
      funcion="crear";
      let quedan="0";
    $.post('../controlador/CatalogoController.php',{funcion,tropa,clasificacion,cantidad,desde,hasta,estado,seleccionado,id_matarife,quedan,dte,promedio,corral,nombrematarife,kilosenpie,tci,id_ingreso},(response)=>{
        if(response=='add'){
            funcion="añadirproceso";
            $.post('../controlador/CatalogoController.php',{funcion,tropa,id_matarife,estado},(response)=>{
            })
                    funcion="reemplazarestado";
                    $.post('../controlador/CatalogoController.php',{funcion,id_ingreso},(response1)=>{
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Guardado',
                        showConfirmButton: false,
                        timer: 3000
                      }) 
                     
                   
                      setTimeout('document.location.reload()',2000);
                    })
          
        $('#form-crear-garron').trigger('reset');
    }
    if(response=='noadd'){
        
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Guardado',
        showConfirmButton: false,
        timer: 3000
            
          })
        $('#form-crear-garron').trigger('reset');
        setTimeout('document.location.reload()',2000);
    }
})
    e.preventDefault();
}
e.preventDefault();
});

$(document).on('click','#hasta_garron_volver',(e)=>{
let cantidad=$('#cantidad_garron_volver').val();
$("#hasta_garron_volver").change(function(){  
  $("#hasta_garron_volver option:selected").each(function (){
    valor = $(this).val();
    if(valor>= 0){
   var desde=$('#desde_garron_volver').val();
   var quedan=$('#quedan_volver').val();
  $('#hasta_garron_guardar_volver').val(parseFloat(desde)+parseFloat(valor) -parseFloat(1));
  }   
  if(parseFloat(valor)==parseFloat(quedan)){
      $('#estado_garron_volver').val('TOTALIDAD');
  }else{
      $('#estado_garron_volver').val('PARCIAL');
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
let quedan1 =  $('#quedan_volver').val();
let quedan=parseFloat(quedan1)-parseFloat(seleccionado)

if(estado=='TOTALIDAD'){
  $('#guardargarron').show();
  funcion="consultarsiexiste";
$.post('../controlador/CatalogoController.php',{funcion,tropa},(response)=>{
  if (response=='add'){
    funcion="agregar";
$.post('../controlador/CatalogoController.php',{funcion,cantidad},(response)=>{

})

funcion="crear";
$.post('../controlador/CatalogoController.php',{funcion,tropa,clasificacion,cantidad,desde,hasta,estado,seleccionado,id_matarife,quedan},(response)=>{

  if(response=='add'){
  
    funcion="buscarid";
    $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
        let id='';
        const idultimo = JSON.parse(response);
        id+=`${idultimo.id}`;
              funcion="reemplazar";
              $.post('../controlador/CatalogoController.php',{funcion,id,hasta},(response)=>{
               
              })
             
    })
  
} funcion="reemplazarestadototal";
              $.post('../controlador/CatalogoController.php',{funcion,tropa},(response1)=>{
           
              })
   funcion="reemplazarestadototalingreso";
              $.post('../controlador/CatalogoController.php',{funcion,tropa},(response1)=>{
               
              })

          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Guardado',
            showConfirmButton: false,
            timer: 3000
          }) 
          setTimeout('document.location.reload()',2000);
          pararomaneos();
          cantidadcorrales();
if(response=='noadd'){
  
  Swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'La Especificacion ya existe',
      showConfirmButton: false,
      timer: 1500
      
    })
 

}


})

  }
  
})

}else{
  $('#guardargarron').hide();
  funcion="agregar";
$.post('../controlador/CatalogoController.php',{funcion,cantidad},(response)=>{
})
funcion="crear";
$.post('../controlador/CatalogoController.php',{funcion,tropa,clasificacion,cantidad,desde,hasta,estado,seleccionado,id_matarife,quedan},(response)=>{

  if(response=='add'){
 
   funcion="buscarid";
    $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
      let id='';
        const idultimo = JSON.parse(response);
        id+=`${idultimo.id}`;
              funcion="reemplazar";
             $.post('../controlador/CatalogoController.php',{funcion,id,hasta},(response)=>{
               
              })

            funcion="buscaridfaenas";
              $.post('../controlador/CatalogoController.php',{funcion,tropa},(response)=>{
   
                  let id='';
                  const idultimo = JSON.parse(response);
                  id+=`${idultimo.id}`;
                        funcion="reemplazarfaenas";
                        $.post('../controlador/CatalogoController.php',{funcion,id},(response)=>{
                        
                        })
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Guardado',
                  showConfirmButton: false,
                  timer: 3000
                }) 
                location.reload(true);
                pararomaneos();
                cantidadcorrales();
              })
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
  cantidadcorrales();
  setTimeout('document.location.reload()',2000);

}

})


}

e.preventDefault();

});






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