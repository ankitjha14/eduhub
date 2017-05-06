<html>
<title>Tutorials</title>
<link rel="stylesheet" type="text/css" href="tabbed-panels.css">
<?php
session_start();
include("API/course_api.php");
if(!isset($_SESSION['professor_id'])){
	if(!isset($_SESSION['student_id'])){
		header("location: index.html");
	}
	else {?>
		<h1 align="center">Navigus Test</h1>
		<h1 align="center"> <pre>Welcome <?php global $stu_id;
				            $stu_id = $_SESSION['student_id'];
							$gett = getstudentdetails($stu_id);
							$get = json_decode($gett);
							echo $get->name ; ?>                <a href="logout.php"><b>Logout</b></a></pre></h1>
		<?php
		  $tut_id = $_GET['tut'];
		  $url = "tutorials.php?tut=".$tut_id;
		  $tuts = overviewoftutorial($tut_id);
		  $tut = json_decode($tuts);
		  ?>
		  <table align="center" width="70%">
		  
		  <br><h2 align="center"> Tutorials Details </h2>
		  
		  <tr>
		  <td align="left"><b> Name </b></td> 
		  <td align="right"><b><?php echo $tut->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Professor </b></td> 
		  <td align="right"><b><?php $name_of_prof = json_decode(getprofessordetails($tut->prof)); echo $name_of_prof->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Course </b></td> 
		  <td align="right"><b><?php $name_of_prof = json_decode(overviewofcourse($tut->course)); echo $name_of_prof->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Reviews </b></td> 
		  <td align="right"><b><?php echo $tut->reviews; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Numbers of Reviews </b></td> 
		  <td align="right"><b><?php echo $tut->no_of_reviews; ?></b></td>
		  </tr>
		  </table>
		  <br><br>
		  <form method = "post" action="<?php echo $url; ?>" enctype="multipart/form-data">
			<table  align="center" width="70%">
			<tr>
				<td align="left"><b>Give Reviews</b></td>
				<td align="right"><input type="number" name="reviews" min="1" max="10" value="1"/></td>
				<td align="right"><input type="submit" name="submit" value="submit"/></td>
			</tr>
			<tr>
			<td>
			<?php if ($handle = opendir('files')) {
								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != ".."&&$entry==$tut->name) {
										echo "<td align='left'><br><a href='download.php?file=".$entry."'><b>Download</b></a></td></tr>";
									}
								}
								closedir($handle);
							}
							
							?>
			</td>
			</tr>
			</table>
			</form>
			<?php 
				$s_nor = $tut->no_of_reviews;
				$S_or = $tut->reviews;
				studentreview();
			?>
			
			<form method = "post" action="<?php echo $url; ?>" enctype="multipart/form-data">
							<table align="center">
							
							<tr>
								<td align="right"><b>Upload Tutorial Solutions :</b><b style="color:red">*</b></td>
								<td><input type="file" name="sol"/></td>
							
								<td colspan="2" align="center"><input type="submit" name="upload" value="Upload"/></td>
							</tr>
							</table>
							</form>
							<?php
							uploadtutorialsolutions();
							
							?>
							<br><h2 align="center"> Solutions </h2>
							<table style='border: 1px solid black;' bgcolor="grey" align="center" width="70%">
							<tr bgcolor="white">
							<td align='center'><b>Solutions(click on tutorials to know more)</b></td>
							<td align='center'><b>Reviews(out of 10)</b></td>
							<td align='center'><b>Total No. of Reviews</b></td>
							<td align='center'><b>Click to download</b></td>
							</tr>
							<?php
							  $sols = getallsolution($tut_id);
							  $sol = json_decode($sols);
							  foreach($sol as $value){
								  echo "<tr><td align='center'><a href='solutions.php?sol=$value->sol_id'><b>$value->name</b></a></td>
												<td align='center'><b>$value->reviews</b></td>
												<td align='center'><b>$value->no_of_reviews</b></td>";
												if ($handle = opendir('files')) {
													while (false !== ($entry = readdir($handle))) {
														if ($entry != "." && $entry != ".."&&$entry==$value->name) {
															echo "<td align='center'><a href='download.php?file=".$entry."'>Download</a></td>";
														}
													}
													closedir($handle);
									}
							  }
							  				
							  ?>
							  </table>
							
			
</html>
<?php } ?>
<?php
}
else {
?>
<h1 align="center">Navigus Test</h1>
<h1 align="center"> <pre>Welcome  <?php global $pro_id;
				            $pro_id = $_SESSION['professor_id'];
							$gett = getprofessordetails($pro_id);
							$get = json_decode($gett);
							echo $get->name; ?>              <a href="logout.php"><b>Logout</b></a></pre></h1>
		<?php
		  $tut_id = $_GET['tut'];
		  $url = "tutorials.php?tut=".$tut_id;
		  $tuts = overviewoftutorial($tut_id);
		  $tut = json_decode($tuts);
		  ?>
		  <table align="center" width="70%">
		  
		  <br><h2 align="center"> Tutorials Details </h2>
		  
		  <tr>
		  <td align="left"><b> Name </b></td> 
		  <td align="right"><b><?php echo $tut->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Professor </b></td> 
		  <td align="right"><b><?php $name_of_prof = json_decode(getprofessordetails($tut->prof)); echo $name_of_prof->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Course </b></td> 
		  <td align="right"><b><?php $name_of_prof = json_decode(overviewofcourse($tut->course)); echo $name_of_prof->name; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Reviews </b></td> 
		  <td align="right"><b><?php echo $tut->reviews; ?></b></td>
		  </tr>
		  <tr>
		  <td align="left"><b> Numbers of Reviews </b></td> 
		  <td align="right"><b><?php echo $tut->no_of_reviews; ?></b></td>
		  </tr>
		  </table>
		  <br><br>
		  <form method = "post" action="<?php echo $url; ?>" enctype="multipart/form-data">
			<table  align="center" width="70%">
			<tr>
				<td align="left"><b>Give Reviews</b></td>
				<td align="right"><input type="number" name="reviews" min="1" max="10" value="1"/></td>
				<td align="right"><input type="submit" name="submit" value="submit"/></td>
			</tr>
			<tr>
			<td>
			<?php if ($handle = opendir('files')) {
								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != ".."&&$entry==$tut->name) {
										echo "<td align='left'><br><a href='download.php?file=".$entry."'><b>Download</b></a></td></tr>";
									}
								}
								closedir($handle);
							}
							
							?>
			</td>
			</tr>
			</table>
			</form>
			<?php 
			$p_nor = $tut->no_of_reviews;
			$p_or = $tut->reviews;
			teacherreview();
				?>
			
</html>
<?php } ?>