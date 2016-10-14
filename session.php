<?php
// Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
$connection = mysqli_connect("localhost", "root", "", "ehealthproject");
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection, "SELECT userName, actualName FROM login WHERE userName='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session=$row['userName'];
$actual_name=$row['actualName'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location: login.php'); // Redirecting To Home Page
}
?>