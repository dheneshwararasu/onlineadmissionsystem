<?php
session_start();
$con=mysqli_connect("localhost","root","","oas");
if(!isset($con))
{
    die("Database Not Found");
}

// Set a maximum number of attempts before locking out the user
$max_attempts = 8;

// Check if the user has exceeded the maximum number of attempts
if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= $max_attempts) {
    // Lock out the user and display an error message
    echo 'You have exceeded the maximum number of attempts. Please try again later.';
    exit;
}

if(isset($_REQUEST["u_sub"]))
{
 // Check if the username and password are valid   
 $id=$_POST['u_id']; //user ID field input data --> ' OR 1=1 OR ''=' | ' OR 1 = 1 LIMIT 1 -- ' ]
 $pwd=$_POST['u_ps']; //password field input data  --> ' OR 1=1 OR ''=' | ' OR 1 = 1 LIMIT 1 -- ' ]

if (isset($_SESSION['id']))
{
    header("location:admin.php");  //this is the update to prevent redirection
    header("location:adlogout.php");
    header("location:adminac.php");
    header("location:adminlogin.php");
    header("location:viewdoc.php");
    header("location:viewform.php");
    header("location:viewresult.php");
    header("location:homepageuser.php");
}

 if($id!=''&&$pwd!='')
 {
   $username = mysqli_real_escape_string($con, $id);
   $password = mysqli_real_escape_string($con, $pwd);

   $query=mysqli_query($con ,"select * from t_user_data where s_id='$username' and s_pwd='$password'");
   $res=mysqli_fetch_row($query);

   $query1=mysqli_query($con ,"select * from t_user where s_id='$username'");
   $res1=mysqli_fetch_row($query1);

   if($res)
   {
    $_SESSION['user']=$id;
    header('location:admsnform.php');
   }
   else
   {
    // If the credentials are incorrect, increment the failed attempts counter
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 1;
    } else {
        $_SESSION['failed_attempts']++;
    }
    echo '<script>';
    echo 'alert("Invalid username or password. Please try again.")';
    echo '</script>';
   }
   
   if($res1)
   {
    $_SESSION['user']=$id;
    header('location:homepageuser_Ahmad.php');
   }
   else
   {
    // If the credentials are incorrect, increment the failed attempts counter
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 1;
    } else {
        $_SESSION['failed_attempts']++;
    }
    echo '<script>';
    echo 'alert("Invalid username or password. Please try again.")';
    echo '</script>';
   }
  }
 else
 {
    echo '<script>';
    echo 'alert("Enter both username and password")';
    echo '</script>';
 
 }
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link type="text/css" rel="stylesheet" href="css/login.css">
		</link>
		<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
		<script src="bootstrap/jquery.min.js"></script>
		<script src="bootstrap/bootstrap.min.js"></script>
		<title></title>
	</head>
	<body style="background-image:url('./images/inbg.jpg');">
		<form id="index" action="index_Ahmad.php" method="post">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<img src="images/cutm.jpg" width="100%" style="box-shadow: 1px 5px 14px #999999; "></img>
					</div>
				</div>
				<div id="divtop">
					<br><br><br><br><br><br><br><br><br><br><br>
					<div id="dmain">
						<center>
							<img src="./images/loginuser.png" width="120px" height="100px">
						</center>
						<br>
						<input type="text" id="u_id" name="u_id" class="form-control" style="width:300px; margin-left: 66px;" placeholder="Enter Your User ID">
						<br>
						<input type="password" id="u_ps" name="u_ps" class="form-control" style="width:300px; margin-left: 66px;" placeholder="Enter Your Password">
						<br>
						<input type="submit" id="u_sub" name="u_sub" value="Login" class="toggle btn btn-primary" style="width:100px; margin-left: 110px;">
						<a href="signup.php" style="margin-left: 30px;">Sign Up </a>
					</div>
				</div>
			</div>
			</div>
			</div>
			</div>
		</form>
	</body>
</html>
