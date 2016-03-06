<?php session_start(); ?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Sun Nov 02 2014 22:41:59 GMT+0000 (UTC) -->
<html data-wf-site="5404f3c663fd63af2a92ff19" data-wf-page="54064c7cc880f6d02e4420b4">
<head>
  <meta charset="ISO-8859-1">
  <title>MiBi - Iniciar Sesi&oacute;n</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="../css/normalize.css">
  <link rel="stylesheet" type="text/css" href="../css/webflow.css">
  <link rel="stylesheet" type="text/css" href="../css/tslup.webflow.css">
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
  <div class="w-section navigation-bar" id="start">
    <div class="w-nav navigation-bar static" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
      <div class="w-container">
        <a class="w-nav-brand brand-link" href="index.html"><img src="../images/TSLUP_logo-01.png">
        </a>
      <!--
        <nav class="w-nav-menu navigation-menu" role="navigation"><a class="w-nav-link navigation-link" href="#start">Home</a><a class="w-nav-link navigation-link" href="#about">About</a><a class="w-nav-link navigation-link" href="#features">Features</a><a class="w-nav-link navigation-link" href="#contact">Contact</a>-->
        </nav>
        <div class="w-nav-button hamburger-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-section section lesspaceup" id="about">

    <div class="w-row logo2" style="margin-top: 25px;">
      <div class="w-col w-col-4" style="text-align: left;">      
      </div>
      <div class="w-col w-col-4">
        <div class="">
           <?php 
		   echo $_SESSION['activeuser'];
	if(!empty($_SESSION['activeuser'])){
		if($_SESSION['activeuser']=="profuser"){
			die("<script>location.href = 'index'</script>");
		}
	}
	if(isset($_POST['password'])){
		$pass = $_POST['password'];
	}
	if (!empty($pass)){
		if($pass == "tec2016enemay"){
			session_start();
			$_SESSION['activeuser'] = "profuser";
			die("<script>location.href = 'index'</script>");
		}else{
			echo '<div class="w-form-fail" style="display: block;"><p>Acceso incorrecto</p></div>
        </div>
      </div>
      <div class="w-col w-col-4"></div>
    </div><br><br>';
		}
	}
	else{
		echo '
        </div>
      </div>
      <div class="w-col w-col-4"></div>
    </div>';
	}
	
	?>
    <div class="w-row">
    <h1 class="title">Ingresar contraseña</h1>
      <div class="w-form">
        <form id="email-form" method="post" action="iniciar-sesion">
          <div class="w-row">
            <div class="w-col w-col-3"></div>
            <div class="w-col w-col-6">
            
              <input class="w-input form-field" id="password" type="password" placeholder="" name="password">
            </div>
            <div class="w-col w-col-3"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="w-section footer">
    <div class="w-row">
      <div class="w-col w-col-4 spc">
        <p class="detailwhatwedo"><img style="height: 30px;" src="../images/TSLUP_logo-01.png"></p>
      </div>
      <div class="w-col w-col-4 spc">
        <p class="detailwhatwedo centername">Tecnológico de Monterrey, Campus Guadalajara</p>
      </div>
      <div class="w-col w-col-4 madeincolumn">
        <p class="detailwhatwedo inline">Manuel B., Roberto F.</p>
      </div>
    </div>
  </div>
  <script>
  function scrolldown(){
	  window.scrollTo(0,10);
  }
  window.onload = scrolldown();
  </script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>