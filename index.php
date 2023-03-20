<?php
session_start();

//include 'dbcontroller.php';

$con=mysqli_connect("localhost","root","","oas");
if(!isset($con))
{
    die("Database Not Found");
}
//$login = FALSE;



if(isset($_REQUEST["u_sub"]))
{
    
 $id=$_POST['u_id'];
 $pwd=$_POST['u_ps'];


   $res = mysqli_query($con, "SELECT * FROM t_user_data WHERE s_id = '$id'");
   $res1 = mysqli_query($con, "SELECT * FROM t_user WHERE s_id = '".$id."'");
   //$res1=mysqli_query($con ,"select * from t_user where s_id='".$id."'");

    if(mysqli_num_rows($res)>0){


        $row = mysqli_fetch_assoc($res);

        $verify = password_verify($pwd, $row['s_pwd']);

        if($verify == 1){
           // echo "DONE";\
            echo '<script>';
            echo 'alert("Login Sucessful")';
            echo '</script>';
            header('location:admsnform.php');
        }else{
           // echo "Please enter correct pasword";
            echo '<script>';
            echo 'alert("Please enter correct pasword")';
            echo '</script>';
        }
    }else{
        //echo "please enter correct username";
        echo '<script>';
        echo 'alert("please enter correct username")';
        echo '</script>';
    }
#created a passweord verify to verify the encrypted password
    if(mysqli_num_rows($res1)>0){
        $row1 = mysqli_fetch_assoc($res1);

        $verify1 = password_verify($pwd, $row1['s_pwd']);

        if($verify1 == 1){
           // echo "DONE";\
            echo '<script>';
            echo 'alert("Login Sucessful")';
            echo '</script>';
            header('location:homepageuser.php');
        }else{
           // echo "Please enter correct pasword";
            echo '<script>';
            echo 'alert("Please enter correct pasword")';
            echo '</script>';
        }
    }else{
        //echo "please enter correct username";
        echo '<script>';
        echo 'alert("please enter correct username")';
        echo '</script>';
    }
}



?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="css/login.css"></link>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
       <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>

       
        <title></title>
        
        
        
    </head>
    <body  style="background-image:url('./images/inbg.jpg');" >
        <form id="index" action="index.php" method="post">
            
            <div class="container-fluid">    
                <div class="row">
                  <div class="col-sm-12">
                        <img src="images/cutm.jpg" width="100%" style="box-shadow: 1px 5px 14px #999999; "></img>
                  </div>
                 </div>    
             
        
            
            
                <div  id="divtop">
                    
                        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
                            <div id="dmain"  > 
                               <center><img src="./images/loginuser.png" width="120px" height="100px" ></center>
                                <br>
                                    <input type="text" id="u_id" name="u_id" class="form-control" style="width:300px; margin-left: 66px;" placeholder="Enter Your User ID"><br>
                                    <input type="password" id="u_ps" name="u_ps" class="form-control" style="width:300px; margin-left: 66px;" placeholder="Enter Your Password"><br>
                                    <input type="submit" id="u_sub" name="u_sub" value="Login" class="toggle btn btn-primary" style="width:100px; margin-left: 160px;"><br>
                                    <a href="signup.php" style="margin-left: 180px;">Sign Up </a>
                             </div>
                     </div>
                    </div>
               </div>
            </div>  
            </div>
        </form>  
       </body>
</html>
