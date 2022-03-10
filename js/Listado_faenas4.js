$(document).ready(function () {
  $("#quedan_garron").hide();
  $("#finalzado").hide();
  $("#siguiente").hide();
  $("#reducir").hide();
  $("#pesogarron").val('');
  $("#matanza").hide();
  $("#alerta").hide();
  $("#camaraelegir").hide();
  $("#agregarelegir").hide();
  $("#obligatorio").hide();
  $("#guardargarronpeso").hide();
  $('#actualizar_faena').hide();
  buscar_producto();
  cantidadcorrales();
  rellenar_corrales();
  botonaparecer();
  finalizados();
  llenar_listado();

  $('#guardargarronpeso').on('click',function(){
    let tropa=$('#numero_tropa_editar').val();
    let garron=$('#garron_id').val();
    let peso=$('#peso_garron').val();
    let id_editar=$('#id_editar').val();
    let editar_peso=$('#editar_peso').val();
    let observacion_decomiso=$('#observacion_decomiso').val();
    let id_ingresos=$("#id_ingreso").val();
    funcion="editargarronpeso";
    let datos=new FormData($('#form-datos')[0]);
    datos.append("funcion",funcion);
    datos.append("tropa",tropa);
    datos.append("garron",garron);
    datos.append("peso",peso);
    datos.append("id_editar",id_editar);
    datos.append("editar_peso",editar_peso);
    datos.append("observacion_decomiso",observacion_decomiso);
    datos.append("id_ingresos",id_ingresos);
    $.ajax({
      type: "POST",
      url:'../controlador/ListadoController.php',
      data: datos,
      cache: false,
      processData:false,
      contentType:false,
      success:function(response){
        if(response=='guardado'){
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se han editado sus datos correctamente',
            showConfirmButton: false,
            timer: 1500
          }).then(function(){
            rellenar_faenados();
        })
        }else if(response=='danger'){
          Swal.fire({
            icon: 'warning',
            title: 'No altero nada',
            text: 'Modifique algun campo para realizar la edicion!',
        })
        }
        
        else{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No se pudo editar sus datos!',
        })
        }
       
      }
    })


});



  function rellenar_faenados() {
    let id_ingresos = $("#id_ingresos").val();
    let funcion = "buscargarronfaenados";
    $.post('../controlador/ListadoController.php',{funcion,id_ingresos},(response)=>{
     
      $('#form_listado_garron').DataTable().clear().destroy();
      $('#form_listado_garron').empty();
    let datatable = $("#form_listado_garron").DataTable({

      "order": [[ 2, "asc" ]],
      "ajax": {
        "url": "../controlador/ListadoController.php",
        "method": "POST",
        "data": {
          "funcion": funcion,
          "id_ingresos": id_ingresos,
        },
      },
      "columns": [
        { "data": "tropa" },
        { "data": "especie" },
        { "data": "garron" },
        { "data": "peso" },

        {
          "defaultContent": `<button class="editar btn btn-warning" data-toggle="modal" data-target="#editargarron" type="button">Editar</button>
          
                                       
                                      `,
        },
      ],
      "language": espanol,
    });

    $("#form_listado_garron tbody").on("click", ".editar", function () {
      let datos = datatable.row($(this).parents()).data();
      let id = datos.id_faenados;
      let tropas = datos.tropa;
      let garron = datos.garron;
      let peso = datos.peso;
      let id_ingreso = datos.id_ingreso;
      $("#numero_tropa_editar").val(tropas);
      $("#garron_id").val(garron);
      $("#peso_garron").val(peso);
      $("#id_editar").val(id);
      $("#id_ingreso").val(id_ingreso);
    });
  })
  }
  $(document).on("keyup", "#editar_peso", function () {
    let valor = $(this).val();
    if (valor == ""||0) {
        $("#guardargarronpeso").hide();
    } else {
        $("#guardargarronpeso").show();
    }
  });

  function llenar_listado() {
    funcion = "verlistado";
    $.post("../controlador/ListadoController.php", { funcion }, (response) => {
      const tipos = JSON.parse(response);
      let template = "";
      tipos.forEach((tipo) => {
        template += `
                
                    <tr clasId="${tipo.id}"clasMatarife="${tipo.matarife}"clasEnpie="${tipo.enpie}" clasIdfaenas="${tipo.idfaenas}"> 
                        <td> 
                        <input type="checkbox" name="${tipo.matarife}" value="${tipo.identificador}" class="opcion">                         
                        </td>                                         
                        <td> 
                        ${tipo.id}                          
                        </td>
                        <td>${tipo.matarife}</td>
                        <td>${tipo.enpie}</td>
                    </tr>
                
                `;
      });
      $("#listado").html(template);
    });
  }
  function llenar_listado_editar() {
    funcion = "verlistado_editar";
    $.post("../controlador/ListadoController.php", { funcion }, (response) => {
      const tipos = JSON.parse(response);
      let template = "";
      tipos.forEach((tipo) => {
        template += `
                
                    <tr clasOrden="${tipo.id}"clasIngresos="${tipo.ingresos}"clasTropa="${tipo.tropa}"clasMatarife="${tipo.matarife}"clasEnpie="${tipo.enpie}" clasDesde="${tipo.desde}" clasHasta="${tipo.hasta}">                                         
                  
                    <td>${tipo.id}</td>
                    <td>${tipo.ingresos}</td>
                        <td>${tipo.tropa}</td>
                        <td>${tipo.matarife}</td>
                        <td>
                        <input type="number" id="enpie"  class="form-control enpie" value="${tipo.enpie}"></input>
                        </td>
                        <td>
                        <input type="number" id="desde"  class="form-control desde" value="${tipo.desde}"></input>
                        </td>
                        <td>
                        <input type="number" id="hasta${tipo.id}"  class="form-control hasta" value="${tipo.hasta}"></input>
                        </td>
                    </tr>
                
                `;
      });

      $("#listado_editar").html(template);
    });
  }
 
  $(document).on('click','#editar_faena',(e) => {
    llenar_listado_editar();
  })
  $(document).on('click','#editar_info',(e) => {
    let listados=RecuperarListadoLS();
    let json = JSON.stringify(listados);  
    guardar_faena(json)
  })

  $('#cp').keyup((e)=>{
    producto = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(producto).attr('clasIngresos');
    const orden = $(producto).attr('clasOrden');
    const cantidad = producto.querySelector('input').value;
    const desde = producto.querySelector('.desde').value;
    const hasta = producto.querySelector('.hasta').value;
    const todo = document.querySelectorAll('.desde').length;
    total=parseFloat(cantidad) + parseFloat(desde)-parseFloat(1);
    $('#hasta'+orden).val(total);
    const listado={
      id:id,
      cantidad:cantidad,
      desde:desde,
      hasta:hasta,
      total:total,  
  }
  let id_faena;
  let listados;
  listados = RecuperarListadoLS();
  listados.forEach(prod => {
      if(prod.id===listado.id){
          id_faena=prod.id;
      }                
  });
  if(id_faena===listado.id){
    listados = RecuperarListadoLS();
    listados.forEach(prod => {
    if(prod.id===listado.id){
    prod.cantidad=cantidad;
    prod.desde=desde;
    prod.hasta=total;
    localStorage.setItem('listados',JSON.stringify(listados));
    }
  })
  }

  else{
        AgregarListadoLS(listado);    
  } 
 
})
function AgregarListadoLS(listado) {
  let listados;
  listados = RecuperarListadoLS();
  listados.push(listado);
  localStorage.setItem('listados',JSON.stringify(listados))
}
function RecuperarListadoLS() {
  let listados;
  if(localStorage.getItem('listados')===null){
      listados=[];
  }
  else{
      listados = JSON.parse(localStorage.getItem('listados'))
  }
  return listados
}
async function   guardar_faena(json){
  funcion="guardar_faena";
  let data=await fetch('../controlador/ListadoController.php',{
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body:'funcion='+funcion+'&&json='+json
  })
  if(data.ok){
      let response=await data.text();
     try{
      if(response.trim()=='edit'){
        const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'success',
          title: 'Faena Modificada!'
        })
        localStorage.clear();
        setTimeout('document.location.reload()',2000);   
         
      }
      } catch(error){
          console.error(error);
          console.log(response);
          Swal.fire({
            icon: 'error',
            title: data.statusText,
            text: 'Hubo conflicto de codigo...No se puede conectar al servidor: '+data.status,
        })
         
      }
  }else{
      Swal.fire({
          icon: 'error',
          title: data.statusText,
         text: 'Hubo conflicto de codigo: '+data.status,
      })
  }

}
  function finalizados() {
    funcion = "verificarfinalizados";
    $.post("../controlador/ListadoController.php", { funcion }, (response) => {
      let cantidad = "";
      const verificar = JSON.parse(response);
      cantidad = +`${verificar.cantidad}`;
      $("#cuantasromaneo").html(cantidad);
    });
  }
  function botonaparecer() {
    $("#siguiente").hide();
    $("#reducir").hide();
    $("#pesogarron").val('');
    
  }
  function rellenar_corrales() {
    funcion = "rellenar_corrales";
    $.post("../controlador/CorralController.php", { funcion }, (response) => {
      const corrales = JSON.parse(response);
      let template = "";
      corrales.forEach((corral) => {
        template += `
                    <option value="${corral.id}">${corral.nombre}</option>
                `;
      });
      $("#corral_garron").html(template);
    });
  }
  function rellenar_camaras() {
    funcion = "rellenar_camaras";
    $.post("../controlador/camaraController.php", { funcion }, (response) => {
      
      const camaras = JSON.parse(response);
      let template = "";
      template += `
            <option value="0"> Seleccione Nº Camara</option>`;
      camaras.forEach((camara) => {
        template += `
                    <option value="${camara.id}">${camara.nombre}</option>
                `;
      });
      $("#elegir_camara").html(template);
    });
  }
  function cantidadcorrales() {
    funcion = "verificarcorrales";
    $.post("../controlador/CatalogoController.php", { funcion }, (response) => {
      const tipos = JSON.parse(response);
      let template = "";
      tipos.forEach((tipo) => {
        template += `
                    <tr clasCorral="${tipo.corral}"clasCantidad="${tipo.cantidad}"clasEspecie="${tipo.especie}"clasSubespcie="${tipo.subespecie}">                                              
                        <td> 
                        ${tipo.corral}                          
                        </td>
                        <td>${tipo.cantidad}</td>
                        <td>${tipo.especie}</td>
                        <td>${tipo.subespecie}</td>
                    </tr>
                `;
      });
      $("#clasificacion").html(template);
    });
  }
  function buscar_producto() {
    let funcion = "buscar";
    $.post("../controlador/ListadoController.php", { funcion }, (response) => {
      
      let datatable = $("#tabla_listados").DataTable({
       // "order": [[ 7, "asc" ]],
        ajax: {
          url: "../controlador/ListadoController.php",
          method: "POST",
          data: { funcion: funcion },
        },
        columns: [
          { data: "identificador" },
          { data: "matarifesub" },
          { data: "numtropas" },
          { data: "tci" },
          { data: "enpie" },
          { data: "especie" },
          { data: "subespecies" },
          { data: "garron" },
          { data: "corral" },
          { data: "guia" },
          { data: "kilosenpie" },

          {
            defaultContent: `<button class="procesar btn btn-success" data-toggle="modal" data-target="#garrones" type="button">PROCESAR</button>
                                       <button class="reducir btn btn-danger" data-toggle="modal" data-target="#reducciongarrones" type="button">Reduccion</button>
                                       
                                    
                                      `,
          },
        ],
        language: espanol,
      });
      $("#tabla_listados tbody").on("click", ".imprimir", function () {
        Mostrar_Loader("Generando_Pdf");
        let datos = datatable.row($(this).parents()).data();
        let id = datos.identificador;
        $.post("../controlador/PDFListadosController.php",{ id },(response) => {
            
            if (response == "") {
              cerrar_loader("exito_generar");
              window.open("../pdf/Listados/pdf-listado.pdf", "_blank");
            } else {
              cerrar_loader("error_generar");
            }
          }
        );
      });
      $("#tabla_listados tbody").on("click", ".procesar", function () {
        $("#maximo").val('');
        $("#tropasnum").val('');
        $("#productor").val('');
        $("#matarifeid").val('');
        $("#especiesid").val('');
        $("#codigo").val('');
        $("#destinocsv").val('');
        $("#nombrematarife").val('');
        $("#tci").val('');
        $("#id_ingresos").val('');
        $('html, body').animate({
          scrollTop: $("#titulo_matanza").offset().top
          }, 1000);
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id;
        let tropas = datos.numtropas;
        let cantidad = datos.enpie;
        let clasificacion = datos.subespecies;
        let promedio = datos.promedio;
        let corral = datos.corral;
        let destino = datos.destino;
        let destinocodigo = datos.destinocodigo;
        let matarife = datos.matarife;
        let id_matarife = datos.id_matarife;
        let productor = datos.productor;
        let guia = datos.guia;
        let desde = datos.desde;
        let hasta = datos.hasta;
        let seleccionado = datos.seleccionado;
        let id_especies = datos.id_especies;
        let codigo = datos.codigo;
        let tci = datos.tci;
        let id_ingresos = datos.identificador;
        funcion="ultimoidfaenados";
        $.post("../controlador/ListadoController.php",{funcion},(response)=>{
          let idultimo='';
          const respuesta=JSON.parse(response);
          idultimo+=`${respuesta.id}`;
          if(idultimo=='null'){
            $('#ultimoid').val(0);
          }else{
          $('#ultimoid').val(idultimo);
          }
        })

        $("#matanza").show();
        $("#titulo_matanza").html(
          "Matanza" +
            " " +
            "Especie:" +
            " " +
            clasificacion +
            "-" +
            "Tropa Nº:" +
            " " +
            tropas +
            "-" +
            "Matarife:" +
            " " +
            matarife
        );
        $("#cantidad_cabezas").html("Cabezas:" + " " + cantidad);
        $("#garrondesdehasta").html(
          "Garrones:" +
            " " +
            "Desde:" +
            " " +
            desde +
            "--" +
            "hasta:" +
            "" +
            hasta
        );
        $("#maximo").val(hasta);
        $("#tropasnum").val(tropas);
        $("#productor").val(productor);
        $("#matarifeid").val(id_matarife);
        $("#especiesid").val(id_especies);
        $("#codigo").val(codigo);
        $("#destinocsv").val(destinocodigo);
        $("#nombrematarife").val(matarife);
        $("#tci").val(tci);
        $("#id_ingresos").val(id_ingresos);
        botonaparecer();
        funcion = "vercamaraprocesado";
        $.post("../controlador/ListadoController.php",{ funcion,id_ingresos },(response) => {
            if (response == "SI") {
              $("#camaraelegir").show();
              rellenar_faenados();
            } else {
              $("#camaraelegir").hide();
              rellenar_faenados();
            }
          }
        );

        funcion = "procesado";
        $.post("../controlador/ListadoController.php",{ funcion, id_ingresos },(response) => {
            if (response == "noadd") {
              $("#numgarron").val(desde);
              $("#clasificaciongarron").val(clasificacion);
            } else {
              $("#clasificaciongarron").val(clasificacion);
              funcion = "buscarmatanza";
              $.post("../controlador/ListadoController.php",{ funcion, id_ingresos },
                (response) => {
                  let garron = "";
                  const garrones = JSON.parse(response);
                  garron += `${garrones.garron}`;
                  $("#numgarron").val(parseFloat(garron) + parseFloat(1));
                  let resultado = hasta - garron;

                  if (resultado < 3) {
                    $("#alerta").show();
                    $("#alertatexto").html(
                      "PELIGRO quedan para procesar" +
                        " " +
                        resultado +
                        " " +
                        "animales"
                    );
                  }
                  funcion = "matanzaestado";
                  $.post("../controlador/ListadoController.php",{ funcion, id_ingresos },(response) => {
                      if (response == "FINALIZADO") {
                        let maximo = $("#maximo").val();
                        $("#siguiente").hide();
                        $("#reducir").hide();
                        $("#finalzado").show();
                        $("#estadodect").val("FINALIZADO");
                        $("#numgarron").val(maximo);
                        var titular = document.getElementById("tracking");
                        titular.style.width = "100%";
                        $("#pesogarron").hide();
                        $("#pesogarron1").hide();
                      } else {
                      
                        $("#finalzado").hide();
                        $("#estadodect").val("PARCIAL");
                        let cantidad = $("#numgarron").val();
                        let maximo = $("#maximo").val();
                        let valor = parseFloat(cantidad) + parseFloat(1);

                        let promedio = (valor * 100) / maximo;
                        var titular = document.getElementById("tracking");
                        titular.style.width = promedio + "%";
                      }
                    }
                  );
                }
              );
            }
          }
        );
      });
      async function  guardar_matanza(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos){
        funcion="guardarmatanza";
        let data=await fetch('../controlador/ListadoController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&tropas='+tropas+'&&productor='+productor+'&&garron='+garron+'&&especie='+especie+'&&peso='+peso+'&&estado='+estado+'&&id_especies='+id_especies+'&&codigo='+codigo+'&&destinocsv='+destinocsv+'&&idultimo='+idultimo+'&&tci='+tci+'&&id_ingresos='+id_ingresos
        })
        if(data.ok){
            let response=await data.text();
           try{
          
              if (response == "add") {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Guardado",
                    showConfirmButton: false,
                    timer: 1500,
                  });
                  carrito(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos);
                  rellenar_faenados();
                  let cantidad = $("#numgarron").val();
                  let maximo = $("#maximo").val();
                  let valor = parseFloat(cantidad) + parseFloat(1);
                  $("#numgarron").val(valor);
                  let promedio = (valor * 100) / maximo;
                  var titular = document.getElementById("tracking");
                  titular.style.width = promedio + "%";
                  botonaparecer();
                  if (valor > maximo) {
                    $("#siguiente").hide();
                    $("#reducir").hide();
                    $("#finalzado").show();
                    $("#estadodect").val("FINALIZADO");
                    $("#pesogarron").hide();
                    $("#pesogarron1").hide();
                    $("#camaraelegir").show();
                  } else {
                    $("#finalzado").hide();
                  }
                  $('#actualizar_faena').hide();
                }else{
                  $('#actualizar_faena').show();
                  Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "No Guardado...Garron duplicado...Actualice la pagina",
                    showConfirmButton: false,
                    timer: 1500,
                  });
                  
                }
            } catch(error){
                console.error(error);
                console.log(response);
                Swal.fire({
                  icon: 'error',
                  title: data.statusText,
                  text: 'Hubo conflicto de codigo...No se puede conectar al servidor: '+data.status,
              })
               
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status,
            })
        }
     
      }
      $(document).on("click", "#actualizar_faena", (e) => {
        let tropas = $("#tropasnum").val();
        productos=RecuperarLS();
        let garron_mayor=0;
        productos.forEach(prod => {
         if(prod.tropas==tropas){
             garron_mayor=prod.garron;
             if(garron_mayor<=prod.garron){
               garron_mayor=prod.garron;
             }
         } 
        });
        $('#numgarron').val(parseFloat(garron_mayor)+parseFloat(1));
      })

      $(document).on("click", "#siguiente", (e) => {
        let tropas = $("#tropasnum").val();
        let productor = $("#productor").val();
        let garron = $("#numgarron").val();
        let especie = $("#clasificaciongarron").val();
        let peso = $("#pesogarronguardar").val();
        let estado = $("#estadodect").val();
        let id_matarife = $("#matarifeid").val();
        let id_especies = $("#especiesid").val();
        let codigo = $("#codigo").val();
        let destinocsv = $("#destinocsv").val();
        let resultado1 = $("#maximo").val();
        let nombrematarife = $("#nombrematarife").val();
        let idultimo=$('#ultimoid').val();
        let tci=$('#tci').val();
        let id_ingresos=$("#id_ingresos").val();
       
        let resultado = resultado1 - garron;

        if (resultado1 - garron < 3) {
          $("#alerta").show();

          $("#alertatexto").html(
            "PELIGRO quedan para procesar" + " " + resultado + " " + "animales"
          );
        }
        guardar_matanza(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos);
      });

      async function verificar(){
        let productos;           
        funcion="verificar_faena";
        productos=RecuperarLS();
        const response = await fetch('../controlador/ListadoController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        let error = await response.text();         
        return error;
    }
    function Eliminar_producto_LS(id){
      let productos;
      productos = RecuperarLS();
      productos.forEach(function(producto,indice) {
          if(producto.garron===id){
              productos.splice(indice,1);
          }                
      });
      localStorage.setItem('productos',JSON.stringify(productos));
  }
    function EliminarLS() {
      localStorage.clear();
  }
      function comparar_LS(){
             verificar().then(error=>{

               if(error==0||error==''){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se cargaron todos los garrones exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                      $('#elegircamara').modal('show');
                       EliminarLS();
                       $('#agregarelegir').hide();
                       $('#camaraelegir').show();
                        })                         
                }
                else if(error>=1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hay uno o mas garrones que no estan cargados',                    
                      })
                      $('#agregarelegir').show();
                      $('#camaraelegir').hide();
                }
     
            });                
      }
      async function ver_faltantesLS(){
        let productos;           
        funcion="verificar_faltantes";
        productos=RecuperarLS();
        let data = await fetch('../controlador/ListadoController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        if(data.ok){
          let response=await data.text();
         try{
          const respuesta=JSON.parse(response);
           if(respuesta==''){
            guardar();
            $('#camaraelegir').show();
           }else{
            let id_garron;
            let productos_ls;
            productos_ls = RecuperarLS();
            respuesta.forEach(resp=>{
            productos_ls.forEach(prod => {
                if(prod.garron==resp.garron){
                    id_garron=prod.garron;
                }  
                if(id_garron===resp.garron){
                  Eliminar_producto_LS(id_garron);
            
              
              }           
            })
          })
           }
           ver_faltantesLS();
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
    async function guardar(){
      let productos;        
      funcion="guardarmatanza_faltante";
      productos=RecuperarLS();
      let data = await fetch('../controlador/ListadoController.php',{
          method: 'POST',
          headers:{'Content-Type':'application/x-www-form-urlencoded'},
           body:'funcion='+funcion+'&&productos='+JSON.stringify(productos),
      })
      if(data.ok){
        let response=await data.text();
       try{
        if (response == "add") {
          Swal.fire({
            
            position: "center",
            icon: "success",
            title: "Guardado",
            showConfirmButton: false,
            timer: 1500,
          });
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

  $(document).on("click", "#agregarelegir", (e) => {
    ver_faltantesLS();
    Swal.fire({
            
      position: "center",
      icon: "success",
      title: "Valores recuperados",
      showConfirmButton: false,
      timer: 1500,
    });
    });
      $(document).on("click", "#camaraelegir", (e) => {
      comparar_LS();
       let tropas = $("#tropasnum").val();
        let especie = $("#clasificaciongarron").val();
        let id_matarife = $("#matarifeid").val();
        let id_especies = $("#especiesid").val();
        let id_ingresos =$("#id_ingresos").val();
        
        $("#numero_tropa_camara").val(tropas);
        $("#clasificacion_garron_camara").val(especie);
        $("#matarife_camara").val(id_matarife);
        $("#especie_garron_camara").val(id_especies);
        $("#numero_id_ingreso").val(id_ingresos);
        rellenar_camaras();
      });
      $("#form-camara-garron").submit((e) => {
        let tropas = $("#numero_tropa_camara").val();
        let especie = $("#clasificacion_garron_camara").val();
        let camara = $("#elegir_camara").val();
        let id_matarife = $("#matarife_camara").val();
        let id_especies = $("#especie_garron_camara").val();
        let id_ingresos=$("#numero_id_ingreso").val();

       funcion = "estadomatanza";
       $.post("../controlador/ListadoController.php",{ funcion, id_ingresos },(response) => {
       });
        funcion = "camarasdestino";
        $.post("../controlador/ListadoController.php",{ funcion, tropas, camara,id_ingresos },(response) => {
        });
        funcion = "despiece";
        $.post("../controlador/ListadoController.php",{ funcion, tropas, especie,id_especies,id_ingresos },(response) => {
          if(response!='error'){
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Guardado",
          showConfirmButton: false,
          timer: 1500,
        });
     
       }else{
        Swal.fire({
          position: "center",
          icon: "warning",
          title: "No se agrego despiece a la base de datos",
          showConfirmButton: false,
          timer: 1500,
        });
       }
        }
        );
       funcion = "estadomatanzaproceso";
       $.post("../controlador/ListadoController.php",{ funcion, tropas, id_matarife },(response) => {}
        );
        funcion = "camaraproceso";
       $.post("../controlador/ListadoController.php",{ funcion, tropas, id_matarife, camara },(response) => {
          setTimeout('document.location.reload()',2000);
       }
      
        );

        e.preventDefault();
        $('html, body').animate({
          scrollTop: $("#fechaactual").offset().top
          }, 1000);
      });

      async function buscarfaenados(id_ingresos){       
        funcion="buscarfaenados";
        let data = await fetch('../controlador/ListadoController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
             body:'funcion='+funcion+'&&id_ingresos='+id_ingresos,
        })
        if(data.ok){
          let response=await data.text();
         try{
         
          let respuesta=JSON.parse(response);
          let maximo=respuesta.maximo;
          if(respuesta.maximo==null){
            funcion = "buscarfaenadosparcial1";
            $.post("../controlador/ListadoController.php",{ funcion, id_ingresos,maximo },(response) => {
                let resp = JSON.parse(response);
              
                $("#cantidad_garron").val(resp.enpie);
                $("#desde_garron").val(resp.desde);
                $("#hasta_garron_guardar").val(resp.hasta);
                let cantidad = resp.enpie;
                let desde = resp.desde;
                let hasta = resp.hasta;
                let enpie = resp.enpie;
                $('#hasta_garron').val(enpie);
                $('#quedan_garron_mostrar').val(0);
                $('#total_garron').val('TOTALIDAD');
              });
          }else{
          funcion = "buscarfaenadosparcial";
          $.post("../controlador/ListadoController.php",{ funcion, id_ingresos,maximo },(response) => {
              let resp = JSON.parse(response);
              $("#cantidad_garron").val(resp.enpie);
              $("#desde_garron").val(resp.desde);
              $("#hasta_garron_guardar").val(resp.hasta);
              let cantidad = resp.enpie;
              let desde = resp.desde;
              let hasta = resp.hasta;
              let enpie = resp.enpie;
              $('#hasta_garron').val(parseFloat(hasta)-parseFloat(desde));
              $('#quedan_garron_mostrar').val(cantidad-enpie);
              $('#total_garron').val('PARCIAL');
            });
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

      $(document).on("click", "#reducir", (e) => {
        rellenar_corrales();
        let tropas = $("#tropasnum").val();
        let productor = $("#productor").val();
        let garron = $("#numgarron").val();
        let especie = $("#clasificaciongarron").val();
        let peso = $("#pesogarronguardar").val();
        let estado = $("#estadodect").val();
        let id_matarife = $("#matarifeid").val();
        $("#numero_tropa").val(tropas);
        $("#clasificacion_garron").val(especie);
        $("#id_matarife").val(id_matarife);
        buscarfaenados(tropas);
      });

      $(document).on("keyup", "#pesogarron", function () {
        let valor = $(this).val();
        $("#pesogarronguardar").val(valor);
        let tropas = $("#tropasnum").val();
        let ultimo = $("#maximo").val();
        let cantidad = $("#numgarron").val();
        let maximo = $("#maximo").val();
        let valor1 = parseFloat(cantidad) + parseFloat(1);
        if (cantidad == maximo) {
          $("#estadodect").val("FINALIZADO");
        } else {
          $("#finalzado").hide();
        }

        if (valor == "") {
          $("#siguiente").hide();
          $("#reducir").hide();
        } else {
          $("#siguiente").show();
          $("#reducir").show();
          funcion="ultimoidfaenados";
          $.post("../controlador/ListadoController.php",{funcion},(response)=>{
         
            let idultimo='';
            const respuesta=JSON.parse(response);
            idultimo+=`${respuesta.id}`;
            if(idultimo=='null'){
              $('#ultimoid').val(1);
            }else{
            $('#ultimoid').val(idultimo);
            }
  
          })
        }
      });

      $("#tabla_listados tbody").on("click", ".reducir", function () {
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id;
        let tropas = datos.numtropas;
        let cantidad = datos.enpie;
        let clasificacion = datos.subespecies;
        let promedio = datos.promedio;
        let corral = datos.corral;
        let destino = datos.destino;
        let matarife = datos.matarife;
        let id_matarife = datos.id_matarife;
        let productor = datos.productor;
        let guia = datos.guia;
        let desde = datos.desde;
        let hasta = datos.hasta;
        let seleccionado = datos.seleccionado;
        let id_ingresos = datos.identificador;
        $("#numero_tropa").val(tropas);
        $("#clasificacion_garron").val(clasificacion);
        $("#id_matarife").val(id_matarife);
        $("#id_ingreso_reducir").val(id_ingresos);

        buscarfaenados(id_ingresos);
      });
    });
  }
});
async function reduccion_total(ultimo,reduccion,corral,id_ingresos,porque,quedan,desde){
  funcion="reducir_total";
  let data=await fetch('../controlador/ListadoController.php',{
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body:'funcion='+funcion+'&&ultimo='+ultimo+'&&reduccion='+reduccion+'&&corral='+corral+'&&id_ingresos='+id_ingresos+'&&porque='+porque+'&&quedan='+quedan+'&&desde='+desde
  }) 
  if(data.ok){
      let response=await data.text();
     try{
      if (response == "add") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Guardado",
          showConfirmButton: false,
          timer: 1500,
        });
        location.reload(true);
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
async function reduccion_parcial(ultimo,reduccion,corral,id_ingresos,porque,quedan,desde){
  funcion="reducir_parcial";
  let data=await fetch('../controlador/ListadoController.php',{
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body:'funcion='+funcion+'&&ultimo='+ultimo+'&&reduccion='+reduccion+'&&corral='+corral+'&&id_ingresos='+id_ingresos+'&&porque='+porque+'&&quedan='+quedan+'&&desde='+desde
  }) 
  if(data.ok){
      let response=await data.text();
     try{
      if (response == "add") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Guardado",
          showConfirmButton: false,
          timer: 1500,
        });
        location.reload(true);
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
$("#form-reducir-garron").submit((e) => {
  let todos = $("#cantidad_garron").val();
  let ultimo = $("#hasta_garron_guardar").val();
  let reduccion = $("#hasta_garron").val();
  let corral = $("#corral_garron").val();
  let id_ingresos = $("#id_ingreso_reducir").val();
  let porque = $("#estado_garron").val();
  let quedan=parseFloat(todos-reduccion) ;
  let desde= $("#desde_garron").val();
  if ($("#total_garron").val() == "TOTALIDAD") {
    reduccion_total(ultimo,reduccion,corral,id_ingresos,porque,quedan,desde);

  }else if ($("#total_garron").val() == "PARCIAL"){
    reduccion_parcial(ultimo,reduccion,corral,id_ingresos,porque,quedan,desde);
  }
  e.preventDefault();
});

function Mostrar_Loader(Mensaje) {
  var texto = null;
  var mostrar = false;
  switch (Mensaje) {
    case "Generando_Pdf":
      texto = " Generando PDF. Por favor espere...";
      mostrar = true;
      break;
  }
  if (mostrar) {
    Swal.fire({
      title: "Generando PDF",
      text: texto,
      showConfirmButton: false,
    });
  }
}
function cerrar_loader(Mensaje) {
  var tipo = null;
  var texto = null;
  var mostrar = false;
  switch (Mensaje) {
    case "exito_generar":
      tipo = "success";
      texto = " El PDF se genero correctamente...";
      mostrar = true;
      break;
    case "error_generar":
      tipo = "error";
      texto = " El PDF no puede generarse... Por favor intente de nuevo";
      mostrar = true;
      break;
    default:
      swal.close();
      break;
  }
  if (mostrar) {
    Swal.fire({
      position: "center",
      icon: tipo,
      text: texto,
      showConfirmButton: false,
    });
  }
  
}

$(document).ready(function () {
  async function buscarlistados(json){
    especie=2;
    let data=await fetch('../controlador/PDFpalcoController.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'json='+json+'&&especie='+especie
    })
    if(data.ok){
        let response=await data.text(); 
       try{ 
        Mostrar_Loader("Generando_Pdf");
            if (response != "") {
              
              cerrar_loader("exito_generar");
              window.open('../pdf/Listados/pdf-informe'+especie+'.pdf', '_blank');
              buscarlistados_ovinos(json);
            } else {
              cerrar_loader("error_generar");
              buscarlistados_ovinos(json);
            }
        } catch(error){
        
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: data.statusText,
           text: 'Hubo conflicto de codigo: '+data.status+'. Comuniquese con el area de sistemas',
        })
        
    }
 
  }
  async function buscarlistados_ovinos(json){
    especie=4;
    let data=await fetch('../controlador/PDFpalcoController_ovinos.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'json='+json+'&&especie='+especie
    })
    if(data.ok){
        let response=await data.text();
       try{ 
        Mostrar_Loader("Generando_Pdf");
            if (response != "") {
              cerrar_loader("exito_generar");
              window.open('../pdf/Listados/pdf-informe'+especie+'.pdf', '_blank');
            } else {
              cerrar_loader("error_generar");
            }
        } catch(error){
        
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: data.statusText,
           text: 'Hubo conflicto de codigo: '+data.status+'. Comuniquese con el area de sistemas',
        })
        
    }
 
  }
  $("#frmdatos").submit(function (evento) {
    evento.preventDefault();
    var checked = [];
    $("#obligatorio").hide();
    let contador = $("input:checked").length;
    if (!contador) {
      $("#obligatorio").show();
      $("#resultado").text("");
      return;
    }
    let resultado = "";
    $(".opcion").each(function (indice, opcion) {
      if ($(opcion).is(":checked")) {
        resultado += $(opcion).attr("name") + ", ";
        checked.push({ id: $(this).attr("value"), dato: $(this).attr("id") });
      }
    });
    $("#resultado").text(`Usted ha Seleccionado: ${resultado}.`);
    let json = JSON.stringify(checked);
    buscarlistados(json);
   
  });
  $("#marcartodas").click(function () {
    $('input[type="checkbox"]').attr(
      "checked",
      $("#marcartodas").is(":checked")
    );
    $("#frmdatos").trigger("reset");
  });
  
});
function  carrito(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos){  
      const producto={
          id:id_ingresos,
          tropas:tropas,
          productor:productor,
          garron:garron,
          especie:especie,
          peso:peso,
          estado:estado, 
          id_especies:id_especies,
          destinocsv:destinocsv,
          idultimo:idultimo,
          tci:tci,               
      }
      let id_producto;
      let productos;
      productos = RecuperarLS();
      productos.forEach(prod => {
          if(prod.id===producto.id){
              id_producto=prod.id;
          }                
      });
      AgregarLS(producto); 
      let contador; 
      //Contar_productos();            
                           
  }
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


async function  guardar_matanza_enter(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos){
  funcion="guardarmatanza";
  let data=await fetch('../controlador/ListadoController.php',{
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body:'funcion='+funcion+'&&tropas='+tropas+'&&productor='+productor+'&&garron='+garron+'&&especie='+especie+'&&peso='+peso+'&&estado='+estado+'&&id_especies='+id_especies+'&&codigo='+codigo+'&&destinocsv='+destinocsv+'&&idultimo='+idultimo+'&&tci='+tci+'&&id_ingresos='+id_ingresos
  })
  if(data.ok){
      let response=await data.text();
     try{
      
      if (response == "add") {
        Swal.fire({

          position: "center",
          icon: "success",
          title: "Guardado",
          showConfirmButton: false,
          timer: 1500,
        });
        carrito(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos);
        let funcion = "buscargarronfaenados";
        $.post('../controlador/ListadoController.php',{funcion,id_ingresos},(response)=>{
         
          $('#form_listado_garron').DataTable().clear().destroy();
          $('#form_listado_garron').empty();
        let datatable = $("#form_listado_garron").DataTable({
         

          "ajax": {
            "url": "../controlador/ListadoController.php",
            "method": "POST",
            "data": {
              "funcion": funcion,
              "id_ingresos": id_ingresos,
            },
          },
          "columns": [
            { "data": "tropa" },
            { "data": "especie" },
            { "data": "garron" },
            { "data": "peso" },
    
            {
              "defaultContent": `<button class="editar btn btn-warning" data-toggle="modal" data-target="#editargarron" type="button">Editar</button>
              
                                           
                                          `,
            },
          ],
          "language": espanol,
        });
    
        $("#form_listado_garron tbody").on("click", ".editar", function () {
          let datos = datatable.row($(this).parents()).data();
          let id = datos.id_faenados;
          let tropas = datos.tropa;
          let garron = datos.garron;
          let peso = datos.peso;
          let id_ingreso = datos.id_ingreso;
          $("#numero_tropa_editar").val(tropas);
          $("#garron_id").val(garron);
          $("#peso_garron").val(peso);
          $("#id_editar").val(id);
          $("#id_ingreso").val(id_ingreso);
          
        });
      })
      let cantidad = $("#numgarron").val();
      let maximo = $("#maximo").val();
      let valor = parseFloat(cantidad) + parseFloat(1);
      $("#numgarron").val(valor);
      let promedio = (valor * 100) / maximo;
      var titular = document.getElementById("tracking");
      titular.style.width = promedio + "%";
      $("#siguiente").hide();
        $("#reducir").hide();
        $("#pesogarron").val("");
          if (valor > maximo) {
            $("#siguiente").hide();
            $("#reducir").hide();
            $("#finalzado").show();
            $("#estadodect").val("FINALIZADO");
            $("#pesogarron").hide();
            $("#pesogarron1").hide();
            $("#camaraelegir").show();
          } else {
            $("#finalzado").hide();
      
}
        $('#actualizar_faena').hide();
        }else{
          $('#actualizar_faena').show();
        Swal.fire({
          
          position: "center",
          icon: "error",
          title: "No Guardado...Garron duplicado...Actualice la pagina",
          showConfirmButton: false,
          timer: 1500,
        });

      }
    
      } catch(error){
          console.error(error);
          console.log(response);
          Swal.fire({
            icon: 'error',
            title: data.statusText,
           text: 'Hubo conflicto de codigo...No se puede conectar al servidor: '+data.status,
        })
         
      }
  }else{
      Swal.fire({
          icon: 'error',
          title: data.statusText,
         text: 'Hubo conflicto de codigo...No se puede conectar al servidor: '+data.status,
      })
  }

}

function recuperar(e) {
  if (e.keyCode == 13) {
      var tb = document.getElementById("pesogarronguardar");
      eval(tb.value);
      let peso=tb.value;
      let tropas = $("#tropasnum").val();
      let productor = $("#productor").val();
      let garron = $("#numgarron").val();
      let especie = $("#clasificaciongarron").val();
      let estado = $("#estadodect").val();
      let id_matarife = $("#matarifeid").val();
      let id_especies = $("#especiesid").val();
      let codigo = $("#codigo").val();
      let destinocsv = $("#destinocsv").val();
      let resultado1 = $("#maximo").val();
      let nombrematarife = $("#nombrematarife").val();
      let idultimo=$('#ultimoid').val();
      let tci=$('#tci').val();
      let id_ingresos=$("#id_ingresos").val();
      let resultado = resultado1 - garron;

      if (resultado1 - garron < 3) {
        $("#alerta").show();
        $("#alertatexto").html(
          "PELIGRO quedan para procesar" + " " + resultado + " " + "animales"
        );
      }
       guardar_matanza_enter(tropas,productor,garron,especie,peso,estado,id_especies,codigo,destinocsv,idultimo,tci,id_ingresos)
    }
}


let espanol = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ningún dato disponible en esta tabla",
  sInfo:
    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
    sSortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    copy: "Copiar",
    colvis: "Visibilidad",
  },
};
