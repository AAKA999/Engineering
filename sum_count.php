<?php
$result_set = array();
$id=$_POST["id"];
include "init.php";
global $con;
$sql = "select count(*) as 'count' ,sum(sugar_count) as 'sum' from daily_log where patient_id = '$id' ";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($result)) {
  $result_set[]  = $row;
}
echo json_encode($result_set);
?>