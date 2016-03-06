<?php 
require('conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
}
$admindahouse = false;
$sesionactiva =	!empty($_SESSION['activeuser']);
session_destroy();
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Sun Nov 02 2014 22:41:59 GMT+0000 (UTC) -->
<html data-wf-site="5404f3c663fd63af2a92ff19" data-wf-page="5404f3c663fd63af2a92ff1a">
<head>
  <meta charset="ISO-8859-1">
  <title>MiBi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/mibi.webflow.css">
  <link rel="stylesheet" type="text/css" href="css/lightbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]
      }
    });
  </script>
  <script type="text/javascript" src="js/modernizr.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
  <div class="w-nav navbar naav" data-collapse="small" data-animation="default" data-duration="400" data-contain="1">
    <div class="w-container">
      <nav class="w-nav-menu w-clearfix" role="navigation"><a class="w-nav-link links _2 centrado" href="registro">Registro</a><a class="w-nav-link links _2 centrado" href="iniciar-sesion">Iniciar Sesi&oacute;n</a>
      </nav>
      <div class="w-nav-button">
        <div class="w-icon-nav-menu"></div>
      </div>
      <div>
      </div>
    </div>
  </div>
  <div class="w-container necesitas" style="margin-top: 3%;">
    <div class="w-row">
      <div class="w-col w-col-4"></div>
      <div class="w-col w-col-4" style="text-align: center">
      <a id="homelink" class="w-inline-block" href="index" onMouseOut="document.getElementById('homelink').setAttribute('style', 'opacity: 1');" onMouseOver="document.getElementById('homelink').setAttribute('style', 'opacity: 0.5');">
        <img class="logo-mibi" src="images/logomibimx.png" alt="544583d0e62142a84d262d04_logomibimx.png">
        </a>
        <div class="webpage_label" style="margin-top: 20%; margin-left: -24%; font-size: 18px; width: 150%;">Su sesi&oacute;n se ha cerrado correctamente</div>
      </div>
      <div class="w-col w-col-4"></div>
    </div>
  </div>
  <div class="w-nav barra_condiciones" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
    <div class="w-container" style="height: 33px;">
      <nav class="" role="navigation" style="height: 33px;"><a class="w-nav-link link_condiciones" href="privacidad?sec=privacy">Aviso de Privacidad</a><a class="w-nav-link link_condiciones" href="privacidad?sec=terms">Términos y Condiciones</a><a class="w-nav-link link_condiciones" href="privacidad?sec=about">Acerca de</a><a class="w-nav-link link_condiciones" href="privacidad?sec=faq">Preguntas Frecuentes</a><a class="w-nav-link link_condiciones" href="contact">Contacto</a>
      </nav>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>