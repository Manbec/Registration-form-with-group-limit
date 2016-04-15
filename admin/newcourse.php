<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['course']) && isset($_POST['cupo']) && isset($_POST['subjectid'])){
	$stmt = $pdo->prepare('INSERT INTO `labspace`(`Description`, `availableSpaces`,`CourseID`) VALUES (:course,:cupo,:subjectid)');
	$stmt->execute(array(':course' => $_POST['course'], ':cupo' => $_POST['cupo'], ':subjectid' => $_POST['subjectid']));
}
die("<script>location.href = 'index?success=labcreated'</script>");
?>