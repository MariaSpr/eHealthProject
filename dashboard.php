<?php
include('session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DashBoard</title>
	<link rel="stylesheet" href="css/mainStyle.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script src="js/javascript.js"></script>
	<script> 
	function showResult(str){
			if (str.length==0){
				document.getElementById("commands").innerHTML = "";
				return;
			}
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("commands").innerHTML = xmlhttp.responseText;
            }
			// var scripts = document.getElementById("commands").getElementsByTagName("script");
				// for( var i=0; i<scripts.length; i++ ) {
					// eval(scripts[i].innerText);
				// }		
			$('#commands').mixItUp('destroy');	
			setTimeout(function(){  $('#commands').mixItUp() }, 250);
        }
		
        xmlhttp.open("GET","search.php?q="+str,true);
        xmlhttp.send();
		}
		function refreshCommands(startID){
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("commands").innerHTML = xmlhttp.responseText;
            }
			// var scripts = document.getElementById("commands").getElementsByTagName("script");
				// for( var i=0; i<scripts.length; i++ ) {
					// eval(scripts[i].innerText);
				// }			
			setTimeout(function(){  $('#commands').mixItUp() }, 250);
        }
		
        xmlhttp.open("GET","getCommands.php?q="+startID,true);
        xmlhttp.send();
		}
		
		function refreshDesc(commandID){
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("information").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getDesc.php?q="+commandID,true);
        xmlhttp.send();
		
		}
	</script>
