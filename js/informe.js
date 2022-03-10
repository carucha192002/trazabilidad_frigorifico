$(document).ready(function(){
    $('#gestion_devolucion1').addClass('active');
    $('#imprimirfaenas').hide();
    $('#imprimirfaenastodas').hide();

    $(document).on('click','#matarife_fudepem',(e)=>{
        rellenar_usuarios();
    })
  
    $(document).on('click','#matarife_comun',(e)=>{
        rellenar_usuarios_comun();
    })


  function rellenar_usuarios(){
    let funcion="rellenar_usuario";
     $.post('../controlador/informeController.php',{funcion},(response)=>{     
         const usuarios = JSON.parse(response);
         
         let template='';
         template+=`
            <option value="0"> Seleccione Matarife</option>`;
         usuarios.forEach(usuario => {
             template+=`
                 <option value="${usuario.id}"name=${usuario.id_submatarife}>${usuario.nombre}</option>
             `;
         });
         $('#usuario').html(template);
     })
     $("#usuario").change(function(){  
        $("#usuario option:selected").each(function (){
          usuarioseleccionado = $(this).val();
          usuarioseleccionado1 = $(this).attr("name");
          $('#usuariseleccionado').val(usuarioseleccionado);
          $('#usuariseleccionado1').val(usuarioseleccionado1);

        })
        
     })
 }
 function rellenar_usuarios_comun(){
    let funcion="rellenar_usuario_comun";
     $.post('../controlador/informeController.php',{funcion},(response)=>{     
         const usuarios = JSON.parse(response);
         
         let template='';
         template+=`
            <option value="0"> Seleccione Matarife</option>`;
         usuarios.forEach(usuario => {
             template+=`
                 <option value="${usuario.id}"name=${usuario.id_submatarife}>${usuario.nombre}</option>
             `;
         });
         $('#usuario').html(template);
     })
     $("#usuario").change(function(){  
        $("#usuario option:selected").each(function (){
          usuarioseleccionado = $(this).val();
          usuarioseleccionado1 = $(this).attr("name");
          $('#usuariseleccionado').val(usuarioseleccionado);
          $('#usuariseleccionado1').val(usuarioseleccionado1);

        })
        
     })
 }

 $(document).on('click','#guardarfaenas',(e)=>{
     let id=$('#usuariseleccionado').val();
     let submatarife=$('#usuariseleccionado1').val();
    let desde= $('#desdefaenas').val();
     let hasta=$('#hastafaenas').val();

     if(submatarife=='0'){
        faena_mes_matarife_comun();
        faena_mes_anterior_productor_comun();
      $('#imprimirfaenastodas').hide();
      $('#imprimirfaenas').show();
      let funcion="listar_busqueda_comun";
           $.post('../controlador/informeController.php',{funcion,id,desde,hasta},(response)=>{
               $('#tabla_pendientes').DataTable().clear().destroy();
               let datatable = $('#tabla_pendientes').DataTable( {
                   
                   "destroy":true,
                   "ajax":{
                       "url":"../controlador/informeController.php",
                       "method": "POST",
                       "data":{funcion:funcion,id:id,desde:desde,hasta:hasta}
                   },
               "columns": [
                   { "data": "id" },
                   { "data": "fecha" },
                   { "data": "tropa" },
                   { "data": "id_matarife" },
                   { "data": "dte" },
                   { "data": "cantidad" },
                   { "data": "desde" },
                   { "data": "hasta" },
                   { "data": "clasificacion" },
                 
                   ],
                   "language": espanol
               });
   
           
           })
     }else{
     faena_mes_matarife();
     faena_mes_anterior_productor();
   $('#imprimirfaenastodas').hide();
   $('#imprimirfaenas').show();
   let funcion="listar_busqueda";
        $.post('../controlador/informeController.php',{funcion,id,desde,hasta,submatarife},(response)=>{
            $('#tabla_pendientes').DataTable().clear().destroy();
            let datatable = $('#tabla_pendientes').DataTable( {
                
                "destroy":true,
                "ajax":{
                    "url":"../controlador/informeController.php",
                    "method": "POST",
                    "data":{funcion:funcion,id:id,desde:desde,hasta:hasta,submatarife:submatarife}
                },
            "columns": [
                { "data": "id" },
                { "data": "fecha" },
                { "data": "tropa" },
                { "data": "id_matarife" },
                { "data": "dte" },
                { "data": "cantidad" },
                { "data": "desde" },
                { "data": "hasta" },
                { "data": "clasificacion" },
              
  
                            
                 
                ],
                "language": espanol
            });

        
        })
        
    }   
 })


 async function faena_mes_matarife(){
    let array=['','','','','','','','','','','',''];
    let idmatarife= $('#usuariseleccionado').val();
    let idmatarife1= $('#usuariseleccionado1').val();
  
    funcion='faena_mes_matarife';
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)+'&&idmatarife1='+JSON.stringify(idmatarife1)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        meses.forEach(mes => {
            if(mes.mes==1){
                array[0]=mes;
            }
            if(mes.mes==2){
                array[1]=mes;
            }
            if(mes.mes==3){
                array[2]=mes;
            }
            if(mes.mes==4){
                array[3]=mes;
            }
            if(mes.mes==5){
                array[4]=mes;
            }
            if(mes.mes==6){
                array[5]=mes;
            }
            if(mes.mes==7){
                array[6]=mes;
            }
            if(mes.mes==8){
                array[7]=mes;
            }
            if(mes.mes==9){
                array[8]=mes;
            }
            if(mes.mes==10){
                array[9]=mes;
            }
            if(mes.mes==11){
                array[10]=mes;
            }
            if(mes.mes==12){
                array[11]=mes;
            }

        });
    })
    let canvasG1=$('#grafico1').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Setiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ],
        datasets:[{
            data:[
                array[0].cantidad,
                array[1].cantidad,
                array[2].cantidad,
                array[3].cantidad,
                array[4].cantidad,
                array[5].cantidad,
                array[6].cantidad,
                array[7].cantidad,
                array[8].cantidad,
                array[9].cantidad,
                array[10].cantidad,
                array[11].cantidad,
            ],
        backgroundColor:[
           '#0B5345',
           '#D4AC0D',
           '#3498DB',
           '#616A6B',
           '#633974',
           '#28B463',
           '#2C3E50',
           '#ABEBC6',
           '#DC7633',
           '#117A65',
           '#5499C7',
           '#D4E6F1',
        ]
        }]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G1 = new Chart(canvasG1,{
        type:'pie',
        data:datos,
        options:opciones,
    })
}
async function faena_mes_matarife_comun(){
    let array=['','','','','','','','','','','',''];
    let idmatarife= $('#usuariseleccionado').val();
  
    funcion='faena_mes_matarife_comun';
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        meses.forEach(mes => {
            if(mes.mes==1){
                array[0]=mes;
            }
            if(mes.mes==2){
                array[1]=mes;
            }
            if(mes.mes==3){
                array[2]=mes;
            }
            if(mes.mes==4){
                array[3]=mes;
            }
            if(mes.mes==5){
                array[4]=mes;
            }
            if(mes.mes==6){
                array[5]=mes;
            }
            if(mes.mes==7){
                array[6]=mes;
            }
            if(mes.mes==8){
                array[7]=mes;
            }
            if(mes.mes==9){
                array[8]=mes;
            }
            if(mes.mes==10){
                array[9]=mes;
            }
            if(mes.mes==11){
                array[10]=mes;
            }
            if(mes.mes==12){
                array[11]=mes;
            }

        });
    })
    let canvasG1=$('#grafico1').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Setiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ],
        datasets:[{
            data:[
                array[0].cantidad,
                array[1].cantidad,
                array[2].cantidad,
                array[3].cantidad,
                array[4].cantidad,
                array[5].cantidad,
                array[6].cantidad,
                array[7].cantidad,
                array[8].cantidad,
                array[9].cantidad,
                array[10].cantidad,
                array[11].cantidad,
            ],
        backgroundColor:[
           '#0B5345',
           '#D4AC0D',
           '#3498DB',
           '#616A6B',
           '#633974',
           '#28B463',
           '#2C3E50',
           '#ABEBC6',
           '#DC7633',
           '#117A65',
           '#5499C7',
           '#D4E6F1',
        ]
        }]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G1 = new Chart(canvasG1,{
        type:'pie',
        data:datos,
        options:opciones,
    })
}
async function faena_mes_anterior_productor(){
        
    let idmatarife=$('#usuariseleccionado').val();
    let idmatarife12=$('#usuariseleccionado1').val();
   
    funcion='faena_mes_anterior_productor';
    let lista=['','','','','','','','','','','',''];
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)+'&&idmatarife12='+JSON.stringify(idmatarife12)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        
        
        meses.forEach(mes => {
            if(mes.mes==1){
                lista[0]=mes;
            }
            if(mes.mes==2){
                lista[1]=mes;
            }
            if(mes.mes==3){
                lista[2]=mes;
            }
            if(mes.mes==4){
                lista[3]=mes;
            }
            if(mes.mes==5){
                lista[4]=mes;
            }
            if(mes.mes==6){
                lista[5]=mes;
            }
            if(mes.mes==7){
                lista[6]=mes;
            }
            if(mes.mes==8){
                lista[7]=mes;
            }
            if(mes.mes==9){
                lista[8]=mes;
            }
            if(mes.mes==10){
                lista[9]=mes;
            }
            if(mes.mes==11){
                lista[10]=mes;
            }
            if(mes.mes==12){
                lista[11]=mes;
            }
        });
    })
    funcion='faena_mes_matarife';
    let idmatarife1=$('#usuariseleccionado').val();
    let idmatarife13=$('#usuariseleccionado1').val();
   
    let lista1=['','','','','','','','','','','',''];
    const response1 = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife1)+'&&idmatarife1='+JSON.stringify(idmatarife13)
    }).then(function(response1){
        return response1.json();
    }).then(function(meses){            
        meses.forEach(mes => {
            if(mes.mes==1){
                lista1[0]=mes;
            }
            if(mes.mes==2){
                lista1[1]=mes;
            }
            if(mes.mes==3){
                lista1[2]=mes;
            }
            if(mes.mes==4){
                lista1[3]=mes;
            }
            if(mes.mes==5){
                lista1[4]=mes;
            }
            if(mes.mes==6){
                lista1[5]=mes;
            }
            if(mes.mes==7){
                lista1[6]=mes;
            }
            if(mes.mes==8){
                lista1[7]=mes;
            }
            if(mes.mes==9){
                lista1[8]=mes;
            }
            if(mes.mes==10){
                lista1[9]=mes;
            }
            if(mes.mes==11){
                lista1[10]=mes;
            }
            if(mes.mes==12){
                lista1[11]=mes;
            }
        });
    })
    let canvasG2=$('#grafico2').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'
        ],
        datasets:[
            {
                label          :'ano actual',
                backgroundColor:'rgba(36, 112, 112, 1)',
                borderColor    :'rgba(60,141,188,0,8)',
                pointRadius    : false,
                pointColor     : '#3b8bba',
                pointStrokeColor:'rgba(60,141,188,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(60,141,188,1)',
                data                :[lista1[0].cantidad,lista1[1].cantidad,lista1[2].cantidad,lista1[3].cantidad,lista1[4].cantidad,lista1[5].cantidad,lista1[6].cantidad,lista1[7].cantidad,lista1[8].cantidad,lista1[9].cantidad,lista1[10].cantidad,lista1[11].cantidad]
            },
            {
                label          :'ano actual',
                backgroundColor:'rgba(210,214,222,1)',
                borderColor    :'rgba(210,214,222,1)',
                pointRadius    : false,
                pointColor     : '#c1c7d1',
                pointStrokeColor:'rgba(210,214,222,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(210,214,222,1)',
                data                :[lista[0].cantidad,lista[1].cantidad,lista[2].cantidad,lista[3].cantidad,lista[4].cantidad,lista[5].cantidad,lista[6].cantidad,lista[7].cantidad,lista[8].cantidad,lista[9].cantidad,lista[10].cantidad,lista[11].cantidad]
            },

        ]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G2 = new Chart(canvasG2,{
        type:'bar',
        data:datos,
        options:opciones,
    })
}
async function faena_mes_anterior_productor_comun(){
        
    let idmatarife=$('#usuariseleccionado').val();
   
    funcion='faena_mes_anterior_productor_comun';
    let lista=['','','','','','','','','','','',''];
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        
        
        meses.forEach(mes => {
            if(mes.mes==1){
                lista[0]=mes;
            }
            if(mes.mes==2){
                lista[1]=mes;
            }
            if(mes.mes==3){
                lista[2]=mes;
            }
            if(mes.mes==4){
                lista[3]=mes;
            }
            if(mes.mes==5){
                lista[4]=mes;
            }
            if(mes.mes==6){
                lista[5]=mes;
            }
            if(mes.mes==7){
                lista[6]=mes;
            }
            if(mes.mes==8){
                lista[7]=mes;
            }
            if(mes.mes==9){
                lista[8]=mes;
            }
            if(mes.mes==10){
                lista[9]=mes;
            }
            if(mes.mes==11){
                lista[10]=mes;
            }
            if(mes.mes==12){
                lista[11]=mes;
            }
        });
    })
    funcion='faena_mes_matarife_comun';
    let idmatarife1=$('#usuariseleccionado').val();
   
    let lista1=['','','','','','','','','','','',''];
    const response1 = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife1)
    }).then(function(response1){
        return response1.json();
    }).then(function(meses){            
        meses.forEach(mes => {
            if(mes.mes==1){
                lista1[0]=mes;
            }
            if(mes.mes==2){
                lista1[1]=mes;
            }
            if(mes.mes==3){
                lista1[2]=mes;
            }
            if(mes.mes==4){
                lista1[3]=mes;
            }
            if(mes.mes==5){
                lista1[4]=mes;
            }
            if(mes.mes==6){
                lista1[5]=mes;
            }
            if(mes.mes==7){
                lista1[6]=mes;
            }
            if(mes.mes==8){
                lista1[7]=mes;
            }
            if(mes.mes==9){
                lista1[8]=mes;
            }
            if(mes.mes==10){
                lista1[9]=mes;
            }
            if(mes.mes==11){
                lista1[10]=mes;
            }
            if(mes.mes==12){
                lista1[11]=mes;
            }
        });
    })
    let canvasG2=$('#grafico2').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'
        ],
        datasets:[
            {
                label          :'ano actual',
                backgroundColor:'rgba(36, 112, 112, 1)',
                borderColor    :'rgba(60,141,188,0,8)',
                pointRadius    : false,
                pointColor     : '#3b8bba',
                pointStrokeColor:'rgba(60,141,188,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(60,141,188,1)',
                data                :[lista1[0].cantidad,lista1[1].cantidad,lista1[2].cantidad,lista1[3].cantidad,lista1[4].cantidad,lista1[5].cantidad,lista1[6].cantidad,lista1[7].cantidad,lista1[8].cantidad,lista1[9].cantidad,lista1[10].cantidad,lista1[11].cantidad]
            },
            {
                label          :'ano actual',
                backgroundColor:'rgba(210,214,222,1)',
                borderColor    :'rgba(210,214,222,1)',
                pointRadius    : false,
                pointColor     : '#c1c7d1',
                pointStrokeColor:'rgba(210,214,222,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(210,214,222,1)',
                data                :[lista[0].cantidad,lista[1].cantidad,lista[2].cantidad,lista[3].cantidad,lista[4].cantidad,lista[5].cantidad,lista[6].cantidad,lista[7].cantidad,lista[8].cantidad,lista[9].cantidad,lista[10].cantidad,lista[11].cantidad]
            },

        ]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G2 = new Chart(canvasG2,{
        type:'bar',
        data:datos,
        options:opciones,
    })
}
})
 $(document).on('click','#guardarfaenastodas',(e)=>{
     let id=$('#usuariseleccionado').val();
     let sub=$('#usuariseleccionado1').val();
    let desde= $('#desdefaenas').val();
     let hasta=$('#hastafaenas').val();
     if(sub=='0'){
        faena_mes_matarife1_comun();
        faena_mes_anterior_productor1_comun();
      let funcion="listar_busqueda_todas_comun";
           $.post('../controlador/informeController.php',{funcion,id,desde,hasta},(response)=>{
       
             const respuesta=JSON.parse(response);
       
             if(respuesta==''){
               Swal.fire({
                   icon: 'error',
                   title: 'Oops...',
                   text: 'No hay registros para mostrar!',                    
                 })
               $('#imprimirfaenastodas').hide();
             }else{
               $('#imprimirfaenastodas').show();
               $('#tabla_pendientes').DataTable().clear().destroy();
               let datatable = $('#tabla_pendientes').DataTable( {
                   "destroy":true,
                   "ajax":{
                       "url":"../controlador/informeController.php",
                       "method": "POST",
                       "data":{funcion:funcion,id:id,desde:desde,hasta:hasta}
                   },
               "columns": [
                   { "data": "id" },
                   { "data": "fecha" },
                   { "data": "tropa" },
                   { "data": "id_matarife" },
                   { "data": "dte" },
                   { "data": "cantidad" },
                   { "data": "desde" },
                   { "data": "hasta" },
                   { "data": "clasificacion" }, 
                   ],
                   "language": espanol
               });
   
         
             }
           })
     }else{
     faena_mes_matarife1();
     faena_mes_anterior_productor1();
  
    
   let funcion="listar_busqueda_todas";
        $.post('../controlador/informeController.php',{funcion,id,desde,hasta},(response)=>{
    
          const respuesta=JSON.parse(response);
    
          if(respuesta==''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay registros para mostrar!',                    
              })
            $('#imprimirfaenastodas').hide();
          }else{
            $('#imprimirfaenastodas').show();
            $('#tabla_pendientes').DataTable().clear().destroy();
            let datatable = $('#tabla_pendientes').DataTable( {
                "destroy":true,
                "ajax":{
                    "url":"../controlador/informeController.php",
                    "method": "POST",
                    "data":{funcion:funcion,id:id,desde:desde,hasta:hasta}
                },
            "columns": [
                { "data": "id" },
                { "data": "fecha" },
                { "data": "tropa" },
                { "data": "id_matarife" },
                { "data": "dte" },
                { "data": "cantidad" },
                { "data": "desde" },
                { "data": "hasta" },
                { "data": "clasificacion" },
              
  
                            
                   
                ],
                "language": espanol
            });

      
          }
        })
        
    }     
 })


