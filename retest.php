<?php
//session_start();
include ('init.php');
global $con;
$pid = $_SESSION['pid'];
//$PID = 1;
//$pid = 1;
$sql = "select p.patient_id,p.medicene,p.day,p.break_fast,p.lunch,p.dinner,p.no_of_dose,
t.wake_time,t.sleep_time,
t.breakfast_time,
t.lunch_time,
t.dinner_time
from prescription p 
inner  join  timing t on(p.patient_id = t.patient_id )
where p.patient_id = '$pid' ";

  //$sql = "select * from schedule ";
$result = mysqli_query($con,$sql);
$result_data = array();
while($dr = mysqli_fetch_assoc($result)) {
     $result_data[] = $dr;
      //$result_data[] =$value;
}

$sql = "select med_id,reacts_with from med_reaction " ;
$result = mysqli_query($con,$sql);
while($dr =mysqli_fetch_assoc($result)) {
  $med_rect = mysqli_query($con ,"select name from  medicene where id ='".$dr['med_id']."' ");
  $med_rect_with = mysqli_query($con ,"select name from  medicene where id ='".$dr['reacts_with']."' ");
	while($cr = mysqli_fetch_array($med_rect)) {
	  $reaction_medice[] = $cr['name'] ;
		
	}
	while($fr = mysqli_fetch_array($med_rect_with)){
		$reaction_medice[] = $fr['name'] ;
	}
  
   //$reaction_medice[] = $dr['reacts_with'] ;
}
 $count_ab = 0;
 $count_al = 0;
 $count_ad = 0;
 $count_bb = 0;
 $count_bl = 0;
 $count_bd = 0;
