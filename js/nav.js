$(document).ready(function(){
cuantasetapas();
pararomaneos();
finalizados();
parciales();
procesar();
reduccion();
function reduccion(){
    funcion="reduciretapas";
    $.post('../controlador/EtapasController.php',{funcion},(response)=>{
       
        let cantidad='';
        const cuantas= JSON.parse(response);
        cantidad+=`${cuantas.cantidad}`;
        $('#cuantas').html(cantidad);
        $('#reduccion_cuantas').html(cantidad);
    })
}
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
function pararomaneos(){
    funcion="verificarromaneos";
    $.post('../controlador/CatalogoController.php',{funcion},(response)=>{
        
        let cantidad='';
        const verificar = JSON.parse(response);
        cantidad=+`${verificar.cantidad}`;
        $('#matanza_cuantas').html(cantidad);
    })
}

function finalizados(){
    funcion="verificarfinalizados";
    $.post('../controlador/ListadoController.php',{funcion},(response)=>{
        let cantidad='';
        const verificar = JSON.parse(response);
        cantidad=+`${verificar.cantidad}`;
        $('#finalizados_cuantas').html(cantidad);
    })

}
function parciales(){
    funcion="verificarparciales";
    $.post('../controlador/ListadoController.php',{funcion},(response)=>{
        let cantidad='';
        const verificar = JSON.parse(response);
        cantidad=+`${verificar.cantidad}`;
        $('#parciales_cuantas').html(cantidad);
    })

}
function procesar(){
    funcion="procesarfaena";
    $.post('../controlador/EtapasController.php',{funcion},(response)=>{
        let cantidad='';
        const verificar = JSON.parse(response);
        cantidad=+`${verificar.cantidad}`;
        $('#procesar_cuantas').html(cantidad);
    })

}
})

        
