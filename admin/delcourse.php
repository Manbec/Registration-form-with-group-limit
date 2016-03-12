<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['course'])){
	$stmt = $pdo->prepare('DELETE FROM `labspace` WHERE `SpaceID`=:id');
	$stmt->execute(array(':id' => $_POST['course']));
}
die("<script>location.href = 'index?success=labdeleted'</script>");
?>