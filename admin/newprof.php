<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['name'])){
	$stmt = $pdo->prepare('INSERT INTO `professor`(`name`) VALUES (:profname)');
	$stmt->execute(array(':profname' => $_POST['name']));
}
die("<script>location.href = 'index?success=profcreated'</script>");
?>