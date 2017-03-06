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
    width:900px;
    float:middle;
    padding:7px;	 	 
}

#outer { width: 1000px; }
#inner { width: 500px; margin: 0 auto; }

input[type=text], select, option {
    width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    float: middle;

}

#pid{
	width: 15%;
    padding: 2px 2px;
    margin: 8px 0;
    display: inline;
    border: 0px ;
    border-radius: 0px;
    box-sizing: border-box;
    background-color: #f2f2f2 ;
}

.inputlabel{
	width: 25%;
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


	if(isset($_POST['edit']))
	{
		$id = $_POST['pid'];
		$name = $_POST['pname'];
		$no = $_POST['pno'];

		$query = "UPDATE patient SET patient_name = '$name', patient_phone = $no WHERE patient_id = $id";
		$result = mysql_query($query,$con);
		if($result)
		{
			$query1 = "SELECT * FROM patient WHERE patient_id = $id ";
			$result1 = mysql_query($query1,$con);

		 	while($row = mysql_fetch_array($result1,MYSQL_ASSOC))
			{
				$pid = $row['patient_id'];
				$pname = $row['patient_name'];
				$phone = $row['patient_phone'];

			}
		}
		else
			echo "Failed";
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
<h2 style="text-align:center;">Changes Saved</h2>

<div>

<form name = "search" method="POST" action="edit_patient_details.php">
<input name = "1" value = <?php echo $pid;?> type = "hidden"></input>
<input name = "2" value = <?php echo $pname;?> type = "hidden"></input>
<input name = "3" value = <?php echo $phone;?> type = "hidden"></input>

<table width = "100%" border="0px">

	<tr>
		<td class ="inputlabel">
 			<b>
 			<label for="name">Patient Id :</label>
 			<input id="pid" name = "pid" type = "text" value = <?php echo $pid;?> readonly  ></input>
			</b>
		</td>
	</tr>

	<tr>
		<td class ="inputlabel">
			<label for="name">Patient Name :</label>

		</td>
		<td>
			<input id="pid" type = "text" name = "pname" value=<?php echo $pname;?> ></input>
		</td>
	</tr>	

	<tr>
		<td class ="inputlabel">
			<label for="name">Patient Contact Number :</label>

		</td>
		<td>
			<input id="pid" type = "text" name = "pno" value =<?php echo $phone;?> ></input>
		</td>
	</tr>	
</table>
<br>

<center><input type="submit" name ="edit" value="Edit Again"></input></center>



</form>
<center><form><input type="submit" name ="edit" value="Select new patient" formaction="update_patient.php"></input></form></center>

<center><form><input type="submit" name ="edit" value="Select new operation" formaction="patient_list.php"></input></form></center>
</div>

</div>
</div>
<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>



</body>
</html>