<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['course']) && isset($_POST['cupo'])){
	$stmt = $pdo->prepare('INSERT INTO `labspace`(`Description`, `availableSpaces`) VALUES (:course,:cupo)');
	$stmt->execute(array(':course' => $_POST['course'], ':cupo' => $_POST['cupo']));
}
die("<script>location.href = 'index?success=labcreated'</script>");
?>