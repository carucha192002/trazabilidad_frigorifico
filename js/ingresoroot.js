$(document).ready(function(){
    $('#ingresover1').addClass('active');
    setTimeout(accesos,2000);
    function llenar_pantalla(categoria){
        let template=``;
        if(categoria===undefined||categoria==''||categoria==null){

        }else{
            template=`
            <div class="col-sm-12">
            <div class="description-block">
            <a id="productor" href="adm_catalogoproductor.php" class="btn btn-block btn-outline-success">Ingresar como Matarife</a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="description-block">
            <a id="autorizado" href="adm_ingresoroot.php" class="btn btn-block btn-outline-primary">Ingresar como Personal Autorizado</a>
            <a id="autorizadopalco" href="adm_listadofaenas.php" class="btn btn-block btn-outline-primary">Ingresar como Personal Autorizado</a>
            <a id="autorizadocamara" href="adm_movcamara.php" class="btn btn-block btn-outline-primary">Ingresar como Personal Autorizado</a>
            <a id="autorizadoinvitado" href="adm_reportes_diarios.php" class="btn btn-block btn-outline-primary">Ingresar como Personal Autorizado</a>
            </div>
          </div>
            `;
        }
        $('#loader1').hide(500);
        $('#menu').html(template);
        
    }
    async function accesos(){
        funcion="traer";
        let data=await fetch('../controlador/InicioController.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
        })
        if(data.ok){
            let response=await data.text();
           try{
            const datos = JSON.parse(response);
            $('#categoria').html(datos.tipo);
            $('#dni').html(datos.dni);
            $('#email').html(datos.email);
            $('#telefono').html(datos.telefono);
            $('#avatar').attr('src','../img/'+datos.avatar)
            llenar_pantalla(datos.categoria);
            if(datos.categoria==4){
                $('#productor').show();
                $('#autorizado').hide();
                $('#autorizadopalco').hide();
                $('#autorizadocamara').hide();
                $('#autorizadocamara').hide();
                $('#autorizadoinvitado').hide();
            }else if(datos.categoria==1)
            {
                $('#productor').hide();
                $('#autorizado').hide();
                $('#autorizadopalco').hide();
                $('#autorizadocamara').show();
                $('#autorizadoinvitado').hide();
            } else if(datos.categoria==2){
                $('#autorizadocamara').hide();
                $('#productor').hide();
                $('#autorizado').show();
                $('#autorizadopalco').hide();
                $('#autorizadocamara').hide();
                $('#autorizadoinvitado').hide();
            } else if(datos.categoria==3){
                $('#autorizadocamara').hide();
                $('#productor').hide();
                $('#autorizado').show();
                $('#autorizadopalco').hide();
                $('#autorizadocamara').hide(); 
                $('#autorizadoinvitado').hide();
            }else if(datos.categoria==5){
                $('#autorizadocamara').hide();
                $('#productor').hide();
                $('#autorizado').hide();
                $('#autorizadopalco').show();
                $('#autorizadocamara').hide();
                $('#autorizadoinvitado').hide();
            }else if(datos.categoria==6){
                $('#autorizadocamara').hide();
                $('#productor').hide();
                $('#autorizado').hide();
                $('#autorizadoinvitado').show();
                $('#autorizadocamara').hide();
                $('#autorizadopalco').hide();
            }
                
            } catch(error){
                //console.error(error);
                $('#productor').hide();
                $('#autorizado').hide();
                $('#autorizadopalco').hide();
                $('#autorizadocamara').hide();
                $('#autorizadocamara').hide();
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: data.statusText,
               text: 'Hubo conflicto de codigo: '+data.status+'. Comuniquese con el area de sistemas',
            })
            $('#productor').hide();
            $('#autorizado').hide();
            $('#autorizadopalco').hide();
            $('#autorizadocamara').hide();
            $('#autorizadocamara').hide();
        }
     
      }
 
   
})