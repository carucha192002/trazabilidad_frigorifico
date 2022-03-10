$(document).ready(function(){
    var fecha= document.getElementById('fechaguiamodal');
    fecha.addEventListener('change', setText);

    function setText() {
    var texto = document.getElementById('fechadtamodal');
    texto.value = fecha.value;
    }
    $('#agregarmuertoscantidad').hide();
    $('#agregarmuertoskilos').hide();
    $('#muertosmodal').hide();
    $('#accionmuertos').hide();
    $('#labelmuertos').hide();
    $('#caidosmodal').hide();
    $('#caidosmodal1').hide();
    $('#agregarcaidoscantidad').hide();
    $('#agregarcaidoskilos').hide();
    $('#accioncaidos').hide();
    $('#digestormuertos').hide();
    $('#digestorcaidos').hide();
    $('#cuitusuariosub').hide();
    $('#matarifesub_item').parent().hide();
    $('#subespc1').hide();
    $('#subespc2').hide();
    $('#subespc3').hide();
    $('#subespc4').hide();

    $('#agregarmuertoscantidad1').hide();
    $('#agregarmuertoskilos1').hide();
    $('#muertosmodal1').hide();
    $('#accionmuertos1').hide();
    $('#labelmuertos1').hide();
    $('#caidosmodalsub1').hide();
    $('#caidosmodalsub12').hide();
    $('#agregarcaidoscantidad1').hide();
    $('#agregarcaidoskilos1').hide();
    $('#accioncaidos1').hide();
    $('#digestormuertos1').hide();
    $('#digestorcaidos1').hide();
    
    $('#agregarmuertoscantidad2').hide();
    $('#agregarmuertoskilos2').hide();
    $('#muertosmodal2').hide();
    $('#accionmuertos2').hide();
    $('#labelmuertos2').hide();
    $('#caidosmodal2').hide();
    $('#caidosmodal12').hide();
    $('#agregarcaidoscantidad2').hide();
    $('#agregarcaidoskilos2').hide();
    $('#accioncaidos2').hide();
    $('#digestormuertos2').hide();
    $('#digestorcaidos2').hide();
    $('#desbloquear').hide();
   
    $('#agregarmuertoscantidad3').hide();
    $('#agregarmuertoskilos3').hide();
    $('#muertosmodal3').hide();
    $('#accionmuertos3').hide();
    $('#labelmuertos3').hide();
    $('#caidosmodal3').hide();
    $('#caidosmodal13').hide();
    $('#agregarcaidoscantidad3').hide();
    $('#agregarcaidoskilos3').hide();
    $('#accioncaidos3').hide();
    $('#digestormuertos3').hide();
    $('#digestorcaidos3').hide();

    $('#agregarmuertoscantidad4').hide();
    $('#agregarmuertoskilos4').hide();
    $('#muertosmodal4').hide();
    $('#accionmuertos4').hide();
    $('#labelmuertos4').hide();
    $('#caidosmodal4').hide();
    $('#caidosmodal14').hide();
    $('#agregarcaidoscantidad4').hide();
    $('#agregarcaidoskilos4').hide();
    $('#accioncaidos4').hide();
    $('#digestormuertos4').hide();
    $('#digestorcaidos4').hide();
    var funcion;
    var edit=false;
    $('.select2').select2();
    comenzar();
  
    $(document).on('click','#crear',(e)=>{
      
    }) 
    async function comenzar(){
        funcion="session";
        let data=await fetch('../controlador/TropasController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
        })
       
        if(data.ok){
            let response=await data.text();
           try{
            let respuesta=JSON.parse(response);
            console.log(respuesta);
            if(respuesta==3){
                $('#desbloquear').show();
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
            }else if(respuesta==2){
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
            }
            else{
                $('#desbloquear').hide();
            }

            } catch(error){
                console.log(error);
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
            $('#matarife').html(template);
            
        })
        $("#matarife").change(function(){  
            $("#matarife option:selected").each(function (){
            numeromatarife = $(this).val();
            let id=numeromatarife;
           
            funcion="matarifecuit_rellenar";
             $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
                
                 let cuit='';
                 let email='';
                 const numerocuit = JSON.parse(response);
                 cuit+=`${numerocuit.cuit}`;
                 email+=`${numerocuit.email}`;
                 $('#cuitusuario').html('USUARIO CUIT Nº'+' '+cuit);
                 $('#emailusuario').val(email);
                
        })
        funcion="ver_subitem";
        $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
            let cantidad='';
            const cantidadsub = JSON.parse(response);
            cantidad+=`${cantidadsub.cantidad}`;  
            if(cantidad>0){
                $('#cuitusuariosub').show();
                $('#matarifesub_item').parent().show();
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
                    $('#matarifesub_item').html(template);
                    
                })
            }else{
                $('#cuitusuariosub').hide();
                $('#matarifesub_item').parent().hide();
                let template1='';
                template1+=`
                <option value="16"> Sin SUB-CATEGORIA</option>`;
                $('#matarifesub_item').html(template1);
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
            $('#productorselect').html(template);
        })
        $("#productorselect").change(function(){  
            $("#productorselect option:selected").each(function (){
            numeroproductor = $(this).val();
            let id=numeroproductor;
            funcion="productorcuit_rellenar";
             $.post('../controlador/ProductorController.php',{funcion,id},(response)=>{
                 let cuit='';
                 const numerocuit = JSON.parse(response);
                 cuit+=`${numerocuit.cuit}`;
                 $('#productorcuit').html('PRODUCTOR CUIT Nº'+' '+cuit);
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
            $('#destinoselect').html(template);
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
            $('#especieselect').html(template);
        })
        $("#especieselect").change(function(){  
            $("#especieselect option:selected").each(function (){
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
                    <option value="${especie.subcategoria}">${especie.nombre}||${especie.codigo}||${especie.diente}</option>
                `;
            });
            $('#subespeciemodal').html(template1);
            $('#subespecieagregarid').val(id);   
            $('#subespeciemodal1').html(template1);
            $('#subespecieagregarid1').val(id);    
            $('#subespeciemodal2').html(template1);
            $('#subespecieagregarid2').val(id);
            $('#subespeciemodal3').html(template1);
            $('#subespecieagregarid3').val(id);     
            $('#subespeciemodal4').html(template1);
            $('#subespecieagregarid4').val(id);              
        })
        $("#subespeciemodal").change(function(){  
            $("#subespeciemodal option:selected").each(function (){
                numeroespecie = $(this).val();
                let id=numeroespecie;
                $('#subespecieagregaridguardar').val(id);
                
})
})
        $("#subespeciemodal1").change(function(){  
                    $("#subespeciemodal1 option:selected").each(function (){
                        numeroespecie = $(this).val();
                        let id=numeroespecie;
                        $('#subespecieagregaridguardar1').val(id);
                        
        })
        })
        $("#subespeciemodal2").change(function(){  
            $("#subespeciemodal2 option:selected").each(function (){
                numeroespecie = $(this).val();
                let id=numeroespecie;
                $('#subespecieagregaridguardar2').val(id);
                
})
})
$("#subespeciemodal3").change(function(){  
    $("#subespeciemodal3 option:selected").each(function (){
        numeroespecie = $(this).val();
        let id=numeroespecie;
        $('#subespecieagregaridguardar3').val(id);
        
})
})
$("#subespeciemodal4").change(function(){  
    $("#subespeciemodal4 option:selected").each(function (){
        numeroespecie = $(this).val();
        let id=numeroespecie;
        $('#subespecieagregaridguardar4').val(id);
        
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
            $('#llenarprocedencia').html(template);
        })
       
    }
    function rellenar_transporte() {
        funcion="rellenar_transporte";
        $.post('../controlador/TransporteController.php',{funcion},(response)=>{
            const transportes = JSON.parse(response);
            let template='';
            template+=`
            <option value="0"> Seleccione Dominio del Transporte</option>`;
            transportes.forEach(transporte => {

                template+=`
                    <option value="${transporte.id}">${transporte.nombre}</option>
                `;
            });
            $('#llenartransporte').html(template);
        })
        $("#llenartransporte").change(function(){  
            $("#llenartransporte option:selected").each(function (){
                habilitacion = $(this).val();
                funcion="datostransporte_rellenar";
                 $.post('../controlador/TransporteController.php',{funcion,habilitacion},(response)=>{
                     const datos = JSON.parse(response);
                     $('#habilitacionmodal').val(datos.habilitacion);

            })
        })                
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
            $('#llenarchofer').html(template);
        })
        $("#llenarchofer").change(function(){  
            $("#llenarchofer option:selected").each(function (){
                numerochofer = $(this).val();
                let id=numerochofer;
                funcion="datoschofer_rellenar";
                 $.post('../controlador/ChoferController.php',{funcion,id},(response)=>{
                     let dni='';
                     const datos = JSON.parse(response);
                     dni+=`${datos.dni}`;
                     $('#dnimodal').val(dni);

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
            $('#corralmodal').html(template);
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
            $('#corraleromodal').html(template);
        })
       
    }
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
            $('#conservacionmodal').html(template);
        })
        $("#conservacionmodal").change(function(){  
            $("#conservacionmodal option:selected").each(function (){
                numeroconservacion = $(this).val();
                let id=numeroconservacion;
                funcion="datosconservacion_rellenar";
                 $.post('../controlador/ConservacionController.php',{funcion,id},(response)=>{
                     let grados='';
                     let vida='';
                     const conservacion = JSON.parse(response);
                     grados+=`${conservacion.grados}`;
                     vida+=`${conservacion.vida}`;
                     $('#conservaciontitulo').html('CONSERVACION GRADOS:'+' '+grados+' '+'VIDA UTIL:'+' '+vida);
                     $('#vencimientomodal').val(vida);
            })
        })                
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
            $('#provinciamodal').html(template);
            $("#provinciamodal").change(function(){ 
                $("#provinciamodal option:selected").each(function (){
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
                      $('#localidadmodal').html(template);
                     
                    })
                })
            })    
        })
       
    }
  
})
$(document).on('click','#desbloquear',(e)=>{
    document.getElementById('fechamodal').disabled = false;
    e.preventDefault();
})
$(document).on('click','#agregarmuertos',(e)=>{
    $('#agregarmuertoscantidad').show();
    $('#agregarmuertoskilos').show();
    $('#digestormuertos').show();
    
})
$(document).on('click','#cerrarmuertos',(e)=>{
    $('#agregarmuertoscantidad').hide();
    $('#agregarmuertoskilos').hide();
    $('#digestormuertos').hide();
    
})
$(document).on('click','#agregarmuertos1',(e)=>{
    $('#agregarmuertoscantidad1').show();
    $('#agregarmuertoskilos1').show();
    $('#digestormuertos1').show();
    
})
$(document).on('click','#cerrarmuertos1',(e)=>{
    $('#agregarmuertoscantidad1').hide();
    $('#agregarmuertoskilos1').hide();
    $('#digestormuertos1').hide();
    
})
$(document).on('click','#agregarmuertos2',(e)=>{
    $('#agregarmuertoscantidad2').show();
    $('#agregarmuertoskilos2').show();
    $('#digestormuertos2').show();
    
})
$(document).on('click','#cerrarmuertos2',(e)=>{
    $('#agregarmuertoscantidad2').hide();
    $('#agregarmuertoskilos2').hide();
    $('#digestormuertos2').hide();
    
})
$(document).on('click','#agregarmuertos3',(e)=>{
    $('#agregarmuertoscantidad3').show();
    $('#agregarmuertoskilos3').show();
    $('#digestormuertos3').show();
    
})
$(document).on('click','#cerrarmuertos3',(e)=>{
    $('#agregarmuertoscantidad3').hide();
    $('#agregarmuertoskilos3').hide();
    $('#digestormuertos3').hide();
    
})
$(document).on('click','#agregarmuertos4',(e)=>{
    $('#agregarmuertoscantidad4').show();
    $('#agregarmuertoskilos4').show();
    $('#digestormuertos4').show();
    
})
$(document).on('click','#cerrarmuertos4',(e)=>{
    $('#agregarmuertoscantidad4').hide();
    $('#agregarmuertoskilos4').hide();
    $('#digestormuertos4').hide();
    
})
$(document).on('click','#agregarcaidos',(e)=>{
    $('#agregarcaidoscantidad').show();
    $('#agregarcaidoskilos').show();
    $('#digestorcaidos').show();
})
$(document).on('click','#cerrarcaidos',(e)=>{
    $('#agregarcaidoscantidad').hide();
    $('#agregarcaidoskilos').hide();
    $('#digestorcaidos').hide();
    
})
$(document).on('click','#agregarcaidos1',(e)=>{
    $('#agregarcaidoscantidad1').show();
    $('#agregarcaidoskilos1').show();
    $('#digestorcaidos1').show();
})
$(document).on('click','#cerrarcaidos1',(e)=>{
    $('#agregarcaidoscantidad1').hide();
    $('#agregarcaidoskilos1').hide();
    $('#digestorcaidos1').hide();
    
})
$(document).on('click','#agregarcaidos2',(e)=>{
    $('#agregarcaidoscantidad2').show();
    $('#agregarcaidoskilos2').show();
    $('#digestorcaidos2').show();
})
$(document).on('click','#cerrarcaidos2',(e)=>{
    $('#agregarcaidoscantidad2').hide();
    $('#agregarcaidoskilos2').hide();
    $('#digestorcaidos2').hide();
    
})
$(document).on('click','#agregarcaidos3',(e)=>{
    $('#agregarcaidoscantidad3').show();
    $('#agregarcaidoskilos3').show();
    $('#digestorcaidos3').show();
})
$(document).on('click','#cerrarcaidos3',(e)=>{
    $('#agregarcaidoscantidad3').hide();
    $('#agregarcaidoskilos3').hide();
    $('#digestorcaidos3').hide();
    
})
$(document).on('click','#agregarcaidos4',(e)=>{
    $('#agregarcaidoscantidad4').show();
    $('#agregarcaidoskilos4').show();
    $('#digestorcaidos4').show();
})
$(document).on('click','#cerrarcaidos4',(e)=>{
    $('#agregarcaidoscantidad4').hide();
    $('#agregarcaidoskilos4').hide();
    $('#digestorcaidos4').hide();
    
})
$(document).on('keyup','#cantidadmodal',function(){
    let valor = $(this).val();
    $('#enpiemodal').val(valor);

    if(valor.trim()>= 1){
        $('#muertosmodal').show();
        $('#accionmuertos').show();
        $('#labelmuertos').show();
        $('#caidosmodal').show();
        $('#caidosmodal1').show();
        $('#accioncaidos').show();
    }
    else{
        $('#muertosmodal').hide();
        $('#accionmuertos').hide();
        $('#labelmuertos').hide();
        $('#caidosmodal').hide();
        $('#caidosmodal1').hide();
        $('#accioncaidos').hide();
    }
    
});
$(document).on('keyup','#cantidadmodal1',function(){
    let valor = $(this).val();
    $('#enpiemodal1').val(valor);

    if(valor.trim()>= 1){
        $('#muertosmodal1').show();
        $('#accionmuertos1').show();
        $('#labelmuertos1').show();
        $('#caidosmodalsub12').show();
        $('#caidosmodalsub1').show();
        $('#accioncaidos1').show();
    }
    else{
        $('#muertosmodal1').hide();
        $('#accionmuertos1').hide();
        $('#labelmuertos1').hide();
        $('#caidosmodalsub12').hide();
        $('#caidosmodalsub1').hide();
        $('#accioncaidos1').hide();
    }
    
});
$(document).on('keyup','#cantidadmodal2',function(){
    let valor = $(this).val();
    $('#enpiemodal2').val(valor);

    if(valor.trim()>= 1){
        $('#muertosmodal2').show();
        $('#accionmuertos2').show();
        $('#labelmuertos2').show();
        $('#caidosmodal2').show();
        $('#caidosmodal12').show();
        $('#accioncaidos2').show();
    }
    else{
        $('#muertosmodal2').hide();
        $('#accionmuertos2').hide();
        $('#labelmuertos2').hide();
        $('#caidosmodal2').hide();
        $('#caidosmodal12').hide();
        $('#accioncaidos2').hide();
    }
    
});
$(document).on('keyup','#cantidadmodal3',function(){
    let valor = $(this).val();
    $('#enpiemodal3').val(valor);

    if(valor.trim()>= 1){
        $('#muertosmodal3').show();
        $('#accionmuertos3').show();
        $('#labelmuertos3').show();
        $('#caidosmodal3').show();
        $('#caidosmodal13').show();
        $('#accioncaidos3').show();
    }
    else{
        $('#muertosmodal3').hide();
        $('#accionmuertos3').hide();
        $('#labelmuertos3').hide();
        $('#caidosmodal3').hide();
        $('#caidosmodal13').hide();
        $('#accioncaidos3').hide();
    }
    
});
$(document).on('keyup','#cantidadmodal4',function(){
    let valor = $(this).val();
    $('#enpiemodal4').val(valor);

    if(valor.trim()>= 1){
        $('#muertosmodal4').show();
        $('#accionmuertos4').show();
        $('#labelmuertos4').show();
        $('#caidosmodal4').show();
        $('#caidosmodal14').show();
        $('#accioncaidos4').show();
    }
    else{
        $('#muertosmodal4').hide();
        $('#accionmuertos4').hide();
        $('#labelmuertos4').hide();
        $('#caidosmodal4').hide();
        $('#caidosmodal14').hide();
        $('#accioncaidos4').hide();
    }
    
});
function agregarmuertos(){
    let selector= document.getElementById('agregarmuertoscantidad');
    let limite= parseFloat($('#enpiemodal').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarmuertoscantidad").change(function(){  
        $("#agregarmuertoscantidad option:selected").each(function (){
          valor = $(this).val();
          if(valor.trim()>= 0){
            $('#muertosmodal').val(valor);
            resultados();
            var cantidad=$('#cantidadmodal').val();
            var cantidadmuertos=$('#muertosmodal').val();
            var cantidadcaidos=$('#caidosmodal').val();
            $('#enpiemodal').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
      let selector1= document.getElementById('agregarmuertoskilos');
        let limite1= parseFloat($('#kilospiemodal').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarmuertoskilos").change(function(){  
            $("#agregarmuertoskilos option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#labelmuertos').html('MUERTOS KGRS:'+' '+valor1);
                $('#agregarcaidoscantidadhidden').val(valor1);
                resultadoskilos();
                var cantidad=$('#kilosmodal').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden').val();
                $('#kilospiemodal').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarmuertos1(){
    let selector= document.getElementById('agregarmuertoscantidad1');
    let limite= parseFloat($('#enpiemodal1').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarmuertoscantidad1").change(function(){  
        $("#agregarmuertoscantidad1 option:selected").each(function (){
          valor = $(this).val();
          if(valor.trim()>= 0){
            $('#muertosmodal1').val(valor);
            resultados1();
            var cantidad=$('#cantidadmodal1').val();
            var cantidadmuertos=$('#muertosmodal1').val();
            var cantidadcaidos=$('#caidosmodalsub1').val();
            $('#enpiemodal1').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
      let selector1= document.getElementById('agregarmuertoskilos1');
        let limite1= parseFloat($('#kilospiemodal1').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarmuertoskilos1").change(function(){  
            $("#agregarmuertoskilos1 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#labelmuertos1').html('MUERTOS KGRS:'+' '+valor1);
                $('#agregarcaidoscantidadhidden1').val(valor1);
                resultadoskilos();
                var cantidad=$('#kilosmodal1').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden1').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden1').val();
                $('#kilospiemodal1').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarmuertos2(){
    let selector= document.getElementById('agregarmuertoscantidad2');
    let limite= parseFloat($('#enpiemodal2').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarmuertoscantidad2").change(function(){  
        $("#agregarmuertoscantidad2 option:selected").each(function (){
          valor = $(this).val();
          if(valor.trim()>= 0){
            $('#muertosmodal2').val(valor);
            resultados2();
            var cantidad=$('#cantidadmodal2').val();
            var cantidadmuertos=$('#muertosmodal2').val();
            var cantidadcaidos=$('#caidosmodal2').val();
            $('#enpiemodal2').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
      let selector1= document.getElementById('agregarmuertoskilos2');
        let limite1= parseFloat($('#kilospiemodal2').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarmuertoskilos2").change(function(){  
            $("#agregarmuertoskilos2 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#labelmuertos2').html('MUERTOS KGRS:'+' '+valor1);
                $('#agregarcaidoscantidadhidden2').val(valor1);
                resultadoskilos();
                var cantidad=$('#kilosmodal2').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden2').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden2').val();
                $('#kilospiemodal2').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarmuertos3(){
    let selector= document.getElementById('agregarmuertoscantidad3');
    let limite= parseFloat($('#enpiemodal3').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarmuertoscantidad3").change(function(){  
        $("#agregarmuertoscantidad3 option:selected").each(function (){
          valor = $(this).val();
          if(valor.trim()>= 0){
            $('#muertosmodal3').val(valor);
            resultados3();
            var cantidad=$('#cantidadmodal3').val();
            var cantidadmuertos=$('#muertosmodal3').val();
            var cantidadcaidos=$('#caidosmodal3').val();
            $('#enpiemodal3').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
      let selector1= document.getElementById('agregarmuertoskilos3');
        let limite1= parseFloat($('#kilospiemodal3').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarmuertoskilos3").change(function(){  
            $("#agregarmuertoskilos3 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#labelmuertos3').html('MUERTOS KGRS:'+' '+valor1);
                $('#agregarcaidoscantidadhidden3').val(valor1);
                resultadoskilos();
                var cantidad=$('#kilosmodal3').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden3').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden3').val();
                $('#kilospiemodal3').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarmuertos4(){
    let selector= document.getElementById('agregarmuertoscantidad4');
    let limite= parseFloat($('#enpiemodal4').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarmuertoscantidad4").change(function(){  
        $("#agregarmuertoscantidad4 option:selected").each(function (){
          valor = $(this).val();
          if(valor.trim()>= 0){
            $('#muertosmodal4').val(valor);
            resultados4();
            var cantidad=$('#cantidadmodal4').val();
            var cantidadmuertos=$('#muertosmodal4').val();
            var cantidadcaidos=$('#caidosmodal4').val();
            $('#enpiemodal4').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
      let selector1= document.getElementById('agregarmuertoskilos4');
        let limite1= parseFloat($('#kilospiemodal4').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarmuertoskilos4").change(function(){  
            $("#agregarmuertoskilos4 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#labelmuertos4').html('MUERTOS KGRS:'+' '+valor1);
                $('#agregarcaidoscantidadhidden4').val(valor1);
                resultadoskilos();
                var cantidad=$('#kilosmodal4').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden4').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden4').val();
                $('#kilospiemodal4').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarcaidos(){
    let selector= document.getElementById('agregarcaidoscantidad');
    let limite= parseFloat($('#enpiemodal').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarcaidoscantidad").change(function(){  
        $("#agregarcaidoscantidad option:selected").each(function (){
          valor = $(this).val();
          if(valor>= 0){
            $('#caidosmodal').val(valor);
            resultados();
            var cantidad=$('#cantidadmodal').val();
        var cantidadmuertos=$('#muertosmodal').val();
        var cantidadcaidos=$('#caidosmodal').val();
        $('#enpiemodal').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
    let selector1= document.getElementById('agregarcaidoskilos');
        let limite1= parseFloat($('#kilospiemodal').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarcaidoskilos").change(function(){  
            $("#agregarcaidoskilos option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#caidosmodal1').html('CAIDOS KGRS:'+' '+valor1);
                $('#agregarcaidoskiloshidden').val(valor1);
                resultadoskilos1();
                var cantidad=$('#kilosmodal').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden').val();
                $('#kilospiemodal').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarcaidos1(){
    let selector= document.getElementById('agregarcaidoscantidad1');
    let limite= parseFloat($('#enpiemodal1').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarcaidoscantidad1").change(function(){  
        $("#agregarcaidoscantidad1 option:selected").each(function (){
          valor = $(this).val();
          if(valor>= 0){
            $('#caidosmodalsub1').val(valor);
            resultados1();
            var cantidad=$('#cantidadmodal1').val();
        var cantidadmuertos=$('#muertosmodal1').val();
        var cantidadcaidos=$('#caidosmodalsub1').val();
        $('#enpiemodal1').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
    let selector1= document.getElementById('agregarcaidoskilos1');
        let limite1= parseFloat($('#kilospiemodal1').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarcaidoskilos1").change(function(){  
            $("#agregarcaidoskilos1 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#caidosmodalsub12').html('CAIDOS KGRS:'+' '+valor1);
                $('#agregarcaidoskiloshidden1').val(valor1);
                resultadoskilos1();
                var cantidad=$('#kilosmodal1').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden1').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden1').val();
                $('#kilospiemodal1').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarcaidos2(){
    let selector= document.getElementById('agregarcaidoscantidad2');
    let limite= parseFloat($('#enpiemodal2').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarcaidoscantidad2").change(function(){  
        $("#agregarcaidoscantidad2 option:selected").each(function (){
          valor = $(this).val();
          if(valor>= 0){
            $('#caidosmodal2').val(valor);
            resultados2();
            var cantidad=$('#cantidadmodal2').val();
        var cantidadmuertos=$('#muertosmodal2').val();
        var cantidadcaidos=$('#caidosmodal2').val();
        $('#enpiemodal2').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
    let selector1= document.getElementById('agregarcaidoskilos2');
        let limite1= parseFloat($('#kilospiemodal2').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarcaidoskilos2").change(function(){  
            $("#agregarcaidoskilos2 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#caidosmodal12').html('CAIDOS KGRS:'+' '+valor1);
                $('#agregarcaidoskiloshidden2').val(valor1);
                resultadoskilos2();
                var cantidad=$('#kilosmodal2').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden2').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden2').val();
                $('#kilospiemodal2').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarcaidos3(){
    let selector= document.getElementById('agregarcaidoscantidad3');
    let limite= parseFloat($('#enpiemodal3').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarcaidoscantidad3").change(function(){  
        $("#agregarcaidoscantidad3 option:selected").each(function (){
          valor = $(this).val();
          if(valor>= 0){
            $('#caidosmodal3').val(valor);
            resultados2();
            var cantidad=$('#cantidadmodal3').val();
        var cantidadmuertos=$('#muertosmodal3').val();
        var cantidadcaidos=$('#caidosmodal3').val();
        $('#enpiemodal3').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
    let selector1= document.getElementById('agregarcaidoskilos3');
        let limite1= parseFloat($('#kilospiemodal3').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarcaidoskilos3").change(function(){  
            $("#agregarcaidoskilos3 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#caidosmodal13').html('CAIDOS KGRS:'+' '+valor1);
                $('#agregarcaidoskiloshidden3').val(valor1);
                resultadoskilos2();
                var cantidad=$('#kilosmodal3').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden3').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden3').val();
                $('#kilospiemodal3').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
function agregarcaidos4(){
    let selector= document.getElementById('agregarcaidoscantidad4');
    let limite= parseFloat($('#enpiemodal4').val())+parseFloat(1);
    for (let i = 0; i < limite; i++) {
        selector.options[i] = new Option(i,+i); 
     }
     $("#agregarcaidoscantidad4").change(function(){  
        $("#agregarcaidoscantidad4 option:selected").each(function (){
          valor = $(this).val();
          if(valor>= 0){
            $('#caidosmodal4').val(valor);
            resultados2();
            var cantidad=$('#cantidadmodal4').val();
        var cantidadmuertos=$('#muertosmodal4').val();
        var cantidadcaidos=$('#caidosmodal4').val();
        $('#enpiemodal4').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }   
              })
            })
    let selector1= document.getElementById('agregarcaidoskilos4');
        let limite1= parseFloat($('#kilospiemodal4').val())+parseFloat(1);
        for (let i = 0; i < limite1; i++) {
            selector1.options[i] = new Option(i,+i); 
         }
         $("#agregarcaidoskilos4").change(function(){  
            $("#agregarcaidoskilos4 option:selected").each(function (){
              valor1 = $(this).val();
              if(valor1.trim()>= 0){
                $('#caidosmodal14').html('CAIDOS KGRS:'+' '+valor1);
                $('#agregarcaidoskiloshidden4').val(valor1);
                resultadoskilos2();
                var cantidad=$('#kilosmodal4').val();
                var kilosmuertos=$('#agregarcaidoscantidadhidden4').val();
                var kiloscaidos=$('#agregarcaidoskiloshidden4').val();
                $('#kilospiemodal4').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
            }   
                  })
                })
}
$(document).on('click','#agregarmuertos',(e)=>{
   agregarmuertos();
    })
$(document).on('click','#agregarmuertos1',(e)=>{
    agregarmuertos1();
     })
$(document).on('click','#agregarmuertos2',(e)=>{
    agregarmuertos2();
     })
$(document).on('click','#agregarmuertos3',(e)=>{
     agregarmuertos3();
    })
$(document).on('click','#agregarmuertos4',(e)=>{
    agregarmuertos4();
    })
 $(document).on('click','#agregarcaidos',(e)=>{
    agregarcaidos();
    })

 $(document).on('click','#agregarcaidos1',(e)=>{
    agregarcaidos1();
    })

 $(document).on('click','#agregarcaidos2',(e)=>{
    agregarcaidos2();
    })
$(document).on('click','#agregarcaidos3',(e)=>{
    agregarcaidos3();
    })
$(document).on('click','#agregarcaidos4',(e)=>{
    agregarcaidos4();
    })
  
    $(document).on('keyup','#kilosmodal',function(){
        let valor = $(this).val();
        $('#kilospiemodal').val(valor);
    
        if(valor.trim()>= 1){
            $('#muertosmodal').show();
            $('#accionmuertos').show();
            $('#labelmuertos').show();
            $('#caidosmodal').show();
            $('#caidosmodal1').show();
            $('#accioncaidos').show();
        }
        else{
            $('#muertosmodal').hide();
            $('#accionmuertos').hide();
            $('#labelmuertos').hide();
            $('#caidosmodal').hide();
            $('#caidosmodal1').hide();
            $('#accioncaidos').hide();
        }
        
    });
    $(document).on('keyup','#kilosmodal1',function(){
        let valor = $(this).val();
        $('#kilospiemodal1').val(valor);
    
        if(valor.trim()>= 1){
            $('#muertosmodal1').show();
            $('#accionmuertos1').show();
            $('#labelmuertos1').show();
            $('#caidosmodal1').show();
            $('#caidosmodalsub1').show();
            $('#accioncaidos1').show();
        }
        else{
            $('#muertosmodal1').hide();
            $('#accionmuertos1').hide();
            $('#labelmuertos1').hide();
            $('#caidosmodal1').hide();
            $('#caidosmodalsub1').hide();
            $('#accioncaidos1').hide();
        }
        
    });
    $(document).on('keyup','#kilosmodal2',function(){
        let valor = $(this).val();
        $('#kilospiemodal2').val(valor);
    
        if(valor.trim()>= 1){
            $('#muertosmodal2').show();
            $('#accionmuertos2').show();
            $('#labelmuertos2').show();
            $('#caidosmodal2').show();
            $('#caidosmodal12').show();
            $('#accioncaidos2').show();
        }
        else{
            $('#muertosmodal2').hide();
            $('#accionmuertos2').hide();
            $('#labelmuertos2').hide();
            $('#caidosmodal2').hide();
            $('#caidosmodal12').hide();
            $('#accioncaidos2').hide();
        }
        
    });
    $(document).on('keyup','#kilosmodal3',function(){
        let valor = $(this).val();
        $('#kilospiemodal3').val(valor);
    
        if(valor.trim()>= 1){
            $('#muertosmodal3').show();
            $('#accionmuertos3').show();
            $('#labelmuertos3').show();
            $('#caidosmodal3').show();
            $('#caidosmodal13').show();
            $('#accioncaidos3').show();
        }
        else{
            $('#muertosmodal3').hide();
            $('#accionmuertos3').hide();
            $('#labelmuertos3').hide();
            $('#caidosmodal3').hide();
            $('#caidosmodal13').hide();
            $('#accioncaidos3').hide();
        }
        
    });
    $(document).on('keyup','#kilosmodal4',function(){
        let valor = $(this).val();
        $('#kilospiemodal4').val(valor);
    
        if(valor.trim()>= 1){
            $('#muertosmodal4').show();
            $('#accionmuertos4').show();
            $('#labelmuertos4').show();
            $('#caidosmodal4').show();
            $('#caidosmodal14').show();
            $('#accioncaidos4').show();
        }
        else{
            $('#muertosmodal4').hide();
            $('#accionmuertos4').hide();
            $('#labelmuertos4').hide();
            $('#caidosmodal4').hide();
            $('#caidosmodal14').hide();
            $('#accioncaidos4').hide();
        }
        
    });
        function resultadoskilos() {
            var cantidad=$('#kilosmodal').val();
            var kilosmuertos=$('#agregarcaidoscantidadhidden').val();
            var kiloscaidos=$('#agregarcaidoskiloshidden').val();
            $('#kilospiemodal').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
        }
        function resultados() {
            var cantidad=$('#cantidadmodal').val();
            var cantidadmuertos=$('#muertosmodal').val();
            var cantidadcaidos=$('#caidosmodal').val();
            $('#enpiemodal').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }
        function resultadoskilos1() {
            var cantidad=$('#kilosmodal1').val();
            var kilosmuertos=$('#agregarcaidoscantidadhidden1').val();
            var kiloscaidos=$('#agregarcaidoskiloshidden1').val();
           
        }
        function resultados1() {
            var cantidad=$('#cantidadmodal1').val();
            var cantidadmuertos=$('#muertosmodal1').val();
            var cantidadcaidos=$('#caidosmodalsub1').val();
            $('#enpiemodal1').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
           
        }
        function resultadoskilos2() {
            var cantidad=$('#kilosmodal2').val();
            var kilosmuertos=$('#agregarcaidoscantidadhidden2').val();
            var kiloscaidos=$('#agregarcaidoskiloshidden2').val();
            $('#kilospiemodal2').val(parseFloat(cantidad)-parseFloat(kilosmuertos)-parseFloat(kiloscaidos));
        }
        function resultados2() {
            var cantidad=$('#cantidadmodal2').val();
            var cantidadmuertos=$('#muertosmodal2').val();
            var cantidadcaidos=$('#caidosmodal2').val();
            $('#enpiemodal2').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }
        function resultados3() {
            var cantidad=$('#cantidadmodal3').val();
            var cantidadmuertos=$('#muertosmodal3').val();
            var cantidadcaidos=$('#caidosmodal3').val();
            $('#enpiemodal3').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }
        function resultados4() {
            var cantidad=$('#cantidadmodal4').val();
            var cantidadmuertos=$('#muertosmodal4').val();
            var cantidadcaidos=$('#caidosmodal4').val();
            $('#enpiemodal4').val(parseFloat(cantidad)-parseFloat(cantidadmuertos)-parseFloat(cantidadcaidos));
        }

        $(document).on('keyup','#guiamodal',function(){
            let valor = $(this).val();
            if(valor.trim()!=""){
                $('#dtamodal').val(valor); 
            }
            else{
                $('#dtamodal').val('AGREGUE Nº DE GUIA POR FAVOR');
            }
           
        });
      

        