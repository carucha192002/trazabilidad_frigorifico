$(document).ready(function(){
    $('#guardar').hide();
    $('#asignartropas').hide();
    var funcion;
    var edit=false;
    $('.select2').select2();
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
            $('#llenartransporte').html(template);
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
            $('#productorselect').html(template);
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
            $('#matarife').html(template);
            
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
       
    }
    $(document).on('click','#guardargarron',(e)=>{
        window.open('adm_reduccion.php');
    })

    $(document).on('click','#destinomodal',(e)=>{
            let nombre= $('#destinoagregar ').val();
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
                    $('#form-crear-destino').trigger('reset');
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
                    $('#form-crear-destino').trigger('reset');
                }
                if(response=='noadd'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'El nombre del destino ya existe',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-crear-destino').trigger('reset');
                }
                if(response=='noedit'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'El destino no se edito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-crear-destino').trigger('reset');
                }
                edit=false;
            });
            e.preventDefault();
        });
        $(document).on('click','#especiemodal',(e)=>{
            let nombre= $('#especieagregar ').val();
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
                    $('#form-crear-especie').trigger('reset');
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
                    $('#form-crear-especie').trigger('reset');
                }
                if(response=='noadd'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'La Especie ya existe',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-crear-especie').trigger('reset');
                }
                if(response=='noedit'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'La Especie no se edito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-crear-destino').trigger('reset');
                }
                edit=false;
            });
            e.preventDefault();
        });
        $(document).on('click','#subespeciemodal1',(e)=>{
            let nombre= $('#subespecieagregar ').val();
            let id=$('#subespecieagregarid').val();
            funcion="crearsubcategoria";
            $.post('../controlador/EspeciesController.php',{funcion,id,nombre},(response)=>{
               
                if(response=='add'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Guardado',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-crear-especie').trigger('reset');
                    rellenar_especies();
                    
                }
               
                if(response=='noadd'){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'La Sub-Especie ya existe',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#form-crear-especie').trigger('reset');
                }
            });
            e.preventDefault();
        });
        $(document).on('click','#actualizarusuariomodal',(e)=>{
            rellenar_matarife();
        });
        $(document).on('click','#actualizarproductormodal',(e)=>{
        rellenar_productores();
        });
        $(document).on('click','#actualizarprocedenciamodal',(e)=>{
        rellenar_procedencia();
        });
        $(document).on('click','#actualizartransportemodal',(e)=>{
        rellenar_transporte();
        });
        $(document).on('click','#actualizarchofermodal',(e)=>{
        rellenar_chofer();
         });
        $(document).on('click','#actualizarcorraleromodal',(e)=>{
        rellenar_corraleros();
         });
          
        $(document).on('click','#actualizarcorralmodal',(e)=>{
        rellenar_corrales();
         });
         $(document).on('click','#actualizarconservacionmodal',(e)=>{
            rellenar_conservacion();
             });
       
    })
    function RecuperarLS() {
        let productos;
        if(localStorage.getItem('productos')===null){
            productos=[];
        }
        else{
            productos = JSON.parse(localStorage.getItem('productos'))
        }
        return productos
    }
    function AgregarLS(producto) {
        let productos;
        productos = RecuperarLS();
        productos.push(producto);
        localStorage.setItem('productos',JSON.stringify(productos))
    }
    function EliminarLS() {
        localStorage.clear();
    }
    async function comprobar(especie,matarife){
        let funcion="comprobarano";
        let data=await fetch('../controlador/TropasController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&especie='+especie+'&&matarife='+matarife
        })
        if(data.ok){
            let response=await data.text();
           try{
            console.log(response);
            if (response.trim()==1){
                numerodetropas(especie,matarife);
                $('#guardar').show();
            }else{
                $('#asignartropas').show();
                $('#guardar').hide();

              funcion="comparaciones";
              $.post('../controlador/TropasController.php',{funcion,matarife,especie,ano},(response)=>{
                  let vigencia='';
                  let limite='';
               const respuestasconsola = JSON.parse(response);
                  vigencia+=`${respuestasconsola.vigencia}`;
                  limite+=`${respuestasconsola.limite}`;
                 
                  if(vigencia ==0 || limite==0){
                      funcion="comparaciones";
                      $.post('../controlador/TropasController.php',{funcion,matarife,especie,ano},(response)=>{
                          let vigencia='';
                          let id='';
                          const respuestasconsola = JSON.parse(response);
                          vigencia+=`${respuestasconsola.vigencia}`;
                          id+=`${respuestasconsola.id}`;
                          if(vigencia ==0){
                              
                              funcion="asignarnuevo";
                              const swalWithBootstrapButtons = Swal.mixin({
                                  customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: 'btn btn-danger mr-2'
                                  },
                                  buttonsStyling: false
                                })
                                
                                swalWithBootstrapButtons.fire({
                                  title: 'La Vigencia del Matarife ha expirado!',
                                  text: "¿Desea asignar una nueva Vigencia?",
                                  imageWidth:100,
                                  imageHeight:100,           
                                  showCancelButton: true,
                                  confirmButtonText: 'Si, Asignar',
                                  cancelButtonText: 'No, Cancelar!',
                                  reverseButtons: true
                                }).then((result) => {
                                  if (result.value) {
                                      $.post('../controlador/TropasController.php',{id,funcion},(response)=>{
                                          if(response=='creado'){
                                              funcion="nuevaasignacion";
                                              $.post('../controlador/TropasController.php',{id,funcion},(response)=>{
                                                
                                           
                                                  funcion="crearnuevaasignacion";
                                              $.post('../controlador/TropasController.php',{funcion,matarife,procedencia,especie,avatar},(response)=>{

                                              })
                                              })

                                              swalWithBootstrapButtons.fire(
                                                  'Perfecto!',
                                                  'Se Creo la nueva Vigencia',
                                                  'success'
                                              )
                                              location.href='../vista/adm_tropas.php','_blank';
                                          }
                                          else{
                                              swalWithBootstrapButtons.fire(
                                                  
                                                  'No se asigno una nueva Vigencia. Gracias!',
                                                  'error'
                                              )
                                          }
                                      })
                                   
                                  } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    swalWithBootstrapButtons.fire(
                                      'Cancelado',
                                      'No se creo la Nueva Vigencia',
                                      'error'
                                    )
                                  }
                                })
                          
          
                          } else{
                              Swal.fire({
                                  position: 'center',
                                  icon: 'warning',
                                  title: 'Ha alcanzado el limite de Numero de Tropas',
                                  showConfirmButton: false,
                                  timer: 3000
                                })

                          }

                      })
                  } else{
                      if(limite ==0){
                              
                          funcion="asignarnuevo";
                          const swalWithBootstrapButtons = Swal.mixin({
                              customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger mr-2'
                              },
                              buttonsStyling: false
                            })
                            
                            swalWithBootstrapButtons.fire({
                              title: 'La alcanzado el maximo Numero de Tropas!',
                              text: "¿Desea asignar un nuevo rango?",
                              imageWidth:100,
                              imageHeight:100,           
                              showCancelButton: true,
                              confirmButtonText: 'Si, Asignar',
                              cancelButtonText: 'No, Cancelar!',
                              reverseButtons: true
                            }).then((result) => {
                              if (result.value) {
                                  $.post('../controlador/TropasController.php',{id,funcion},(response)=>{
                                      if(response=='creado'){
                                          funcion="nuevaasignacion";
                                          $.post('../controlador/TropasController.php',{id,funcion},(response)=>{
  
                                       
                                              funcion="crearnuevaasignacion";
                                          $.post('../controlador/TropasController.php',{funcion,matarife,procedencia,especie,avatar},(response)=>{

                                          })
                                          })

                                          swalWithBootstrapButtons.fire(
                                              'Perfecto!',
                                              'Se Creo un nuevo rango',
                                              'success'
                                              
                                          )
                                          location.href='../vista/adm_tropas.php','_blank';
                                      }
                                      else{
                                          swalWithBootstrapButtons.fire(
                                              
                                              'No se asigno un nuevo rango. Gracias!',
                                              'error'
                                          )
                                      }
                                  })
                               
                              } else if (result.dismiss === Swal.DismissReason.cancel) {
                                swalWithBootstrapButtons.fire(
                                  'Cancelado',
                                  'No se creo un nuevo Rango',
                                  'error'
                                )
                              }
                            })
                      
      
                      }
                  }
              })
             
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
      async function numerodetropas(especie,matarife){
        let funcion="comprobartropas";
        let data=await fetch('../controlador/TropasController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&especie='+especie+'&&matarife='+matarife
        })
        if(data.ok){
            let response=await data.text();
           try{
            let respuesta='';
            let numero='';
            const respuestasconsola = JSON.parse(response);
            respuesta+=`${respuestasconsola.numero}`;
            $('#tropamodal').val(respuesta);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El numero de Tropa Asigando es:'+' '+respuesta+'  '+'Ahora puede guardar el registro',
                showConfirmButton: false,
                timer: 3000
              })
              $('#asignartropas').hide();

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
   
     
    $(document).on('click','#Comprobartropas',(e)=>{
        let especie = $('#especieselect').val(); 
        let matarife = $('#matarife').val(); 
        comprobar(especie,matarife);
    })

    $(document).on('click','#guardar',(e)=>{
        const anols=$('#ano').val();
        const fecha = $('#fechamodal').val();
        const libro = $('#libromodal').val(); 
        const folio = $('#foliomodal').val();   
        const tci = $('#tci_modal').val(); 
        const destino = $('#destinoselect').val(); 
        const especiels = $('#especieselect').val(); 
        const subespecie = $('#subespecieagregaridguardar').val();    
        const subespecie1 = $('#subespecieagregaridguardar1').val(); 
        const subespecie2 = $('#subespecieagregaridguardar2').val(); 
        const subespecie3 = $('#subespecieagregaridguardar3').val(); 
        const subespecie4 = $('#subespecieagregaridguardar4').val(); 
        const cantidad = $('#cantidadmodal').val(); 
        const cantidad1 = $('#cantidadmodal1').val(); 
        const cantidad2 = $('#cantidadmodal2').val(); 
        const cantidad3 = $('#cantidadmodal3').val(); 
        const cantidad4 = $('#cantidadmodal4').val(); 
        const kilos = $('#kilosmodal').val(); 
        const kilos1 = $('#kilosmodal1').val(); 
        const kilos2 = $('#kilosmodal2').val(); 
        const kilos3 = $('#kilosmodal3').val(); 
        const kilos4 = $('#kilosmodal4').val(); 
        const muertos = $('#muertosmodal').val();
        const muertos1 = $('#muertosmodal1').val();
        const muertos2 = $('#muertosmodal2').val();
        const muertos3 = $('#muertosmodal3').val();
        const muertos4 = $('#muertosmodal4').val(); 
        const caidos = $('#caidosmodal').val(); 
        const caidos1 = $('#caidosmodalsub1').val(); 
        const caidos2 = $('#caidosmodal2').val(); 
        const caidos3 = $('#caidosmodal3').val(); 
        const caidos4 = $('#caidosmodal4').val(); 
        const enpie = $('#enpiemodal').val(); 
        const enpie1 = $('#enpiemodal1').val(); 
        const enpie2 = $('#enpiemodal2').val(); 
        const enpie3 = $('#enpiemodal3').val(); 
        const enpie4 = $('#enpiemodal4').val(); 
        const kilosenpie = $('#kilospiemodal').val(); 
        const kilosenpie1 = $('#kilospiemodal1').val(); 
        const kilosenpie2 = $('#kilospiemodal2').val(); 
        const kilosenpie3 = $('#kilospiemodal3').val(); 
        const kilosenpie4 = $('#kilospiemodal4').val(); 
        const conservacion = $('#conservacionmodal').val(); 
        const vencimiento = $('#vencimientomodal').val(); 
        const corral = $('#corralmodal').val(); 
        const corralero = $('#corraleromodal').val(); 
        const matarife_ls = $('#matarife').val(); 
        const productor = $('#productorselect').val(); 
        const guia = $('#guiamodal').val(); 
        const fechaguia = $('#fechaguiamodal').val(); 
        const dtamodal = $('#dtamodal').val(); 
        const fechadtamodal = $('#fechadtamodal').val(); 
        const llenarprocedencia = $('#llenarprocedencia').val(); 
        const provinciamodal = $('#provinciamodal').val(); 
        const localidadmodal = $('#localidadmodal').val(); 
        const CPmodal = $('#CPmodal').val(); 
        const llenartransporte = $('#llenartransporte').val(); 
        const llenarchofer = $('#llenarchofer').val(); 
        const dnimodal = $('#dnimodal').val(); 
        const habilitacionmodal = $('#habilitacionmodal').val(); 
        const horasdeviajemodal = $('#horasdeviajemodal').val(); 
        const lavadomodal = $('#lavadomodal').val(); 
        const prescintomodal = $('#prescintomodal').val(); 
        const prescintomodalacoplado = $('#prescintomodalacoplado').val(); 
        const observacionmodal = $('#observacionmodal').val(); 
        const kiloscuerosmodal = $('#kiloscuerosmodal').val(); 
        const numtropas = $('#tropamodal').val();
        const cargo = $('#cargo').val();
        const digestormuertos = $('#digestormuertos').val();
        const digestorcaidos = $('#digestorcaidos').val();
        const matarifesub_item = $('#matarifesub_item').val();
        guardar(anols,fecha,libro,folio,tci,destino,especiels,subespecie,subespecie1,subespecie2,subespecie3,subespecie4,cantidad,cantidad1,cantidad2,cantidad3,cantidad4,
            kilos,kilos1,kilos2,kilos3,kilos4,muertos,muertos1,muertos2,muertos3,muertos4,caidos,caidos1,caidos2,caidos3,caidos4,enpie,enpie1,enpie2,enpie3,enpie4,kilosenpie,kilosenpie1,kilosenpie2,kilosenpie3,kilosenpie4,
            conservacion,vencimiento,corral,corralero,matarife_ls,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,
            provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,
            prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargo,digestormuertos,digestorcaidos,matarifesub_item);
    });

    async function guardar(anols,fecha,libro,folio,tci,destino,especiels,subespecie,subespecie1,subespecie2,subespecie3,subespecie4,cantidad,cantidad1,cantidad2,cantidad3,cantidad4,
            kilos,kilos1,kilos2,kilos3,kilos4,muertos,muertos1,muertos2,muertos3,muertos4,caidos,caidos1,caidos2,caidos3,caidos4,enpie,enpie1,enpie2,enpie3,enpie4,kilosenpie,kilosenpie1,kilosenpie2,kilosenpie3,kilosenpie4,
            conservacion,vencimiento,corral,corralero,matarife_ls,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,
            provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,
            prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargo,digestormuertos,digestorcaidos,matarifesub_item){
        funcion="guardar";
        let data=await fetch('../controlador/TropasController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&anols='+anols+'&&fecha='+fecha+'&&libro='+libro+'&&folio='+folio+'&&tci='+tci+'&&destino='+destino+'&&especiels='+especiels+'&&subespecie='+subespecie+'&&subespecie1='+subespecie1+'&&subespecie2='+subespecie2+'&&subespecie3='+subespecie3+'&&subespecie4='+subespecie4+'&&cantidad='+cantidad+'&&cantidad1='+cantidad1+'&&cantidad2='+cantidad2+'&&cantidad3='+cantidad3+'&&cantidad4='+cantidad4
            +'&&kilos='+kilos+'&&kilos1='+kilos1+'&&kilos2='+kilos2+'&&kilos3='+kilos3+'&&kilos4='+kilos4+'&&muertos='+muertos+'&&muertos1='+muertos1+'&&muertos2='+muertos2+'&&muertos3='+muertos3+'&&muertos4='+muertos4+'&&caidos='+caidos+'&&caidos1='+caidos1+'&&caidos2='+caidos2+'&&caidos3='+caidos3+'&&caidos4='+caidos4+'&&enpie='+enpie+'&&enpie1='+enpie1+'&&enpie2='+enpie2+'&&enpie3='+enpie3+'&&enpie4='+enpie4
            +'&&kilosenpie='+kilosenpie+'&&kilosenpie1='+kilosenpie1+'&&kilosenpie2='+kilosenpie2+'&&kilosenpie3='+kilosenpie3+'&&kilosenpie4='+kilosenpie4+'&&conservacion='+conservacion+'&&vencimiento='+vencimiento+'&&corral='+corral+'&&corralero='+corralero+'&&matarife_ls='+matarife_ls+'&&productor='+productor+'&&fechaguia='+fechaguia+'&&guia='+guia+'&&dtamodal='+dtamodal+'&&fechadtamodal='+fechadtamodal+'&&llenarprocedencia='+llenarprocedencia
            +'&&provinciamodal='+provinciamodal+'&&localidadmodal='+localidadmodal+'&&CPmodal='+CPmodal+'&&llenartransporte='+llenartransporte+'&&llenarchofer='+llenarchofer+'&&dnimodal='+dnimodal+'&&habilitacionmodal='+habilitacionmodal+'&&horasdeviajemodal='+horasdeviajemodal+'&&lavadomodal='+lavadomodal
            +'&&prescintomodal='+prescintomodal+'&&prescintomodalacoplado='+prescintomodalacoplado+'&&observacionmodal='+observacionmodal+'&&kiloscuerosmodal='+kiloscuerosmodal+'&&numtropas='+numtropas+'&&cargo='+cargo+'&&digestormuertos='+digestormuertos+'&&digestorcaidos='+digestorcaidos+'&&matarifesub_item='+matarifesub_item})

        if(data.ok){
        
           try{
             
            let response=await data.text();
            console.log(response);
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
                    title: 'Guardado',
                    showConfirmButton: false,
                    timer: 3000
                  })
                  setTimeout('document.location.reload()',2000);
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
    $(document).on('click','#abrirsub2',(e)=>{
        $('#subespc2').show();
    })
    $(document).on('click','#abrirsub1',(e)=>{
        $('#subespc1').show();
    })
    $(document).on('click','#abrirsub3',(e)=>{
        $('#subespc3').show();
    })
    $(document).on('click','#abrirsub4',(e)=>{
        $('#subespc4').show();
    })


   

