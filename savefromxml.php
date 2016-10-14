<?php 
$url="http://localhost/ehealthdoc/pullxml.php?key=allhailthegreatlama&notest";
$data=simplexml_load_file($url);


//Get patients first
$conn=mysqli_connect("localhost", "root" , "", "ehealthproject");

foreach($data->patients->patient as $patient):
	$patientID=$patient->patientID;
	$commandID=$patient->commandID;
	$pName=$patient->pName;
	$pSurname=$patient->pSurname;
	$Address=$patient->Address;
	$Work_phone=$patient->Work_phone;
	$Home_phone=$patient->Home_phone;
	$Cell_phone=$patient->Cell_phone;
	$Date_of_birth=$patient->Date_of_birth;
	$SSN=$patient->SSN;
	$Mother_name=$patient->Mother_name;
	$Father_name=$patient->Father_name;
	$Sex=$patient->Sex;
	
	$sql="INSERT INTO `patient` (`patientID`, `commandID`, `pName`, `pSurname`, `Address`, `Work_phone`, `Home_phone` , `Cell_phone`, `Date_of_birth`, `SSN`, `Mother_name`, `Father_name`, `Sex`)"
	. " VALUES ('$patientID', NULL, '$pName', '$pSurname', '$Address', '$Work_phone', '$Home_phone' , '$Cell_phone', '$Date_of_birth', '$SSN', '$Mother_name', '$Father_name', '$Sex')";
	
	if (!mysqli_query($conn, $sql)){
	echo "Error: ".mysqli_error($conn);
	echo "<br>";
	}
	endforeach;
	
foreach($data->commands->command as $command):
	$commandID=$command->commandID;
	$patientID=$command->patientID;
	$Issued=$command->Issued;
	$Issued_by=$command->Issued_by;
	$Reason=$command->Reason;
	$Recommended=$command->Recommended;
	$Emergency_State=$command->Emergency_State;
	$Type=$command->Type;
	
	$sql="INSERT INTO `command` (`commandID`, `radiologistID`, `patientID`, `Issued`, `Issued_by`, `Reason`, `Execute_by`, `Current_State`, `Recommended`, `Emergency_State`, `Type`, `Execute_Time`) VALUES "
	."('$commandID', NULL, '$patientID', '$Issued', '$Issued_by' , '$Reason',  NULL, 'pending', '$Recommended', '$Emergency_State', '$Type', NULL);";
	
	if (!mysqli_query($conn, $sql)){
	echo "Error: ".mysqli_error($conn);
	echo "<br>";
	}
	endforeach;
	
	mysqli_close($conn); // Closing Connection
	header('Location: dashboard.php'); // Redirecting To Main Page
?>