<?php
//ini_set('display_errors', 1); 
//error_reporting(E_ALL);
require('conbd.php');
$siteKey = "6LdZKggTAAAAAEMl-2fIzUuSUZ2p7nn7wLoBn6pl";
$secret = "6LdZKggTAAAAAKM57eGAAOlZSjHZ18Wl6iUjXTGb";

if(isset($_POST['mat']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['spaceid'])){
	
	require_once "recaptchalib.php";
	// Register API keys at https://www.google.com/recaptcha/admin
	// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
	$lang = "es";
	// The response from reCAPTCHA
	$resp = null;
	// The error code from reCAPTCHA, if any
	$error = null;
	$reCaptcha = new ReCaptcha($secret);
	// Was there a reCAPTCHA response?
	if (isset($_POST["g-recaptcha-response"])) {
		$resp = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	}
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
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/tslup.webflow.css">
  <link rel="stylesheet" type="text/css" href="css/lightbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script src="js/lightbox.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Roboto:300,regular,500"]
      }
    });
  </script>
  <script type="text/javascript" src="js/modernizr.js"></script>
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
	  if(isset($_POST['mat']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['spaceid'])){
		if ($resp != null && $resp->success) {
		echo '
   <div id="registerlight" class="white_content">
                                  <div class="w-row" style="text-align: center;">
                                  <div class="w-col w-col-4"></div>
                                  <div class="w-col w-col-4">
                                  	
                                  		<p>Registro completado</p>
                                  		<a style="position: relative; height: auto; padding: 10px;  float: none;  margin-left: 0px; margin-top: 20px;   display: block; cursor:pointer;   background-color: #265aa6; color: white;" onclick="lightboxOut(\'registerlight\',\'registerfade\')">Ok</a>
                                  </div>
                                  <div class="w-col w-col-4"></div>
                                  </div> 
                                    <div class="w-row" >
                                    
                                      
                                      </div>
                                      
     </div>
        <div id="registerfade" class="black_overlay" onclick="lightboxOut(\'registerlight\',\'registerfade\')"></div>';
		  }
	}
	?>

  <script>lightboxIn('registerlight','registerfade');</script>
  <div class="w-section navigation-bar" id="start">
    <div class="w-nav navigation-bar static" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
      <div class="w-container">
        <a class="w-nav-brand brand-link" href="index.html"><img src="images/TSLUP_logo-01.png">
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
      <h2 class="title">Cupo máximo por grupo 24 personas</h2>
      <div class="w-form">
        <form id="email-form" method="post" action="?">
          <div class="w-row">
            <div class="w-col w-col-2"></div>
            <div class="w-col w-col-6">
            
              <input class="w-input form-field" id="mat" type="text" placeholder="Matrícula" name="mat">
              <input class="w-input form-field" id="name" type="text" placeholder="Nombre" name="name">
              <input class="w-input form-field" id="lname" type="text" placeholder="Apellidos" name="lname">
              <label>Profesor que imparte la teoría</label>
              <select class="w-input form-field" name="professor">
              	<?php
					if(sizeof($professors )>0){
						for($i = 0; $i < sizeof($professors ); $i++){
  							echo '<option value="'.$professors [$i]["ProfessorID"].'">'.$professors[$i]["name"].'</option>';
						}
					}
					else{
					}
				?>
			  </select>
            </div>
            <div class="w-col w-col-2"></div>
            <div class="w-col w-col-2"></div>
          </div>
          <div class="w-row">
            <div class="w-col w-col-2"></div>
            <div class="w-col w-col-6">
              <label>Horario a elegir</label>
              <select class="w-input form-field" name="spaceid">
              	<?php
					if(sizeof($labspaces)>0){
						for($i = 0; $i < sizeof($labspaces); $i++){
							if(intval($labspaces[$i]["remaining"])>0){
  								echo '<option value="'.$labspaces[$i]["SpaceID"].'">'.$labspaces[$i]["Description"].'</option>';
							}
						}
					}
					else{
					}
				?>
			  </select>
              <?php if(isset($_POST['email']) && !($resp != null && $resp->success)){
			  		echo '<div class="w-form-fail" style="display: block; width:302px;';
					echo '"><p>Please, verify</p></div><script>
				  window.scrollTo(0,document.body.scrollHeight);</script>';
							}?>
                            <div  <?php if(isset($_POST['email']) && !($resp != null && $resp->success)){}else{echo 'style="height: 125px;"';}?>>
							<div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
                            </div>
				  <script type="text/javascript"
					  src="https://www.google.com/recaptcha/api.js?hl=en">
				  </script>
            </div>
            <div class="w-col w-col-2">
              <label style="color: white;"> .</label>
              <input class="w-button button" type="submit" value="Enviar" data-wait="Please wait...">
            </div>
            <div class="w-col w-col-2"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="w-section footer">
    <div class="w-row">
      <div class="w-col w-col-4 spc">
        <p class="detailwhatwedo"><img style="height: 30px;" src="images/TSLUP_logo-01.png"></p>
      </div>
      <div class="w-col w-col-4 spc">
        <p class="detailwhatwedo centername">Tecnológico de Monterrey, Campus Guadalajara</p>
      </div>
      <div class="w-col w-col-4 madeincolumn">
        <p class="detailwhatwedo inline">
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>