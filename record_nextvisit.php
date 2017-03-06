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

#outer { width: 800px; }
#inner { width: 700px; margin: 0 auto; }

input[type=text],select,option{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    float : center;
}


input[type=submit] {
    width: 75%;
    background-color: #65cdff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0px;
    border: none;
    float : center;
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

#meds {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 75%;

    float: middle;
    text-align: center;
}


#meds tr:nth-child(even){background-color: #f2f2f2}

#meds tr:hover {background-color: #ddd;}

#meds th {
    padding-top: 12px;
    padding-bottom: 12px;
    background-color: #65cdff;
    color: white;
    width: 50%;
    border-style: solid;
    border-color: black;
    float: center;
    margin: auto;
}

#meds td{
  border-style: solid;
  border-color: black;


}

#meal{
  border-style: 0px solid;
  border-color: white;
  border-width: 0px;
}

#transparent{
  background-color: #f2f2f2;
  border-width: 0px; 
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

     $i=1;
     $pid = $_SESSION['pid'];

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

  <center><div><p><h2>Record of Previous Visits </h2></p></div></center>
   <form action="" method="POST">
   
   <table width = "100%"> 
   <tr>
     <td> <b>Patient id : <?php echo $_SESSION['pid']; ?></b></td>
     <td style="text-align: right; padding-right: 10px;"><b>Date : <input id = "transparent" name = "day" value = <?php echo date('Y-m-d');?> readonly></b></td>
   </tr>
   <tr>
     <td> <b>Patient name : <?php echo $_SESSION['pname']; ?></b></td>
   </tr>


   </table>

   <br>
   <center>
   <table id = "meds">
     <tr>
       <th>
         Sr.No.
       </th>
       <th>
         Visit Date
       </th>
       
     </tr>
     <?php

        $query = "SELECT * FROM visit_dates WHERE patient_id = $pid";
        $result = mysql_query($query,$con);

        while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
          echo "<tr>
                <td>".$i++."</td>
                <td>".$row['visit_date']."</td>
          </tr>";
        }


     ?>
   </table>
   <br>
   
   </form>
   <form action = "patient_options.php">
   <input type="submit" name ="Back" value="Back"></input>
  

</form>
</center>
</div>
</div>
</div>

<div id="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>