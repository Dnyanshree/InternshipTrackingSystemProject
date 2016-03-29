<?php
session_start();
require('connect.php');

$invalid=0;
$register=0;
  if(isset($_POST['signupform']))
  {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name= $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
   /* ch $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zip_code = $_POST['zip_code']; */

    /*------------student details---------*/
    /* ch $major = $_POST['major'];
    $current_semester = $_POST['current_semester'];
    $gpa = $_POST['gpa']; */

    /*--------------login details------------*/
    $username = $_POST['username'];
    $password=md5($_POST['password']); // Encrypted password
	$activation=md5($email.time()); // Encrypted email+timestamp

    $stmt = $db->prepare("SELECT username FROM login as L , person as P where P.person_id=L.person_id AND (L.username=:username OR P.email=:email) ");
  	$stmt->execute(array(':username'=>$username,
  						':email'=>$email));
  	$result = $stmt->fetch();
	
	
	/*$stmt1 = $db->prepare("SELECT email FROM person WHERE email =:em");
	$stmt1->execute(array(':em'=>$email));
	$result1 = $stmt1->fetch();*/
	
	
  	if(empty($result))
  	{
		
		/*ch in insert query below..only few columns kept others deleted*/
	    $sql = "INSERT INTO person (person_type,first_name, middle_name, last_name, phone, email) VALUES ( :person_type,:first_name, :middle_name, :last_name, :phone, :email)";
	    $q = $db->prepare($sql);
	   
	    $q->execute(array(':person_type'=>"student",
	                     ':first_name'=>$first_name,
	                     ':middle_name'=>$middle_name,
	                     ':last_name'=>$last_name,
	                     ':phone'=>$phone,
	                     ':email'=>$email,
	                     ));
	   /* ch in above execute statement--unwanted fields removed */
	    $person_id = $db->lastInsertId(); 

	$query1 = "SELECT * FROM `person` WHERE `email` = '$email'";

	$result = mysql_query($query1);



	if ( mysql_num_rows ($result) == 1 )
	{
	$value="Already registered"; $success=0;
	}
	
	else{
	    $sql = "INSERT INTO login (person_id,username,password) VALUES (:person_id,:username,:password )";
	    $q = $db->prepare($sql);    
	    $q->execute(array(':person_id'=>$person_id,
	    				 ':username'=>$username,
	    				 ':password'=>$password
	                    ));
	    /* ch in below code. removed insert into student table query
		$sql = "INSERT INTO student (person_id,major,current_semester,gpa) VALUES (:person_id,:major,:current_semester,:gpa )";
	    $q = $db->prepare($sql);    
	    $q->execute(array(':person_id'=>$person_id,
	    				 ':major'=>$major,
	    				 ':current_semester'=>$current_semester,
	    				  ':gpa'=>$gpa,
	                    )); */
						
		$success=1;
		}

		$to=$email;
		$subject="Email verification";
		$body='Hi, <br/> <br/> We need to make sure you are human. Please verify your email and get started using your Website account. <br/> <br/> <a href="http://localhost/email_activation2/activation.php?code='.$activation.'">'.$base_url.'activation/'.$activation.'</a>';
		mail($to,$subject,$body,'From:');

		$msg= "Registration successful, please activate email.";	
		

    }
    else 
	{
		if(!empty($result['username'])){
		echo "username cannot be same$username";
		}
		else{
			echo "email can not be same $email";
		}
	}
    
  }

