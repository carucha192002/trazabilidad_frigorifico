$(document).ready(function(){
    $('#gestion_devolucion1').addClass('active');
    $('#gestion_despacho1').removeClass('active');
    $('#cat-carrito').hide();
    $('#cat-pen').hide();
    $('#cat-ent').hide();
    $("#Barras").on("shown.bs.modal", function() {
        $("#buscar-barras").trigger("focus");
    })

    $(document).on('click','.borrar-producto',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        elemento.remove();
        Eliminar_producto_LS(id);
        Contar_productos();
               
    }) 
    RecuperarLS();
    $('#procesartodo').hide();
    $('#eliminartodo').hide();
})

function EliminarLS() {
    localStorage.clear();
}
RecuperarLS_modal();
function RecuperarLS_modal(){
    let productos,id_producto,garron;
    productos = RecuperarLS();
    
    funcion="buscar_id";
    Contar_productos();
    
    productos.forEach(producto => {
        id_producto=producto.id;
        garron=producto.garron;
        
        $.post('../controlador/DevolucionController.php',{funcion,id_producto,garron},(response)=>{      
        
            let template_carrito='';
            let json = JSON.parse(response);
            template_carrito=`
                            <tr prodID="${json.id}">
                            
                                <td>${json.id}</td> 
                                <td>${json.unidad}</td> 
                                <td>${json.tropa}</td>     
                                <td>${json.especie}</td> 
                                <td>${json.despieces}</td>  
                                <td>${json.garron}</td>  
                                <td>${json.peso}</td> 
                                <td>${json.productor}</td> 
                                <td>${json.matarife}</td> 
                                <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>         
                            </tr>                     
            `;
            $('#garroncarritobarras').append(template_carrito);
        })               
    });
}
function Contar_productos() {
    let productos;
    let contador=0;
    productos=RecuperarLS();
    productos.forEach(producto => {
        contador++;                
    });
    $('#contador1').html('Cantidad de Productos:'+contador);
}

   function RecuperarLS() {
            let productos;
           
            if(localStorage.getItem('productos')===null){
                productos=[];
                $('#procesartodo').hide();
                $('#eliminartodo').hide();
            }
            else{
                productos = JSON.parse(localStorage.getItem('productos'))
                $('#procesartodo').show();
                $('#eliminartodo').show();
            }
            return productos
            
        }
        function AgregarLS(producto) {
            let productos;
            productos = RecuperarLS();
            productos.push(producto);
            localStorage.setItem('productos',JSON.stringify(productos))
        }
function recuperar(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("buscar-barras");
        eval(tb.value);
       
        let valor=tb.value;
        funcion="buscardespachoexiste";
      $.post('../controlador/DevolucionController.php',{funcion,valor},(response)=>{
          if(response=='add'){
            funcion="buscardespachobarras";
            $.post('../controlador/DevolucionController.php',{funcion,valor},(response)=>{
              
                let id='';
                let tropa='';
                let especie='';
                let despiece='';
                let camara='';
                let garron='';
                let peso='';
                let productor='';
                let matarife='';
                let dte='';
                const datos=JSON.parse(response);
                id += `${datos.id}`;
                tropa += `${datos.tropa}`;
                especie += `${datos.especie}`;
                despiece += `${datos.despiece}`;
                camara += `${datos.camara}`;
                garron += `${datos.garron}`;
                peso += `${datos.peso}`;
                productor += `${datos.productor}`;
                matarife += `${datos.matarife}`;
                dte += `${datos.dte}`;
                $('#tropa_carrito_barras').val(tropa);
                $('#especie_carrito_barras').val(especie);
                $('#despiece_carrito_barras1').val(despiece);
                const producto={
                    id:id,
                    tropa:tropa,
                    especie:especie,
                    despiece:despiece,
                    camara:camara,
                    garron:garron,
                    peso:peso,
                    productor:productor,
                    matarife:matarife,
                    dte:dte,
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
                      $('#buscar-barras').val(' '); 
                      $('#form-carrito_barras').trigger('reset');  
                      $("#buscar-barras").trigger("focus");

    
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
                    <tr prodId="${producto.id}">
                    
                    <td>${producto.id}</td> 
                    <td>${producto.cantidad}</td> 
                    <td>${producto.tropa}</td>     
                    <td>${producto.especie}</td> 
                    <td>${producto.despiece}</td>  
                    <td>${producto.camara}</td>  
                    <td>${producto.peso}</td> 
                    <td>${producto.productor}</td> 
                    <td>${producto.matarife}</td>  
                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>         
                    </tr>            
                `; 
                $('#garroncarritobarras').append(template);
                AgregarLS(producto); 
                let contador; 
                Contar_productos(); 
                $('#buscar-barras').val(' ');  

                }  
            })      
            
          }else{
            $('#tropa_carrito_barras').val('');
                $('#especie_carrito_barras').val('');
                $('#despiece_carrito_barras1').val('');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se encuentra el Producto!',                    
                  })
                  $('#buscar-barras').val(' ');  
          }
         
      })

    }
   
}


  $(document).on('click','#eliminartodo',(e)=>{
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
    $('#garroncarritobarras').empty();
    EliminarLS();
    Contar_productos(); 
    e.preventDefault(); 
    $('#form-carrito_barras').trigger('reset');      
   
        $("#buscar-barras").trigger("focus");
    
}) 
$(document).on('click','#procesartodo',(e)=>{
    let productos;
    productos=RecuperarLS();
    if(productos.length===0){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No hay productos para devolver!',                    
          })
    }else{
        let productos,id_producto,garron;
        productos = RecuperarLS();
        funcion="cargardevolucion";       
        productos.forEach(producto => {
            id_producto=producto.id;
            garron=producto.garron;
          
            $.post('../controlador/DevolucionController.php',{funcion,id_producto},(response)=>{
              
                if(response=='add'){
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
                    title: 'Productos Agregados nuevamente!'
                  })
                 
                
                }

            })
            $.post( "../modelo/Codigobarras.php", { filepath: "../etiquetas/barras/"+id_producto+".png", text:id_producto } );
            
           
           
        });
             
       

    
    let productos1,id_producto1,garron1;
    productos1 = RecuperarLS();

    funcion="recuperardatos";       
    productos1.forEach(producto => {
        id_producto1=producto.id;
        garron1=producto.garron;
        $.post('../controlador/DevolucionController.php',{funcion,id_producto1},(response)=>{  
            let tropas = '';
            let productor = '';
            let garron = '';
            let especie = '';
            let peso = '';
            let estado = '';
            let maximo = '';
            let nombrematarife = '';
            const respuestaetiqueta=JSON.parse(response);
            tropas+=respuestaetiqueta.tropas;
            productor+=respuestaetiqueta.productor1;
            garron+=respuestaetiqueta.garron;
            especie+=respuestaetiqueta.especie1;
            peso+=respuestaetiqueta.peso;
            estado+=respuestaetiqueta.estado1;
            maximo+=respuestaetiqueta.maximo;
            nombrematarife+=respuestaetiqueta.nombrematarife1;
            $.post("../controlador/ListadoController1.php",{tropas,productor,garron,especie,peso,estado,maximo,nombrematarife,},(response) => {
                
                })
        })   
           
            })  
            $('#procesartodo').hide();
            $('#eliminartodo').hide();
            EliminarLS();
            
        }
}) 

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