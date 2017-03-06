<?php
include ('init.php');
global $con;

$id=$_POST["id"];
//echo $id;
$sql = "select * from timing where patient_id='$id'";
$result =mysqli_query($con,$sql);
$result_data = array();
while($dr = mysqli_fetch_assoc($result)) {

	$result_data[] = $dr;
}
echo json_encode($result_data) ;
?>