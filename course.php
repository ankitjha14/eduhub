<html>
<title>Course</title>
<link rel="stylesheet" type="text/css" href="tabbed-panels.css">
<?php
session_start();
include("API/course_api.php");
if(!isset($_SESSION['professor_id'])){
	if(!isset($_SESSION['student_id'])){
		header("location: index.html");
	}
	else {
	?>
	<h1 align="center">Navigus Test</h1>
<h1 align="center"> <pre>Welcome  <?php global $stu_id;
				            $stu_id = $_SESSION['student_id'];
							$gett = getstudentdetails($stu_id);
							$get = json_decode($gett);
							echo $get->name; ?>              <a href="logout.php"><b>Logout</b></a></pre></h1>
<body>
    <div class="tabbed">
      <input name="tabbed" id="tabbed1" type="radio" checked>
      <section>
        <h1>
          <label for="tabbed1">Overview Of Course</label>
        </h1>
        <div>
		  <?php
		  $course_id = $_GET['course'];
		  $url = "course.php?course=".$course_id;
		  $details = overviewofcourse($course_id);
		  $det = json_decode($details);
		  ?>
		  <pre> <h2> Name : <?php echo $det->name; ?></h2></pre>
		  <pre> <h2> Assigned Professor : <?php $name_of_prof = json_decode(getprofessordetails($det->prof)); echo $name_of_prof->name; ?></h2></pre>
		  <pre> <h2> Description : <?php echo $det->description; ?></h2></pre>
		  <pre> <h2> Recommended Books : <?php echo $det->rec_books; ?></h2></pre>
		  
		  
        </div>
      </section>
      <input name="tabbed" id="tabbed2" type="radio">
      <section>
        <h1>
          <label for="tabbed2">Lecture Slides</label>
        </h1>
        <div>
		<h3 align="center">Lecture Slides</h3>
		<table style='border: 1px solid black;' bgcolor="grey" align="center" width="50%">
			<tr bgcolor="white">
				<td align='center'><b>Lecture</b></td>
				<td align='center'><b>Click to download</b></td>
			</tr>				
		<?php
		$slides = getlectureslide($course_id);
		$slide = json_decode($slides);
		  foreach ($slide as $value)
		  {
			  echo "<tr><td align='center'><b>$value->name</b></td>";
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
		</div>
      </section>
      <input name="tabbed" id="tabbed3" type="radio">
      <section>
        <h1>
          <label for="tabbed3">Tutorials</label>
        </h1>
        <div>
		<h3 align="center">Tutorials</h3>
							<table style='border: 1px solid black;' bgcolor="grey" align="center" width="50%">
							<tr bgcolor="white">
							<td align='center'><b>Tutorials(click on tutorials to know more)</b></td>
							<td align='center'><b>Reviews(out of 10)</b></td>
							<td align='center'><b>Total No. of Reviews</b></td>
							<td align='center'><b>Click to download</b></td>
							</tr>
		<?php
		$tuts = gettutorials($course_id);
		$tut = json_decode($tuts);
		  foreach ($tut as $value)
		  {
			  echo "<tr><td align='center'><a href='tutorials.php?tut=$value->tut_id'><b>$value->name</b></a></td>
							<td align='center'><b>$value->reviews</b></td>
							<td align='center'><b>$value->no_of_reviews</b></td>";
							if ($handle = opendir('files')) {
								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != ".."&&$entry==$value->name) {
										echo "<td align='center'><a href='download.php?file=".$entry."'>Download</a></td></tr>";
									}
								}
								closedir($handle);
							}
		  }				
		  ?>
		  </table>
        </div>
      </section>
    
    </div>
  </body>
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
							echo $get->name;?>              <a href="logout.php"><b>Logout</b></a></pre></h1>
<body>
    <div class="tabbed">
      <input name="tabbed" id="tabbed1" type="radio" checked>
      <section>
        <h1>
          <label for="tabbed1">Overview Of Course</label>
        </h1>
        <div>
		  <?php
		  $course_id = $_GET['course'];
		  $url = "course.php?course=".$course_id;
		  $details = overviewofcourse($course_id);
		  $det = json_decode($details);
		  ?>
		  <pre> <h2> Name : <?php echo $det->name; ?></h2></pre>
		  <pre> <h2> Assigned Professor : <?php $name_of_prof = json_decode(getprofessordetails($det->prof)); echo $name_of_prof->name; ?></h2></pre>
		  <pre> <h2> Description : <?php echo $det->description; ?></h2></pre>
		  <pre> <h2> Recommended Books : <?php echo $det->rec_books; ?></h2></pre>
		  
		  
        </div>
      </section>
      <input name="tabbed" id="tabbed2" type="radio">
      <section>
        <h1>
          <label for="tabbed2">Lecture Slides</label>
        </h1>
        <div>
          <h3 align="center">Lecture Slides</h3>
		  <form method = "post" action="<?php echo $url; ?>" enctype="multipart/form-data">
							<table align="center">
							
							<tr>
								<td align="right"><b>Upload Lecture Slide :</b><b style="color:red">*</b></td>
								<td><input type="file" name="slide"/></td>
							
								<td colspan="2" align="center"><input type="submit" name="upload" value="Upload"/></td>
							</tr>
							</table>
							</form>
							<?php
							uploadslide();
							?>
							<table style='border: 1px solid black;' bgcolor="grey" align="center" width="50%">
							<tr bgcolor="white">
							<td align='center'><b>Lecture</b></td>
							<td align='center'><b>Click to download</b></td>
							</tr>
		<?php
		$slides = getlectureslide($course_id);
		$slide = json_decode($slides);
		  foreach ($slide as $value)
		  {
			  echo "<tr><td align='center'><b>$value->name</b></td>";
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
		</div>
      </section>
      <input name="tabbed" id="tabbed3" type="radio">
      <section>
        <h1>
          <label for="tabbed3">Tutorials</label>
        </h1>
        <div>
		<h3 align="center">Tutorials</h3>
           <form method = "post" action="<?php echo $url; ?>" enctype="multipart/form-data">
							<table align="center">
							
							<tr>
								<td align="right"><b>Upload Tutorials :</b><b style="color:red">*</b></td>
								<td><input type="file" name="tutorial"/></td>
							
								<td colspan="2" align="center"><input type="submit" name="upload_tutorial" value="Upload"/></td>
							</tr>
							</table>
							</form>
							<?php
							uploadtutorial();
							
							?>
							<table style='border: 1px solid black;' bgcolor="grey" align="center" width="50%">
							<tr bgcolor="white">
							<td align='center'><b>Tutorials(click on tutorials to know more)</b></td>
							<td align='center'><b>Reviews(out of 10)</b></td>
							<td align='center'><b>Total No. of Reviews</b></td>
							<td align='center'><b>Click to download</b></td>
							</tr>
		<?php
		$tuts = gettutorials($course_id);
		$tut = json_decode($tuts);
		  foreach ($tut as $value)
		  {
			  echo "<tr><td align='center'><a href='tutorials.php?tut=$value->tut_id'><b>$value->name</b></a></td>
							<td align='center'><b>$value->reviews</b></td>
							<td align='center'><b>$value->no_of_reviews</b></td>";
							if ($handle = opendir('files')) {
								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != ".."&&$entry==$value->name) {
										echo "<td align='center'><a href='download.php?file=".$entry."'>Download</a></td></tr>";
									}
								}
								closedir($handle);
							}
		  }				
		  ?>
		  </table>
        </div>
      </section>
	  <input name="tabbed" id="tabbed4" type="radio">
	  <section>
        <h1>
          <label for="tabbed4">List of Students Enrolled</label>
        </h1>
        <div>
		<table style='border: 1px solid black;' bgcolor="grey" align="center" width="50%">
							<tr bgcolor="white">
							<td align='center'><b>Name</b></td>
							<td align='center'><b>Roll Number</b></td>
							<td align='center'><b>Branch</b></td>
							</tr>
		<?php
		  $students = getlistofstudentenrolled($course_id);
			$stu = json_decode($students);
			foreach ($stu as $value)
			{
				echo "<tr><td align='center'><b>$value->name</b></td>
					<td align='center'><b>$value->roll</b></td>
					<td align='center'><b>$value->branch</b></td></tr>";
			}
		  ?>
		  </table>
		</div>
      </section>
    
    </div>
  </body>
</html>
<?php } ?>