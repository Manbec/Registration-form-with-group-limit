<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['name']) && isset($_POST['subjectalias'])){
	$stmt = $pdo->prepare('UPDATE `subject` SET `Name`=:name, `Alias`=:alias WHERE `id`=:id');
	$stmt->execute(array(':id' => $_POST['subjectID'], ':name' => $_POST['name'], ':alias' => $_POST['subjectalias']));
}
die("<script>location.href = 'index?success=subjectupdated'</script>");
?>