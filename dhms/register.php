<?php
error_reporting(0);
require_once('include/config.php');

if(isset($_POST['submit']))
{ 
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$Password=$_POST['Password'];
$pass=md5($Password);
$RepeatPassword = $_POST['RepeatPassword'];

// Email id Already Exit

$usermatch=$dbh->prepare("SELECT mobile,email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
$usermatch->execute(array(':usreml'=>$email,':mblenmbr'=>$mobile)); 
while($row=$usermatch->fetch(PDO::FETCH_ASSOC))
{
$usrdbeml= $row['email'];
$usrdbmble=$row['mobile'];
}


if(empty($fname))
{
  $nameerror="Please Enter First Name";
}

 else if(empty($mobile))
 {
 $mobileerror="Please Enter Mobile No";
 }

 else if(empty($email))
 {
 $emailerror="Please Enter Email";
 }

else if($email==$usrdbeml || $mobile==$usrdbmble)
 {
  $error="Email Id or Mobile Number Already Exists!";
 }
  else if($Password=="" || $RepeatPassword=="")
 {
    
   $error="Password And Confirm Password Not Empty!";
 
 }
 else if($_POST['Password'] != $_POST['RepeatPassword'])
 {
  
   $error="Password And Confirm Password Not Matched";
 }

 
else{
$sql="INSERT INTO tbluser (fname,lname,email,mobile,password) Values(:fname,:lname,:email,:mobile,:Password)";

$query = $dbh -> prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':Password',$pass,PDO::PARAM_STR);

$query -> execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId>0)
{
echo "<script>alert('Registred successfully');</script>";
echo "<script>window.location.href='login.php'</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again.');</script>";
 }
}
 }
 
 ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <title>Fashi | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Oswald&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Oswald', sans-serif;
        }
        
    </style>
</head>

<body>
   
   <!-- Header Section Begin -->
    <?php include 'include/header.php'; ?>
    <!-- Header End -->

  <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                      <center><h4>Register</h4>
                             <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($succmsg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($succmsg); ?> </div><?php }?><br><br></center>
                    <div class="">
                        <div class="register-form">
                          
                            <form  class="comment-form" method="post">
                                <div class="row">
                                   <div class="group-input col-sm-6">
                                         <label for="name">First Name:</label>
                                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname; ?>" required="">
                                        <span style="color:red;"><?php echo $nameerror;?></span>
                                    </div>
                                   <div class="group-input col-sm-6">
                                         <label for="name">Last Name:</label>
                                        <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname; ?>" required="">
                                       
                                    </div>
                                 <div class="group-input col-sm-6">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required="">
                                        <span style="color:red;"><?php echo $emailerror;?></span>
                                    </div>

                                     <div class="group-input col-sm-6">
                                        <label for="mobile">Mobile:</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" value="<?php echo $mobile; ?>" required="">
                                       <span style="color:red;"><?php echo $mobileerror;?></span>
                                    </div>
                                    <div class="group-input col-sm-6">
                                        <label for="name">Password:</label>
                                        <input type="password" class="form-control" name="Password"
                                            id="Password" required="">
                                     
                                    </div>
                                    <div class="group-input col-sm-6">
                                <label for="con-pass">Confirm Password *</label>
                                <input type="password" class="form-control" name="RepeatPassword" id="RepeatPassword" required="">
                                     
                            </div>
                                    
                                </div>
                         <input type="submit" name="submit" id="submit" class="site-btn register-btn" value="Register Now">

                               
                            </form>
                            <div class="switch-login">
                            <a href="login.php" class="or-login">Or Login</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section Begin -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

  <style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #dd3d36;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #5cb85c;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
