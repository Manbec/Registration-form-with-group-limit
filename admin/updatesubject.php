<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['name'])){
	$stmt = $pdo->prepare('UPDATE `subject` SET `Name`=:name WHERE `id`=:id');
	$stmt->execute(array(':id' => $_POST['subjectID'], ':name' => $_POST['name']));
}
die("<script>location.href = 'index?success=subjectupdated'</script>");
?>