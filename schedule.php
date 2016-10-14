<?php
include('session.php');
$error=''; // Error Message
$q = intval($_GET['q']);
if (isset($_POST['submit'])) {
if (empty($_POST['time']) || empty($_POST['date']) || empty($_POST['radios'])) {
$error = "One or more fields are empty!";
}
else
{
// Define $time and $date and $radios
$time=$_POST['time'];
$date=$_POST['date'];
$radios=$_POST['radios'];
// Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
$conn = mysqli_connect("localhost", "root", "", "ehealthproject");
// echo ($time);
// echo ("<br>");
// echo ($date);
// echo ("<br>");
// echo ($q);
$sql="UPDATE command SET radiologistID=$radios, Execute_Time=\"$time\", Execute_by=\"$date\", Current_State=\"done\" WHERE commandID=$q";
if (mysqli_query($conn, $sql)) {
    echo "<script type='text/javascript'>alert('Command was scheduled successfully!');</script>";
	//header("location: dashboard.php");
} else {
    $error= "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
}
else {}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Schedule Page</title>
	<link rel="stylesheet" href="css/mainStyle.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/BeatPicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	


	<script src="js/jquery-1.11.3.min.js"></script>

	<script src="js/BeatPicker.js"></script>
	
	
</head>
<body>
	
	<!-- =============== HEADER ======================== -->
	<header>
		<div id="logo">
			<span id="heart" class="fa fa-heartbeat"></span>	
			<p id="log">HealthAPP</p>

			<div id="account">
				<span id="user" class="fa fa-user"></span>
				<p id="acc"><?php echo $actual_name; ?></p>

			</div>

			<div style="clear: both";></div>
		</div> <!-- end logo div -->
	</header>


<!-- ============= MENU ==================== -->
			
			<div id="menu">
				<ul>
					<li><a href="dashboard.php"><span id="dashicon" class="fa fa-tachometer"></span>DASHBOARD</a></li>
					<li><a href="radiologists.php"><span id="rdicon" class="fa fa-user-md"></span>RADIOLOGISTS</a></li>
					<li><a href="calendar.php"><span id="calicon" class="fa fa-calendar"></span>CALENDAR</a></li>
					<li><a href="logout.php"><span id="logouticon" class="fa fa-power-off"></span>LOG OUT</a></li>
				</ul>
			</div>

		<!-- ============ CONTENT ================= -->
	<div id="content">
		

		<!-- ===================SUB HEADER  =====================-->
		<div id="subheaderSch">
			<div id="sub-icons">
				<div id="menuBox"><span id="menu-icon" class="fa fa-bars"></span></div>
			</div>  

			<p>SCHEDULE</p>

			<div style="clear: both";></div>
		</div>  <!-- end subheader -->

		<!-- ==== ORDER INFORMATION ==== -->

		<div id="comm_infoSch">
			<p id="comm_titleSch">ORDER INFORMATION</p>
			<div id="informationSch">
	<?php
		$q = intval($_GET['q']);

		$con = mysqli_connect('localhost','root','','ehealthproject');
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		$sql="SELECT * FROM command WHERE commandID='".$q."'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		if($row['Current_State']=="pending"){
			if($row['Emergency_State']=="no"){
				echo	("<p class=\"norm_color\">RADIOLOGICAL EXAM: <span class=\"inf\">".$row['Type']."</span></p>");
				echo 	("<p class=\"norm_color\">ID: <span class=\"inf\">$q</span></p>");
				echo 	("<p class=\"norm_color\">REASON: <span class=\"inf\">".$row['Reason']."</span></p>");
				echo 	("<p class=\"norm_color\">DATE OF ORDER: <span class=\"inf\">".$row['Issued']."</span></p>");
				echo 	("<p class=\"norm_color\">ISSUED BY: <span class=\"inf\">".$row['Issued_by']."</span></p>");
				echo 	("<p class=\"norm_color\">RECOMMENED DATE: <span class=\"inf\">".$row['Recommended']."</span></p>");
				echo 	("<p class=\"norm_color\">EMERGENCY: <span class=\"inf\">Low priority</span></p>");
				echo	("<p class=\"norm_color\">SCHEDULED DATE: <span class=\"inf\">PENDING</span></p>");
		
			//	echo 	("<a href=\"schedule.php?q=$q\"><button id=\"sch_btn\" type=\"button\">SCHEDULE</button></a>");
			}
			else {
				echo	("<p class=\"norm_color\">RADIOLOGICAL EXAM: <span class=\"inf\">".$row['Type']."</span></p>");
				echo 	("<p class=\"norm_color\">ID: <span class=\"inf\">$q</span></p>");
				echo 	("<p class=\"norm_color\">REASON: <span class=\"inf\">".$row['Reason']."</span></p>");
				echo 	("<p class=\"norm_color\">DATE OF ORDER: <span class=\"inf\">".$row['Issued']."</span></p>");
				echo 	("<p class=\"norm_color\">ISSUED BY: <span class=\"inf\">".$row['Issued_by']."</span></p>");
				echo 	("<p class=\"norm_color\">RECOMMENED DATE: <span class=\"inf\">".$row['Recommended']."</span></p>");
				echo 	("<p class=\"norm_color\">EMERGENCY: <span class=\"inf\">High priority</span></p>");
				echo	("<p class=\"norm_color\">SCHEDULED DATE: <span class=\"inf\">PENDING</span></p>");
				
			//	echo 	("<a href=\"schedule.php?q=$q\"><button id=\"sch_btn\" type=\"button\">SCHEDULE</button></a>");
			}
		}
		else{
		
		echo	("<p class=\"norm_color\">RADIOLOGICAL EXAM: <span class=\"inf\">".$row['Type']."</span></p>");
		echo 	("<p class=\"norm_color\">ID: <span class=\"inf\">$q</span></p>");
		echo 	("<p class=\"norm_color\">REASON: <span class=\"inf\">".$row['Reason']."</span></p>");
		echo 	("<p class=\"norm_color\">DATE OF ORDER: <span class=\"inf\">".$row['Issued']."</span></p>");
		echo 	("<p class=\"norm_color\">ISSUED BY: <span class=\"inf\">".$row['Issued_by']."</span></p>");
		echo 	("<p class=\"norm_color\">RECOMMENED DATE: <span class=\"inf\">".$row['Recommended']."</span></p>");
		//echo 	("<p class=\"norm_color\">EMERGENCY: <span class=\"inf\">High priority</span></p>");
		echo	("<p class=\"norm_color\">SCHEDULED DATE: <span class=\"inf\">".$row['Execute_by']."</span></p>");
		echo	("<p class=\"norm_color\">SCHEDULED TIME: <span class=\"inf\">".$row['Execute_Time']."</span></p>");
			
			
		} 
		mysqli_close($con);
	?>		

<!-- 
			
				<p class="norm_color">RADIOLOGICAL EXAM: <span class="inf">X-Rays</span></p>
				<p class="norm_color">ID: <span class="inf">001</span></p>
				<p class="norm_color">REASON: <span class="inf">Checkup</span></p>
				<p class="norm_color">DATE OF ORDER: <span class="inf">04/03/2015</span></p>
				<p class="norm_color">RECOMMENDED DATE: <span class="inf">10/05/2015</span></p>
				<p class="norm_color">PRIORITY: <span class="inf">Low priority</span></p>
				<p class="norm_color">SCHEDULED DATE: <span class="inf">PENDING</span></p>

			
 -->
			</div> 
		</div> <!-- end order information --> 


		
		<!--============== PATIENT INFORMATION ============== -->
		<div id="comm_infoPat">
			<p id="comm_titlePat">PATIENT INFORMATION</p>

			<div id="informationPat">
	<?php
		$q = intval($_GET['q']);

		$con = mysqli_connect('localhost','root','','ehealthproject');
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		$sql="select patient.* from patient,command where command.commandID='".$q."' AND patient.patientID=command.patientID";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result); 
		
			echo	("<p class=\"norm_color\">SSN: <span class=\"inf\">".$row['SSN']."</span></p>");
			echo	("<p class=\"norm_color\">ID: <span class=\"inf\">".$row['patientID']."</span></p>");
			echo	("<p class=\"norm_color\">FIRST NAME: <span class=\"inf\">".$row['pName']."</span></p>");
			echo	("<p class=\"norm_color\">LAST NAME: <span class=\"inf\">".$row['pSurname']."</span></p>");
			echo	("<p class=\"norm_color\">FATHER'S NAME: <span class=\"inf\">".$row['Father_name']."</span></p>");
			echo	("<p class=\"norm_color\">MOTHER'S NAME: <span class=\"inf\">".$row['Mother_name']."</span></p>");
			if($row['Sex']==0) {
				echo	("<p class=\"norm_color\">SEX: <span class=\"inf\">Male</span></p>");
			}
			else {
				echo	("<p class=\"norm_color\">SEX: <span class=\"inf\">Female</span></p>");
			}
			echo	("<p class=\"norm_color\">DATE OF BIRTH: <span class=\"inf\">".$row['Date_of_birth']."</span></p>");
			echo	("<p class=\"norm_color\">ADDRESS: <span class=\"inf\">".$row['Address']."</span></p>");
			echo	("<p class=\"norm_color\">HOME PHONE: <span class=\"inf\">".$row['Home_phone']."</span></p>");
			echo	("<p class=\"norm_color\">JOB PHONE: <span class=\"inf\">".$row['Work_phone']."</span></p>");
			echo	("<p class=\"norm_color\">MOBILE PHONE: <span class=\"inf\">".$row['Cell_phone']."</span></p>");
		mysqli_close($con);
		?>
