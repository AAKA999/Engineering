<?php
include ('init.php');
global $con;

 $sql = "select * from schedule ";
 
 $sql2="select usrname,latest_med_name,date,time";
$result =mysqli_query($con,$sql);
$result_data = array();
while($dr = mysqli_fetch_assoc($result)) {

	$result_data[] =$dr;
}
echo json_encode($result_data) ;
?>