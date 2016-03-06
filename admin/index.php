<?php
//ini_set('display_errors', 1); 
//error_reporting(E_ALL);

require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}

if(isset($_POST['mat']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['spaceid'])){

	if ($resp != null && $resp->success) {
		$stmt = $pdo->prepare('INSERT INTO registration VALUES (:mat,:spaceid,:name,:lname)');
		$stmt->execute(array(':mat' => $_POST['mat'], ':spaceid' => $_POST['spaceid'], ':name' => $_POST['name'], ':lname' => $_POST['lname']));
	}
}

$stmt = $pdo->prepare('Select labspace.SpaceID, availableSpaces-ifnull(registrations,0) as remaining, Description from (SELECT ls.SpaceId, count(Matricula) as registrations FROM `registration` r join labspace ls where r.spaceID = ls.SpaceID group by r.spaceID) as T right join labspace on  T.SpaceID = labspace.SpaceID;');
$stmt->execute();
$labspaces = $stmt->fetchall();

$stmt = $pdo->prepare('Select * from professor');
$stmt->execute();
$professors = $stmt->fetchall();

//print_r($labspaces);
/*if(isset($_POST['email'])){
	$stmt = $pdo->prepare('INSERT INTO `client`(`mail`, `name`) VALUES (:mail,:name)');
	$stmt->execute(array(':mail' => $_POST['email'], ':name' => $_POST['name']));
}*/
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Wed Jun 10 2015 18:41:16 GMT+0000 (UTC) -->
<html data-wf-site="5571e5ec944bce2d287c29b6" data-wf-page="5571e5ec944bce2d287c29b8">
<head>
  <meta charset="utf-8">
  <title>Registro de laboratorios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="../css/normalize.css">
  <link rel="stylesheet" type="text/css" href="../css/webflow.css">
  <link rel="stylesheet" type="text/css" href="../css/tslup.webflow.css">
  <link rel="stylesheet" type="text/css" href="../css/lightbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script src="../js/lightbox.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Roboto:300,regular,500"]
      }
    });
  </script>
  <script type="text/javascript" src="../js/modernizr.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon_tslup.png">
  <link rel="apple-touch-icon" href="images/tslup256x256.png">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-63978632-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
</head>
<body>
  <!--LIGHTBOX-->
  
  <?php 
	  if(isset($_GET['success'])){
		echo '
   <div id="registerlight" class="white_content">
                                  <div class="w-row" style="text-align: center;">
                                  <div class="w-col w-col-4"></div>
                                  <div class="w-col w-col-4">
                                  	
                                  		<p>';
								
								switch ($_GET['success']) {
									case 'labcreated':
										echo "Horario Creado";
										break;
									case 'labupdated':
										echo "Horario Actualizado";
										break;
										
									case 'labdeleted':
										echo "Horario Borrado";
										break;
									case 'profcreated':
										echo "Profesor Añadido";
										break;
										
									case 'profupdated':
										echo "Profesor Actualizado";
										break;
										
									case 'profdeleted':
										echo "Profesor Borrado";
										break;
								}
								
									echo'</p>
                                  		<a style="position: relative; height: auto; padding: 10px;  float: none;  margin-left: 0px; margin-top: 20px;   display: block; cursor:pointer;   background-color: #265aa6; color: white;" onclick="lightboxOut(\'registerlight\',\'registerfade\')">Ok</a>
                                  </div>
                                  <div class="w-col w-col-4"></div>
                                  </div> 
                                    <div class="w-row" >
                                    
                                      
                                      </div>
                                      
     </div>
        <div id="registerfade" class="black_overlay" onclick="lightboxOut(\'registerlight\',\'registerfade\')"></div>';
	}
	?>

  <script>lightboxIn('registerlight','registerfade');</script>
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
    <div class="w-container section" id="contact">
      <h1 class="title">Registro de laboratorios</h1>
      <div class="w-form">
          <div class="w-row">
            <div class="w-col w-col-12">
                <div data-duration-in="300" data-duration-out="100" class="w-tabs">
                  <div class="w-tab-menu">
                    <a data-w-tab="Tab 1" class="w-tab-link w--current w-inline-block">
                      <div>Horarios</div>
                    </a>
                    <a data-w-tab="Tab 2" class="w-tab-link w-inline-block">
                      <div>Profesores</div>
                    </a>
                  </div>
                  <div class="w-tab-content">
                    <div data-w-tab="Tab 1" class="w-tab-pane w--tab-active">
                      <div id="newlab">
                    	<form id="email-form" style="padding: 10px;" method="post" action="newcourse">
                          <div class="w-row">
            				<div class="w-col w-col-1"><p>Curso:</p></div>
                            <div class="w-col w-col-4">
                              <input class="w-input form-field list" id="password" type="text" placeholder="Nombre del curso" name="course">
                            </div>
            				<div class="w-col w-col-1"><p>Cupo:</p></div>
                            <div class="w-col w-col-2">
                              <input class="w-input form-field list" id="course" type="number" min="0" step="1" placeholder="Cupo" name="cupo">
                            </div>
                            <div class="w-col w-col-4">
                              <a onclick="lightboxOut('mescontactlight', 'mescontactfade')" style="float: left; margin-top: 0px; margin-right: 10px;">
                                 <img class="control-icon" src="../images/lapiz.png" onmouseover="this.src= '../images/lapiz-01.png';" onmouseout="this.src= '../images/lapiz.png';" />
                              </a>
                            <a onclick="lightboxOut('mescontactlight', 'mescontactfade')" style="float: left; margin-top: 0px; margin-right: 10px;">
                                 <img class="control-icon" src="../images/borrar-04.png" onmouseover="this.src= '../images/borrar-02.png';" onmouseout="this.src= '../images/borrar-04.png';" />
                              </a>
                              
              					<input style="float:left" class="w-button button" type="submit" value="Guardar" data-wait="Please wait...">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div data-w-tab="Tab 2" class="w-tab-pane">
                     <div id="newprof">
                    	<form id="email-form" style="padding: 10px;" method="post" action="newcourse">
                          <div class="w-row">
            				<div class="w-col w-col-1"><p>Profesor:</p></div>
                            <div class="w-col w-col-4">
                              <input class="w-input form-field list" id="password" type="text" placeholder="Nombre del profesor" name="course">
                            </div>
                            <div class="w-col w-col-4">
                              <a onclick="lightboxOut('mescontactlight', 'mescontactfade')" style="float: left; margin-top: 0px; margin-right: 10px;">
                                 <img class="control-icon" src="../images/lapiz.png" onmouseover="this.src= '../images/lapiz-01.png';" onmouseout="this.src= '../images/lapiz.png';" />
                              </a>
                            <a onclick="lightboxOut('mescontactlight', 'mescontactfade')" style="float: left; margin-top: 0px; margin-right: 10px;">
                                 <img class="control-icon" src="../images/borrar-04.png" onmouseover="this.src= '../images/borrar-02.png';" onmouseout="this.src= '../images/borrar-04.png';" />
                              </a>
                              
              					<input style="float:left" class="w-button button" type="submit" value="Guardar" data-wait="Please wait...">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>