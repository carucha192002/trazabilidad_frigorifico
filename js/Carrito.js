$(document).ready(function(){   
    calcularTotal();
    Contar_productos();
    RecuperarLS_carrito_compra();            
    RecuperarLS_carrito();
   $('#subtotales').hide(); 
   $('#clientefudepen').hide();
   $('#titulofude').hide();
   $('#cliente').hide();
   $('#titulonombre').hide();
    
    rellenar_cliente();
 
    function rellenar_cliente() {
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
            $('#cliente1').html(template);
            
        })
        $("#cliente1").change(function(){  
            $("#cliente1 option:selected").each(function (){
            numeromatarife = $(this).val();
            let id=numeromatarife;
            funcion="matarifecuit_rellenar";
             $.post('../controlador/MatarifeController.php',{funcion,id},(response)=>{
                
                 let cuit='';
                 let email='';
                 let nombre='';
                 let id_matarife='';
                 const numerocuit = JSON.parse(response);
                 cuit+=`${numerocuit.cuit}`;
                 email+=`${numerocuit.email}`;
                 nombre+=`${numerocuit.nombre}`;
                 id_matarife+=`${numerocuit.id_matarife}`;
                 $('#dni').val(cuit);
                

                 if(id_matarife=='20'){
                    funcion="fudepen_rellenar";
                    $.post('../controlador/MatarifeController.php',{funcion,id_matarife},(response)=>{
                  
                        $('#clientefudepen').show();
                        $('#titulofude').show();
                        const fudepen = JSON.parse(response);
                        let template='';
                        
                        template+=`
                        <option value="0"> Seleccione Subcategorias FUDEPEN</option>`;
                        fudepen.forEach(fude => {
                            template+=`
                            
                                <option value="${fude.nombre}">${fude.nombre}</option>
                            `;
                        });
                        $('#clientefudepen').html(template);
                        $("#clientefudepen").change(function(){  
                            $("#clientefudepen option:selected").each(function (){
                            nombre_sub = $(this).val();
                            $('#cliente').val(nombre_sub+'(FUDEPEN)');
                            })
                        })

                        
                    })
                 }else{
                    $('#cliente').val(nombre);
                    $('#clientefudepen').hide();
                    $('#titulofude').hide();
                 }
              
        })
                             
            })  
         }) 
    }
    $(document).on('click','#desbloquear',(e)=>{
        $('#clientefudepen').hide();
        $('#titulofude').hide();
        $('#titulo-select-retira').hide();
        $('#cliente1').hide();
        $('#cliente').show();
        $('#titulonombre').show();
        $("#dni").prop('disabled', false);
    
    })

    $(document).on('click','#actualizar',(e)=>{
        rellenar_cliente();
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
            title: 'Actualizado'
          })
    })

    $(document).on('click','.agregar-carrito',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const tropa=$(elemento).attr('prodTropa');
        const especie=$(elemento).attr('prodEspecie');
        const despiece=$(elemento).attr('prodDespiece');
        const camara=$(elemento).attr('prodCamara');
        const garron=$(elemento).attr('prodGarron');
        
            const producto={
                id:id,
                tropa:tropa,
                especie:especie,
                despiece:despiece,
                camara:camara,
                garron:garron,
                cantidad:1                
            }
            let id_producto;
            let productos;
            productos = RecuperarLS();
            productos.forEach(prod => {
                if(prod.id===producto.id){
                    id_producto=prod.id;
                }                
            });
            if(id_producto===producto.id){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El producto ya fue cargado!',                    
                  })
            }
            else{
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
                    title: 'Producto Agregado!'
                  })
                template=` 
                <tr prodID="${producto.id}">
                <td>${producto.id}</td> 
                <td>${producto.tropa}</td>     
                <td>${producto.especie}</td> 
                <td>${producto.despiece}</td>  
                <td>${producto.camara}</td>  
                <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>         
                </tr>            
            `; 
            $('#lista').append(template);
            AgregarLS(producto); 
            let contador; 
            Contar_productos();            
            }                      
        })
  
        $(document).on('click','.borrar-producto',(e)=>{
            const elemento = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(elemento).attr('prodId');
            elemento.remove();
            Eliminar_producto_LS(id);
            Contar_productos();
            calcularTotal();            
        })   
        $(document).on('click','#vaciar-carrito',(e)=>{
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
                icon: 'error',
                title: 'Carrito Vacio'
              })
            $('#lista').empty();
            EliminarLS();
            Contar_productos();           
        })  
        $(document).on('click','#procesar-pedido',(e)=>{
            Procesar_pedido();
        })
        $(document).on('click','#procesar-compra',(e)=>{
            Procesar_compra();
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
        function RecuperarLS_carrito(){
            let productos,id_producto,garron;
            productos = RecuperarLS();
            funcion="buscar_id";
           
            productos.forEach(producto => {
                id_producto=producto.id;
                garron=producto.garron;
                $.post('../controlador/LoteController.php',{funcion,id_producto,garron},(response)=>{      
                  
                    let template_carrito='';
                    let json = JSON.parse(response);
                    template_carrito=`
                                    <tr prodID="${json.id}">
                                        <td>${json.id}</td> 
                                        <td>${json.tropa}</td>     
                                        <td>${json.especie}</td> 
                                        <td>${json.despieces}</td>  
                                        <td>${json.garron}</td>  
                                        <td>${json.unidad}</td> 
                                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>         
                                    </tr>                     
                    `;
                    $('#lista').append(template_carrito);
                })               
            });
        }
        function Eliminar_producto_LS(id){
            let productos;
            productos = RecuperarLS();
            productos.forEach(function(producto,indice) {
                if(producto.id===id){
                    productos.splice(indice,1);
                }                
            });
            localStorage.setItem('productos',JSON.stringify(productos));
        }
        function EliminarLS() {
            localStorage.clear();
        }
        function Contar_productos() {
            let productos;
            let contador=0;
            productos=RecuperarLS();
            productos.forEach(producto => {
                contador++;                
            });
            $('#contador').html(contador);
            $('#contador1').html('Cantidad de Productos:'+contador);
            
        }
        function Procesar_pedido() {
            let productos;
            productos=RecuperarLS();
            if(productos.length===0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El Carrito esta vacio!',                    
                  })
            }
            else{
                location.href='../vista/adm_procesardespacho.php';
            }
        }
        function RecuperarLS_carrito_compra(){
            let productos,id_producto,garron;
            productos = RecuperarLS();
            funcion="buscar_id";
            productos.forEach(producto => {
                id_producto=producto.id;
                garron=producto.garron;
                $.post('../controlador/LoteController.php',{funcion,id_producto,garron},(response)=>{  
                 
                    let template_compra='';
                    let json = JSON.parse(response);
                    template_compra=`
                            <tr prodID="${producto.id}" prodPrecio="${json.unidad}">
                                    <td>${json.id}</td> 
                                    <td>${json.stock}</td>  
                                    <td class="precio">${json.unidad}</td>    
                                    <td>${json.especie}</td> 
                                    <td>${json.despieces}</td>  
                                    <td>${json.garron}</td> 
                                    <td>${json.tropa}</td> 
                                    <td>${json.vencimiento}</td>
                                    <td>
                                        <input type="number" min="1" class="form-control cantidad_producto" value="1">
                                    </td>                                      
                                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>         
                                    <td class="subtotales">
                                        <h5 style="visibility: hidden">${json.unidad*producto.cantidad}</h5>
                                    </td> 
                            </tr>                                      
                    `;
                    $('#lista-compra').append(template_compra);
                })               
            });           
        }
        async function RecuperarLS_carrito_compra1(){
            let productos;
            productos=RecuperarLS();
            funcion="traer_productos";
            const response = await fetch('../controlador/ProductoController.php',{
                method: 'POST',
                headers:{'Content-Type':'application/x-www-form-urlencoded'},
                body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
            })
            let resultado = await response.text();    
            $('#lista-compra').append(resultado);        
        }
        $('document').on('click','#actualizar',(e)=>{
            let productos,precios;
            precios=document.querySelectorAll('.precio');
            productos=RecuperarLS();
            productos.forEach(function(producto,indice) {
                producto.precio = precios[indice].textContent;                
            });
            localStorage.setItem('productos',JSON.stringify(productos));
            calcularTotal();
        })
        $('#cp').keyup((e)=>{
            let id, cantidad,producto,productos,montos,precio;
            producto = $(this)[0].activeElement.parentElement.parentElement;
           
            id = $(producto).attr('prodId');
            precio = $(producto).attr('prodPrecio');
            cantidad = producto.querySelector('input').value;
            montos = document.querySelectorAll('.subtotales');
            productos=RecuperarLS();
            productos.forEach(function(prod,indice) {
                if(prod.id===id){
                    prod.cantidad=cantidad;
                    prod.precio=precio;
                    montos[indice].innerHTML = `<h5 style="visibility: hidden">${cantidad*productos[indice].precio}</h5>`;
                    
                }
            });
            localStorage.setItem('productos',JSON.stringify(productos));
            calcularTotal();
        })
        function calcularTotal(){
            let productos,subtotal,con_igv,total_sin_descuento,pago,vuelto,descuento;
            let total=0,igv=0.18;
            productos=RecuperarLS();
            productos.forEach(producto => {
                let subtotal_producto= Number(producto.precio*producto.cantidad);
                total=total+subtotal_producto;
            });
            pago=$('#pago').val();
            descuento=$('#descuento').val();
            total_sin_descuento=total.toFixed(2);
            con_igv=parseFloat(total*igv).toFixed(2);
            subtotal=parseFloat(total-con_igv).toFixed(2);
            total=total-descuento;
            vuelto=pago-total;
            $('#subtotal').html(subtotal);
            $('#con_igv').html(con_igv);
            $('#total_sin_descuento').html(total_sin_descuento);
            $('#total').html(total.toFixed(2));
            $('vuelto').html(vuelto.toFixed(2));   
                   
        }
        function Procesar_compra(){
            let nombre,dni,destino,estado;
            nombre=$('#cliente').val();
            dni=$('#dni').val();          
            destino=$('#destino').val();   
            estado=$('#estado').val();  
      
            if(RecuperarLS().length == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No hay productos, Seleccione algunos!',                    
                  }).then(function(){
                      location.href='../vista/adm_despacho.php'
                  })
            }
            else if(nombre==''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Necesitamos un nombre de Cliente!',  
                                    
                  })                 
            }
            else if(destino==''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Necesitamos un Destino!',                    
                  })
            }
            else{
                 verificar_stock().then(error=>{
                 
                    if(error==0){
                        Registrar_compra(nombre,dni,destino,estado);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Se realizo el pedido',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function(){
                           EliminarLS();
                               location.href='../vista/adm_despacho.php'
                            })                          
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Hay conflicto en el Stock de un producto!',                    
                          })
                    }
                });                
               
            }
        }
        async function verificar_stock(){
            let productos;           
            funcion="verificar_stock";
            productos=RecuperarLS();
            const response = await fetch('../controlador/LoteController.php',{
                method: 'POST',
                headers:{'Content-Type':'application/x-www-form-urlencoded'},
                body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
            })
            let error = await response.text();            
            return error;
        }
        function Registrar_compra(nombre,dni,destino,estado){
            funcion='registrar_compra';
            let total=0;
            let productos=RecuperarLS();
            let json = JSON.stringify(productos);
            $.post('../controlador/CompraController.php',{funcion,total,nombre,dni,destino,estado,json},(response)=>{
            })
           
        }
        $(document).on('click','.agregar-carrito1',(e)=>{
            const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
            const id = $(elemento).attr('prodId');
            const tropa=$(elemento).attr('prodTropa');
            const especie=$(elemento).attr('prodEspecie');
            const despiece=$(elemento).attr('prodDespiece');
            const camara=$(elemento).attr('prodCamara');
            const garron=$(elemento).attr('prodGarron');
            
            $('#tropa_carrito_toda').val(tropa);
            $('#especie_carrito_toda').val(especie);
            $('#despiece_carrito_toda').val(garron);
            $('#despiece_carrito_toda1').val(despiece);
            let funcion="verificartropas";
         $.post('../controlador/camaraController.php',{funcion,tropa},(response)=>{
          const tipos = JSON.parse(response);
          let template='';
          tipos.forEach(tipo => {
              template+=`
                  <tr clasId="${tipo.id}"clasCamara="${tipo.camara}"clasGarron="${tipo.garron}"clasPeso="${tipo.peso}">  
                      <td> 
                      <input type="checkbox" name="${tipo.garron}" value="${tipo.id}" class="opcion">                         
                      </td>                                             
                      <td> 
                      ${tipo.garron}                          
                      </td>
                      <td>${tipo.peso}</td>
                      <td>${tipo.camara}</td>
        
                  </tr>
              `;
        });
        $('#garroncarrito').html(template);
        })
                   
            })
            $('#form-carrito_toda').submit(e=>{
                let tropa=  $('#tropa_carrito_toda').val();
                let especie=  $('#especie_carrito_toda').val();
                let cuarteado=  $('#despiece_carrito_toda').val();
                
                  var checked = [];
                  $('#obligatorio').hide();
                  let contador1 = $('input:checked').length;
                  if(!contador1){
                      $('#obligatorio').show();
                      $('#resultado').text('');
                      return;
                  }
                  let resultado='';
                  $('.opcion').each(function(indice,opcion){
                      if($(opcion).is(':checked')){
                      resultado+=$(opcion).attr('name') + ', ';
                      checked.push({"id":$(this).attr("value"),"tropa":$('#tropa_carrito_toda').val(),"especie":$('#especie_carrito_toda').val(),"despiece":$('#despiece_carrito_toda').val(),"garron":$(this).attr("name")});
                      }
                  });
                  $('#resultado').text(`Usted ha Seleccionado: ${resultado}.`);
              
                  let json = JSON.stringify(checked);
               
                
               checked.forEach(elemento => {
                const producto={
                    id:elemento.id,
                    tropa:elemento.tropa,
                    especie:elemento.especie,
                    despieces:elemento.despiece,
                    garron:elemento.garron,
                    cantidad:1  
                    
                    
                }
                let id_producto;
                let productos;
                productos = RecuperarLS();
                productos.forEach(prod => {
                    if(prod.id===producto.id){
                        id_producto=prod.id;
                    }                
                });
                if(id_producto===producto.id){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El producto ya fue cargado!',                    
                      })
                }
                else{
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
                        title: 'Producto Agregado!'
                      })
                template=` 
                <tr prodID="${producto.id}">
               
                <td>${producto.id}</td> 
                <td>${producto.tropa}</td>     
                <td>${producto.especie}</td> 
                <td>${producto.despieces}</td>  
                <td>${producto.garron}</td>   
                <td>${producto.cantidad}</td>   
                <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>         
                </tr>            
            `; 
            $('#lista').append(template);
                    
            AgregarLS(producto); 
            let contador; 
            Contar_productos();   
                    }
              $('#form-carrito_toda').trigger('reset');
               });
               location.reload(true);
                      e.preventDefault();
           
              })
            
              $('#marcartodas').click(function(){
                $('input[type="checkbox"]').attr('checked', $('#marcartodas').is(':checked'));
                $('#frmdatos').trigger('reset');
              });
            
})
