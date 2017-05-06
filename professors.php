<html>
<title>Professors</title>
<link rel="stylesheet" type="text/css" href="tabbed-panels.css">
</html>
<?php
session_start();
include("API/professor_api.php");
if(!isset($_SESSION['professor_id'])){
?>
<html>
</br></br>
<h1 align="center">Navigus Test</h1>
</br></br>
<h3 align="center">Log In</h3>
<form method = "post" action="professors.php" enctype="multipart/form-data">
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
	<td colspan="2" align="center"><input type="submit" name="professor" value="Login as a Professor"/></td>
</tr>
</table>
</form>



</html>
<?php
login();
}
else{ 
?>
<html>
<body bgcolor="grey">
</br>
<h1 align="center">Navigus Test</h1>
<h1 align="center"> <pre>Welcome  <?php global $pro_id;
				            $pro_id = $_SESSION['professor_id'];
							$gett = getprofessordetails($pro_id);
							$get = json_decode($gett);
							echo $get->name; ?>              <a href="logout.php"><b>Logout</b></a></pre></h1>
							<?php 
							if($get->designation=='' OR $get->dept=='' OR $get->email=='' OR $get->phone=='')
							{
							?>
							<form method = "post" action="professors.php" enctype="multipart/form-data">
							<table style='border: 1px solid black;' bgcolor="grey" align="center">
							<tr>
								<td align="right"><b>Designation</b></td>
								<td><select name="designation">
									<option value='Associate Professor'>Associate Professor</option>
									<option value='Professor'>Professor</option>
									<option value='Assistant Professor'>Assistant Professor</option>
									<option value='Head of Dept.'>Head of Dept.</option>
									<option value='Director'>Director</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right"><b>Department</b></td>
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
							<?php	
							update_profile();
						}
							
							else{
							$gett = getprofessordetails($pro_id);
							$get = json_decode($gett);
							?>
							<table style='border: 1px solid black;' bgcolor="skyblue" align="center" height="100%" width="70%">
							<tr>
							<td width="50%">
							<img src = "images/stu_pictures/<?php echo $get->picture; ?>" height = "40%" width = "80%">
							</td>
							<td width="50%">
							
							<table bgcolor="skyblue" align="center" height="40%" width="100%">
							<tr>
								<td align="center"><b>Name</b></td>
								<td><b><?php echo $get->name; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Designation</b></td>
								<td><b><?php echo $get->designation; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Department</b></td>
								<td><b><?php echo $get->dept; ?></b></td>
							</tr>
								<td align="center"><b>Email</b></td>
								<td><b><?php echo $get->email; ?></b></td>
							</tr>
							<tr>
								<td align="center"><b>Phone</b></td>
								<td><b><?php echo $get->phone; ?></b></td>
							</tr>
							
							<tr>
								<td align="center"><b>list of courses taught</b></td>
							
							<td>
							<?php
							$courses = getprofessorcourse($get->pro_id);
							$course = json_decode($courses);
							foreach ($course as $value)
							{
								echo "<a href = 'course.php?course=$value->c_id'><b align='center'> -> $value->name</b></br></a>";
							}
							?>
							</tr>
							</table>
							</td>
							</tr>
							</table>
							<?php } ?>
							
</html>
<?php } ?>