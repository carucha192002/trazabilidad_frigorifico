$(document).ready(function(){
    $('#gestion_resultados1').addClass('active');
    let funcion;
    faena_mes();
    faena_mes_anterior();
    async function faena_mes_anterior(){
        funcion='faena_mes_anterior';
        let lista=['','','','','','','','','','','',''];
        const response = await fetch('../controlador/GraficosController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
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
        funcion='faena_mes';
        let lista1=['','','','','','','','','','','',''];
        const response1 = await fetch('../controlador/GraficosController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
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
    let array=['','','','','','','','','','','',''];
     async function faena_mes(){
        funcion='faena_mes';
        const response = await fetch('../controlador/GraficosController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
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
})