if (isset($_POST['loginform']))
{
	$username = $_POST['username'];
	$password= md5($_POST['password']);

	$stmt = $db->prepare("SELECT * FROM login as L , person as P WHERE L.person_id=P.person_id AND L.username=:username AND L.password = :password");
	$stmt->execute(array(':username' => $username,
						':password' => $password
		));
	$row = $stmt->fetch();
	
	$person_id=$row['person_id'];
	

	if (!empty($row))
	{
		
		$sql = "UPDATE login SET lastlogin=? WHERE login_id=?";
		$q = $db->prepare($sql);
		$q->execute(array(date("Y-m-d H:i:s"),$row['login_id']));
		
		$_SESSION['username'][] = array();
		$_SESSION['username']['uname'] = $username;
		$_SESSION['username']['qry'] = $row;
		$_SESSION['username']['timestamp'] = $row['lastlogin'];

	}
	else
	{
		$invalid=1;
	}
}
if (isset($_SESSION['username'])){

	$result = $_SESSION['username']['qry'];
	//$result = $stmt->fetch();
	if($result['person_type']=="supervisor")
	{
		header('Location: profile.php');
	}
	else if($result['person_type']=="student")
	{
		
		$stmt = $db->prepare("SELECT student_id FROM student  WHERE person_id= :person_id");
		$stmt->execute(array(':person_id' => $person_id
			));
			
		$row = $stmt->fetch();
		if(empty($row['student_id']))
		{
				header('Location: courseDetail.php');
		}
		else
		{
						
			header('Location: profile.php');
		}
		
	}
	else if($result['person_type']=="admin")
	{
		//header('Location: adminLanding.php');
		header('Location: profile.php');
	}

	print_r($_SESSION['login_id'])  ;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login | Internship Tracking System</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <style type="text/css">
	.vid-container{
	  position:relative;
	  height:100vh;
	  overflow:hidden;
	}
	.bgvid{
	  position:absolute;
	  left:0;
	  top:0;
	  width:100vw;
	}
	.inner-container{
	width: 400px;
	position: absolute;
	top: calc(50vh - 200px);
	left: calc(50vw - 200px);
	overflow: hidden;
	height: 386px;
	}
	</style>
<script type="text/javascript">

var vid = document.getElementById("bgvideo");
    bgvideo.pause(); 

</script>
</head>

  <body class="login-img3-body">
  
  <video id="bgvideo" class="bgvid" autoplay muted="muted" preload="auto" >
	<source src="videoplayback4.mp4" type="video/webm">
  </video>

  <div id="login" class="inner-container" style="height:auto" >    
    <div class="container">
      <form class="login-form form-validate" id="login_form" action="index.php" novalidate="novalidate" method="post">        
        <div class="login-wrap">
            <p class="login-img"><img src="img/logo.png"></p>
			<?php if($success==1) {?>
			<p style="color:gold;font-size:16px">Signup Successful. Please Login.</p>
			<?php  } ?>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" id="username" name="username" required autofocus >
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <?php if($invalid==1)
					echo "<span style='color:#FD8700'> Invalid Username OR Password </span>";
			?>
            <label class="checkbox" style="color:#fff">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#" style="color:#fff!important"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="loginform">Login</button>
            <button id="signupbtn" class="btn btn-info btn-lg btn-block" onClick="return false" >Student Signup</button>
        </div>
      </form>

    </div>
</div>
  <div id="signup" class="inner-container" style="display:none;height:auto;top: calc(30vh - 200px);">    
    <div class="container">
      <form class="login-form form-validate" id="signup_form" action="index.php" novalidate="novalidate" method="post" >        
        <div class="login-wrap">
            <p class="login-img"><img src="img/logo.png"></p>
      <center><h2 style="color:#fff">STUDENT SIGNUP</h2></center>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="text" class="form-control" placeholder="First Name" id="firstname" name="first_name" required autofocus >
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="text" class="form-control" placeholder="Middle Name" id="middlename" name="middle_name" required autofocus >
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="text" class="form-control" placeholder="Last Name" id="lastname" name="last_name" required autofocus >
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="text" class="form-control" placeholder="Username" id="username" name="username" required autofocus >
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="password" class="form-control" placeholder="Password" id="password" name="password" required autofocus >
            </div>
			<!-- /*ch added phn and email */ -->
			<div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" required autofocus >
            </div>
			<div class="input-group">
              <span class="input-group-addon"><i class="icon_ribbon"></i></span>
              <input type="text" class="form-control" placeholder="Email" id="email" name="email" required autofocus >
            </div>
            <?php if($invalid==1)
					echo "<span style='color:#FD8700'> Invalid Username OR Password </span>";
			?>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="signupform">Signup</button>
            <span style="color:#fff">Already Registered?</span>
            <button class="btn btn-info btn-lg btn-block" id="loginbtn" onClick="return false" >Login</button>
        </div>
      </form>

    </div>
</div>

  </body>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
        $("#login_form").validate();
        $("#signup_form").validate();
		
	$(function() {
 
    $( "#signupbtn" ).click(function() {
      $( "#signup" ).show(1000);
      $( "#login" ).hide();
    });
 
    $( "#loginbtn" ).click(function() {
      $( "#login" ).show(1000);
      $( "#signup" ).hide();
    });

  });</script>

</html>
