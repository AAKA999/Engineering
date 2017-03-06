<?php
//session_start();
include ('init.php');
global $con;
$p_id = $_SESSION['pid'];
//$p_id = '1';
//$sql  = "select count(*) as 'Total',sugar_count"
//next_visit
//$p_id = $_REQUEST['id'];
//$sql = "select next_visit_date from next_visit where p_id = '".$p_id."'";
$sql = "select next_visit_date from next_visit where p_id = '1'";
$result = mysqli_query($con,$sql);
while($dr = mysqli_fetch_array($result)) {
$next_visit_date = $dr ;
}
 $sql = "select count(*) as 'total',SUM(sugar_count) as 'sugar_sum' from daily_log where update_date <= '".$next_visit_date['next_visit_date']."' AND patient_id = '".$p_id."' " ;
 $query_result =mysqli_query($con,$sql);
 while($cr = mysqli_fetch_array($query_result)){
 $daily_log_data[] = $cr ;
 }
/* $sql = "select count(*) as 'total_count',SUM(current_blood_sugar) as 'current_sum' from visit_log where entry_date <= '".$next_visit_date['next_visit_date']."' AND pid = '".$p_id."' " ;
 $results = mysqli_query($con,$sql);
 while($dr = mysqli_fetch_array($results)){
 $visit_log_data[] = $dr ;
 }*/
$day = date('Y-m-d');
 $sql = "select * from visit_log where entry_date = '".$day."' AND pid = ".$p_id." limit 1";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)){
	$sugar = $row['current_blood_sugar'];
	//echo $sugar;
	//echo "string";
}
 
  $total_count = $daily_log_data[0]['total'] + 1;
  //echo $total_count;
  $total_sum = $daily_log_data[0]['sugar_sum'] + $sugar;
  //echo $total_sum;
  $avg_sugar = $total_sum/$total_count;
  $avg_blood_sugar = round($avg_sugar, 2); 
  $today = date("Y-m-d");
  $sql = "UPDATE visit_log SET avg_blood_sugar ='".$avg_blood_sugar."' WHERE pid ='".$p_id."' AND  entry_date ='".$today."' ";
 if(mysqli_query($con,$sql)) {
 echo "<script>alert('Visit Log updated')</script>" ;
 }
 else  {
 echo "some problem in the code ";
 }
  

     $sql = "DELETE FROM daily_log WHERE patient_id = ".$p_id;
     $result = mysqli_query($con,$sql);
           
?>