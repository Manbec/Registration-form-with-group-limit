<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['profid']) && isset($_POST['name'])){
	$stmt = $pdo->prepare('UPDATE `professor` SET `name`=:name WHERE `ProfessorID`=:id');
	$stmt->execute(array(':id' => $_POST['profid'], ':name' => $_POST['name']));
}
die("<script>location.href = 'index?success=profupdated'</script>");
?>