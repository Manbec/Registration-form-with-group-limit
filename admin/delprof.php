<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['profid'])){
	$stmt = $pdo->prepare('DELETE FROM `professor` WHERE `ProfessorID`=:id');
	$stmt->execute(array(':id' => $_POST['profid']));
}
die("<script>location.href = 'index?success=profdeleted'</script>");
?>