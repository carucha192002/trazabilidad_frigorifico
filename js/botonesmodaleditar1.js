$(document).ready(function(){
    var funcion;
    var edit=false;
    $('.select2').select2();
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
    function rellenar_productores() {
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
    }
    function rellenar_matarife() {
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
       
    }
    

    $(document).on('click','#destinomodaleditar',(e)=>{
            let nombre= $('#destinoagregareditar ').val();
            let id=$('#id_edit_prod').val();
            if(edit==true){
                funcion="editar";
            }
            else{
                funcion="crear";
            }
            $.post('../controlador/DestinoController.php',{funcion,id,nombre},(response)=>{
                if(response=='add'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Guardado',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-destino').trigger('reset');
                   rellenar_destinos();
                }
                if(response=='edit'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Editado',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-destino').trigger('reset');
                }
                if(response=='noadd'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'El nombre del destino ya existe',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-destino').trigger('reset');
                }
                if(response=='noedit'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'El destino no se edito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-destino').trigger('reset');
                }
                edit=false;
            });
            e.preventDefault();
        });
        $(document).on('click','#especiemodaleditar',(e)=>{
            let nombre= $('#especieagregareditar ').val();
            let id=$('#id_edit_prod').val();
            if(edit==true){
                funcion="editar";
            }
            else{
                funcion="crear";
            }
            $.post('../controlador/EspeciesController.php',{funcion,id,nombre},(response)=>{
                if(response=='add'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Guardado',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-especie').trigger('reset');
                    rellenar_especies();
                    
                }
                if(response=='edit'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Editado',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-especie').trigger('reset');
                }
                if(response=='noadd'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'La Especie ya existe',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-especie').trigger('reset');
                }
                if(response=='noedit'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'La Especie no se edito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-editar-destino').trigger('reset');
                }
                edit=false;
            });
            e.preventDefault();
        });
        $(document).on('click','#actualizarusuariomodaleditar',(e)=>{
            rellenar_matarife();
        });
        $(document).on('click','#actualizarproductormodaleditar',(e)=>{
        rellenar_productores();
        });
        $(document).on('click','#actualizarprocedenciamodaleditar',(e)=>{
        rellenar_procedencia();
        });
        $(document).on('click','#actualizartransportemodaleditar',(e)=>{
        rellenar_transporte();
        });
        $(document).on('click','#actualizarchofermodaleditar',(e)=>{
        rellenar_chofer();
         });
        $(document).on('click','#actualizarcorraleromodaleditar',(e)=>{
        rellenar_corraleros();
         });
          
        $(document).on('click','#actualizarcorralmodaleditar',(e)=>{
        rellenar_corrales();
         });
         $(document).on('click','#actualizarcorralmodaleditar',(e)=>{
            rellenar_conservacion();
        });
       
    })
    
    $('#form-editar-ingreso').submit(e=>{
        let id=$('#ideditar').val();
        let ano=$('#anoeditar').val();
        let fecha = $('#fechaeditar').val();
        let libro = $('#libromodaleditar').val(); 
        let folio = $('#foliomodaleditar').val();   
        let destino = $('#destinoselecteditar').val(); 
        let especie = $('#especieselecteditar').val();  
        let subespecie = $('#subespecieagregaridguardareditar').val();
        let cantidad = $('#cantidadmodaleditar').val(); 
        let kilos = $('#kilosmodaleditar').val(); 
        let muertos = $('#muertosmodaleditar').val(); 
        let caidos = $('#caidosmodaleditar').val(); 
        let enpie = $('#enpiemodaleditar').val(); 
        let kilosenpie = $('#kilospiemodaleditar').val(); 
        let conservacion = $('#conservacionmodaleditar').val(); 
        let vencimiento = $('#vencimientomodaleditar').val(); 
        let corral = $('#corralmodaleditar').val(); 
        let corralero = $('#corraleromodaleditar').val(); 
        let matarife = $('#matarifeeditar').val(); 
        let productor = $('#productorselecteditar').val(); 
        let guia = $('#guiamodaleditar').val(); 
        let fechaguia = $('#fechaguiamodaleditar').val(); 
        let dtamodal = $('#dtamodaleditar').val(); 
        let fechadtamodal = $('#fechadtamodaleditar').val(); 
        let llenarprocedencia = $('#llenarprocedenciaeditar').val(); 
        let provinciamodal = $('#provinciamodaleditar').val(); 
        let localidadmodal = $('#localidadmodaleditar').val(); 
        let CPmodal = $('#CPmodaleditar').val(); 
        let llenartransporte = $('#llenartransporteeditar').val(); 
        let llenarchofer = $('#llenarchofereditar').val(); 
        let dnimodal = $('#dnimodaleditar').val();  
        let habilitacionmodal = $('#habilitacionmodaleditar').val(); 
        let horasdeviajemodal = $('#horasdeviajemodaleditar').val(); 
        let lavadomodal = $('#lavadomodaleditar').val(); 
        let prescintomodal = $('#prescintomodaleditar').val(); 
        let prescintomodalacoplado = $('#prescintomodalacopladoeditar').val(); 
        let observacionmodal = $('#observacionmodaleditar').val(); 
        let kiloscuerosmodal = $('#kiloscuerosmodaleditar').val(); 
        let numtropas = $('#tropamodaleditar').val();
        let cargo = $('#cargoeditar').val();
        let fechaedicion = $('#fechamodaleditar').val();
        let digestormuertos = $('#digestormuertoseditar').val();
        let digestorcaidos = $('#digestorcaidoseditar').val();
        let matarifesub_item = $('#matarifesub_itemeditar').val();
        let tci = $('#tci').val();
                        funcion="editardatostropas";
                        $.post('../controlador/TropasController.php',{funcion,id,ano,fecha,libro,folio,destino,especie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargo,fechaedicion,subespecie,digestormuertos,digestorcaidos,matarifesub_item,tci},(response)=>{
                          if(response!='add'){
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: 'Agregue '+response,
                                showConfirmButton: false,
                                timer: 3000
                              })
                         }else{
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Editado',
                                showConfirmButton: false,
                                timer: 3000
                              })
                           setTimeout('document.location.reload()',2000);
                         }
                           
                        })

        e.preventDefault();
    });

