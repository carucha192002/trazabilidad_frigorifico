$(document).ready(function() {
    $('#gestion_agenda1').addClass('active');
    moment().format();
    var date = new Date();
   var yyyy = date.getFullYear().toString();
   var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
   var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
        header: {
             language: 'es',
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay',

        },
        defaultDate: yyyy+"-"+mm+"-"+dd,
        editable: true,
       
       
       
        select: function(start, end, intervalos,fecha) {
            
            $('#ModalAdd #start').val(moment(start).format('HH:mm:ss'));
            $('#ModalAdd #end').val(moment(end).format('HH:mm:ss'));
            $('#ModalAdd #intervalos').val(moment(intervalos).format('HH:mm:ss'));
            $('#ModalAdd #intervalos1').val(moment(intervalos).format('HH:mm:ss'));
            $('#ModalAdd #fecha').val(moment(start).format('YYYY-MM-DD'));

            
      
        },
        dayClick: function(date, allDay,jsEvent,view){
            $(this).css('background-color','red');
            $('#fecha').val(date.format());
            var fecha = new Date(date.format());
            if(fecha.getDay()==0){
                $('#semana').val('Lunes');
            }else if (fecha.getDay()==1){
                $('#semana').val('Martes');
            }else if (fecha.getDay()==2){
                $('#semana').val('Miercoles');
            }else if (fecha.getDay()==3){
                $('#semana').val('Jueves');
            }else if (fecha.getDay()==4){
                $('#semana').val('Viernes');
            }else if (fecha.getDay()==5){
                $('#semana').val('Sabado');
            }else if (fecha.getDay()==6){
                $('#semana').val('Domingo');
            }
            
            $('#ModalAdd').modal('show');
        },
        events:{
            url: '../controlador/AgendaHistorialController.php'

        },
            
        eventRender: function(event, element) {
            element.bind('dblclick', function() {

                $('#ModalEditar #id_editar').val(event.id);
                $('#ModalEditar #tituloeditar').val(event.title);
                $('#ModalEditar').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position

            edit(event);

        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

            edit(event);

        },
    
    })  
    function edit(event){
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if(event.end){
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }else{
            end = start;
        }
        
        id =  event.id;
        
    
         
        let funcion="editar_drop";
        $.ajax({
         type: "POST",
         url:'../controlador/AgendaController.php',
         data:'funcion='+funcion+'&&id='+id+'&&start='+start+'&&end='+end,

         success: function(rep) {
            
                if(rep == 'editado'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se modifico la agenda correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        location.reload(true);
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se pudo modificar la agenda. Pruebe nuevamente!',
                    })
                }
            }
        });
    }
    
    $(document).on('click','#modificar',(e) => {
        let titulo=$('#tituloeditar').val();
        let color=$('#coloreditar').val();
        let textcolor=$('#textcoloreditar').val();
        let start=$('#starteditar').val();
        let end=$('#endeditar').val();
        let fecha=$('#fechaeditar').val();
        let id=$('#id_editar').val();
    
            funcion="editar_agenda";
            $.post('../controlador/AgendaController.php',{funcion,titulo,color,textcolor,start,end,fecha,id},(response)=>{
                if(response=='editado'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se modifico la agenda correctamente',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function(){
                    $('form-editar').trigger('reset');
                    location.reload(true);
                })
             }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudo modificar la agenda. Pruebe nuevamente!',
                })
             }
            })
    
    })
    $(document).on('click','#borrar',(e) => {
        let id=$('#id_editar').val();
    
            funcion="borrar_agenda";
            $.post('../controlador/AgendaController.php',{funcion,id},(response)=>{
                if(response=='borrado'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se borro el evento correctamente',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function(){
                    $('form-editar').trigger('reset');
                    location.reload(true);
                })
             }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudo modificar la agenda. Pruebe nuevamente!',
                })
             }
            })
    
    })
    $(document).on('click','#guardarturnos',(e) => {
        let titulo=$('#titulo').val();
        let color=$('#color').val();
        let textcolor=$('#textcolor').val();
        let start=$('#start').val()+":00";
        let end=$('#end').val()+":00";
        let intervalos=$('#intervalos').val()+":00";
        let intervalos1=$('#intervalos1').val()+":00";
        let fecha=$('#fecha').val();
        let semana=$('#semana').val();

            funcion="agregar_agenda";
           $.post('../controlador/AgendaController.php',{funcion,titulo,color,textcolor,start,end,fecha,semana},(response)=>{
            if(response=="guardado"){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se agrego a la agenda correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function(){
                    setTimeout('document.location.reload()',2000);
                })
             }
            })
    })
 
    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done'
    });
})
