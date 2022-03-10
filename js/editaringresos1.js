$(document).ready(function(){
    $('#agregarmuertoscantidadeditar').hide();
    $('#agregarmuertoskiloseditar').hide();
    $('#muertosmodaleditar').hide();
    $('#accionmuertoseditar').hide();
    $('#labelmuertoseditar').hide();
    $('#caidosmodaleditar').hide();
    $('#caidosmodal1editar').hide();
    $('#agregarcaidoscantidadeditar').hide();
    $('#agregarcaidoskiloseditar').hide();
    $('#accioncaidoseditar').hide();
    $('#digestormuertoseditar').hide();
    $('#digestorcaidoseditar').hide();
    $('#cuitusuariosubeditar').hide();
    $('#matarifesub_itemeditar').parent().hide();
    var funcion;
    var edit=false;
    $('.select2').select2();
    rellenar_matarifes();
    rellenar_productor();
    rellenar_destinos();
    rellenar_especies();
    rellenar_procedencia();
    rellenar_transporte();
    rellenar_chofer();
    rellenar_provincia();
    rellenar_corrales();
    rellenar_corraleros();
    rellenar_conservacion();
    function rellenar_conservacion() {
        funcion="rellenar_conservacion";
        $.post('../controlador/ConservacionController.php',{funcion},(response)=>{
            
            const conservaciones = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Conservacion</option>`;
            conservaciones.forEach(conservacion => {

                template+=`
                    <option value="${conservacion.id}">${conservacion.nombre}</option>
                `;
            });
            $('#conservacionmodaleditar').html(template);
        })
        $("#conservacionmodaleditar").change(function(){  
            $("#conservacionmodaleditar option:selected").each(function (){
                numeroconservacion = $(this).val();
                let id=numeroconservacion;
                funcion="datosconservacion_rellenar";
                 $.post('../controlador/ConservacionController.php',{funcion,id},(response)=>{
                     let grados='';
                     let vida='';
                     const conservacion = JSON.parse(response);
                     grados+=`${conservacion.grados}`;
                     vida+=`${conservacion.vida}`;
                     $('#conservaciontituloeditar').html('CONSERVACION GRADOS:'+' '+grados+' '+'VIDA UTIL:'+' '+vida);
                     $('#vencimientomodaleditar').val(vida);
            })
        })                
                })   
        }
    function rellenar_matarifes() {
        funcion="matarife_rellenar";
        $.post('../controlador/MatarifeController.php',{funcion},(response)=>{
            const matarifes = JSON.parse(response);
            let template='';
            
            template+=`
            <option value="0"> Seleccione Matarife</option>`;
            matarifes.forEach(matarife => {
                template+=`
                
                    <option value="${matarife.id}">${matarife.nombre}</option>
                `;
            });
            $('#matarifeeditar').html(template);
            
        })
        $("#matarifeeditar").change(function(){  
            $("#matarifeeditar option:selected").each(function (){
            numeromatarife = $(this).val();
            let id=numeromatarife;
            funcion="matarifecuit_rellenar";
             $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
                 let cuit='';
                 const numerocuit = JSON.parse(response);
                 cuit+=`${numerocuit.cuit}`;
                 $('#cuitusuarioeditar').html('USUARIO CUIT Nº'+' '+cuit);
        })
         funcion="ver_subitem";
        $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
            let cantidad='';
            const cantidadsub = JSON.parse(response);
            cantidad+=`${cantidadsub.cantidad}`;  
            if(cantidad>0){
                $('#cuitusuariosubeditar').show();
                $('#matarifesub_itemeditar').parent().show();
                funcion="matarife_rellenar_sub";
                $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
                    const matarifes = JSON.parse(response);
                    let template='';
                    
                    template+=`
                    <option value="0"> Seleccione SUB-CATEGORIA</option>`;
                    matarifes.forEach(matarife => {
                        template+=`
                        
                            <option value="${matarife.id}">${matarife.nombre}</option>
                        `;
                    });
                    $('#matarifesub_itemeditar').html(template);
                    
                })
            }else{
                $('#cuitusuariosubeditar').hide();
                $('#matarifesub_itemeditar').parent().hide();
                let template1='';
                template1+=`
                <option value="16"> Sin SUB-CATEGORIA</option>`;
                $('#matarifesub_itemeditar').html(template1);
            }
            
   })              
            })  
         }) 
    }
    
    function rellenar_productor() {
        funcion="productor_rellenar";
        $.post('../controlador/ProductorController.php',{funcion},(response)=>{
            const productores = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Productor</option>`;
            productores.forEach(productor => {

                template+=`
                    <option value="${productor.id}">${productor.nombre}</option>
                `;
            });
            $('#productorselecteditar').html(template);
        })
        $("#productorselecteditar").change(function(){  
            $("#productorselecteditar option:selected").each(function (){
            numeroproductor = $(this).val();
            let id=numeroproductor;
            funcion="productorcuit_rellenar";
             $.post('../controlador/ProductorController.php',{funcion,id},(response)=>{
                 let cuit='';
                 const numerocuit = JSON.parse(response);
                 cuit+=`${numerocuit.cuit}`;
                 $('#productorcuiteditar').html('PRODUCTOR CUIT Nº'+' '+cuit);
        })
                             
            })  
         }) 
    }
    function rellenar_destinos() {
        funcion="rellenar_destinos";
        $.post('../controlador/DestinoController.php',{funcion},(response)=>{
            const destinos = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Destino</option>`;
            destinos.forEach(destino => {

                template+=`
                    <option value="${destino.id}">${destino.nombre}</option>
                `;
            });
            $('#destinoselecteditar').html(template);
        })
       
    }
    function rellenar_especies() {
        funcion="rellenar_especies";
        $.post('../controlador/EspeciesController.php',{funcion},(response)=>{
            const especies = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Especie</option>`;
            especies.forEach(especie => {

                template+=`
                    <option value="${especie.id}">${especie.nombre}</option>
                `;
            });
            $('#especieselecteditar').html(template);
        })
        $("#especieselecteditar").change(function(){  
            $("#especieselecteditar option:selected").each(function (){
                numeroespecie = $(this).val();
                let id=numeroespecie;
                funcion="buscarsubcategoria";
                 $.post('../controlador/EspeciesController.php',{funcion,id},(response)=>{
                     const subespecies = JSON.parse(response);
            let template1='';
            template1+=`
            <option value="0"> Seleccione Sub-especie</option>`;
            subespecies.forEach(especie => {

                template1+=`
                    <option value="${especie.subcategoria}">${especie.nombre}</option>
                `;
            });
            $('#subespeciemodaleditar').html(template1);
            $('#subespecieagregarideditar').val(id);            
        })
        $("#subespeciemodaleditar").change(function(){  
            $("#subespeciemodaleditar option:selected").each(function (){
                numeroespecie = $(this).val();
                let id=numeroespecie;
                $('#subespecieagregaridguardareditar').val(id);
})
})
})
})

       
    }
    function rellenar_procedencia() {
        funcion="rellenar_procedencia";
        $.post('../controlador/ProcedenciaController.php',{funcion},(response)=>{
            const procedencias = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Procedencia</option>`;
            procedencias.forEach(procedencia => {

                template+=`
                    <option value="${procedencia.id}">${procedencia.nombre}</option>
                `;
            });
            $('#llenarprocedenciaeditar').html(template);
        })
       
    }
    function rellenar_transporte() {
        funcion="rellenar_transporte";
        $.post('../controlador/TransporteController.php',{funcion},(response)=>{
            const transportes = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Transporte</option>`;
            transportes.forEach(transporte => {

                template+=`
                    <option value="${transporte.id}">${transporte.nombre}</option>
                `;
            });
            $('#llenartransporteeditar').html(template);
        })
       
    }
    function rellenar_chofer() {
        funcion="rellenar_chofer";
        $.post('../controlador/ChoferController.php',{funcion},(response)=>{
            const choferes = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Chofer</option>`;
            choferes.forEach(chofer => {

                template+=`
                    <option value="${chofer.id}">${chofer.nombre}</option>
                `;
            });
            $('#llenarchofereditar').html(template);
        })
        $("#llenarchofereditar").change(function(){  
            $("#llenarchofereditar option:selected").each(function (){
                numerochofer = $(this).val();
                let id=numerochofer;
                
                funcion="datoschofer_rellenar";
                 $.post('../controlador/ChoferController.php',{funcion,id},(response)=>{
                     let dni='';
                     const datos = JSON.parse(response);
                     dni+=`${datos.dni}`;
                     $('#dnimodaleditar').val(dni);

            })
        })                
                }) 
       
    }
    function rellenar_corrales() {
        funcion="rellenar_corrales";
        $.post('../controlador/CorralController.php',{funcion},(response)=>{
            const corrales = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Nº Corral</option>`;
            corrales.forEach(corral => {

                template+=`
                    <option value="${corral.id}">${corral.nombre}</option>
                `;
            });
            $('#corralmodaleditar').html(template);
        })
       
    }
    function rellenar_corraleros() {
        funcion="rellenar_corraleros";
        $.post('../controlador/CorralerosController.php',{funcion},(response)=>{
            const corraleros = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Corralero</option>`;
            corraleros.forEach(corralero => {

                template+=`
                    <option value="${corralero.id}">${corralero.nombre}</option>
                `;
            });
            $('#corraleromodaleditar').html(template);
        })
       
    }
    function rellenar_provincia() {
        funcion="rellenar_provincia";
        $.post('../controlador/ProvinciaController.php',{funcion},(response)=>{
            const provincias = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Provincia</option>`;
            provincias.forEach(provincia => {

                template+=`
                    <option value="${provincia.id}">${provincia.nombre}</option>
                `;
            });
            $('#provinciamodaleditar').html(template);
            $("#provinciamodaleditar").change(function(){ 
                $("#provinciamodaleditar option:selected").each(function (){
                  id_provincia = $(this).val();
                  funcion="rellenar_localidades";
                  $.post('../controlador/ProvinciaController.php',{funcion,id_provincia},(response)=>{                  
                      const localidades = JSON.parse(response);
                      let template='';   
                      template+=`
                      <option value="0"> Seleccione Localidad</option>`;               
                      localidades.forEach(localidad => {
                          template+=`
                              <option value="${localidad.id}">${localidad.nombre}</option>                    
                          `;                
                      });
                      $('#localidadmodaleditar').html(template);
                     
                    })
                })
            })    
        })
       
    }
  
})
$(document).on('click','#agregarmuertoseditar',(e)=>{
    $('#agregarmuertoscantidadeditar').show();
    $('#agregarmuertoskiloseditar').show();
    $('#digestormuertoseditar').show();
    
})
$(document).on('click','#cerrarmuertoseditar',(e)=>{
    $('#agregarmuertoscantidadeditar').hide();
    $('#agregarmuertoskiloseditar').hide();
    $('#digestormuertoseditar').hide();
})
$(document).on('click','#agregarcaidoseditar',(e)=>{
    $('#agregarcaidoscantidadeditar').show();
    $('#agregarcaidoskiloseditar').show();
    $('#digestorcaidoseditar').show();
})
$(document).on('click','#cerrarcaidoseditar',(e)=>{
    $('#agregarcaidoscantidadeditar').hide();
    $('#agregarcaidoskiloseditar').hide();
    $('#digestorcaidoseditar').hide();
    
})
$(document).on('keyup','#cantidadmodaleditar',function(){
    let valor = $(this).val();
    $('#enpiemodaleditar').val(valor);

    if(valor.trim()>= 1){
        $('#muertosmodaleditar').show();
        $('#accionmuertoseditar').show();
        $('#labelmuertoseditar').show();
        $('#caidosmodaleditar').show();
        $('#caidosmodal1editar').show();
        $('#accioncaidoseditar').show();
    }
    else{
        $('#muertosmodaleditar').hide();
        $('#accionmuertoseditar').hide();
        $('#labelmuertoseditar').hide();
        $('#caidosmodaleditar').hide();
        $('#caidosmodal1editar').hide();
        $('#accioncaidoseditar').hide();
    }
    
});
$(document).on('click','#agregarmuertoseditar',(e)=>{
    let selector= document.getElementById('agregarmuertoscantidadeditar');
    let limite= parseFloat($('#enpiemodaleditar').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarmuertoscantidadeditar").change(function(){  
        $("#agregarmuertoscantidadeditar option:selected").each(function (){
          valor = $(this).val();
          if(valor.trim()>= 0){
            $('#muertosmodaleditar').val(valor);
            resultados();
        }   
              })
            })
      let selector1= document.getElementById('agregarmuertoskiloseditar');
        let limite1= parseFloat($('#kilospiemodaleditar').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarmuertoskiloseditar").change(function(){  
            $("#agregarmuertoskiloseditar option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#labelmuertoseditar').html('MUERTOS KGRS:'+' '+valor1);
                $('#agregarcaidoscantidadhiddeneditar').val(valor1);
                resultadoskilos();
            }   
                  })
                })
    })
    $(document).on('click','#agregarcaidoseditar',(e)=>{
        let selector= document.getElementById('agregarcaidoscantidadeditar');
        let limite= parseFloat($('#enpiemodaleditar').val())+parseFloat(1);
        for (let i = 0; i < limite; i++) {
            selector.options[i] = new Option(i,+i); 
         }
         $("#agregarcaidoscantidadeditar").change(function(){  
            $("#agregarcaidoscantidadeditar option:selected").each(function (){
              valor = $(this).val();
              if(valor.trim()>= 0){
                $('#caidosmodaleditar').val(valor);
                resultados();
            }   
                  })
                })
        let selector1= document.getElementById('agregarcaidoskiloseditar');
            let limite1= parseFloat($('#kilospiemodaleditar').val())+parseFloat(1);
            for (let i = 0; i < limite1; i++) {
                selector1.options[i] = new Option(i,+i); 
             }
             $("#agregarcaidoskiloseditar").change(function(){  
                $("#agregarcaidoskiloseditar option:selected").each(function (){
                  valor1 = $(this).val();
                  if(valor1.trim()>= 0){
                    $('#caidosmodal1editar').html('CAIDOS KGRS:'+' '+valor1);
                    $('#agregarcaidoskiloshiddeneditar').val(valor1);
                    resultadoskilos();
                }   
                      })
                    })
       
        })
    function resultados() {
        var cantidad=$('#cantidadmodaleditar').val();
        var cantidadmuertos=$('#muertosmodaleditar').val();
        var cantidadcaidos=$('#caidosmodaleditar').val();
        $('#enpiemodaleditar').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
    }
    $(document).on('keyup','#kilosmodaleditar',function(){
        let valor = $(this).val();
        $('#kilospiemodaleditar').val(valor);
    
        if(valor.trim()>= 1){
            $('#muertosmodaleditar').show();
            $('#accionmuertoseditar').show();
            $('#labelmuertoseditar').show();
            $('#caidosmodaleditar').show();
            $('#caidosmodal1editar').show();
            $('#accioncaidoseditar').show();
        }
        else{
            $('#muertosmodaleditar').hide();
            $('#accionmuertoseditar').hide();
            $('#labelmuertoseditar').hide();
            $('#caidosmodaleditar').hide();
            $('#caidosmodal1editar').hide();
            $('#accioncaidoseditar').hide();
        }
        
    });
        function resultadoskilos() {
            var cantidad=$('#kilosmodaleditar').val();
            var kilosmuertos=$('#agregarcaidoscantidadhiddeneditar').val();
            var kiloscaidos=$('#agregarcaidoskiloshiddeneditar').val();
            $('#kilospiemodaleditar').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
        }
        $(document).on('keyup','#guiamodaleditar',function(){
            let valor = $(this).val();
            if(valor.trim()!=""){
                $('#dtamodaleditar').val(valor); 
            }
            else{
                $('#dtamodaleditar').val('AGREGUE Nº DE GUIA POR FAVOR');
            }
        });

        