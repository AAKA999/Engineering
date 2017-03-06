<!DOCTYPE html>
<html>
<head>
	<title></title>

<style>
#header {
    background-color:#303F9F;
    color:white;
    text-align:center;
    padding:5px;
}

#section {
    width:500px;
    float:middle;
    padding:7px;     
}

#outer { width: 600px; }
#inner { width: 250px; margin: 0 auto; }

input[type=text],input[type=date],input[type=time], select, option {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #65cdff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
     -webkit-transition: .5s ease;
  transition: .5s ease;
}

input[type=submit]:hover {
    background-color: #8e99d7;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 40px;
  margin:auto;
}
#footer {
    background-color:#303F9F;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;    
}

#logout{

  float:right;
  position: absolute;
  height: 60px;
  width: 60px;
  margin-top: -90px;
  margin-left: 530px;
   border: none;
    border-radius: 40px;
    background-color: red;
    color: white;
    cursor: pointer;
    font: bold Georgia, serif;
    background: -webkit-radial-gradient(circle, #FF4081,#FF4081);
    box-shadow: 1px 0px 0px black;
    outline: none;
    text-indent: -40%;
   

}
</style>
	<?php 
//Start the Session
 session_start();

   define('DB_HOST', 'localhost');
	 define('DB_NAME', 'hospital'); 
	 define('DB_USER','root'); 
	 define('DB_PASSWORD','');
	 
	 $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Database: " . mysql_error());
	 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
   $pid = $_SESSION['pid'];?>

</head>
<body>
<div id="header">

<h1>MedAgent</h1>
<h2><i>Your Medical Companion</i></h2>
<form  method="POST" action="index.php">
  <input id = "logout" type = "submit" value = "Logout"></input>
</form>

</div>
<div id="outer">

<div id="section">

  <center><div><p><h1>Enter Next Visit Details </h1></p></center>

   <br>
   
<!-- 
   <form name="add" action="add_patient.php">
		<input class = "left" name = "add_patient" type="submit" value="Add Patient"></input>
   </form> 
   

   <form name="update" action="update_patient.php">
   		<input class="right" name = "update_details" type="submit" value="Update patient details"></input>
   </form>
<br> -->
   <form name="add" action="" method="POST">
 
     <label for="name"></label>
    <label for="name"> Date:</label><input type="date"  name="day">
    <label for="name"> Time:</label><input type="time" name = "timing" value="00:00:00" step="1"></input>
    <input type="submit" value="Submit" name="submit">
   
   <?php

    if(isset($_POST['submit']))
    {
        //session_start();
        $day = $_POST['day'];
        $timing = $_POST['timing'];
        $longtime = $timing.":00";
        //echo $longtime;
        //echo $pid;
        //echo gettype($longtime);
        /*$time = strtotime($ans);
        // $day = date('Y-m-d',$time);*/
        $query = "SELECT * FROM next_visit WHERE p_id = $pid";
        $result = mysql_query($query,$con);
        if(mysql_num_rows($result)!=0)
        {
        while($row = mysql_fetch_array($result,MYSQL_ASSOC))
        {
          $sql = "INSERT INTO visit_dates(visit_date,visit_time,patient_id)VALUES('".$row['next_visit_date']."','".$row['visit_time']."',$pid)";

          $ans = mysql_query($sql,$con);
        }
        $query = "UPDATE next_visit SET next_visit_date = '$day', visit_time = '$longtime' WHERE p_id = $pid";
        $result = mysql_query($query,$con);
        if($result)
          echo "<script>alert('Updated Successfully....!!!!!')</script>";
        else 
          echo "no1";
      }

      else
      {

        $query = "INSERT INTO next_visit(next_visit_date,visit_time,p_id)VALUES('$day','$longtime',$pid)";
        $ans = mysql_query($query,$con);

        if($ans)
          echo "<script>alert('Entered Successfully....!!!!!')</script>";
        else
          echo "no";

      }
        include("android/sch_form.php");
      
      /*  while($row = mysql_fetch_array($result,MYSQL_ASSOC))
        {

          $_SESSION['pid'] = $pid;
          $_SESSION['pname'] = $row['patient_name'];

           echo "<script>window.open('patient_options.php','_self')</script>";

          
        }
*/
    }



   ?>

		</form>
    <form method="POST" action="patient_options.php">
  <input type="submit" value="Back"></input>
</form>
</div>
</div>
</div>

<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>