<?php
session_start();
if(!isset($_SESSION['professor_id'])){
	if(!isset($_SESSION['student_id'])){
	?>
		<html>
		</br></br>
		<h1 align="center">Navigus Test</h1>
		</br></br>
		<h3 align="center">Choose who you are?</h3>
		<a href="students.php"><img src = "images/stu.png" height="40%"  width="35%" align="left" > </a>
		<a href="professors.php"><img src = "images/pro.png" height="40%"  width="35%" align="right"></a>
		</html>
	<?php
	}
	else {
	header("location: students.php");
	}
	}
else {
	header("location: professors.php");
	}
?>

	
