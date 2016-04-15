<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
if(isset($_POST['subjectname'])){
	$stmt = $pdo->prepare('INSERT INTO `subject`(`Name`) VALUES (:name)');
	$stmt->execute(array(':name' => $_POST['subjectname']));
	die("<script>location.href = 'index?success=subjectcreated'</script>");
}
else{
	die("<script>location.href = 'index?fail=createsubject'</script>");
}
?>