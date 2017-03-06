<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
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

input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form{
	width: 100%;

}
input[type=submit] {
    
}

.right{
	width: 20%;
    background-color: #65cdff;
    color: white;
    padding: 40px;
    margin-top: 2px;
    margin-right: 380px;
    border: none;
    margin-left: -5px;
    border-radius: 4px;
    cursor: pointer;
    float: right;
     -webkit-transition: .5s ease;
  transition: .5s ease;
}

.left{
	width: 20%;
    background-color: #65cdff;
    color: white;														
    padding: 40px;
    margin-left: 380px;
   margin-top: 2px;	
    margin-right: -5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: left;
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
	min-height: 100px;
	overflow: hidden; 	
}
#footer {
    background-color:#303F9F;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
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
	 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); ?>

</head>
<body>
<div id="header">

<h1>MedAgent</h1>
<h2><i>Your Medical Companion</i></h2>

</div>

  <center><div><p><h1> Select an option </h1></p>

   <br>
   
<!-- 
   <form name="add" action="add_patient.php">
		<input class = "left" name = "add_patient" type="submit" value="Add Patient"></input>
   </form> 
   

   <form name="update" action="update_patient.php">
   		<input class="right" name = "update_details" type="submit" value="Update Patient Details"></input>
   </form>

<br> -->

   <form name="add" action="doctor_list.php">
		<input class = "left" name = "visit_log" type="submit" value="List of Doctors"></input>
   </form> 
   

   <form name="update" action="get_patient_details.php">
   		<input class="right" name = "update_details" type="submit" value="Get Patient Details"></input>
   </form>

<br>

<!--    <form name="update" action="doctor_list">
      <input class="left" name = "update_details" type="submit" value="Doctors visited"></input>
   </form>

      <form name="update" action="doctor_list">
      <input class="right" name = "update_details" type="submit" value="Patient Schedule"></input>
   </form>

<br>

   <form name="update" action="doctor_list">
      <input class="left" name = "update_details" type="submit" value="Missed Medicines"></input>
   </form>

      <form name="update" action="doctor_list">
      <input class="right" name = "update_details" type="submit" value="Taken Medicines"></input>
   </form>

<br>

   <form name="update" action="visit_log.php">
      <input class="left" name = "update_details" type="submit" value="Visit Log"></input>
   </form> 

      <form name="update" action="doctor_list">
      <input class="right" name = "update_details" type="submit" value="Extra"></input> -->
   </form>
</div>
</center>
<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>