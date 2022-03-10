$(document).ready(function(){
    $('#gestion_reportes_diarios1').addClass('active');
    
    mostrar_consultas();
    $(document).on('click','#imprimir_caprinos',(e) => {
        let fecha=$('#fecha_faena').val();
        let especie=4;
        caprinos(fecha,especie);
    })
    $(document).on('click','#imprimir_ovinos',(e) => {
        let fecha=$('#fecha_faena').val();
        let especie=2;
        caprinos(fecha,especie);
    })
    async function caprinos(fecha,especie){
        funcion="caprinos";
        let data=await fetch('../controlador/DiarioControllerCaprinos.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&fecha='+fecha+'&&especie='+especie,
        })
        if(data.ok){
            let response=await data.text();
           try{
               console.log(response);
               Mostrar_Loader('Generando_Pdf');
                  if(response.trim()==''){
                   cerrar_loader('exito_generar');  
                   window.open('../pdf/romaneos/pdf-romaneo_caprino.pdf','_blank');
                  }else{
                   cerrar_loader('error_generar');  
                  }
                    
             
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
    async function diario(id,fecha,id_ingreso){
        funcion="ver";
        let data=await fetch('../controlador/DiarioController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&id='+id+'&&fecha='+fecha+'&&id_ingreso='+id_ingreso,
        })
        if(data.ok){
            let response=await data.text();
           try{
                let registros=JSON.parse(response);
          
                let template="";
                $('#registros').html(template);
                registros.forEach(registro => {
                    template+=`
                        <tr RegId1="${registro.tropa}" Regfecha1="${registro.fecha}">
                            <td>${registro.garron}</td>                        
                            <td>${registro.tropa}</td>
                            <td>${registro.especie}</td>
                            <td>${registro.peso}</td>
                            <td>${registro.productor}</td>
                            <td>${registro.establecimiento}</td>
                        </tr>
                        
                       
                    `;
                    $('#registros2').html(template);                
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

    $(document).on('click','.ver_tropa',(e) => {
        producto = $(this)[0].activeElement.parentElement.parentElement;
        id = $(producto).attr('RegId');
        fecha = $(producto).attr('Regfecha');
        id_ingreso = $(producto).attr('RegIngreso');
        $('#fecha_imprimir').val(fecha);
        $('#tropa_imprimir').val(id);
        $('#ingreso_imprimir').val(id_ingreso);

        diario(id,fecha,id_ingreso)
        
      
      })
      $(document).on('click','#imprimir',(e) => {
       let id= $('#tropa_imprimir').val();
       let fecha=   $('#fecha_imprimir').val();
       let id_ingreso=   $('#ingreso_imprimir').val();
        imprimir_formulario(id,fecha,id_ingreso);

            })
        
            async function imprimir_formulario(id,fecha,id_ingreso){
                let data=await fetch('../controlador/PDFDiariosController.php',{
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body:'id='+id+'&&fecha='+fecha+'&&id_ingreso='+id_ingreso,
                })
    
                if(data.ok){
                    let response=await data.text();
                 
                    $.ajax({
                        type:"POST",
                        url:"../controlador/PDFDiariosController.php",
                        data:'id='+id+'&&fecha='+fecha+'&&id_ingreso='+id_ingreso,
                        async:true,
                        success: function(response){
                            console.log(response);
                            if(response==''){
                          cerrar_loader('exito_generar');  
                          window.open('../pdf/reportesdiarios/pdf-reportesdiarios.pdf','_blank');
                         Mostrar_Loader('Generando_Pdf');
                            }else{
                                cerrar_loader('error_generar'); 
                            }
                        }
                    })
                   
               
                   try{
                      
                    } catch(error){
                        console.error(error);
                        cerrar_loader('error_generar'); 
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: data.statusText,
                       text: 'Hubo conflicto de codigo: '+data.status,
                    })
                }
             
              }
     
      
      function mostrar_consultas(){
    
      let funcion="listar";
      let datatable = $('#tabla_reportes').DataTable( {
          "ajax":{
              "url":"../controlador/DiarioController.php",
              "method": "POST",
              "data":{funcion:funcion}
          },
          "columns": [
              { "data": "id" },
              { "data": "fecha" },
             
             
              { "defaultContent": `
                                  <button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_reporte"><i class="fas fa-search"></i></button>
                                  `}
          ],
          "language": espanol
      } );
   
 

     
      $('#tabla_reportes tbody').on('click','.ver',function(){
          let datos = datatable.row($(this).parents()).data();
          let id = datos.id;
          let id_ingresos = datos.id_ingreso;
          let fecha = datos.fecha;
          funcion="ver_todo";
          $.post('../controlador/DiarioController.php',{funcion,id,fecha,id_ingresos},(response)=>{ 
              let registros=JSON.parse(response);
              let template="";
              $('#registros').html(template);
              registros.forEach(registro => {
                  template+=`
                  <tr RegId="${registro.tropa}" Regfecha="${registro.fecha}" RegIngreso="${registro.id_ingreso}">
                   
                        <td>${registro.fecha}</td>  
                          <td>${registro.id}</td>                        
                          <td>${registro.tropa}</td>
                          <td>${registro.tci}</td>
                          <td>${registro.cantidad}</td>
                          <td>${registro.total}</td>
                          <td>${registro.clasificacion}</td>
                          <td>${registro.garron}</td>
                          <td>${registro.corral}</td>
                          <td>${registro.dte}</td>
                          <td>${registro.kilosenpie}</td>
                          <td>${registro.promedio}</td>
                          <td>${registro.kiloscarne}</td>
                          <td><button id_tropa="${registro.id_ingreso}" type="button" class="ver_tropa btn btn-success"data-toggle="modal" data-target="#vista_reporte1"> Ver este romaneo</button> </td>                
                      </tr>
                  `;
                  $('#registros').html(template);   
                  $('#fecha_faena').val(registro.fecha);             
              });
              
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