async function faena_mes_matarife1(){
    let array=['','','','','','','','','','','',''];
    let idmatarife= $('#usuariseleccionado').val();
   
  
    funcion='faena_mes_matarife1';
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        meses.forEach(mes => {
            if(mes.mes==1){
                array[0]=mes;
            }
            if(mes.mes==2){
                array[1]=mes;
            }
            if(mes.mes==3){
                array[2]=mes;
            }
            if(mes.mes==4){
                array[3]=mes;
            }
            if(mes.mes==5){
                array[4]=mes;
            }
            if(mes.mes==6){
                array[5]=mes;
            }
            if(mes.mes==7){
                array[6]=mes;
            }
            if(mes.mes==8){
                array[7]=mes;
            }
            if(mes.mes==9){
                array[8]=mes;
            }
            if(mes.mes==10){
                array[9]=mes;
            }
            if(mes.mes==11){
                array[10]=mes;
            }
            if(mes.mes==12){
                array[11]=mes;
            }

        });
    })
    let canvasG1=$('#grafico1').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Setiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ],
        datasets:[{
            data:[
                array[0].cantidad,
                array[1].cantidad,
                array[2].cantidad,
                array[3].cantidad,
                array[4].cantidad,
                array[5].cantidad,
                array[6].cantidad,
                array[7].cantidad,
                array[8].cantidad,
                array[9].cantidad,
                array[10].cantidad,
                array[11].cantidad,
            ],
        backgroundColor:[
           '#0B5345',
           '#D4AC0D',
           '#3498DB',
           '#616A6B',
           '#633974',
           '#28B463',
           '#2C3E50',
           '#ABEBC6',
           '#DC7633',
           '#117A65',
           '#5499C7',
           '#D4E6F1',
        ]
        }]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G1 = new Chart(canvasG1,{
        type:'pie',
        data:datos,
        options:opciones,
    })
}
async function faena_mes_matarife1_comun(){
    let array=['','','','','','','','','','','',''];
    let idmatarife= $('#usuariseleccionado').val();
   
  
    funcion='faena_mes_matarife1_comun';
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        meses.forEach(mes => {
            if(mes.mes==1){
                array[0]=mes;
            }
            if(mes.mes==2){
                array[1]=mes;
            }
            if(mes.mes==3){
                array[2]=mes;
            }
            if(mes.mes==4){
                array[3]=mes;
            }
            if(mes.mes==5){
                array[4]=mes;
            }
            if(mes.mes==6){
                array[5]=mes;
            }
            if(mes.mes==7){
                array[6]=mes;
            }
            if(mes.mes==8){
                array[7]=mes;
            }
            if(mes.mes==9){
                array[8]=mes;
            }
            if(mes.mes==10){
                array[9]=mes;
            }
            if(mes.mes==11){
                array[10]=mes;
            }
            if(mes.mes==12){
                array[11]=mes;
            }

        });
    })
    let canvasG1=$('#grafico1').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Setiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ],
        datasets:[{
            data:[
                array[0].cantidad,
                array[1].cantidad,
                array[2].cantidad,
                array[3].cantidad,
                array[4].cantidad,
                array[5].cantidad,
                array[6].cantidad,
                array[7].cantidad,
                array[8].cantidad,
                array[9].cantidad,
                array[10].cantidad,
                array[11].cantidad,
            ],
        backgroundColor:[
           '#0B5345',
           '#D4AC0D',
           '#3498DB',
           '#616A6B',
           '#633974',
           '#28B463',
           '#2C3E50',
           '#ABEBC6',
           '#DC7633',
           '#117A65',
           '#5499C7',
           '#D4E6F1',
        ]
        }]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G1 = new Chart(canvasG1,{
        type:'pie',
        data:datos,
        options:opciones,
    })
}
async function faena_mes_anterior_productor1(){
        
    let idmatarife=$('#usuariseleccionado').val();
 
   
    funcion='faena_mes_anterior_productor1';
    let lista=['','','','','','','','','','','',''];
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        
        
        meses.forEach(mes => {
            if(mes.mes==1){
                lista[0]=mes;
            }
            if(mes.mes==2){
                lista[1]=mes;
            }
            if(mes.mes==3){
                lista[2]=mes;
            }
            if(mes.mes==4){
                lista[3]=mes;
            }
            if(mes.mes==5){
                lista[4]=mes;
            }
            if(mes.mes==6){
                lista[5]=mes;
            }
            if(mes.mes==7){
                lista[6]=mes;
            }
            if(mes.mes==8){
                lista[7]=mes;
            }
            if(mes.mes==9){
                lista[8]=mes;
            }
            if(mes.mes==10){
                lista[9]=mes;
            }
            if(mes.mes==11){
                lista[10]=mes;
            }
            if(mes.mes==12){
                lista[11]=mes;
            }
        });
    })
    funcion='faena_mes_matarife1';
    let idmatarife1=$('#usuariseleccionado').val();
    
   
    let lista1=['','','','','','','','','','','',''];
    const response1 = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife1)
    }).then(function(response1){
        return response1.json();
      
    }).then(function(meses){            
        meses.forEach(mes => {
            if(mes.mes==1){
                lista1[0]=mes;
            }
            if(mes.mes==2){
                lista1[1]=mes;
            }
            if(mes.mes==3){
                lista1[2]=mes;
            }
            if(mes.mes==4){
                lista1[3]=mes;
            }
            if(mes.mes==5){
                lista1[4]=mes;
            }
            if(mes.mes==6){
                lista1[5]=mes;
            }
            if(mes.mes==7){
                lista1[6]=mes;
            }
            if(mes.mes==8){
                lista1[7]=mes;
            }
            if(mes.mes==9){
                lista1[8]=mes;
            }
            if(mes.mes==10){
                lista1[9]=mes;
            }
            if(mes.mes==11){
                lista1[10]=mes;
            }
            if(mes.mes==12){
                lista1[11]=mes;
            }
        });
    })
    let canvasG2=$('#grafico2').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'
        ],
        datasets:[
            {
                label          :'ano actual',
                backgroundColor:'rgba(36, 112, 112, 1)',
                borderColor    :'rgba(60,141,188,0,8)',
                pointRadius    : false,
                pointColor     : '#3b8bba',
                pointStrokeColor:'rgba(60,141,188,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(60,141,188,1)',
                data                :[lista1[0].cantidad,lista1[1].cantidad,lista1[2].cantidad,lista1[3].cantidad,lista1[4].cantidad,lista1[5].cantidad,lista1[6].cantidad,lista1[7].cantidad,lista1[8].cantidad,lista1[9].cantidad,lista1[10].cantidad,lista1[11].cantidad]
            },
            {
                label          :'ano actual',
                backgroundColor:'rgba(210,214,222,1)',
                borderColor    :'rgba(210,214,222,1)',
                pointRadius    : false,
                pointColor     : '#c1c7d1',
                pointStrokeColor:'rgba(210,214,222,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(210,214,222,1)',
                data                :[lista[0].cantidad,lista[1].cantidad,lista[2].cantidad,lista[3].cantidad,lista[4].cantidad,lista[5].cantidad,lista[6].cantidad,lista[7].cantidad,lista[8].cantidad,lista[9].cantidad,lista[10].cantidad,lista[11].cantidad]
            },

        ]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G2 = new Chart(canvasG2,{
        type:'bar',
        data:datos,
        options:opciones,
    })
}
async function faena_mes_anterior_productor1_comun(){
        
    let idmatarife=$('#usuariseleccionado').val();
 
   
    funcion='faena_mes_anterior_productor1_comun';
    let lista=['','','','','','','','','','','',''];
    const response = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife)
    }).then(function(response){
        return response.json();
    }).then(function(meses){
        
        
        
        meses.forEach(mes => {
            if(mes.mes==1){
                lista[0]=mes;
            }
            if(mes.mes==2){
                lista[1]=mes;
            }
            if(mes.mes==3){
                lista[2]=mes;
            }
            if(mes.mes==4){
                lista[3]=mes;
            }
            if(mes.mes==5){
                lista[4]=mes;
            }
            if(mes.mes==6){
                lista[5]=mes;
            }
            if(mes.mes==7){
                lista[6]=mes;
            }
            if(mes.mes==8){
                lista[7]=mes;
            }
            if(mes.mes==9){
                lista[8]=mes;
            }
            if(mes.mes==10){
                lista[9]=mes;
            }
            if(mes.mes==11){
                lista[10]=mes;
            }
            if(mes.mes==12){
                lista[11]=mes;
            }
        });
    })
    funcion='faena_mes_matarife1';
    let idmatarife1=$('#usuariseleccionado').val();
    
   
    let lista1=['','','','','','','','','','','',''];
    const response1 = await fetch('../controlador/GraficoControllerMatarife1.php',{
        method: 'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&idmatarife='+JSON.stringify(idmatarife1)
    }).then(function(response1){
        return response1.json();
      
    }).then(function(meses){            
        meses.forEach(mes => {
            if(mes.mes==1){
                lista1[0]=mes;
            }
            if(mes.mes==2){
                lista1[1]=mes;
            }
            if(mes.mes==3){
                lista1[2]=mes;
            }
            if(mes.mes==4){
                lista1[3]=mes;
            }
            if(mes.mes==5){
                lista1[4]=mes;
            }
            if(mes.mes==6){
                lista1[5]=mes;
            }
            if(mes.mes==7){
                lista1[6]=mes;
            }
            if(mes.mes==8){
                lista1[7]=mes;
            }
            if(mes.mes==9){
                lista1[8]=mes;
            }
            if(mes.mes==10){
                lista1[9]=mes;
            }
            if(mes.mes==11){
                lista1[10]=mes;
            }
            if(mes.mes==12){
                lista1[11]=mes;
            }
        });
    })
    let canvasG2=$('#grafico2').get(0).getContext('2d');
    let datos={
        labels:[
            'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'
        ],
        datasets:[
            {
                label          :'ano actual',
                backgroundColor:'rgba(36, 112, 112, 1)',
                borderColor    :'rgba(60,141,188,0,8)',
                pointRadius    : false,
                pointColor     : '#3b8bba',
                pointStrokeColor:'rgba(60,141,188,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(60,141,188,1)',
                data                :[lista1[0].cantidad,lista1[1].cantidad,lista1[2].cantidad,lista1[3].cantidad,lista1[4].cantidad,lista1[5].cantidad,lista1[6].cantidad,lista1[7].cantidad,lista1[8].cantidad,lista1[9].cantidad,lista1[10].cantidad,lista1[11].cantidad]
            },
            {
                label          :'ano actual',
                backgroundColor:'rgba(210,214,222,1)',
                borderColor    :'rgba(210,214,222,1)',
                pointRadius    : false,
                pointColor     : '#c1c7d1',
                pointStrokeColor:'rgba(210,214,222,1)',
                pointHighlightFill:'#fff',
                pointHighlightStroke:'rgba(210,214,222,1)',
                data                :[lista[0].cantidad,lista[1].cantidad,lista[2].cantidad,lista[3].cantidad,lista[4].cantidad,lista[5].cantidad,lista[6].cantidad,lista[7].cantidad,lista[8].cantidad,lista[9].cantidad,lista[10].cantidad,lista[11].cantidad]
            },

        ]
    }
    let opciones={
        maintainAspectRatio:false,
        responsive:true,
    }
    let G2 = new Chart(canvasG2,{
        type:'bar',
        data:datos,
        options:opciones,
    })
}
$(document).on('click','#imprimirfaenastodas',(e)=>{
    Mostrar_Loader('Generando_Pdf');
    let id=$('#usuariseleccionado').val();
    let desde= $('#desdefaenas').val();
     let hasta=$('#hastafaenas').val();
     let sub=$('#usuariseleccionado1').val(); 
     if(sub=='0'){
        imprimir_todo_comun(id,desde,hasta);
     }else{
        imprimir_todo(id,desde,hasta);
     }
   
         
})
async function  imprimir_todo(id,desde,hasta){
    let data=await fetch('../controlador/PDFCONTROLLERFinformetodo.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'id='+id+'&&desde='+desde+'&&hasta='+hasta
    })
    if(data.ok){
        let response=await data.text();
        console.log(response);
       try{
            if(response!=''){
               cerrar_loader('exito_generar'); 
               window.open('../pdf/Fichastodas/pdf-'+id+'.pdf','_blank');
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
  async function  imprimir_todo_comun(id,desde,hasta){
    let data=await fetch('../controlador/PDFCONTROLLERFinformetodo_comun.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'id='+id+'&&desde='+desde+'&&hasta='+hasta
    })
    if(data.ok){
        let response=await data.text();
        console.log(response);
       try{
            if(response!=''){
               cerrar_loader('exito_generar'); 
               window.open('../pdf/Fichastodas/pdf-'+id+'.pdf','_blank');
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
  $(document).on('click','#imprimirfaenas',(e)=>{
    Mostrar_Loader('Generando_Pdf');
    let id=$('#usuariseleccionado').val();
    let desde= $('#desdefaenas').val();
     let hasta=$('#hastafaenas').val();
     let submatarife=$('#usuariseleccionado1').val();
     if(submatarife=='0'){
        imprimir_faenas_comun(id,desde,hasta);
     }else{
        imprimir_faenas(id,desde,hasta,submatarife);
     }
 
         
})
async function  imprimir_faenas(id,desde,hasta,submatarife){
    let data=await fetch('../controlador/PDFCONTROLLERFinforme.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'id='+id+'&&desde='+desde+'&&hasta='+hasta+'&&submatarife='+submatarife
    })
    if(data.ok){
        let response=await data.text();
        console.log(response);
       try{
            if(response==''){
               cerrar_loader('exito_generar'); 
               window.open('../pdf/Fichastodas/pdf-parcial.pdf','_blank');
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
  async function  imprimir_faenas_comun(id,desde,hasta){
    let data=await fetch('../controlador/PDFCONTROLLERFinforme_comun.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'id='+id+'&&desde='+desde+'&&hasta='+hasta
    })
    if(data.ok){
        let response=await data.text();
        console.log(response);
       try{
            if(response==''){
               cerrar_loader('exito_generar'); 
               window.open('../pdf/Fichastodas/pdf-parcial.pdf','_blank');
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
 