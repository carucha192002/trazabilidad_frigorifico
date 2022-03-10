$(document).ready(function() {
  verificar_usuario();
    funcion = 'devolver_avatar';
    $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
      const avatar = JSON.parse(response);
      $('#avatar4').attr('src','../img/'+avatar.avatar);
      $('#avatar3').attr('src','../img/'+avatar.avatar);
    })
    funcion = 'despachos';
    $.post('../controlador/ResultadoController.php',{funcion},(response)=>{
     const respuesta=JSON.parse(response);
     $('#salidas_cuantas').html(respuesta.cantidad);
    })

    async function verificar_usuario(){
      funcion='tipo_usuario';
      let data=await fetch('../controlador/UsuarioController.php',{
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body:'funcion='+funcion
      })
      if(data.ok){
          let response=await data.text();
         try{
            let respuesta=JSON.parse(response);
    
              if(response==1){
                $('#gestion_lote').hide();
                $('#gestion_usuario').hide();
                $('#gestion_producto').hide();
                $('#gestion_atributo').hide();
                $('#gestion_proveedor').hide();
                $('#gestion_venta').hide();
                $('#ventas').hide();
                $('#almacen').hide();
                $('#compras').hide();
                $('#listar').hide();
                $('#gestion_productor').hide();
                $('#gestion_especies').hide();
                $('#gestion_corraleros').hide();
                $('#gestion_corral').hide();
                $('#gestion_procedencia').hide();
                $('#gestion_destino').hide();
                $('#gestion_chofer').hide();
                $('#gestion_matarife').hide();
                $('#gestion_transporte').hide();
                $('#gestion_conservacion').hide();
                $('#gestion_tropas').hide();
                $('#gestion_clasificacion').hide();
                $('#gestion_usuario').hide();
                $('#gestion_resultados').hide();
                $('#tituloresultado').hide();
                $('#ingresos_cuantas').hide();
                $('#ingresos_cuantas_campana').hide();
                $('#matanza_cuantas').hide();
                $('#matanza_cuantas_campana').hide();
                $('#procesar_cuantas').hide();
                $('#procesar_cuantas_campana').hide();
                $('#finalizados_cuantas').hide();
                $('#finalizados_cuantas_campana').hide();
                $('#reduccion_cuantas').hide();
                $('#reduccion_cuantas_campana').hide();
                $('#gestion_despacho').hide();
                $('#gestion_camara').hide();
                $('#gestion_despiece').hide();
                $('#reduccionid').hide();
                $('#etiquetasresultado').hide();
                $('#gestion_etiquetas').hide();
                
                $('#gestion_backup').hide();
                $('#backup').hide();
                $('#importantever').hide();
                $('#faenasver').hide();
                $('#procesarfaenasver').hide();
                $('#finalizadosver').hide();
                $('#parcialver').hide();
                $('#parciales_cuantas').hide();
                $('#gestion_resultadosproductor').hide();
                $('#tituloresultadoproductor').hide();
                $('#ingresover').hide();
                $('#faenados').hide();
                $('#gestion_faenados').hide();
                $('#gestion_devolucion').hide();
                $('#devolucion').hide();
                $('#gestion_informe').hide();
                $('#informes').hide();
                $('#gestion_agenda').hide();
                $('#agenda_titulo').hide();
               
              }
              else if(response==2){
                $('#gestion_lote').hide();
                $('#gestion_usuario').hide();
                $('#gestion_producto').hide();
                $('#gestion_atributo').hide();
                $('#gestion_proveedor').hide();
                $('#gestion_venta').hide();
                $('#ventas').hide();
                $('#almacen').hide();
                $('#compras').hide();
                $('#listar').hide();
                $('#gestion_productor').hide();
                $('#gestion_especies').hide();
                $('#gestion_corraleros').hide();
                $('#gestion_corral').hide();
                $('#gestion_procedencia').hide();
                $('#gestion_destino').hide();
                $('#gestion_chofer').hide();
                $('#gestion_matarife').hide();
                $('#gestion_transporte').hide();
                $('#gestion_conservacion').hide();
                $('#gestion_tropas').hide();
                $('#gestion_clasificacion').hide();
                $('#gestion_usuario').hide();
                $('#gestion_resultados').hide();
                $('#tituloresultado').hide();
                $('#ingresos_cuantas_campana').hide();
                $('#matanza_cuantas').hide();
                $('#matanza_cuantas_campana').hide();
                $('#procesar_cuantas').hide();
                $('#procesar_cuantas_campana').hide();
                $('#finalizados_cuantas').hide();
                $('#finalizados_cuantas_campana').hide();
                $('#reduccion_cuantas').hide();
                $('#reduccion_cuantas_campana').hide();
                $('#gestion_despacho').hide();
                $('#gestion_camara').hide();
                $('#gestion_despiece').hide();
                $('#reduccionid').hide();
                $('#etiquetasresultado').show();
                $('#gestion_etiquetas').show();
                $('#gestion_etiquetas1').show();
                $('#gestion_backup').hide();
                $('#backup').hide();
                $('#importantever').hide();
                $('#faenasver').hide();
                $('#procesarfaenasver').hide();
                $('#finalizadosver').hide();
                $('#parcialver').hide();
                $('#parciales_cuantas').hide();
                $('#gestion_resultadosproductor').hide();
                $('#tituloresultadoproductor').hide();
                $('#gestion_despacho').hide();
                $('#gestion_reportes').hide();
                $('#gestion_movcamara').hide();
                $('#faenados').hide();
                $('#gestion_faenados').hide();
                $('#gestion_devolucion').hide();
                $('#devolucion').hide();
                $('#gestion_informe').hide();
                $('#informes').hide();
                $('#gestion_agenda').hide();
                $('#agenda_titulo').hide();
                $('#gestion_reportes_diarios').hide();
                $('#gestion_reportes_diarios1').hide();
                $('#gestion_salidas').hide();
                $('#gestion_salidas1').hide();
                $('#gestion_faenados_obs').hide();
                $('#gestion_faenados_obs1').hide();
            
              }
              else if(response==5){
                $('#gestion_lote').hide();
                $('#gestion_usuario').hide();
                $('#gestion_producto').hide();
                $('#gestion_atributo').hide();
                $('#gestion_proveedor').hide();
                $('#gestion_venta').hide();
                $('#ventas').hide();
                $('#almacen').hide();
                $('#compras').hide();
                $('#listar').hide();
                $('#gestion_productor').hide();
                $('#gestion_especies').hide();
                $('#gestion_corraleros').hide();
                $('#gestion_corral').hide();
                $('#gestion_procedencia').hide();
                $('#gestion_destino').hide();
                $('#gestion_chofer').hide();
                $('#gestion_matarife').hide();
                $('#gestion_transporte').hide();
                $('#gestion_conservacion').hide();
                $('#gestion_tropas').hide();
                $('#gestion_clasificacion').hide();
                $('#gestion_usuario').hide();
                $('#gestion_resultados').hide();
                $('#tituloresultado').hide();
                $('#ingresover').hide();
                $('#ingresos_cuantas_campana').hide();
                $('#matanza_cuantas').hide();
                $('#matanza_cuantas_campana').hide();  
                $('#ingresos_cuantas').hide();
                $('#finalizados_cuantas').hide();
                $('#finalizados_cuantas_campana').hide();
                $('#reduccion_cuantas').hide();
                $('#reduccion_cuantas_campana').hide();
                $('#gestion_despacho').hide();
                $('#gestion_camara').hide();
                $('#gestion_despiece').hide();
                $('#reduccionid').hide();
                $('#etiquetasresultado').hide();
                $('#gestion_etiquetas').hide();
                $('#gestion_backup').hide();
                $('#backup').hide();
                $('#importantever').hide();
                $('#faenasver').hide();
                $('#finalizadosver').hide();
                $('#parcialver').hide();
                $('#parciales_cuantas').hide();
                $('#gestion_resultadosproductor').hide();
                $('#tituloresultadoproductor').hide();
                $('#gestion_despacho').hide();
                $('#gestion_reportes').hide();
                $('#gestion_movcamara').hide();
                $('#faenados').hide();
                $('#gestion_faenados').hide();
                $('#gestion_devolucion').hide();
                $('#devolucion').hide();
                $('#gestion_informe').hide();
                $('#informes').hide();
                $('#gestion_agenda').hide();
                $('#agenda_titulo').hide();
                
        
              }
              else if(response==4){
                
                $('#ingresos_cuantas').hide();
                $('#listar').hide();
                $('#gestion_productor').hide();
                $('#gestion_especies').hide();
                $('#gestion_corraleros').hide();
                $('#gestion_corral').hide();
                $('#gestion_procedencia').hide();
                $('#gestion_destino').hide();
                $('#gestion_chofer').hide();
                $('#gestion_matarife').hide();
                $('#gestion_transporte').hide();
                $('#gestion_conservacion').hide();
                $('#gestion_tropas').hide();
                $('#gestion_clasificacion').hide();
                $('#gestion_usuario').hide();
                $('#gestion_resultados').hide();
                $('#tituloresultado').hide();
              
                $('#matanza_cuantas').hide();
                $('#matanza_cuantas_campana').hide();
                $('#procesar_cuantas').hide();
                $('#procesar_cuantas_campana').hide();
                $('#finalizados_cuantas').hide();
                $('#finalizados_cuantas_campana').hide();
                $('#reduccion_cuantas').hide();
                $('#reduccion_cuantas_campana').hide();
                $('#gestion_despacho').hide();
                $('#gestion_reportes').hide();
                $('#gestion_movcamara').hide();
                $('#gestion_camara').hide();
                $('#gestion_despiece').hide();
                $('#reduccionid').hide();
                $('#etiquetasresultado').hide();
                $('#gestion_etiquetas').hide();
                $('#gestion_backup').hide();
                $('#backup').hide();
                $('#importantever').hide();
                $('#ingresover').hide();
                $('#faenasver').hide();
                $('#procesarfaenasver').hide();
                $('#finalizadosver').hide();
                $('#parcialver').hide();
                $('#parciales_cuantas').hide();
                $('#faenados').hide();
                $('#gestion_faenados').hide();
                $('#gestion_devolucion').hide();
                $('#devolucion').hide();
                $('#gestion_informe').hide();
                $('#informes').hide();
                $('#gestion_agenda').hide();
                $('#agenda_titulo').hide();
                $('#numero_notificacion').hide();
                $('#agenda_titulo').hide();
                $('#gestion_salidas').hide();
                $('#gestion_reportes_diarios').hide();
                $('#gestion_faenados_obs').hide();
              }
              else if(response==3){
                $('#gestion_resultadosproductor').hide();
                $('#tituloresultadoproductor').hide();
                
              }else if(response==6){
               
                
                  $('#ingresos_cuantas').hide();
                  $('#listar').hide();
                  $('#gestion_productor').hide();
                  $('#gestion_especies').hide();
                  $('#gestion_corraleros').hide();
                  $('#gestion_corral').hide();
                  $('#gestion_procedencia').hide();
                  $('#gestion_destino').hide();
                  $('#gestion_chofer').hide();
                  $('#gestion_matarife').hide();
                  $('#gestion_transporte').hide();
                  $('#gestion_conservacion').hide();
                  $('#gestion_tropas').hide();
                  $('#gestion_clasificacion').hide();
                  $('#gestion_usuario').hide();
                  $('#gestion_resultados').hide();
                  $('#tituloresultado').hide();
                  $('#gestion_resultadosproductor').hide();
                  $('#tituloresultadoproductor').hide();
                  $('#matanza_cuantas').hide();
                  $('#matanza_cuantas_campana').hide();
                  $('#procesar_cuantas').hide();
                  $('#procesar_cuantas_campana').hide();
                  $('#finalizados_cuantas').hide();
                  $('#finalizados_cuantas_campana').hide();
                  $('#reduccion_cuantas').hide();
                  $('#reduccion_cuantas_campana').hide();
                  $('#gestion_despacho').hide();
                  $('#gestion_reportes').hide();
                  $('#gestion_movcamara').hide();
                  $('#gestion_camara').hide();
                  $('#gestion_despiece').hide();
                  $('#reduccionid').hide();
                  $('#etiquetasresultado').hide();
                  $('#gestion_etiquetas').hide();
                  $('#gestion_backup').hide();
                  $('#backup').hide();
                  $('#importantever').hide();
                  $('#ingresover').hide();
                  $('#faenasver').hide();
                  $('#procesarfaenasver').hide();
                  $('#finalizadosver').hide();
                  $('#parcialver').hide();
                  $('#parciales_cuantas').hide();
                  $('#faenados').hide();
                  $('#gestion_faenados').hide();
                  $('#gestion_devolucion').hide();
                  $('#devolucion').hide();
                  $('#gestion_informe').hide();
                  $('#informes').hide();
                  $('#gestion_agenda').hide();
                  $('#agenda_titulo').hide();
                  $('#numero_notificacion').hide();
                  $('#agenda_titulo').hide();
                  $('#gestion_salidas').hide();
                  $('#gestion_reportes_diarios').show();
                  $('#gestion_faenados_obs').hide();
                  $('#active_nav_notificaciones').hide();
                }
        
             
          } catch(error){
             
              if(response.trim()=='error'){
                  location.href='../controlador/logout.php';
              }
          }
      }else{
          Swal.fire({
              icon: 'error',
              title: data.statusText,
             text: 'Hubo conflicto de codigo: '+data.status,
          })
      }
    
    }
   
})