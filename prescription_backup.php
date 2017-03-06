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
    width:800px;
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

#meds {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;

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
    border-style: solid;
    border-color: black;
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

            function getslot($value){

              if($value == "Before")
                $slot = "b";
              else if($value == "After")
                $slot = "a";
              else
                $slot = "n";

              return $slot;

            }


            function getslotvalue($value){

              if($value == "b")
                $slot = "Before";
              else if($value == "a")
                $slot = "After";
              else
                $slot = "None";

              return $slot;

            }
   $pid = $_SESSION['pid'];

            if(isset($_POST['prescription'])){
              //echo "string";
              $sql = "SELECT * FROM prescription WHERE patient_id = $pid";
              $result = mysql_query($sql,$con);
              while($row = mysql_fetch_array($result,MYSQL_ASSOC))
              {
                $insert_query = "INSERT INTO prev_prescriptions(medicine,day,break_fast,lunch,dinner,no_of_dose,patient_id) VALUES ('".$row['medicene']."','".$row['day']."','".$row['break_fast']."','".$row['lunch']."','".$row['dinner']."',".$row['no_of_dose'].",$pid)";
                $r = mysql_query($insert_query,$con);
              }

              $sql = "DELETE FROM prescription WHERE patient_id = $pid";
              $result = mysql_query($sql,$con);

              }
   ?>

</head>
<body>
<div id="header">

<h1>MedAgent</h1>
<h2><i>Your Medical Companion</i></h2>

</div>
<div id="outer">

<div id="section">

  <center><div><p><h2>Prescription</h2></p></center>
   <form action="" method="POST">
   <table width="100%">
   <tr>
     <td> <b>Patient id : <?php echo $_SESSION['pid']; ?></b></td>
     <td style="text-align: right; padding-right: 10px;"><b>Date : <input id = "transparent" name = "day" value = <?php echo date('Y-m-d');?> readonly></b></td>
   </tr>
   <tr>
     <td> <b>Patient name : <?php echo $_SESSION['pname']; ?></b></td>
   </tr>
   </table>

   <br>
   <table id = "meds">
     <tr>
       <th>
         Sr.No.
       </th>
       <th width="20%">
         Medicine name
       </th>
       <th>
         Breakfast
       </th>
       <th>
         Lunch  
       </th>
       <th>
         Dinner
       </th>
       <th width="10%">
         Dosage
       </th>
      
     </tr>
     <?php

          if(isset($_POST['add']))
          {

            $med = $_POST['med'];
            $day = $_POST['day'];
            $breakfast = getslot($_POST['breakfast']);
            $lunch = getslot($_POST['lunch']);
            $dinner = getslot($_POST['dinner']);
            $dosage = $_POST['dosage'];
          /*  echo $med;
            echo $day;
            echo $breakfast;
            echo $lunch;
            echo $dinner;
            echo $dosage;
*/

            $sql = "INSERT INTO prescription(patient_id,medicene,day,break_fast,lunch,dinner,no_of_dose) VALUES ($pid,'$med','$day','$breakfast','$lunch','$dinner',$dosage)";
            $r = mysql_query($sql,$con);

            if($r)
              echo "done";
            else
              echo "string";
              $query = "SELECT * FROM prescription WHERE patient_id = $pid";
            $result = mysql_query($query,$con);
            if(mysql_num_rows($result) != 0)
            {
              //echo mysql_num_rows($result);

              while ($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
                echo "<tr>
                      <td>".$i++."</td>
                      <td><input id = 'transparent' type = 'text' value = ".$row['medicene']."></td>
                      <td><input id = 'transparent' type = 'text' value = ".getslotvalue($row['break_fast'])."></td>
                      <td><input id = 'transparent' type = 'text' value = ".getslotvalue($row['lunch'])."></td>
                      <td><input id = 'transparent' type = 'text' value = ".getslotvalue($row['dinner'])."></td>
                      <td><input id = 'transparent' type = 'text' value = ".$row['no_of_dose']."></td>
                      <tr>";
              }



            }
          }


     ?>
     <tr>
       <td>
         <?php echo $i++;?>
       </td>
       <td >
<!--          <select>
           <option>a</option>
           <option>b</option>
         </select> -->

           
    <?php 
     echo "<select name='med'>";
        $query = "SELECT * FROM medicene";
        $result = mysql_query($query,$con);
        while($row=mysql_fetch_array($result,MYSQL_ASSOC))
        {
            echo "<option value = ".$row['name'].">".$row['name']."</option>";
        }
        echo "</select>";
    ?>
       </td>
      <!--  <td>
         <table name = "meal" align="center" width="100%">
           <tr >
             <td id="meal">
               Breakfast
             </td>
            <!--  <td id="meal">
               <input type="checkbox"></input>
             </td> -->
             <!--  <td id="meal">
         <select>
            <option>None</option>
           <option>Before</option>
           <option>After</option>
         </select>
       </td>
           </tr>

           <tr >
             <td id="meal">
               Lunch
             </td>
             <td id="meal">
               <input type="checkbox"></input>
             </td>
              <td id="meal">
         <select>
            <option>None</option>
           <option>Before</option>
           <option>After</option>
         </select>
       </td>
           </tr>

           <tr >
             <td id="meal">
               Dinner
             </td> -->
             <!-- <td id="meal">
               <input type="checkbox"></input>
             </td> -->
           <!--    <td id="meal">
         <select>
            <option>None</option>
           <option>Before</option>
           <option>After</option>
         </select>
       </td>
           </tr>
         </table>
       </td> --> 
           <td>
         <select name = "breakfast">
            <option>None</option>
           <option>Before</option>
           <option>After</option>
         </select>
       </td>
           <td>
         <select name = "lunch">
            <option>None</option>
           <option>Before</option>
           <option>After</option>
         </select>
       </td>
           <td>
         <select name = "dinner">
            <option>None</option>
           <option>Before</option>
           <option>After</option>
         </select>
       </td>
         <td>
         <input name = "dosage" type="text"></input>
       </td>
     </tr>

   </table>
   <br>
   <input type = "submit" name = "add" value = "Add new medicine"></input>
   </form>
   <form action = "add_next_visit.php">
   <input type="submit" name ="submit" value="submit"></input>
  

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