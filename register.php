<?php
require"init.php";
$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];

$sql_query="insert into users(usrname,email,password) values('$username','$email','$password');";
if(mysqli_query($con,$sql_query))
{
	echo "Welcome ".$username;
	//echo"<h3>Data Insertion Success..</h3>";
}
else
{
//	echo"Data inserion error..".mysqli_error($con);
echo "0";
}
?>