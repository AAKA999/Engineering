<?php
include ('init.php');
$id=$_POST['id'];
global $con;

$sql = "select * from next_visit where p_id='".$id."'";
$result =mysqli_query($con,$sql);
$result_data = array();
while($dr = mysqli_fetch_assoc($result)) {

	$result_data[] = $dr;
}
echo json_encode($result_data) ;
?>