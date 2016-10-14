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
		
		echo 	("<a href=\"schedule.php?q=$q\"><button id=\"sch_btn\" type=\"button\">SCHEDULE</button></a>");
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
				
		echo 	("<a href=\"schedule.php?q=$q\"><button id=\"sch_btn\" type=\"button\">SCHEDULE</button></a>");
	}
}
else{
		echo	("<p class=\"norm_color\">RADIOLOGICAL EXAM: <span class=\"inf\">".$row['Type']."</span></p>");
		echo 	("<p class=\"norm_color\">ID: <span class=\"inf\">$q</span></p>");
		echo 	("<p class=\"norm_color\">REASON: <span class=\"inf\">".$row['Reason']."</span></p>");
		echo 	("<p class=\"norm_color\">DATE OF ORDER: <span class=\"inf\">".$row['Issued']."</span></p>");
		echo 	("<p class=\"norm_color\">RECOMMENED DATE: <span class=\"inf\">".$row['Recommended']."</span></p>");
		echo 	("<p class=\"norm_color\">ISSUED BY: <span class=\"inf\">".$row['Issued_by']."</span></p>");
		//echo 	("<p class=\"norm_color\">EMERGENCY: <span class=\"inf\">High priority</span></p>");
		echo	("<p class=\"norm_color\">SCHEDULED DATE: <span class=\"inf\">".$row['Execute_by']."</span></p>");
		echo	("<p class=\"norm_color\">SCHEDULED TIME: <span class=\"inf\">".$row['Execute_Time']."</span></p>");
				
		echo 	("<a href=\"schedule.php?q=$q\"><button id=\"sch_btn\" type=\"button\">RESCHEDULE</button></a>");
	
}
mysqli_close($con);
?>		