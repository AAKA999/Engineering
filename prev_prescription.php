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

</head>
<body>
<div id="header">

<h1>MedAgent</h1>
<h2><i>Your Medical Companion</i></h2>

</div>
<div id="outer">

<div id="section">

  <center><div><p><h2>Previous Prescription </h2></p></div></center>
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
     <tr>
       <td>
         <?php echo $i++;?>
       </td>
       <td >
<!--          <select>
           <option>a</option>
           <option>b</option>
         </select> -->
<input name = "Medicine name" type="text"></input>
           
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
           <input name = "breakfast" type="text"></input>
       </td>
           <td>
           <input name = "lunch" type="text"></input>
       </td>
           <td>
         <input name = "dinner" type="text"></input>
       </td>
         <td>
         <input name = "dosage" type="text"></input>
       </td>

     </tr>

   </table>
   <br>
   
   </form>
   <form action = "patient_options.php">
   <input type="submit" name ="Back" value="Back"></input>
  

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