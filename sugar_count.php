<?php
require"init.php";
$id=$_POST["id"];
$date=$_POST["date"];
$sugar_count=$_POST["sugar_count"];


$sugar_goal=abs($_POST["sugar_count"]-140);
if ($sugar_count>140){
			echo "Blood sugar is ".$sugar_goal."mg/dL more than the normal blood sugar";
			$final_sugar_goal = $sugar_goal." more";
	}
	else{
			echo "Blood sugar is ".$sugar_goal."mg/dL less than the normal blood sugar";
                        $final_sugar_goal = $sugar_goal." less";
	}
$sql_query="insert into daily_log(update_date,sugar_count,sugar_goal,patient_id) values('$date','$sugar_count','$final_sugar_goal','$id');";
if(mysqli_query($con,$sql_query))
{
	
	
	//echo"<h3>Data Insertion Success..</h3>";
}
else
{
//	echo"Data inserion error..".mysqli_error($con);
echo "Failed to Add Data";
}
?>