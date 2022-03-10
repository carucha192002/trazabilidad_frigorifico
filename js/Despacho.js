$(document).ready(function(){
  $('#gestion_despacho1').addClass('active');
    $('#cat-carrito').show();
    $('#cat-pen').show();
    $('#cat-ent').show();
    buscar_producto();
    mostrar_lote_riesgo();
    function buscar_producto(consulta) {
        funcion="buscardespacho";
        $.post('../controlador/LoteController.php',{consulta,funcion},(response)=>{
      
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto => {
                template+=`
                <div prodId="${producto.id}" prodTropa="${producto.tropa}" prodEspecie="${producto.especie}"prodDespiece="${producto.despiece}"prodCamara="${producto.camara}"prodGarron="${producto.garron}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1">TROPA: </i>${producto.tropa}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Garron: ${producto.garron}</b></h2>
                     
                      <h4 class="lead"><b><i class="fas fa-location-arrow">CAMARA: </i>(${producto.camara})</b></h4>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> ESPECIE: ${producto.especie}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> CUARTEADO: ${producto.despiece}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-hard-hat"></i></span> ID: ${producto.id}</li>
                      
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">                    
                    <button class="agregar-carrito btn btn-sm btn-primary">
                      <i class="fas fa-plus-square mr-2"></i> Agregar al Carrito
                    </button> 
                    <br>
                   
                    <button class="agregar-carrito1 btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#todatropa">
                    <i class="fas fa-plus-square mr-2"></i> Agregar Tropa Completa
                  </button>                    
                  </div>
                </div>
              </div>
            </div>
                `;
            });
            $('#productos').html(template);
        });
    }
    $(document).on('keyup','#buscar-tropa',function(){
      let valor = $(this).val();
      
      if(valor.trim()!=""){
          buscar_producto(valor);
      }
      else{
          buscar_producto();
      }
  });
 
    function mostrar_lote_riesgo() {
        funcion="buscar";
        $.post('../controlador/LoteController.php',{funcion},(response)=>{  
            const lotes = JSON.parse(response);
            let template='';
            lotes.forEach(lote => {
                if(lote.estado=='warning'){
                    template+=`
                    <tr class="table-warning">
                    <td>${lote.id}</td>
                    <td>${lote.tropa}</td>
                    <td>${lote.especie}</td>
                    <td>${lote.despieces}</td>
                    <td>${lote.productor}</td>
                    <td>${lote.camara}</td>
                    <td>${lote.nomconservacion}</td>
                    <td>${lote.fecha}</td>
                    <td>${lote.vidautil}</td>
                    <td>${lote.mes}</td>
                    <td>${lote.dia}</td>
                    </tr>
                    `;
                }
                if(lote.estado=='danger'){
                    template+=`
                    <tr class="table-danger">
                    <td>${lote.id}</td>
                    <td>${lote.tropa}</td>
                    <td>${lote.especie}</td>
                    <td>${lote.despieces}</td>
                    <td>${lote.productor}</td>
                    <td>${lote.camara}</td>
                    <td>${lote.nomconservacion}</td>
                    <td>${lote.fecha}</td>
                    <td>${lote.vidautil}</td>
                    <td>${lote.mes}</td>
                    <td>${lote.dia}</td>
                    </tr>
                    `;
                }
                if(lote.estado=='ligth'){
                  template+=`
                  <tr class="table-info">
                  <td>${lote.id}</td>
                  <td>${lote.tropa}</td>
                  <td>${lote.especie}</td>
                  <td>${lote.despieces}</td>
                  <td>${lote.productor}</td>
                  <td>${lote.camara}</td>
                  <td>${lote.nomconservacion}</td>
                  <td>${lote.fecha}</td>
                  <td>${lote.vidautil}</td>
                  <td>${lote.mes}</td>
                  <td>${lote.dia}</td>
                  </tr>
                  `;
              }
               
            });            
            $('#lotes').html(template);
        })
    }
})
