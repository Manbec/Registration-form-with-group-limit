<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['course']) && isset($_POST['cupo'])){
	$stmt = $pdo->prepare('UPDATE `labspace` SET `Description`=:course,`availableSpaces`=:cupo WHERE `SpaceID`=:id');
	$stmt->execute(array(':id' => $_POST['courseID'], ':course' => $_POST['course'], ':cupo' => $_POST['cupo']));
}
die("<script>location.href = 'index?success=labupdated'</script>");
?>