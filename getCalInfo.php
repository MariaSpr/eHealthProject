<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','ehealthproject');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql="SELECT  Type, Execute_By, Execute_Time, Type, Reason FROM command WHERE radiologistID=$q";
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