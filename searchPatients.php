<?php 
$connection = mysqli_connect("localhost", "root", "", "ihs");
$searchString = $_GET['q'];
$sql = "SELECT SSN,name,surname,sex FROM Patient WHERE name LIKE '%".$searchString."%' OR surname LIKE '%".$searchString."%' OR SSN LIKE '%".$searchString."%'";
$result=mysqli_query($connection, $sql); 

while ($row=mysqli_fetch_array($result)) {
   echo ("<tr>");
   echo ("<td>".$row['SSN']."</td>");
   echo ("<td>".$row['name']."</td>");
   echo ("<td>".$row['surname']."</td>");
   echo ("<td>".$row['sex']."</td>");
   echo ("<td><center><button type=\"button\" class=\"btn btn-default\"><span class=\"fa fa-pencil group\"></span></button><button type=\"button\" class=\"btn btn-default\"><span class=\"fa fa-times group\"></span></button></center></td>");
     echo ("</tr>");
    }
 ?>