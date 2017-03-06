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

#date{
    
    border: 0px ;
    border-radius: 0px;
    box-sizing: border-box;
    background-color: #f2f2f2

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

<div>
  <form method = "POST" action="">

    <b><table>
        <tr>
        <td>
        <label for="name">Today's Date :</label>
        </td>
        <td>
        <input type="text" id="date" name="date"  readonly value = "<?php echo date("Y-m-d")?>">
        </td>
        </tr>
        </table>
    </b>

    <label for="Stid">Enter Patient Id :</label>
    <input type="text" id="pid" name="pid">

    <label for="name">Enter Current Sugar Level :</label>
    <input type="text" id="sugar" name="sugar">

    <label for="name">Enter Blood Pressure :</label>
    <input type="text" id="bp" name="bp"/>


    <input type="submit" value="Submit" name = "submit">

    <?php

        if (isset($_POST['submit'])) {

            $pid = $_POST['pid'];
            $_SESSION['pid'] = $pid;

              $query = "SELECT * FROM daily_log WHERE patient_id = $pid";
            $result = mysql_query($query,$con);

             while($row = mysql_fetch_array($result,MYSQL_ASSOC))
              {
                $insert_query = "INSERT INTO prev_daily_log(update_date,sugar_count,sugar_goal,patient_id) VALUES ('".$row['update_date']."',".$row['sugar_count'].",'".$row['sugar_goal']."',$pid)";
                $r = mysql_query($insert_query,$con);
              }

            
             $sugar = $_POST['sugar'];
             $bp = $_POST['bp'];
             $day = $_POST['date'];
             //echo $day;

             $query = "INSERT INTO visit_log (current_blood_sugar,avg_blood_sugar,bp,entry_date,pid) VALUES ($sugar,1,$bp,'$day',$pid)";
             $result = mysql_query($query,$con);
           
               // echo "done";
             include("android/sugar_average_function.php");
             
         } 


    ?>
  </form>

  <form method="POST" action="patient_list.php">
  <input type="submit" value ="Back to Patient Page"></input>
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




