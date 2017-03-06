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
</style>
</head>
<body>

<div id="header">
<h1>MedAgent</h1>
<h2><i>Your Medical Companion</i></h2>
</div>


<div id="outer">

<div id="section">
<h2 style="text-align:center;">Visit Log</h2>

<div>
  <form action="action_page.php">

    <b><table>
        <tr>
        <td>
        <label for="name">Today's Date :</label>
        </td>
        <td>
        <input type="text" id="date" name="date"  readonly value = "<?php echo date("d/m/Y") ?>">
        </td>
        </tr>
        </table>
    </b>

    <label for="Stid">Enter Patient Id :</label>
    <input type="text" pid="wid" name="wid">

    <label for="name">Enter Current Sugar Level :</label>
    <input type="text" id="pid" name="pid">

    <label for="name">Enter Blood Pressure :</label>
    <input type="text" id="dadd" name="dadd"/>


    <input type="submit" value="Submit">
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