<!-- 
				<p class="norm_color">SSN: <span class="inf">0123456</span></p>
				<p class="norm_color">ID: <span class="inf">001</span></p>
				<p class="norm_color">FIRST NAME: <span class="inf">John</span></p>
				<p class="norm_color">LAST NAME: <span class="inf">Smith</span></p>
				<p class="norm_color">FATHER'S NAME: <span class="inf">Alex</span></p>
				<p class="norm_color">MOTHER'S NAME: <span class="inf">Christina</span></p>
				<p class="norm_color">SEX: <span class="inf">Male</span></p>
				<p class="norm_color">DATE OF BIRTH: <span class="inf">20/05/1964</span></p>
				<p class="norm_color">ADDRESS: <span class="inf">Virginia Street 20</span></p>
				<p class="norm_color">HOME PHONE: <span class="inf">210-1090435</span></p>
				<p class="norm_color">JOB PHONE: <span class="inf">210-0987980</span></p>
				<p class="norm_color">MOBILE PHONE: <span class="inf">6903465214</span></p>
 -->
				<br>
			</div> 

		</div> <!-- end commands information --> 

		<div style="clear: both";></div>
		
		<form method="POST" action="">
		<div id="av_radiologists">
			<p id="radio_title">AVAILABLE RADIOLOGISTS</p>

			<div id="radiolist">

			
			<?php

				$con = mysqli_connect('localhost','root','','ehealthproject');
				if (!$con) {
					die('Could not connect: ' . mysqli_error($con));
				}
				$sql="select * from radiologist";
				$result = mysqli_query($con,$sql); 
				$counter = 0;
				while($row = mysqli_fetch_array($result)) {
					echo("<div class=\"radiologist\">");
					$counter = $counter + 1;
					echo("<input id=\"radio_btn$counter\" type=\"radio\" name=\"radios\" value=\"".$row['radiologistID']."\">");
					echo("<label for=\"radio_btn$counter\"></label>");
					echo("<p id=\"nameRd\"><span class=\"norm_color\">".$row['rName']." ".$row['rSurname']."</span></p>");

					echo("<div style=\"clear: both\";></div>");

					echo("<p id=\"IDRd\"><span class=\"norm_color\">ID:</span> 00".$row['radiologistID']."</p>");
					$res = mysqli_query($con, "select COUNT(*) from command where radiologistID=".$row['radiologistID']."");
					$rw = mysqli_fetch_array($res);
					echo("<p id=\"jobs\">jobs: <span class=\"norm_color\">".$rw[0]."</span></p>");
					echo("<span id=\"rd_icon\" class=\"fa fa-user-md\"></span>");

					echo("</div>");
					
					echo("<div style=\"clear: both\";></div>");
					
				}
				mysqli_close($con);
			?>
				
				<!-- 
