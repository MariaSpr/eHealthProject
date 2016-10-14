<?php
include('session.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calendar</title>
	<link rel="stylesheet" href="css/mainStyle.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/simplecalendar.js"></script>
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
					<li><a href="#"><span id="calicon" class="fa fa-calendar"></span>CALENDAR</a></li>
					<li><a href="logout.php"><span id="logouticon" class="fa fa-power-off"></span>LOG OUT</a></li>
				</ul>
			</div>



	<!-- ==============CONTENT ===================== -->

	<div id="content">

		<!-- ===================SUB HEADER  =====================-->
		<div id="subheaderRd">
			<div id="sub-icons">
				<div id="menuBox"><span id="menu-icon" class="fa fa-bars"></span></div>
			</div>  

			<p>CALENDAR</p>

			<div style="clear: both";></div>
		</div>  <!-- end subheader -->


		<!-- ============= CALENDAR ================ -->

			<div id="wrap_cal2">
				<div class="calendar hidden-print">
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
									<div class="list">
									
									<?php 
									$con = mysqli_connect('localhost','root','','ehealthproject');
										if (!$con) {
											die('Could not connect: ' . mysqli_error($con));
										}
										$sql="SELECT  Type, Execute_By, Execute_Time, Type, Reason FROM command WHERE Current_State=\"done\" ";
										$result = mysqli_query($con,$sql);
										
										while($row = mysqli_fetch_array($result)) {
										
										$debris = explode("-", $row['Execute_By']);
										echo ("<div class=\"day-event\" date-month=\"".ltrim($debris[1], '0')."\" date-day=\"".ltrim($debris[2], '0')."\" data-number=\"1\">");
										echo ("	<h2 class=\"title\">".$row['Execute_By']."</h2>");
										echo ("	<p class=\"date\">".$row['Type']."</p>");
										echo ("	<p>Assigned Time: ".$row['Execute_Time']." <br> Reason: ".$row['Reason']." </p>");											
										echo ("</div>");
										}
										mysqli_close($con);
									?>
										<!-- <div class="day-event" date-month="5" date-day="4" data-number="1">
											<h2 class="title">Niar</h2>
											<p class="date">ΜΙΑΡ</p>
											<p>Appointments: Niar niar niar</p>
											
										</div>
										<div class="day-event" date-month="3" date-day="13" data-number="2">
											<h2 class="title">ΝΙΑΡ</h2>
											<p class="date">2014-12-13</p>
											<p>ΝΙΑΡ</p>
											
										</div>
										<div class="day-event" date-month="3" date-day="13" data-number="1">
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
											
										</div>-->
									</div>
								</div>

		</div> <!-- end wrap cal2 --> 


	</div> <!-- end content -->

	<!-- ===================== FOOTER ======================== 

	<footer>
		<p>Copyright &copy; all rights reserved 2015</p>
	</footer>
-->
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