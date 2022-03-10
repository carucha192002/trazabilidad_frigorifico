<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';


    

if($_POST['funcion']=='enviarbackup'){
    
  $dir = '../Backup/';
   $day = date("l");
   $archivo=$dir.$day.'mataderomunicipal'.'_backup.sql';
   $email='francocara18@yahoo.com.ar';
    date_default_timezone_set('America/Mendoza');
    $fecha=date('d-m-Y H:i:s');
    $año=date('Y');
    $mail = new PHPMailer(true);
try { 
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'depositomunicipalmalargue@hotmail.com';                     // SMTP username
    $mail->Password   = '31167252franco';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('depositomunicipalmalargue@hotmail.com', 'Administracion Matadero Frigorifico Malargue');
    $mail->addAddress($email);     // Add a recipient
    $mail->AddAttachment($archivo, $archivo);
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mensaje='
    <!DOCTYPE>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Narrative Invitation Email</title>
  <style type="text/css">

  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    border: 0;
    outline: none;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    font-size: 13px;
    line-height: 19px;
    text-align: left;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
  }

  table {
    border-collapse: collapse !important;
  }


  h1, h2, h3, h4 {
    padding: 0;
    margin: 0;
    color: #444444;
    font-weight: 400;
    line-height: 110%;
  }

  h1 {
    font-size: 35px;
  }

  h2 {
    font-size: 30px;
  }

  h3 {
    font-size: 24px;
  }

  h4 {
    font-size: 18px;
    font-weight: normal;
  }


  </style>

  <style type="text/css" media="screen">
      @media screen {
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);

        /* Thanks Outlook 2013! */
        td, h1, h2, h3 {
          font-family: Open Sans, Helvetica Neue, Arial, sans-serif !important;
        }
      }
  </style>

  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td style="background:#1f1f1f" width="100%">

          <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
              <tr>
                <td valign="top" width="270" style="background:#1f1f1f; text-align:left;">
                 width="50" height="50" alt="Your Logo"/>
                  
                 
                </td>
                <td>
                  <h2 style="color: #f8f8f8; text-align:left;">
                    Matadero Frigorifico Regional Malargue <br>Municipalidad de Malargue</br>
                  </h2>
                </td>
               
              </tr>
            </table>
          </center>

        </td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #e7e7e7;">

          <center>
            <table cellpadding="0" cellspacing="0" width="600" class="w320">
              <tr>
                <td align="left" class="mobile-padding" style="padding:20px 20px 30px">

                  <br class="mobile-hide" />

                  <h1>Matadero Frigorifico Regional Malargue<br></h1>
                  <h3> Backup Sistema</h3>

                  <br>
                  Hola, <strong></strong>
                  <br>
                  Te enviamos de forma automatica un archivo adjunto con el backup de los datos del sistema
                  <br>
                  <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                    <tr>
                      <td style="width:130px;background:#D84A38;">
                        <div>
                        
                        </div>
                      </td>
                      <td width="316" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td>
                    </tr>
                  </table>
                </td>
                <td class="mobile-hide" style="padding-top:20px;padding-bottom:0;">
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td align="right" width="220" style="padding-right:20px; vertical-align:middle;">
                        <table width="94" align="right" cellpadding="0" cellspacing="0">
                          <tr>
                            <td style="border:2px solid #000000">
                             
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                     <td style="font-size:12px; padding-top:5px; text-align:center; padding-right:20px">
                      
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>

        </td>
      </tr>
      <tr>
        <td valign="top" style="background-color:#f8f8f8;border-bottom:1px solid #e7e7e7;">

          <center>
            <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;">
              <tr>
                <td valign="top" class="mobile-padding" style="padding:20px;">
                  <h2>Centro de ayuda</h2>
                  <br>
                  
                  <br>
                  * Para restablecer la copia de Seguridad pongase en contacto con la gente de sistema
                  <br><br>
                  Atentamente. <strong>Centro de Backup</strong><br>
                  '.$fecha.'
                  <br>
                </td>
              </tr>
            </table>
          </center>

        </td>
      </tr>
     
      <tr>
        <td style="background-color:#1f1f1f;">
          <center>
            <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;color:#ffffff" bgcolor="#1f1f1f" >
              <tr>
                <td align="right" valign="middle" class="mobile-padding" style="font-size:12px;padding:20px; background-color:#1f1f1f; color:#ffffff; text-align:left; ">
                  <h2 style="color:#FF0000;"  href="#">Creado por Franco Cara | '.$año.'</h2>
                 
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    </td>
  </tr>
</table>
</body>
</html>

    ';
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Backup Sistema';
    $mail->Body    = $mensaje;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPDebug = false;
    $mail->do_debug = false;
    $mail->send();
    echo 'enviado';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