<div class="radiologist">
					
					<input id="radio_btn" type="radio" name="radios">
					<label for="radio_btn"></label>
					<p id="nameRd"><span class="norm_color">Chris Boss</span></p>

					<div style="clear: both";></div>

					<p id="IDRd"><span class="norm_color">ID:</span> 002</p>
					<p id="jobs">jobs: <span class="norm_color">5</span></p>
				<span id="rd_icon" class="fa fa-user-md"></span>


				</div>   
				
				<div style="clear: both";></div>

				<div class="radiologist">
					
					<input id="radio_btn2" type="radio" name="radios">
					<label for="radio_btn2"></label>
					<p id="nameRd"><span class="norm_color">Jane Doe</span></p>

					<div style="clear: both";></div>

					<p id="IDRd"><span class="norm_color">ID:</span> 002</p>
					<p id="jobs">jobs: <span class="norm_color">7</span></p>
				<span id="rd_icon" class="fa fa-user-md"></span>


				</div>   
				
				<div style="clear: both";></div>
				
				<div class="radiologist">
					
					<input id="radio_btn3" type="radio" name="radios">
					<label for="radio_btn3"></label>
					<p id="nameRd"><span class="norm_color">Donald Trump</span></p>

					<div style="clear: both";></div>

					<p id="IDRd"><span class="norm_color">ID:</span> 003</p>
					<p id="jobs">jobs: <span class="norm_color">10</span></p>
				<span id="rd_icon" class="fa fa-user-md"></span>


				</div>   
				
				<div style="clear: both";></div>
				
				<div class="radiologist">
					
					<input id="radio_btn4" type="radio" name="radios">
					<label for="radio_btn4"></label>
					<p id="nameRd"><span class="norm_color">Brian Tracy</span></p>

					<div style="clear: both";></div>

					<p id="IDRd"><span class="norm_color">ID:</span> 005</p>
					<p id="jobs">jobs: <span class="norm_color">11</span></p>
				<span id="rd_icon" class="fa fa-user-md"></span>


				</div>   
				
				<div style="clear: both";></div>

				<div class="radiologist">
					
					<input id="radio_btn5" type="radio" name="radios">
					<label for="radio_btn5"></label>
					<p id="nameRd"><span class="norm_color">John Lame</span></p>

					<div style="clear: both";></div>

					<p id="IDRd"><span class="norm_color">ID:</span>006</p>
					<p id="jobs">jobs: <span class="norm_color">12</span></p>
				<span id="rd_icon" class="fa fa-user-md"></span>



				</div>   
				
				<div style="clear: both";></div> -->

			</div> <!--end radiolist -->

		</div> <!-- end av radiologists -->

	
		
		
		<!-- Schedule section -->

		<div id="schedule">
			<p id="sch_title">SCHEDULE DATE &amp; TIME</p>
			<div id="inputSch">

				
					<div id="iconBoxS">
						<span id="calIcon" class="fa fa-calendar-o"></span>
					</div>
					
							<!-- ===================== START CHANGE ====================================-->


						<input  name="date" type="date" data-beatpicker="true" data-beatpicker-module="clear,icon,footer" placeholder="PICK A DATE">
					
						<!-- CLEAR -->
						<div style="clear: both";></div>


						<!-- Time Input -->

					<div id="iconBoxS">
						<span id="clockIcon" class="fa fa-clock-o"></span>
					</div>

					<input name="time" type="text" id="clock" placeholder="PICK AN HOUR">
					


					<!-- ============================= END CHANGE =============================== -->


						<!-- CLEAR -->
						<div style="clear: both";></div>

					<button id="sch_btn" type="submit" name="submit">SCHEDULE</button>
				<p style="color:red;"><?php echo ($error); ?></p> 
			</div>
		</div>
</form>
		



		<div style="clear: both";></div>

	</div> <!-- END CONTENT -->
	
	<!-- ===================== FOOTER ======================== -->

	<footer>
		<p>Copyright &copy; all rights reserved 2015</p>
	</footer>


<script src="js/jquery.timepicker.js"></script>

	<!-- JQUERY SCRIPT -->
	<script>
		$(function(){

		//menu
	$("#menu-icon").click(function() {
	  $("#menu").toggleClass("active");
		});

	$("#menu-icon").click(function() {
	  $("#trigger").toggleClass("active");
		});

	$('#clock').timepicker();

	


	});
	</script>
</body>
</html>