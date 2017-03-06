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
   $pid = $_SESSION['pid'];

  $fetch_query = "SELECT * FROM timing WHERE patient_id = $pid";
  $result_query = mysql_query($fetch_query,$con);

  while($row = mysql_fetch_array($result_query,MYSQL_ASSOC))
  {
    $wakeup = $row['wake_time'];
    $sleep = $row['sleep_time'];
    $breakfast = $row['breakfast_time'];
    $lunch = $row['lunch_time'];
    $dinner = $row['dinner_time'];
  } 

   ?>

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

  <center><div><p><h1>Edit User Timings </h1></p></center>

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
    <label for="name"> Wake up Time:</label><input type="time"  name="wakeup" step ="1" value=<?php echo $wakeup;?>>
    <label for="name"> Breakfast Time:</label><input type="time"  name="breakfast" step ="1" value=<?php echo $breakfast;?>>
    <label for="name"> Lunch Time:</label><input type="time"  name="lunch" step ="1" value=<?php echo $lunch;?>>
    <label for="name"> Dinner Time:</label><input type="time" name = "dinner" step ="1" value=<?php echo $dinner;?>></input>
    <label for="Sleep Time">Sleep Time:</label><input type="time"  name="sleep" step ="1" value=<?php echo $sleep;?>>
    <input type="submit" value="Submit" name="submit">
   
   <?php

    if(isset($_POST['submit']))
    {
        $wakeup = $_POST['wakeup'];
        $sleep = $_POST['sleep'];
        $breakfast = $_POST['breakfast'];
        $lunch = $_POST['lunch'];
        $dinner = $_POST['dinner'];
        $day = date('Y-m-d');

        $query = "UPDATE timing SET update_date = '$day', wake_time = '$wakeup', sleep_time = '$sleep', breakfast_time = '$breakfast', lunch_time = '$lunch', dinner_time = '$dinner' WHERE patient_id = $pid";
        $result = mysql_query($query,$con);

        if($result)
          echo "<script>alert('Timings Updated Succesfully...!!!')</script>";
        else
          echo "no";

        

    }



   ?>

		</form>

    <form action="patient_list.php" method="POST">
      <input type="submit" value="Back to Patient page"></input>
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