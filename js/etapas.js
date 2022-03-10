$(document).ready(function(){
cuantasetapas();
    function cuantasetapas(){
    funcion="veretapas";
    $.post('../controlador/EtapasController.php',{funcion},(response)=>{
        let cantidad='';
        const cuantas= JSON.parse(response);
        cantidad+=`${cuantas.cantidad}`;
        $('#cuantas').html(cantidad);
        $('#ingresos_cuantas').html(cantidad);
    })
}
$(document).on('click','#imprimirpdf',(e)=>{
    Mostrar_Loader('Generando_Pdf');
    let id=$('#id_ingresos').val();
            $.post('../controlador/PDFFinalizadoController.php',{id},(response)=>{
               if(response==''){
                cerrar_loader('exito_generar');  
                window.open('../pdf/finalizados/pdf-'+id+'.pdf','_blank');
               }else{
                cerrar_loader('error_generar');  
               }
            })

})
$(document).on('click','#imprimircsv',(e)=>{
    Mostrar_Loadercsv('Generando_Csv');
    let id=$('#id_ingresos').val();
    $.post('../controlador/ExcelController.php',{funcion,id},(response)=>{
        if(response==''){
         cerrar_loadercsv('exito_generar');  
         window.open('../csv/reporte_matanza-'+id+'.Csv','_blank');
        }else{
         cerrar_loadercsv('error_generar');  
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

})

        
