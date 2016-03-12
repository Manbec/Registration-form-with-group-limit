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

$stmt = $pdo->prepare('Select * from labspace;');
$stmt->execute();
$labspaces = $stmt->fetchall();

$stmt = $pdo->prepare('Select * from professor');
$stmt->execute();
$professors = $stmt->fetchall();

$stmt = $pdo->prepare('SELECT * FROM `registration` natural join labspace');
$stmt->execute();
$registrations = $stmt->fetchall();

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
  <title>Administración de laboratorios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="../css/normalize.css">
  <link rel="stylesheet" type="text/css" href="../css/webflow.css">
  <link rel="stylesheet" type="text/css" href="../css/tslup.webflow.css">
  <link rel="stylesheet" type="text/css" href="../css/lightbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script src="../js/lightbox.js"></script>
  <script src="../js/modernizr.js"></script>
  <script src="../js/jquery-1.3.2.min.js" ></script>
  <script>
    WebFont.load({
      google: {
        families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Roboto:300,regular,500"]
      }
    });
  </script>
  <style>
  th > span {
	  color: black;
  }
  </style>
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
    <script>
		function prepareDel(type,id,descriptor){
			document.getElementById(type+'Id').value = id;
			document.getElementById(type+'Name').value = descriptor;
		}
		function enableEditCourse(type,id){
			document.getElementById(type+'buttons'+id).setAttribute('style', 'display:block;');
			document.getElementById(type+'icons'+id).setAttribute('style', 'display:none;');	
			document.getElementById(type+'name'+id).removeAttribute('disabled');
			document.getElementById(type+'space'+id).removeAttribute('disabled');
		}
		function disableEditCourse(type,id){
			
			document.getElementById(type+'buttons'+id).setAttribute('style', 'display:none;');
			document.getElementById(type+'icons'+id).setAttribute('style', 'display:block;');	
			document.getElementById(type+'name'+id).setAttribute('disabled','disabled');
			document.getElementById(type+'space'+id).setAttribute('disabled','disabled');
		}
		function enableEditProf(type,id){
			document.getElementById(type+'buttons'+id).setAttribute('style', 'display:block;');
			document.getElementById(type+'icons'+id).setAttribute('style', 'display:none;');	
			document.getElementById(type+'name'+id).removeAttribute('disabled');
		}
		function disableEditProf(type,id){
			
			document.getElementById(type+'buttons'+id).setAttribute('style', 'display:none;');
			document.getElementById(type+'icons'+id).setAttribute('style', 'display:block;');	
			document.getElementById(type+'name'+id).setAttribute('disabled','disabled');
		}
		function showNewLab(){
			document.getElementById('newlab').setAttribute('style', '');	
		}
		
		function showNewProf(){
			document.getElementById('newprof').setAttribute('style', '');	
		}
		
		
		function hideNewLab(){
			document.getElementById('newlab').setAttribute('style', 'display: none;');	
		}
		function exportTableToCSV($table, filename) {

    var $rows = $table.find('tr:has(td),tr:has(th)'),

        // Temporary delimiter characters unlikely to be typed by keyboard
        // This is to avoid accidentally splitting the actual contents
        tmpColDelim = String.fromCharCode(11), // vertical tab character
        tmpRowDelim = String.fromCharCode(0), // null character

        // actual delimiter characters for CSV format
        colDelim = '","',
        rowDelim = '"\r\n"',

        // Grab text from table into CSV formatted string
        csv = '"' + $rows.map(function (i, row) {
            var $row = $(row), $cols = $row.find('td,th');

            return $cols.map(function (j, col) {
                var $col = $(col), text = $col.text();

                return text.replace(/"/g, '""'); // escape double quotes

            }).get().join(tmpColDelim);

        }).get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim) + '"',



        // Data URI
        csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        console.log(csv);

        if (window.navigator.msSaveBlob) { // IE 10+
            //alert('IE' + csv);
            window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
        } 
        else {
            $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
        }
}
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
    
     <div id="delcourselight" class="white_content">
                                  <div class="w-row" style="text-align: center;">
                                  <div class="w-col w-col-3"></div>
                                  <div class="w-col w-col-6">
                                  <form id="email-form" method="post" action="delcourse">
                              			<input class="w-input form-field list" style="display: none;" id="courseId" type="text" placeholder="ID del curso" name="course">
                                  	
                                  		<p><strong>¿Seguro que desea borrar el curso <strong><span id="courseName">	</span></strong>?</strong> <br>Se perderán todos los registros del mismo</p>
                                  		<input style="height: auto; width: 100%; padding: 10px; float: none; margin-top: 20px;   display: block; cursor:pointer;   background-color: red; color: white;" type="submit" value="Borrar">
                                        
                                  </form>
                                        <a style="position: relative; height: auto; padding: 10px;  float: none;  margin-left: 0px; margin-top: 20px;   display: block; cursor:pointer;   background-color: #265aa6; color: white;" onclick="lightboxOut('delcourselight','delcoursefade')">Cancelar</a>
                                  </div>
                                  <div class="w-col w-col-3"></div>
                                  </div> 
                                      
     </div>
        <div id="delcoursefade" class="black_overlay" onclick="lightboxOut('delcourselight','delcoursefade')"></div>
        
        
     <div id="delproflight" class="white_content">
                                  <div class="w-row" style="text-align: center;">
                                  <div class="w-col w-col-3"></div>
                                  <div class="w-col w-col-6">
                                  <form id="email-form" method="post" action="delprof">
                              			<input class="w-input form-field list" style="display: block;" id="profId" type="text" placeholder="ID del profesor" name="profid">
                                  	
                                  		<p><strong>¿Seguro que desea borrar el curso <strong><span id="profName">	</span></strong>?</strong> <br>Se perderán todos los registros del mismo</p>
                                  		<input style="height: auto; width: 100%; padding: 10px; float: none; margin-top: 20px;   display: block; cursor:pointer;   background-color: red; color: white;" type="submit" value="Borrar">
                                        
                                  </form>
                                        <a style="position: relative; height: auto; padding: 10px;  float: none;  margin-left: 0px; margin-top: 20px;   display: block; cursor:pointer;   background-color: #265aa6; color: white;" onclick="lightboxOut('delproflight','delproffade')">Cancelar</a>
                                  </div>
                                  <div class="w-col w-col-3"></div>
                                  </div> 
                                      
     </div>
        <div id="delproffade" class="black_overlay" onclick="lightboxOut('delproflight','delproffade')"></div>

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
    <div class="w-container" id="contact">
      <h1 class="title">Administración de laboratorios</h1>
      <div class="w-form">
          <div class="w-row">
            <div class="w-col w-col-12">
                <div data-duration-in="300" data-duration-out="100" class="w-tabs">
                  <div class="w-tab-menu">
                    <a data-w-tab="Tab 1" class="w-tab-link w-inline-block">
                      <div>Horarios</div>
                    </a>
                    <a data-w-tab="Tab 2" class="w-tab-link <?php if (strpos($_GET['success'], 'prof') !== false) {echo 'w--current';} ?> w-inline-block">
                      <div>Profesores</div>
                    </a>
                    <a data-w-tab="Tab 3" class="w-tab-link w-inline-block">
                      <div>Registrados</div>
                    </a>
                  </div>
                  <div class="w-tab-content">
                    <div data-w-tab="Tab 1" class="w-tab-pane w--tab-active">
                    	<?php
						
						for($i = 0; $i < sizeof($labspaces); $i++){
							echo '
							<div class="w-row course-row">
                          
                    	<form id="email-form" style="padding: 10px;" method="post" action="updatecourse">
            				<div class="w-col w-col-1"><p>Curso:</p></div>
                            <div class="w-col w-col-4">
                              <input class="w-input form-field list" id="coursename'.$labspaces[$i]['SpaceID'].'" type="text" placeholder="Nombre del curso" value="'.$labspaces[$i]['Description'].'" name="course" disabled>
							  <input class="w-input form-field list" style="display: none;" type="text" placeholder="Nombre del curso" value="'.$labspaces[$i]['SpaceID'].'" name="courseID">
                            </div>
                            <div class="w-col w-col-4">
							<div id="courseicons'.$labspaces[$i]['SpaceID'].'" style="display: block;">
                              <a onclick="enableEditCourse(\'course\','.$labspaces[$i]['SpaceID'].')" class="course-action-icon">
                                 <img class="control-icon" src="../images/lapiz.png" onmouseover="this.src= \'../images/lapiz-01.png\';" onmouseout="this.src=\'../images/lapiz.png\';" />
                              </a>
                            <a onclick="lightboxIn(\'delcourselight\', \'delcoursefade\');prepareDel(\'course\','.$labspaces[$i]['SpaceID'].');" class="course-action-icon">
                                 <img class="control-icon" src="../images/borrar-04.png" onmouseover="this.src= \'../images/borrar-02.png\';" onmouseout="this.src= \'../images/borrar-04.png\';" />
                              </a>
							  </div>
                              <div id="coursebuttons'.$labspaces[$i]['SpaceID'].'" style="display: none;">
              					<input style="" class="w-button button course-button" type="submit" value="Guardar" data-wait="Please wait...">
                                <a style="" class="w-button button course-button" onclick="disableEditCourse(\'course\','.$labspaces[$i]['SpaceID'].')">Cancelar</a>
							  </div>
                            </div>
                            
                        </form>
                          </div>';
						}
						?>
                      	<div class="w-row course-row">
                            <a onclick="showNewLab();" class="course-action-icon" style="margin-bottom: 10px;">
                                 <img class="control-icon" src="../images/borrar-03.png" onmouseover="this.src= '../images/borrar-01.png';" onmouseout="this.src= '../images/borrar-03.png';" />
                              </a>
                          </div>
                      <div id="newlab" style="display: none;">
                          <div class="w-row course-row">
                          
                    	<form id="email-form" style="padding: 10px;" method="post" action="newcourse">
            				<div class="w-col w-col-1"><p>Curso:</p></div>
                            <div class="w-col w-col-4">
                              <input class="w-input form-field list" id="password" type="text" placeholder="Nombre del curso" name="course">
                            </div>
            				<div class="w-col w-col-1"><p>Cupo:</p></div>
                            <div class="w-col w-col-2">
                              <input class="w-input form-field list" id="course" type="number" min="0" step="1" placeholder="Cupo" name="cupo">
                            </div>
                            <div class="w-col w-col-4">
              					<input style="" class="w-button button course-button" type="submit" value="Guardar" data-wait="Please wait...">
                                <a style="" class="w-button button course-button">Cancelar</a>
                            </div>
                            
                        </form>
                          </div>';
						  
                      </div>
                    </div>
                    <div data-w-tab="Tab 2" class="w-tab-pane">
                     <?php
						
						for($i = 0; $i < sizeof($professors ); $i++){
							echo '
							<div class="w-row course-row">
                          
                    	<form id="email-form" style="padding: 10px;" method="post" action="updateprof">
            				<div class="w-col w-col-1"><p>Curso:</p></div>
                            <div class="w-col w-col-4">
                              <input class="w-input form-field list" id="profname'.$professors [$i]['ProfessorID'].'" type="text" placeholder="Nombre del curso" value="'.$professors [$i]['name'].'" name="name" disabled>
							  <input class="w-input form-field list" style="display: none;" type="text" placeholder="Nombre del curso" value="'.$professors [$i]['ProfessorID'].'" name="profid">
                            </div>
                            <div class="w-col w-col-4">
							<div id="proficons'.$professors [$i]['ProfessorID'].'" style="display: block;">
                              <a onclick="enableEditProf(\'prof\','.$professors [$i]['ProfessorID'].')" class="course-action-icon">
                                 <img class="control-icon" src="../images/lapiz.png" onmouseover="this.src= \'../images/lapiz-01.png\';" onmouseout="this.src=\'../images/lapiz.png\';" />
                              </a>
                            <a onclick="lightboxIn(\'delproflight\', \'delproffade\');prepareDel(\'prof\','.$professors [$i]['ProfessorID'].');" class="course-action-icon">
                                 <img class="control-icon" src="../images/borrar-04.png" onmouseover="this.src= \'../images/borrar-02.png\';" onmouseout="this.src= \'../images/borrar-04.png\';" />
                              </a>
							  </div>
                              <div id="profbuttons'.$professors [$i]['ProfessorID'].'" style="display: none;">
              					<input style="" class="w-button button course-button" type="submit" value="Guardar" data-wait="Please wait...">
                                <a style="" class="w-button button course-button" onclick="disableEditProf(\'prof\','.$professors [$i]['ProfessorID'].')">Cancelar</a>
							  </div>
                            </div>
                            
                        </form>
                          </div>';
						}
						?>
                      	<div class="w-row course-row">
                            <a onclick="showNewProf();" class="course-action-icon" style="margin-bottom: 10px;">
                                 <img class="control-icon" src="../images/borrar-03.png" onmouseover="this.src= '../images/borrar-01.png';" onmouseout="this.src= '../images/borrar-03.png';" />
                              </a>
                          </div>
                      <div id="newprof" style="display: none;">
                          <div class="w-row course-row">
                          
                    	<form id="email-form" style="padding: 10px;" method="post" action="newprof">
            				<div class="w-col w-col-2"><p>Agregar profesor:</p></div>
                            <div class="w-col w-col-4">
                              <input class="w-input form-field list" id="password" type="text" placeholder="Nombre del Profesor" name="name">
                            </div>
                            <div class="w-col w-col-4">
              					<input style="" class="w-button button course-button" type="submit" value="Guardar" data-wait="Please wait...">
                                <a style="" class="w-button button course-button">Cancelar</a>
                            </div>
                            
                        </form>
                          </div>';
						  
                      </div>
                    </div>
                    
                    <div data-w-tab="Tab 3" class="w-tab-pane">
                    <a style="margin: 30px;" class="w-button button" id="xx" onclick="exportTableToCSV.apply(this, [$('#example1'), 'export.csv']);">Exportar CSV</a>
                     <div class="w-row course-row">
                     
                        <div class="w-col w-col-2">
                        </div>
                     <div class="w-col w-col-8">
                    	<table id="example1" border="1"  style="background-color:#FFFFCC" width="0%" cellpadding="3" cellspacing="3">

					<?php
					$count = 0;
					$currCourse = $registrations[$count]['Description'];
					$stmt = $pdo->prepare('Select labspace.SpaceID, availableSpaces-ifnull(registrations,0) as remaining, Description from (SELECT ls.SpaceId, count(Matricula) as registrations FROM `registration` r join labspace ls where r.spaceID = ls.SpaceID group by r.spaceID) as T right join labspace on  T.SpaceID = labspace.SpaceID where labspace.SpaceID = '.$registrations[$count]['spaceID'].';');
					$stmt->execute();
					$currspaces = $stmt->fetchall();

					echo '     <tr>
						
								<th>Laboratorio: <span>'.$currCourse.'</span></th>
						
								<th>Cupo: <span>'.(intval($registrations[$count]['availableSpaces'])-intval($currspaces[0]['remaining'])).'/'.$registrations[$count]['availableSpaces'].'</span></th>
						
							</tr>';
					
					while($count < sizeof($registrations)){
						if($currCourse != $registrations[$count]['Description']){
							$currCourse = $registrations[$count]['Description'];
							$stmt = $pdo->prepare('Select labspace.SpaceID, availableSpaces-ifnull(registrations,0) as remaining, Description from (SELECT ls.SpaceId, count(Matricula) as registrations FROM `registration` r join labspace ls where r.spaceID = ls.SpaceID group by r.spaceID) as T right join labspace on  T.SpaceID = labspace.SpaceID where labspace.SpaceID = '.$registrations[$count]['spaceID'].';');
							$stmt->execute();
							$currspaces = $stmt->fetchall();
		
							echo '     <tr>
						
								<th>Laboratorio: <span>'.$currCourse.'</span></th>
						
								<th>Cupo: <span>'.(intval($registrations[$count]['availableSpaces'])-intval($currspaces[0]['remaining'])).'/'.$registrations[$count]['availableSpaces'].'</span></th>
						
							</tr>';
						}
						
						echo '
						
							<tr>
						
								<td>'.$registrations[$count]['Matricula'].'</td>
						
								<td>'.$registrations[$count]['Name'].' '.$registrations[$count]['LastName'].'</td>
						
							</tr>
						';
						
						$count++;
					}
					?>
</table>
						</div>
                        <div class="w-col w-col-2">
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
  <script>
  

// This must be a hyperlink
$("#xx").on('click', function (event) {

    exportTableToCSV.apply(this, [$('#example1'), 'export.csv']);

    // IF CSV, don't do event.preventDefault() or return false
    // We actually need this to be a typical hyperlink
});
  </script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>