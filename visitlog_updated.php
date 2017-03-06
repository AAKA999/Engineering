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
    width:900px;
    padding:0px;	 	 
}

#outer { width: 900px; }
#inner { width: 700px; margin: 0 auto; }

input[type=text], select {
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
    padding: 30px;
	margin:auto;
}
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    float: middle;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    text-align: center;
    padding: 8px;

}

#customers tr:nth-child(even){background-color: #f2f2f2}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    background-color: #65cdff;
    color: white;
}
#footer {
    background-color:#303F9F;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}

#ip{

    background-color: #f2f2f2;
    border: 0px;
    text-align: center;
    width: 50%;
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


<div id="outer">

<div id="section">
<h2 style="text-align:center;">Visit Log</h2>
<h3>
    <p>Patient ID :<?php echo $_SESSION['pid'];?></p>
    <p>Patient Name :<?php echo $_SESSION['pname'];?></p>
</h3>

<table id="customers">
    <tr>
        <th>Date</th>
        <th>OnDay Sugar Level</th>
        <th>Avg Sugar count</th>
        <th>Blood Pressure</th>
        
    </tr>

<?php
    $id = $_SESSION['pid'];
    $query = "SELECT * FROM visit_log WHERE pid = $id";
    $result = mysql_query($query,$con);
    while($row = mysql_fetch_array($result,MYSQL_ASSOC))
    {
        echo " <tr>
                <td><input id = 'ip' value = '".$row['entry_date']."' readonly/></td>
                <td><input id = 'ip' value = '".$row['current_blood_sugar']."' readonly /></td>
                <td><input id = 'ip' value = '".$row['avg_blood_sugar']."' readonly/></td>
                <td><input id = 'ip' value = '".$row['bp']."' readonly /></td>
                </tr>";
    }

?>
</table><br><br>

<form action = "patient_options.php"> <input type = "submit" value="Back"></input></form>
</div>
</div>
<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>