foreach($result_data as $key => $value) {
	$med_name = $value['medicene'];
  if(in_array($med_name , $reaction_medice)) {
       //if patient id present then logic to checking for rection time then entry
   
                if($value['break_fast']=="a") {
                    
                    $number_of_doses = $value['no_of_dose'];
                     $sql_rect_query = "select  react_time  from med_reaction where med_id ='". $value['medicene']."' limit 1";
                     $result_set = mysqli_query($con,$sql_rect_query);
                    while($dr = mysqli_fetch_array($result_set)) {
                        $result_rection_time = $dr ;
                    }
                   for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                    if($count_ab == 1) {
						    $time = strtotime($value['breakfast_time']);
                           $time = date("H:i",strtotime('+120 minutes', $time));  
						
                                        }
                   if($count_ab == 0) {
                      //$break_fast = $value['breakfast_time'];
                      //$date = strtotime(date('$break_fast'));
                     $time = $value['breakfast_time'];
                      $count_ab ++;

                    }
                     $sql = "insert into schedule(patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                   }
                    mysqli_query($con,$sql);
                   

                   }
                              
                if($value['dinner'] == "a") {
         
               $number_of_doses = $value['no_of_dose'];
                     $sql_rect_query = "select  react_time  from med_reaction where med_id ='". $value['medicene']."' limit 1";
                     $result_set = mysqli_query($con,$sql_rect_query);
                    while($dr = mysqli_fetch_array($result_set)) {
                        $result_rection_time = $dr ;
                    }
                   for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                    if($count_ad == 1) {
                         $time = strtotime($value['dinner_time']);
                         $time = date("H:i", strtotime('+120 minutes', $time));  
                  }
                  if($count_ad == 0){
                     //$dinner_time = $value['dinner_time'];
                     //$date = strtotime(date('$dinner_time'));
                    $time = $value['dinner_time'];
                    $count_ad++ ;
                  }
   //$value['dinner_time'] = $result_rection_time + $value['dinner_time'];
                    $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                    mysqli_query($con,$sql);

                   }
             
            }  
                if($value['lunch'] == "a") {
                  
               $number_of_doses = $value['no_of_dose'];
                     $sql_rect_query = "select  react_time  from med_reaction where med_id ='". $value['medicene']."' limit 1";
                     $result_set = mysqli_query($con,$sql_rect_query);
                    while($dr = mysqli_fetch_array($result_set)) {
                        $result_rection_time = $dr ;
                    }

               //$time_r =$result_rection_time + $value['']
                   for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                    if($count_al == 1) {
                       $time = strtotime($value['lunch_time']);
                       $time = date("H:i", strtotime('+120 minutes', $time));
                    }
                    if($count_al == 0) {
                      $time = $value['lunch_time'];
                      //$dinner_time = $value['dinner_time'];
                     // $date = strtotime(date('$dinner_time'));
                     // $time = date("H:i:s",strtotime("+00 minutes", $date)); 
					$count_al ++;
                    }  
                    $sql = "insert into schedule (patient_id,latest_med_name,date,time) value ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                    mysqli_query($con,$sql);

                   }
            }

            if($value['break_fast'] =="b") {
               $number_of_doses = $value['no_of_dose'];
                     $sql_rect_query = "select  react_time  from med_reaction where med_id ='". $value['medicene']."' limit 1";
                     $result_set = mysqli_query($con,$sql_rect_query);
                    while($dr = mysqli_fetch_array($result_set)) {
                        $result_rection_time = $dr ;
                    }
                   for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                     if($count_bb == '1'){
						 
						 $time = strtotime($value['breakfast_time']);
                        $time = date("H:i", strtotime('-120 minutes', $time));
                                          }
                     if($count_bb =='0')  {
                       $time = $value['breakfast_time'];
                       //$date = strtotime(date('$break_fast'));
                      // $time = date("H:i:s",strtotime("-00 minutes", $date));
					  $count_bb++ ;
                    
                     }
                    $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                    mysqli_query($con,$sql);

            }
        }
            if($value['lunch'] =="b") {
            
               $number_of_doses = $value['no_of_dose'];
                     $sql_rect_query = "select  react_time  from med_reaction where med_id ='". $value['medicene']."' limit 1";
                     $result_set = mysqli_query($con,$sql_rect_query);
                    while($dr = mysqli_fetch_array($result_set)) {
                        $result_rection_time = $dr ;
                    }
                   for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                    if($count_bl == 1) {
                     $time = strtotime($value['lunch_time']);
                     $time = date("H:i", strtotime('-120 minutes', $time));
                   }
                   if($count_bl ==0) {
                   // $lunch_time = $value['lunch_time'];
                    // $date = strtotime(date('$lunch_time'));
                     $time = $value['lunch_time'];
					 $count_bl++;
                   }
                    $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                    mysqli_query($con,$sql);

                   }}

                        if($value['dinner'] =="b") {
                     $number_of_doses = $value['no_of_dose'];
                     $sql_rect_query = "select  react_time  from med_reaction where med_id ='". $value['medicene']."' limit 1";
                     $result_set = mysqli_query($con,$sql_rect_query);
                    while($dr = mysqli_fetch_array($result_set)) {
                        $result_rection_time = $dr ;
                    }

               //$time_r =$result_rection_time + $value['']
                   for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                     if($count_bd ==1){
                     $time = strtotime($value['dinner_time']);
                     $time = date("H:i", strtotime('-120 minutes',$time));
                   }
                   if($count_bd == 0) {
                     //$dinner_time = $value['dinner_time'];
                     //$date = strtotime(date('$dinner_time'));
                     $time = $value['dinner_time'];
					 $count_bd++;
                   }
                    $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                    mysqli_query($con,$sql);

                   }
                     }

                     //$count_b == 1;   






   }
   else
  {
    //no mater to checking direct entry to schedule table 
          if($value['break_fast']=="a") {
            $number_of_doses = $value['no_of_dose'];
                for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
                    //$breakfast_time = $value['breakfast_time'];
                    $time = $value['breakfast_time'];
                     //$date = strtotime(date('$dinner_time'));
                     //$time = date("H:i:s",strtotime("+0 minutes", $date));     
					 $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                 mysqli_query($con,$sql);

               }
             
            }

            if($value['lunch']=="a") {
              $number_of_doses = $value['no_of_dose'];
                for($i = 0;$i< count($number_of_doses);$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
             $time = $value['lunch_time'];
             //$time = date("$lunch_time",strtotime($lunch_time."+15 minutes"));

                 $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                 mysqli_query($con,$sql);
               }
             }
            if($value['dinner'] == "a") {
                $number_of_doses = $value['no_of_dose'];
                for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
             $time = $value['dinner_time'];
            // $time = date("$dinner_time",strtotime($dinner_time."+15 minutes"));
                 $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                 mysqli_query($con,$sql);

             
               }
             }

            if($value['break_fast'] =="b") {
                $number_of_doses = $value['no_of_dose'];
                for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
             $time = $value['breakfast_time'];
              //$time = date("$breakfast_time",strtotime($breakfast_time."-15 minutes"));
                 $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                 mysqli_query($con,$sql);


               }
            }
            if($value['lunch'] =="b") {
              $number_of_doses = $value['no_of_dose'];
                for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
             $time = $value['lunch_time'];
             //$time = date("$lunch_time",strtotime($lunch_time."-15 minutes"));
                 $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                 mysqli_query($con,$sql);
              }
            }
            if($value['dinner'] =="b") {
                $number_of_doses = $value['no_of_dose'];
                for($i = 0;$i< $number_of_doses ;$i++) { //number of doses equL TO NUMBER of enrty in the shedule table
               $time = $value['dinner_time'];
             //$time = date("$dinner_time",strtotime($dinner_time."-15 minutes"));
                 $sql = "insert into schedule (patient_id,latest_med_name,date,time) values ('".$value['patient_id']."','".$value['medicene']."','".$value['day']."','".$time."')";
                 mysqli_query($con,$sql);
              } 
            }  

       }//end of else
   }// end of the foreach loop
?>