<?php
if(!empty($_GET['id']) && $_GET['name']){
session_start();
$_SESSION['product-verification']=$_GET['id'];
//echo $_SESSION['product-verification'];

if(!empty($_GET['noti'])){
  $_SESSION['noti']=$_GET['noti'];
  //echo $_SESSION['noti'];
}

?>
  <title>Municipalidad de Malargüe</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
 include_once 'layouts/nav.php'
?>
    <title><?php echo $_GET['name']?>|Mas Descripcion</title>
    <style>
      .preguntas{
        height:100% !important;
      }
    </style>
      <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $_GET['name']?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $_GET['name']?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          </div>
       <input type="hidden" id="id_ingresos" value="<?php echo $_GET['id']?>">
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-pre-tab" data-toggle="tab" href="#product-pre" role="tab" aria-controls="product-pre" aria-selected="true">Preguntas</a>
                
              
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-pre" role="tabpanel" aria-labelledby="product-pre-tab"> 
                <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                      <img class="direct-chat-img mr-1" src="../util/img/usuarios/user_default.png" alt="Message User Image">
                        <input type="text" name="message" placeholder="Escribir pregunta" class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
            
            <div class="direct-chat-messages direct-chat-danger preguntas">
            <input type="" id="id_ingresos" value="<?php echo $_GET['id'] ?>">
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    
                    <img class="direct-chat-img" src="../util/img/usuarios/user_default.png" alt="Message User Image">
                   
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                      <img class="direct-chat-img mr-1" src="../util/img/usuarios/60d6181830f46-NELSON.jpeg" alt="Message User Image">
                        <input type="text" name="message" placeholder="Responder pregunta" class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger">Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  </div>
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <img class="direct-chat-img" src="../util/img/usuarios/60d6181830f46-NELSON.jpeg" alt="Message User Image">
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                  
                  </div>
            
                </div>
               </div>
       
           
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <?php
include_once 'layouts/footer.php';
}
else{
    header('Location:../index.php');
}
    ?>
