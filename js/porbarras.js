$(document).ready(function(){
    $('#cat-carrito').show();
    $('#cat-pen').show();
    $('#cat-ent').show();
    $("#Barras").on("shown.bs.modal", function() {
        $("#buscar-barras").trigger("focus");
    })
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
        
        $.post('../controlador/LoteController.php',{funcion,id_producto,garron},(response)=>{      
         
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
        $.post('../controlador/LoteController.php',{funcion,valor},(response)=>{
           
            if(response=='add'){
              funcion="buscardespachobarras";
              $.post('../controlador/LoteController.php',{funcion,valor},(response)=>{ 
          
          
           let id='';
           let tropa='';
           let especie='';
           let despiece='';
           let productor='';
           let garron='';
           let peso='';
           let matarife='';
           let dte='';
          

           const datos=JSON.parse(response);
           id += `${datos.id}`;
           tropa += `${datos.tropa}`;
           especie += `${datos.especie}`;
           despiece += `${datos.despiece}`;
           productor += `${datos.productor}`;
           garron += `${datos.garron}`;
           peso += `${datos.peso}`;
           matarife += `${datos.matarife}`;
           dte += `${datos.dte}`;
           
           
           $('#tropa_carrito_barras').val(tropa);
           $('#especie_carrito_barras').val(especie);
           $('#despecie_carrito_barras1').val(despiece);
           const producto={
            id:id,
            tropa:tropa,
            especie:especie,
            despieces:despiece,
            garron:garron,
            peso:peso,
            productor:productor,
            matarife:matarife,
            cantidad:1,    
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
        
                
           } else{

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
              $('#buscar-barras').val(' ');  
                 $("#buscar-barras").trigger("focus");
        template=` 
        <tr prodID="${producto.id}">
       
        <td>${producto.id}</td> 
        <td>${producto.cantidad}</td> 
        <td>${producto.tropa}</td>     
        <td>${producto.especie}</td> 
        <td>${producto.despieces}</td>  
        <td>${producto.garron}</td>  
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
            }
           
            
              })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No existe este Producto!',                    
                      })
                      $('#buscar-barras').val(' '); 
                      $('#form-carrito_barras').trigger('reset');  
                      $("#buscar-barras").trigger("focus");
                    
  
                }
              })
  
            }
            
           
     
}
$('#marcartodasbarras').click(function(){
    $('input[type="checkbox"]').attr('checked', $('#marcartodasbarras').is(':checked'));
    $('#frmdatos').trigger('reset');
  });
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
            text: 'El Carrito esta vacio!',                    
          })
    }
    else{
        location.href='../vista/adm_procesardespacho.php';
    }
}) 
