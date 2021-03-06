﻿<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Radiologists</title>
	<link rel="stylesheet" href="css/mainStyle.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/simplecalendar.js"></script>
	<script> 
		function refreshCal(radiologistID){
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("calList").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getCalInfo.php?q="+radiologistID,true);
        xmlhttp.send();
		}
	</script>
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
					<li><a href="#" class="activeLi"><span id="rdicon" class="fa fa-user-md"></span>RADIOLOGISTS</a></li>
					<li><a href="calendar.php"><span id="calicon" class="fa fa-calendar"></span>CALENDAR</a></li>
					<li><a href="logout.php"><span id="logouticon" class="fa fa-power-off"></span>LOG OUT</a></li>
				</ul>
			</div>

	<!-- ==================== CONTENT ====================== -->

	<div id="content">
		
		<!-- ===================SUB HEADER  =====================-->
		<div id="subheaderRd">
			<div id="sub-icons">
				<div id="menuBox"><span id="menu-icon" class="fa fa-bars"></span></div>
			</div>  

			<p>RADIOLOGISTS</p>

			<div style="clear: both";></div>
		</div>  <!-- end subheader -->

		<p id="med_title">RADIOLOGISTS</p>
		<p id="cal_title">CALENDAR</p>
		<div style="clear: both";></div>

		<div id="med_list">
		
		<?php

				$con = mysqli_connect('localhost','root','','ehealthproject');
				if (!$con) {
					die('Could not connect: ' . mysqli_error($con));
				}
				$sql="select * from radiologist";
				$result = mysqli_query($con,$sql); 

				while($row = mysqli_fetch_array($result)) {
					echo("<div id=\"med_box\" onclick=\"refreshCal(".$row['radiologistID'].")\">");
					echo("<p id=\"med_name\"><span class=\"norm_color\">".$row['rName']." ".$row['rSurname']."</span></p>");
					echo("<p id=\"med_ID\"><span class=\"norm_color\">ID:</span> 00".$row['radiologistID']."</p>");
					$res = mysqli_query($con, "select COUNT(*) from command where radiologistID=".$row['radiologistID']."");
					$rw = mysqli_fetch_array($res);
					echo("<p id=\"med_job\">jobs: <span class=\"norm_color\">".$rw[0]."</span></p>");
					echo("<span id=\"med_icon\" class=\"fa fa-user-md\"></span>");

					echo("</div>");
									
				}
				mysqli_close($con);
			?>