</head>
<body>
	
	<!-- ==================== HEADER ============================= -->
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
					<li><a href="#"><span id="dashicon" class="fa fa-tachometer"></span>DASHBOARD</a></li>
					<li><a href="radiologists.php"><span id="rdicon" class="fa fa-user-md"></span>RADIOLOGISTS</a></li>
					<li><a href="calendar.php"><span id="calicon" class="fa fa-calendar"></span>CALENDAR</a></li>
					<li><a href="logout.php"><span id="logouticon" class="fa fa-power-off"></span>LOG OUT</a></li>
				</ul>
			</div>
	
	
	<div id="content">
		<!-- ===================SUB HEADER  =====================-->
		<div id="subheader">
			<div id="sub-icons">
				<div id="menuBox"><span id="menu-icon" class="fa fa-bars"></span></div>
				<!-- <span id="search-icon" class="fa fa-search"></span> -->
				
				<div class="box">
				  <div class="container-1">
				      <span class="icon"><i class="fa fa-search"></i></span>
				      <input type="search" id="search" placeholder="Search..." onkeyup="showResult(this.value)" />
				  </div>
				</div>
			</div>  

			<p>DASHBOARD</p>

			<div style="clear: both";></div>
		</div>  <!-- end subheader -->

		<!-- ===================SORT AND FILTER SUBHEADER =================-->

		<div id="sort_filter_header">

			<div id="sort">
				<p>SORT:</p>

				<div id="sort_btns">
					
					<button type="button" class="def_bl_btn filter" data-filter="all">DEFAULT</button>
					<button type="button" class="def_bl_btn sort" data-sort="myorder:asc">ASCENDING</button>
					<button type="button" class="def_bl_btn sort" data-sort="myorder:desc">DESCENDING</button>

				</div>    <!-- end buttons --> 
			</div> <!-- general sort -->

			<div id="filter">
				<p>FILTER:</p>
				<div id="filter_btns">
					<button type="button" class="em_rd_btn filter" data-filter=".emergency">EMERGENCY</button>
					<button type="button" class="dn_gr_btn filter" data-filter=".done">DONE</button>
					<button type="button" class="def_bl_btn filter" data-filter=".pending">PENDING</button>

				</div>    <!-- end buttons --> 
			</div> <!-- general filter -->

		<div style="clear: both";></div>
		</div> <!-- end sort filter  -->


		<!-- ============== ORDERS ================ -->
		<div id="commands" class="list">

			<div id="comm_normal" class="mix pending" data-myorder="1">
				<p id="title"><span class="norm_color">X-Rays</span></p>
				<p id="ID"><span class="norm_color">ID:</span> 001</p>
				<p id="date">date: <span class="norm_color">pending </span></p>
				<span id="norm_icon" class="fa fa-chevron-right"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->

			<div id="comm_normal" class="mix pending" data-myorder="2">
				<p id="title"><span class="norm_color">MRI</span></p>
				<p id="ID"><span class="norm_color">ID:</span> 002</p>
				<p id="date">date: <span class="norm_color">pending </span></p>
				<span id="norm_icon" class="fa fa-chevron-right"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->

			<div id="comm_done" class="mix done" data-myorder="3">
				<p id="title"><span class="done_color">Ultrasound</span></p>
				<p id="ID"><span class="done_color">ID:</span> 003</p>
				<p id="date">date: <span class="done_color">05/05/2015</span></p>
				<span id="done_icon" class="fa fa-check"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->


			<div id="comm_normal" class="mix pending" data-myorder="4">
				<p id="title"><span class="norm_color">Bone Scan</span></p>
				<p id="ID"><span class="norm_color">ID:</span> 004</p>
				<p id="date">date: <span class="norm_color">pending </span></p>
				<span id="norm_icon" class="fa fa-chevron-right"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->

			<div id="comm_emerg" class="mix emergency pending" data-myorder="5">
				<p id="title"><span class="emerg_color">CAT Scan</span></p>
				<p id="ID"><span class="emerg_color">ID:</span> 005</p>
				<p id="date">date: <span class="emerg_color">pending </span></p>
				<span id="emerg_icon" class="fa fa-exclamation-circle"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->

			<div id="comm_normal" class="mix pending" data-myorder="6">
				<p id="title"><span class="norm_color">Thyroid Scan</span></p>
				<p id="ID"><span class="norm_color">ID:</span> 006</p>
				<p id="date">date: <span class="norm_color">pending </span></p>
				<span id="norm_icon" class="fa fa-chevron-right"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->

			<div id="comm_normal" class="mix pending" data-myorder="7">
				<p id="title"><span class="norm_color">X-Rays</span></p>
				<p id="ID"><span class="norm_color">ID:</span> 007</p>
				<p id="date">date: <span class="norm_color">pending </span></p>
				<span id="norm_icon" class="fa fa-chevron-right"></span>
			</div> 

			<!-- <div style="clear: both";></div> -->

			<!-- <div id="comm_done" class="mix done" data-myorder="8">
				<p id="title"><span class="done_color">Fluroscopy</span></p>
				<p id="ID"><span class="done_color">ID:</span> 008</p>
				<p id="date">date: <span class="done_color">12/05/2015</span></p>
				<span id="done_icon" class="fa fa-check"></span>
			</div> 
			
			
			<div id="comm_emerg" class="mix emergency" data-myorder="9">
				<p id="title"><span class="emerg_color">PET Scan</span></p>
				<p id="ID"><span class="emerg_color">ID:</span> 009</p>
				<p id="date">date: <span class="emerg_color">pending </span></p>
				<span id="emerg_icon" class="fa fa-exclamation-circle"></span>
			</div> 
			
			
			<div id="comm_normal" class="mix pending" data-myorder="10">
				<p id="title"><span class="norm_color">Thallium Scan</span></p>
				<p id="ID"><span class="norm_color">ID:</span> 010</p>
				<p id="date">date: <span class="norm_color">pending </span></p>
				<span id="norm_icon" class="fa fa-chevron-right"></span>
			</div> -->

		</div> <!-- end commands -->


		<!-- ============= COMMAND INFORMATION =========== -->

		<div id="comm_info">
			<p id="comm_title">ORDER INFORMATION</p>

			<div id="information">
				<p id="norm_color">SELECT AN ORDER</p>
			<!--	<p class="norm_color">RADIOLOGICAL EXAM: <span class="inf">X-Rays</span></p>
				<p class="norm_color">ID: <span class="inf">001</span></p>
				<p class="norm_color">REASON: <span class="inf">Checkup</span></p>
				<p class="norm_color">DATE OF COMMAND: <span class="inf">04/03/2015</span></p>
				<p class="norm_color">RECOMMENED DATE: <span class="inf">10/05/2015</span></p>
				<p class="norm_color">PRIORITY: <span class="inf">Low priority</span></p>
				<p class="norm_color">SCHEDULED DATE: <span class="inf">PENDING</span></p>
				
				<a href="schedule.php"><button id="sch_btn" type="button">SCHEDULE</button></a> -->
			</div>

		</div> <!-- end commands information --> 

		<div style="clear: both";></div>
			
			<!--  ========================= PAGINATION ======================== -->

	<div id="pagination">
		<div id="pages">
			<ul>
			<li style="visibility: hidden"><a href="#"><span class="textbtn prev">PREVIOUS</span></a></li>
				<?php
					// Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
					$connection = mysqli_connect("localhost", "root", "", "ehealthproject");
					$result = mysqli_query($connection , "select COUNT(*) from command");
					$row = mysqli_fetch_array($result);
					$get_total_rows = $row[0];
					echo ("<li><a  class=\"current\" onclick=\"$('#commands').mixItUp('destroy'); refreshCommands(0); \" >1</a></li>");
					$helper = 0;
					if(($get_total_rows/7)>1){
						$helper = $get_total_rows - 7;
						$pageCount = 2;
						echo ("<li><a  onclick=\"$('#commands').mixItUp('destroy'); refreshCommands(7);\" >2</a></li>");
						while(($helper/7)>1){
							$helper = $helper - 7;
							$pageCount = $pageCount + 1;
							$toContinue = 7*($pageCount - 1);
							echo ("<li><a  onclick=\"$('#commands').mixItUp('destroy'); refreshCommands($toContinue);\" >$pageCount</a></li>");
						}
					}
				?>
			<!--	
				<li><span class="current">1</span></li>
				<li><a href="">2</a></li>
				<li><a href="#">3</a></li>-->
				<li style="visibility: hidden"><a href="#"><span  class="textbtn next">NEXT</span></a></li> 
			</ul>
		</div>
	</div>




	</div> <!-- end content -->


	

     <!-- ===================== FOOTER ======================== -->

	<footer>
		<p>Copyright &copy; all rights reserved 2015</p>
	</footer>

	<!-- JQUERY SCRIPT -->
	<script>
	
	$(function(){
			
	refreshCommands(0);
	

	//$('#commands').mixItUp('');
	// Instantiate MixItUp:


	//menu
	$("#menu-icon").click(function() {
	  $("#menu").toggleClass("active");
		});

	$("#menu-icon").click(function() {
	  $("#trigger").toggleClass("active");
		});
	});
	

	</script>
	<script src="js/jquery.mixitup.min.js"></script>
</body>
</html>