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

#right{
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

#left{
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

#left:hover {
    background-color: #8e99d7;
}

#right:hover {
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
input[type=submit] {
    width: 50%;
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
<form  method="POST" action="index.php">
  <input id = "logout" type = "submit" value = "Logout"></input>
</form>


</div>

  <center><div><p><h1> Select an option </h1></p>
  <h3>
    <p>Patient ID :<?php echo $_SESSION['pid'];?></p>
    <p>Patient Name :<?php echo $_SESSION['pname'];?></p>
</h3>

   <br>
   
<!-- 
   <form name="add" action="add_patient.php">
		<input class = "left" name = "add_patient" type="submit" value="Add Patient"></input>
   </form> 
   

   <form name="update" action="update_patient.php">
   		<input class="right" name = "update_details" type="submit" value="Update patient details"></input>
   </form>
<br> -->
   <form name="add" action="prescription.php" method="POST">
		<input id = "left" name = "prescription" type="submit" value="Presciption"></input>
   </form> 
   

   <form name="update" action="visitlog_updated.php" method="POST">
   		<input id="right" name = "visit_log" type="submit" value="Visit log"></input>
   </form>


   <form name="prev" action="select_visit_date.php" method="POST">
      <input id="left" name = "previous prescription" type="submit" value="Previous prescription"></input>
   </form>


   <form name="update" action="record_nextvisit.php" method="POST">
      <input id="right" name = "previous visits" type="submit" value="Previous Visits"></input>
   </form>
   <br>
<form method="POST" action="choose_patient.php">
  <input type="submit" value="Back"></input>
</form>
</div>
</center>
<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>