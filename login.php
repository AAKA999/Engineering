<?php 
//Start the Session
 session_start();

     define('DB_HOST', 'localhost');
	 define('DB_NAME', 'hospital'); 
	 define('DB_USER','root'); 
	 define('DB_PASSWORD','');
	 
	 $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Database: " . mysql_error());
	 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); ?>


<html>
	<head>

		<title>
			LOGIN
		</title>
		<style>
#header {
    background-color:#303F9F;
    color:white;
    text-align:center;
    padding:5px;
}

#section {
    width:350px;
    float:left;
    padding:10px;	 	 
}
#aside{line-height:20px;
    background-color:#65cdff;
    height:650px;
    width:700px;
    float:right;
    padding:5px;	      
}


#footer {
    background-color:#303F9F;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}

   <meta charset="UTF-8">
    
<title>Sign-Up/Login Form</title>
  
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
 
   <link rel="stylesheet" href="normalize.css">

    
     
   <link rel="stylesheet" href="style.css">

    
    
   
 
 
 
  

</style>
	</head>

	<body>

	<center><h1>LOGIN</h1></center>
	<br>
	<br>
	<br>
		<form method="POST" action="">
		<p>
		Username:  
			<input name="login_id">
			</input>

		</p>

		<br>
		<br>

		<p>
		Password:  
			<input name="password" type="password">
			</input>

		</p>
		<br>
		<br>
		<p>
		  <input name = "submit" type = "submit" value="submit"></input>

		</form>

		<?php 
          //error_reporting(0);
          if(isset($_POST['submit']))
          {	
          	
		    $id = $_POST['login_id'];
		 $pass = $_POST['password'];

		 $query = "SELECT * FROM staff WHERE emp_id ='$id' && password = '$pass'";
		 $result = mysql_query($query,$con);
		 
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		 if( $data['role'] == 2)
		 	echo "<script>window.open('nurse.php','_self')</script>";
		 }


		?>

		 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  
      <script src="index.js"></script>


	</body>
</html>