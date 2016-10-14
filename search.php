<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost','root','','ehealthproject');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql="SELECT commandID, Type, Execute_By, Current_State, Emergency_State FROM command WHERE commandID=".$q;
$result = mysqli_query($con,$sql);
$counter=1;
if ($row = mysqli_fetch_array($result)){
if($row['Current_State']=="pending"){
		if($row['Emergency_State']=="no"){
			echo ("<div id=\"comm_normal\" onclick=\"refreshDesc(".$row['commandID'].")\"   class=\"mix pending\" data-myorder=\"$counter\">");
			echo 	("<p id=\"title\"><span class=\"norm_color\">".$row['Type']."</span></p>");
			echo 	("<p id=\"ID\"><span class=\"norm_color\">ID:</span> 0".$row['commandID']."</p>");
			echo 	("<p id=\"date\">date: <span class=\"norm_color\">pending </span></p>");
			echo 	("<span id=\"norm_icon\" class=\"fa fa-chevron-right\"></span>");
			echo ("</div>");
		}
		else {
			echo ("<div id=\"comm_emerg\" onclick=\"refreshDesc(".$row['commandID'].")\" s class=\"mix emergency pending\" data-myorder=\"$counter\">");
			echo 	("<p id=\"title\"><span class=\"emerg_color\">".$row['Type']."</span></p>");
			echo 	("<p id=\"ID\"><span class=\"emerg_color\">ID:</span> 0".$row['commandID']."</p>");
			echo 	("<p id=\"date\">date: <span class=\"emerg_color\">pending </span></p>");
			echo 	("<span id=\"emerg_icon\" class=\"fa fa-exclamation-circle\"></span>");
			echo ("</div>");
		}
	}
	else {
			echo ("<div id=\"comm_done\" onclick=\"refreshDesc(".$row['commandID'].")\"  class=\"mix done\" data-myorder=\"$counter\">");
			echo 	("<p id=\"title\"><span class=\"done_color\">".$row['Type']."</span></p>");
			echo 	("<p id=\"ID\"><span class=\"done_color\">ID:</span> 0".$row['commandID']."</p>");
			echo 	("<p id=\"date\">date: <span class=\"done_color\">".$row['Execute_By']."</span></p>");
			echo 	("<span id=\"done_icon\" class=\"fa fa-check\"></span>");
			echo ("</div>");
	}
	}
//echo ("<script> $('#commands').mixItUp('destroy'); setTimeout(function(){  $('#commands').mixItUp() }, 250); </script>");
mysqli_close($con);

?>