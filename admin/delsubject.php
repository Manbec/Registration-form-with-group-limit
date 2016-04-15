<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['subjectid'])){
	$stmt = $pdo->prepare('DELETE FROM `subject` WHERE `id`=:id');
	$stmt->execute(array(':id' => $_POST['subjectid']));
}
die("<script>location.href = 'index?success=subjectdeleted'</script>");
?>