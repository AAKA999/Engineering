<?php
require"init.php";
$id=$_POST["id"];
$wake_time=$_POST["wake_time"];
$sleep_time=$_POST["sleep_time"];
$dinner_time=$_POST["dinner_time"];
$lunch_time=$_POST["lunch_time"];


$sql_query="update timing set wake_time='$wake_time',sleep_time='$sleep_time',dinner_time='$dinner_time',lunch_time='$lunch_time'where time_id='$id'";
if(mysqli_query($con,$sql_query))
{
	echo "Data Successfuly Updated";
	//echo"<h3>Data Insertion Success..</h3>";
}
else
{
//	echo"Data inserion error..".mysqli_error($con);
echo "0";
}
?>