<!--			 <div id="med_box">
				<p id="med_name"><span class="norm_color">Chris Boss</span></p>
				<p id="med_ID"><span class="norm_color">ID:</span>001</p>
				<p id="med_job">jobs: <span class="norm_color">3 </span></p>
				<span id="med_icon" class="fa fa-user-md"></span>
			</div> 

			<div id="med_box">
				<p id="med_name"><span class="norm_color">Chris Boss</span></p>
				<p id="med_ID"><span class="norm_color">ID:</span>001</p>
				<p id="med_job">jobs: <span class="norm_color">3 </span></p>
				<span id="med_icon" class="fa fa-user-md"></span>
			</div> 

			<div id="med_box">
				<p id="med_name"><span class="norm_color">Chris Boss</span></p>
				<p id="med_ID"><span class="norm_color">ID:</span>001</p>
				<p id="med_job">jobs: <span class="norm_color">3 </span></p>
				<span id="med_icon" class="fa fa-user-md"></span>
			</div> 

			<div id="med_box">
				<p id="med_name"><span class="norm_color">Chris Boss</span></p>
				<p id="med_ID"><span class="norm_color">ID:</span>001</p>
				<p id="med_job">jobs: <span class="norm_color">3 </span></p>
				<span id="med_icon" class="fa fa-user-md"></span>
			</div> -->

		</div> <!-- end medlist -->
		

		<!-- Calendar -->


		<div id="wrap_cal">
			<div class="calendar hidden-print">
						<div class="ajaxWorkaround">
								<header>
									<h2 class="month"></h2>
									<a class="btn-prev fa fa-angle-left" href="#"></a>
									<a class="btn-next fa fa-angle-right" href="#"></a>
								</header>
								<table>
									<thead class="event-days">
										<tr></tr>
									</thead>
									<tbody class="event-calendar">
										<tr class="1"></tr>
										<tr class="2"></tr>
										<tr class="3"></tr>
										<tr class="4"></tr>
										<tr class="5"></tr>
									</tbody>
								</table>
						</div>
								<div id="calList" class="list">
									<!-- <div class="day-event" date-month="5" date-day="4" data-number="1">
										<h2 class="title">Niar</h2>
										<p class="date">ΜΙΑΡ</p>
										<p>Appointments: Niar niar niar</p>
										
									</div>
									<div class="day-event" date-month="3" date-day="13" data-number="1">
										<h2 class="title">ΝΙΑΡ</h2>
										<p class="date">2014-12-13</p>
										<p>ΝΙΑΡ</p>
										
									</div>
									<div class="day-event" date-month="3" date-day="13" data-number="2">
										<h2 class="title">Lorem ipsum 2</h2>
										<p class="date">2014-12-13</p>
										<p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok.</p>
										
									</div>
									<div class="day-event" date-month="3" date-day="14" data-number="1">
										<h2 class="title">Lorem ipsum 3</h2>
										<p class="date">2014-12-14</p>
										<p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok.</p>
										
									</div>
									<div class="day-event" date-month="3" date-day="16" data-number="1">
										<h2 class="title">Lorem ipsum 4</h2>
										<p class="date">2014-12-16</p>
										<p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok.</p>
										
									</div>
									<div class="day-event" date-month="3" date-day="24" data-number="1">
										<h2 class="title">Lorem ipsum 5</h2>
										<p class="date">2014-12-24</p>
										<p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok.</p>
										
									</div>
									<div class="day-event" date-month="3" date-day="31" data-number="1">
										<h2 class="title">Lorem ipsum 6</h2>
										<p class="date">2014-12-31</p>
										<p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok.</p>
										
									</div> -->
								</div>
							</div>

	</div> <!-- end wrap cal --> 
		
		
		
		<div style="clear: both";></div>

		<!-- calendar -->
		
	<!-- <table class="calendar">
		  <thead>
		    <tr>
		      <td>MON</td>
		      <td>TUE</td>
		      <td>WED</td>
		      <td>THU</td>
		      <td>FRI</td>
		      <td>SAT</td>
		      <td>SUN</td>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td date-month="12" date-day="1">1</td>
		      <td date-month="12" date-day="2">2</td>
		      <td date-month="12" date-day="3">3</td>
		      <td date-month="12" date-day="4">4</td>
		      <td date-month="12" date-day="5">5</td>
		      <td date-month="12" date-day="6">6</td>
		      <td date-month="12" date-day="7">7</td>
		    </tr>
		    <tr>
		      <td date-month="12" date-day="8">8</td>
		      <td date-month="12" date-day="9">9</td>
		      <td date-month="12" date-day="10">10</td>
		      <td date-month="12" date-day="11">11</td>
		      <td date-month="12" date-day="12">12</td>
		      <td date-month="12" date-day="13">13</td>
		      <td date-month="12" date-day="14">14</td>
		    </tr>
		    <tr>
		      <td date-month="12" date-day="15">15</td>
		      <td date-month="12" date-day="16">16</td>
		      <td date-month="12" date-day="17">17</td>
		      <td date-month="12" date-day="18">18</td>
		      <td date-month="12" date-day="19">19</td>
		      <td date-month="12" date-day="20">20</td>
		      <td date-month="12" date-day="21">21</td>
		    </tr>
		    <tr>
		      <td date-month="12" date-day="22">22</td>
		      <td date-month="12" date-day="23">23</td>
		      <td date-month="12" date-day="24">24</td>
		      <td date-month="12" date-day="25">25</td>
		      <td date-month="12" date-day="26">26</td>
		      <td date-month="12" date-day="27">27</td>
		      <td date-month="12" date-day="28">28</td>
		    </tr>
		    <tr>
		      <td date-month="12" date-day="29">29</td>
		      <td date-month="12" date-day="30">30</td>
		      <td date-month="12" date-day="31">31</td>
		    </tr>
		  </tbody>
</table> -->

	
	</div> <!-- end content -->

<!-- ===================== FOOTER ======================== -->

	<footer>
		<p>Copyright &copy; all rights reserved 2015</p>
	</footer>

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

	});
	</script>

</body>
</html>