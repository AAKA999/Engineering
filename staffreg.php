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
}

input[type=submit]:hover {
    background-color: #3F51B5;
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
</style>
</head>
<body>

<div id="header">
<h1>MedAgent</h1>
<h2><i>Your Medical Companion</i></h2>
</div>


<div id="outer">

<div id="section">
<h2 style="text-align:center;">Staff Registration </h2>

<div>
  <form action="action_page.php">
    <label for="Stid">Enter Name :</label>
    <input type="text" id="Stid" name="stid">

    <label for="name">Enter Name :</label>
    <input type="text" id="name" name="name">

<label for="name">Contact Number :</label>
    <input type="text" id="name" name="name">

<label for="name">Residential Address :</label>
    <input type="text" id="name" name="name">

<label for="name">Enter Role Id :</label>
    <input type="text" id="name" name="name">

<label for="name">Internal/external doc :</label>
    <input type="text" id="name" name="name">


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




