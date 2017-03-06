<!DOCTYPE html>
<html>
<head>
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

input[type=text], select, option {
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

<?php 
  
  $pname = $_POST['patient_name'];
  $cno = $_POST['contact'];
  $bloodgroup = $_POST['bgroup'];
  $disease = $_POST['disease'];
  
  $query = "SELECT b_id FROM blood_group_info WHERE blood_group_name = '$bloodgroup'LIMIT 1";
  $result = mysql_query($query,$con);
  $bid = mysql_num_rows($result);
  while($bid != 0)
  {
    $data = mysql_fetch_array($result);
    $blood_id =  $data['b_id'];
    $bid--;
  }

  $query = "SELECT * FROM diseasetable WHERE disease_name = '$disease'";
  $result = mysql_query($query);
  $did = mysql_num_rows($result);
  while($did != 0)
  {
    $data = mysql_fetch_array($result);
    $disease_id = $data['disease_id'];
    $did--;
  }


  $query = "INSERT INTO patient(patient_name,patient_phone,blood_group,disease)VALUES('$pname',$cno,$blood_id,$disease_id)";
  $result = mysql_query($query,$con);
  if($result)
  { 
    $PATIENT = mysql_insert_id();

  }

  $_SESSION['pid'] = $PATIENT;
  //echo  $_SESSION['pid'];

?>


<div id="outer">

<div id="section">
<br>
<h1 style="text-align:center;">PATIENT ID : <?php echo $PATIENT;?> </h1>
<br>
<br><br><br><br><br><br><br>
<form action = "add_timing.php">
 <input type = "submit" name = "timing" value="Next >>"></input>
</form>
</div>
</div>
  
<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>




