<!DOCTYPE html>
<html>
<head>

<style>

</style>
   <meta charset="UTF-8">
    
<title>MedAgent</title>
  
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
 
   <link rel="stylesheet" href="css/normalize.css">

    
     
   <link rel="stylesheet" href="css/style.css">

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


<div class="header">
<h1><b>MedAgent</b></h1>
<h2><i>Your Medical Companion</i></h2>
</div>

<div class="aside">
  <div class="form">
      

      <ul class="tab-group">
     
   <li class="tab active"><a href="#signup">Sign Up</a></li>
 
       <li class="tab"><a href="#login">Log In</a></li>
    
  </ul>
      
 
     <div class="tab-content">
  
      <div id="signup">   
                   
 <!--form-->
         <form action="" method="post" name = "signup">
   
       
          <div class="top-row">
      
      <div class="field-wrap">
           
   <label>
              
  First Name<span class="req">*</span>
     
         </label>
            
  <input name = "fname" type="text" required autocomplete="off" />
   
         </div>
        
  
          <div class="field-wrap">
     
         <label>
    
            Last Name<span class="req">*</span>
      
        </label>
         
     <input name="lname" type="text"required autocomplete="off"/>
  
          </div>
   
       </div>

          
<div class="field-wrap">
    
        <label>
            
  Email Address<span class="req">*</span>
           
 </label>
   
         <input name="email" type="email"required autocomplete="off"/>
  
        </div>
          

          <div class="field-wrap">
        
    <label>
            
  Set A Password<span class="req">*</span>

            </label>
     
       <input name="pass" type="password"required autocomplete="off"/>
   
       </div>

        <div class="field-wrap">
        
    <label>
            
  Enter Contact Number<span class="req">*</span>

            </label>
     
       <input name = "contact" required autocomplete="off"/>
   
       </div>
  
  

   <div class="top-row">
      
      <div class="field-wrap">
           
   
  <select name = "emp_type" id = 'a'>

      <?php 
        $query = "SELECT * FROM role ";
        $result = mysql_query($query,$con);
        while($row=mysql_fetch_array($result,MYSQL_ASSOC))
        {
            echo "<option value = ".$row['role_name'].">".$row['role_name']."</option>";
        }
    ?>
  
  </select>
   
         </div>
        
  
          <div class="field-wrap">
     
      
          <select name = "specialization">

      <?php 

        $query = "SELECT * FROM specialization";
        $result = mysql_query($query,$con);
        while($row=mysql_fetch_array($result,MYSQL_ASSOC))
        {  
          
            echo "<option value = ".$row['spl_name'].">".$row['spl_name']."</option>";
            
        }
    ?>
  </select>
  
          </div>
   
       </div>

        
          <button type="submit" class="button button-block" name = "submit"/>Get Started</button>
  
        
          
          <?php 
          //error_reporting(0);
   if(isset($_POST['submit']))
    { 
       
       $email = $_POST['email'];
       $pass = $_POST['pass'];
       $fname = $_POST['fname'];
       $lname = $_POST['lname'];
       $contact = $_POST['contact'];
       $emp = $_POST['emp_type'];
       $spl_name = $_POST['specialization'];
        //echo $spl_name;
       $query = "SELECT role_id FROM role WHERE role_name = '$emp' LIMIT 1";
       $result = mysql_query($query,$con);
       $bid = mysql_num_rows($result);
       while($bid != 0)
      {
        $data = mysql_fetch_array($result);
        $role =  $data['role_id'];
        $bid--;
      }

      $query = "SELECT spl_id FROM specialization WHERE spl_name = '$spl_name'";
      $result = mysql_query($query);
      $did = mysql_num_rows($result);
      //echo $did;
      while($did != 0)
      {
        $data = mysql_fetch_array($result);
        $spl_id = $data['spl_id'];
        $did--;
      }
             
      $query = "INSERT INTO staff(email_id,password,emp_name,emp_last,emp_contact,specialization,role)VALUES('$email','$pass','$fname','$lname',$contact,$spl_id,$role)";
      $result = mysql_query($query,$con);
      if($result)
      { 
        $id = mysql_insert_id();
      }

     $query = "SELECT * FROM staff WHERE emp_id ='$id'";
     $result = mysql_query($query,$con);
     
     $data=mysql_fetch_array($result,MYSQL_ASSOC);
     if( $data['role'] == 2)
      echo "<script>window.open('patient_list.php','_self')</script>";

      else
        echo "<script>window.open('choose_patient.php','_self')</script>";
    }


    ?>
</form><!--formends-->

  
      </div>
        
 
       <div id="login">   
    
      <h1>Welcome Back!</h1>
      <!--form-->
    
          <form action="" method="post" name = "login">
     
     
            <div class="field-wrap">
  
          <label>
       
       Email Address<span class="req">*</span>
  
          </label>
        
    <input type="email" name = "email" required autocomplete="off"/>
       
   </div>
 
         
          <div class="field-wrap">
      
      <label>
        
      Password<span class="req">*</span>
   
         </label>
     
       <input type="password" name="pass" required autocomplete="off"/>
         
 </div>
          

          <p class="forgot"><a href="#">Forgot Password?</a></p>
      
    
          <button class="button button-block" type="submit" name = "submit1" />Log In</button>
          <?php 
          //error_reporting(0);
          if(isset($_POST['submit1']))
          { 
            
        $email = $_POST['email'];
     $pass = $_POST['pass'];

     $query = "SELECT * FROM staff WHERE email_id ='$email' && password = '$pass'";
     $result = mysql_query($query,$con);
     
    $data=mysql_fetch_array($result,MYSQL_ASSOC);

     if( $data['role'] == 2)
      echo "<script>window.open('patient_list.php','_self')</script>";
    else if( $data['role'] == 1)
      echo "<script>window.open('choose_patient.php','_self')</script>";

     }


    ?>

        
  
          </form><!--formends-->

  
      </div>
       
 
      </div><!-- tab-content -->
    
  
</div> <!-- /form -->
 
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  
      <script src="js/index.js"></script>



</div>

<div class="section">
<h2>WELCOME TO MedAgent Desktop</h2>
<p>MedAgent will help you manage your patient records with ease</p>
<p>It will help you add new patients along with the generation of prescriptions</p>
<p>MedAgent provides features such as adding new patient, prescription generation, view medical history and many more</p>
<p><b>SIGN UP<b> to use MedAgent</p>
<p><b>LOG IN</b> if you already have an account</p>
</div>

<div class="footer">
<p><a>About US</a> | <a>Contact Us</a> | <a>Privacy Policy</a> </p>
      <p>Copyright &copy; MedAgent</p>
</div>

</body>
</html>