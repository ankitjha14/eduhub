<html>
<title>Solutions</title>
<link rel="stylesheet" type="text/css" href="tabbed-panels.css">
<?php
session_start();
include("API/course_api.php");
if(!isset($_SESSION['student_id'])){
		header("location: index.html");
	}
else {
?>
		<h1 align="center">Navigus Test</h1>
		<h1 align="center"> <pre>Welcome <?php global $stu_id;
				            $stu_id = $_SESSION['student_id'];
							$gett = getstudentdetails($stu_id);
							$get = json_decode($gett);
							echo $get->name ; ?>                <a href="logout.php"><b>Logout</b></a></pre></h1>
		<?php
		  $sol_id = $_GET['sol'];
		  $url = "solutions.php?sol=".$sol_id;
			$sols = overviewofsolution($sol_id);
			$sol = json_decode($sols);
		  ?>
		  <table align="center" width="70%">
		  
		  <br><h2 align="center"> Solution Details </h2>
		  
		  <tr>
		  <td align="left"><b> Name </b></td> 
		  <td align="right"><b><?php echo $sol->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Tutorial </b></td> 
		  <td align="right"><b><a href='tutorials.php?tut=<?php echo $sol->tut_id; ?>'><?php $name_of_tut = json_decode(overviewoftutorial($sol->tut_id)); echo $name_of_tut->name; ?></a></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Student </b></td> 
		  <td align="right"><b><?php $name_of_stu = json_decode(getstudentdetails($sol->stu_id)); echo $name_of_stu->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Grades </b></td> 
		  <td align="right"><b><?php echo $sol->reviews; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Numbers of Grades </b></td> 
		  <td align="right"><b><?php echo $sol->no_of_reviews; ?></b></td>
		  </tr>
		  </table>
		  <br><br>
		  <form method = "post" action="<?php echo $url; ?>" enctype="multipart/form-data">
			<table  align="center" width="70%">
			
			<tr>
			<td>
			<?php if ($handle = opendir('files')) {
								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != ".."&&$entry==$sol->name) {
										echo "<td align='left'><br><a href='download.php?file=".$entry."'><b>Download</b></a></td></tr>";
									}
								}
								closedir($handle);
							}
							
							?>
			</td>
			<tr>
				<td align="left"><br><br><b>Give Grades</b></td>
				<td align="right"><br><br><input type="number" name="reviews" min="1" max="10" value="1"/></td>
				<td align="right"><br><br><input type="submit" name="submit" value="submit"/></td>
			</tr>
			</table>
			</form>
			<?php 
					$new_no = $sol->no_of_reviews;
					$new_no = $new_no + 1;
					$old_rev = $sol->reviews;
					solutionreview();
				?>
			
</html>
<?php } ?>