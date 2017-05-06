<html>
<title>student</title>
<link rel="stylesheet" type="text/css" href="tabbed-panels.css">
</html>
<?php
session_start();
include("API/student_api.php");
if(!isset($_SESSION['student_id'])){
?>
<html>
</br></br>
<h1 align="center">Navigus Test</h1>
</br></br>
<h3 align="center">Log In</h3>
<form method = "post" action="students.php" enctype="multipart/form-data">
<table style='border: 1px solid black;' bgcolor="skyblue" align="center">
<tr>
	<td align="right"><b>Username</b></td>
	<td><input type="text" name="username" size="50"/></td>
</tr>
<tr>
	<td align="right"><b>Password</b></td>
	<td><input type="password" name="password" size="50"/></td>
</tr>
</tr>
	<td colspan="2" align="center"><input type="submit" name="student" value="Login as a Student"/></td>
</tr>
</table>
</form>

</br>
<h3 align="center">Register</h3>
<form method = "post" action="students.php" enctype="multipart/form-data">
<table style='border: 1px solid black;' bgcolor="grey" align="center">
<tr>
	<td align="right"><b>Name</b></td>
	<td><input type="text" name="name" size="50"/></td>
</tr>
<tr>
	<td align="right"><b>Username</b></td>
	<td><input type="text" name="user" size="50"/></td>
</tr>
<tr>
	<td align="right"><b>Password</b></td>
	<td><input type="password" name="pass" size="50"/></td>
</tr>
</tr>
	<td colspan="2" align="center"><input type="submit" name="student_reg" value="Register as a Student"/></td>
</tr>
</table>
</form>

</html>
<?php
login();
signup();
}
else{ 

?>
<html>
<body bgcolor="skyblue">
</br>
<h1 align="center">Navigus Test</h1>
<h1 align="center"> <pre>Welcome  <?php global $stu_id;
				            $stu_id = $_SESSION['student_id'];
							$gett = getstudentdetails($stu_id);
							$get = json_decode($gett);
							echo $get->name ; ?>              <a href="logout.php"><b>Logout</b></a></pre></h1>
							<?php 
							if($get->roll=='' OR $get->picture=='' OR $get->year==0 OR $get->branch=='' OR $get->sem==0)
							{
							?>
							</html>
							<form method = "post" action="students.php" enctype="multipart/form-data">
							<table style='border: 1px solid black;' bgcolor="skyblue" align="center">
							<tr>
								<td align="right"><b>Roll Number</b></td>
								<td><input type="text" name="roll" size="50"/></td>
							</tr>
							<tr>
								<td align="right"><b>Year</b><b style="color:red">*</b></td>
								<td><input type="number" name="year" min="1" max="4" value="1"/></td>
							</tr>
							<tr>
								<td align="right"><b>Branch</b></td>
								<td><select name="branch">
								<?php 
								$gett = getbranch();
								$get = json_decode($gett);
							    foreach ($get as $value){
								echo "<option value='$value->branch_name'>$value->branch_name</option>";	
								}?>
								</select></td>
							</tr>
							<tr>
								<td align="right"><b>Sem</b></td>
								<td><input type="number" name="sem" min="1" max="8" value="1"/></td>
							</tr>
							<tr>
								<td align="right"><b>Email</b></td>
								<td><input type="email" name="email" size="50"/></td>
							</tr>
							<tr>
								<td align="right"><b>Phone</b></td>
								<td><input type="text" name="phone" size="50"/></td>
							</tr>

							
							<tr>
								<td align="right"><b>Upload Picture :</b><b style="color:red">*</b></td>
								<td><input type="file" name="picture"/></td>
							</tr>
							</tr>
								<td colspan="2" align="center"><input type="submit" name="update" value="Update Profile"/></td>
							</tr>
							</table>
							</form>
							</html>
							<?php	
							
							
							update_profile();

							
							}
							
					else
						{
							$gett =  getstudentdetails($stu_id);
							$getu = json_decode($gett);
							
							?>
							
							<table style='border: 1px solid black;' bgcolor="skyblue" align="center" width="70%">
							<tr>
							<td width="50%">
							<img src = "images/stu_pictures/<?php echo $getu->picture; ?>" height = "40%" width = "80%">
							</td>
							<td width="50%">
							
							<table bgcolor="skyblue" align="center" height="100%" width="100%">
							<tr>
								<td align="center"><b>Name</b></td>
								<td><b><?php echo $getu->name; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Roll Number</b></td>
								<td><b><?php echo $getu->roll; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Branch</b></td>
								<td><b><?php echo $getu->branch; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Year</b></td>
								<td><b><?php echo $getu->year; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Sem</b></td>
								<td><b><?php echo $getu->sem; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Email</b></td>
								<td><b><?php echo $getu->email; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Phone</b></td>
								<td><b><?php echo $getu->phone; ?></b></td>
							</tr>
							</table>
							</td>
							</tr>
							</table>
							
							
							
							<table style='border: 1px solid black;' bgcolor="skyblue" align="center" width="70%">
							<tr>
								<td align="center"><b>List of Course in which you are enrolled :</b></td>
							</tr>
							<?php 
							
							
							    $course_list = getlistofcourse($getu->sem,$getu->branch);
								$out = json_decode($course_list);
								//$list = array();
								foreach ($out as $value)
								{
									$name=$value->name;
									$c_id=$value->c_id;
									echo "<tr>
												<td align='center'><a href = 'course.php?course=$c_id'><b>$name</b></a></td>
												</tr>";
									echo "<br>";
								}
							?>
							</table>
						<?php } ?>	
</html>
<?php } ?>