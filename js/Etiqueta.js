$(document).ready(function () {
  $('#gestion_etiquetas1').addClass('active');
  buscar_producto();
  function buscar_producto(consulta) {
    funcion = "buscar";
    $.post(
      "../controlador/etiquetasController.php",{ consulta, funcion },(response) => {
        const productos = JSON.parse(response);
        let template = "";
        productos.forEach((producto) => {
          template += `
                <div prodId="${producto.id}"prodId1="${producto.id_ingresos}" prodAno="${producto.ano}" prodMatarife="${producto.matarife}" prodProductor="${producto.productor}"prodGuia="${producto.guia}"prodDestino="${producto.destino}"prodEspecie="${producto.especie}"prodSubespecies="${producto.subespecies}"prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1"></i>${producto.enpie}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Tropa: ${producto.id}</b></h2>
                      <h2 class="lead"><b>${producto.matarife}</b></h2>    
                      <h2 class="lead"><b>Garrones: ${producto.desde}-${producto.hasta}</b></h2> 
                      <h2 class="lead"><b>AÑO: ${producto.ano}</b></h2>                    
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> GUIA: ${producto.guia}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> DESTINO: ${producto.destino}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-hard-hat"></i></span> ESPECIE: ${producto.especie}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> SUBESPECIE: ${producto.subespecies}</li>
                        <li class="small"><span class="fa-li"><i class="far fa-folder-open"></i></span> PRODUCTOR: ${producto.productor}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">                    
                    <button class="imprimir_etiqueta btn btn-sm btn-primary">
                      <i class="fas fa-plus-square mr-2"></i> Imprimir Etiqueta
                    </button>                    
                  </div>
                </div>
              </div>
            </div>
                `;
        });
        $("#productos").html(template);
      }
    );
  }
  $(document).on("keyup", "#buscar-producto", function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_producto(valor);
    } else {
      buscar_producto();
    }
  });
  async function codigos_qr(id_ingresos){
    funcion="codigos_qr";
    let data=await fetch('../controlador/FinalizadoController.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
    })
    if(data.ok){
        let response=await data.text();
       try{
        const id=JSON.parse(response);
        id.forEach(qr => {
            funcion="codigos";
            let id_qr = qr.id;
            let tropas = qr.tropa;
            let productor = qr.productor;
            let garron = qr.garron;
            let especie = qr.especie;
            let peso = qr.peso;
            let estado = qr.estado;
            let maximo = qr.maximo;
            let matarife = qr.matarife;
            $.post( "../controlador/ListadoController1.php",{funcion,id_qr,tropas,productor,garron,especie,peso,estado,maximo,matarife},(e)=>{
            } );
            
        });
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
  async function codigos_barras(id_ingresos){
    funcion="codigos_barras";
    let data=await fetch('../controlador/FinalizadoController.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
    })
    if(data.ok){
        let response=await data.text();
       try{
          const id=JSON.parse(response);
          id.forEach(barras => {
              $filepath="../etiquetas/barras/"+barras.id+".png";
              $text=barras.id;
              $.post( "../modelo/Codigobarras.php", { filepath:$filepath , text:$text} );
              
          });
       
    } catch(error){
            //console.error(error);
            //console.log(response);
           
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: data.statusText,
           text: 'Hubo conflicto de codigo: '+data.status,
        })
    }
 
  }
  async function  etiquetas(id,ano,id_ingresos){
    funcion="tipo";
    let data=await fetch('../controlador/FinalizadoController.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&id_ingresos='+id_ingresos
    })
    if(data.ok){
        let response=await data.text();
       try{
           const especies=JSON.parse(response);
      
        if(especies.especie==4){
            $.post('../controlador/PDFEtiquetacaprinosController.php',{id,id_ingresos},(response)=>{
               if(response==''){
                cerrar_loader('exito_generar');  
                window.open('../pdf/etiquetas/pdf-'+id+'.pdf','_blank');

                funcion = "buscarsiexisteetiqueta";
                $.post("../controlador/etiquetasController.php",{ funcion, id, ano}, (response) => {
            

            let respuesta='';
            const respuestas=JSON.parse(response);
            respuesta+=respuestas.etiqueta
                  if(respuesta=='NO'){
              funcion = "agregaretiqueta";
              $.post("../controlador/etiquetasController.php",{ funcion, id, ano, guia, especie, subespecies, matarife },(response) => {
               
                if (response == "edit") {
                    Swal.fire({
                      title: "Se genero exitosamente la etiqueta",
                      showConfirmButton: false,
                    });
                    location.reload(true);
                  }
                }
              );
              
              $.post("../controlador/etiquetasController1.php",{ id, ano, guia, especie, subespecies, nombrematarife },(response) => {
              
            }
              );
            
            }else{
              Swal.fire({
                title: "Etiqueta Generada",
                showConfirmButton: false,
              });
            }
                      });
               }else{
                cerrar_loader('error_generar');  
               }
            
            })
        }else{
                $.post('../controlador/PDFEtiquetaovinosController.php',{id,id_ingresos},(response)=>{
                   if(response==''){
                    cerrar_loader('exito_generar');  
                    window.open('../pdf/etiquetas/pdf-'+id_ingresos+'.pdf','_blank');
    
                    funcion = "buscarsiexisteetiqueta";
                    $.post("../controlador/etiquetasController.php",{ funcion, id_ingresos}, (response) => {
 
                        let respuesta='';
                        const respuestas=JSON.parse(response);
                        respuesta+=respuestas.etiqueta
                            if(respuesta=='NO'){
                        funcion = "agregaretiqueta";
                        $.post("../controlador/etiquetasController.php",{ funcion, id,id_ingresos, ano, guia, especie, subespecies, matarife },(response) => {
                            if (response == "edit") {
                                Swal.fire({
                                title: "Se genero exitosamente la etiqueta",
                                showConfirmButton: false,
                                });
                                location.reload(true);
                      }
                    }
                  );
                  $.post("../controlador/EtiquetasController1.php",{ id, ano, guia, especie, subespecies, nombrematarife },(response) => {
                }
                  );
                
                }else{
                  Swal.fire({
                    title: "Etiqueta Generada",
                    showConfirmButton: false,
                  });
                }
                          });
                   }else{
                    cerrar_loader('error_generar');  
                   }
                
                })
        }  
       
    } catch(error){
            //console.error(error);
            //console.log(response);
           
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: data.statusText,
           text: 'Hubo conflicto de codigo: '+data.status,
        })
    }
 
  }
  $(document).on("click", ".imprimir_etiqueta", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    const id = $(elemento).attr("prodId");
    console.log(id);
    const id_ingresos = $(elemento).attr("prodId1");
    const ano = $(elemento).attr("prodAno");
    const guia = $(elemento).attr("prodGuia");
    const especie = $(elemento).attr("prodEspecie");
    const subespecies = $(elemento).attr("prodSubespecies");
    const matarife = $(elemento).attr("prodMatarife");
    const producto = {
      id: id,
      ano: ano,
      guia: guia,
      especie: especie,
      subespecies: subespecies,
      matarife: matarife,
    };
   

  Swal.fire({
    title: "Etiqueta Generada",
    showConfirmButton: false,
  });
  etiquetas(id,ano,id_ingresos);
  codigos_qr(id_ingresos);
  codigos_barras(id_ingresos);


      

  
  });
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
