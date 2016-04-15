<?php
require('../conbd.php');
if(isset($_SESSION['activeuser'])){
    $username = $_SESSION['activeuser'];
} else {
	die("<script>location.href = 'iniciar-sesion'</script>");
}
echo $_POST['course'].
		$_POST['cupo'].
		$_POST['subjectid'];
if(isset($_POST['course']) && isset($_POST['cupo']) && isset($_POST['subjectid'])){
	$stmt = $pdo->prepare('UPDATE `labspace` SET `Description`=:course,`availableSpaces`=:cupo,`CourseID`=:subjectid WHERE `SpaceID`=:id');
	$stmt->execute(array(':id' => $_POST['courseID'], ':course' => $_POST['course'], ':cupo' => $_POST['cupo'], ':subjectid' => $_POST['subjectid']));
die("<script>location.href = 'index?success=labupdated'</script>");
}
else{
	die("<script>location.href = 'index?fail=labupdated'</script>");
}
?>
