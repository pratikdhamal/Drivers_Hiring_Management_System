<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
    {   
header('location:login.php');
}
else{


if(isset($_POST['submit']))
{
$fstname=$_POST['fname'];
$lname=$_POST['lname'];
$mobile=$_POST['mobile'];
$Address=$_POST['Address'];
if(empty($name))
 {
  $fname = "Enter First Name!";
 }

  $sql="update tbluser set fname=:fname,lname=:lname,mobile=:mobile,Address=:Address where id=:uid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fstname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':Address',$Address,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
//$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
echo "<script>alert('Profile has been updated.');</script>";
echo "<script> window.location.href =profile.php;</script>";
}


 ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <title>DHMS | My Profiles</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Oswald&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

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
                        <span>Profile Update</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
 $uid=$_SESSION['uid'];
$sql ="SELECT id, fname, lname, email, mobile, password, address, create_date from tbluser where id=:uid ";
$query= $dbh -> prepare($sql);
$query->bindParam(':uid',$uid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
$fname=$result->fname;
$lname=$result->lname;
$mobile=$result->mobile;
$email=$result->email;
$Address=$result->address;

}
}?>


    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                      <center><h4>Profile Update</h4></center>
                    <div class="">
                        <div class="register-form">
                          
                            <form  class="comment-form" method="post">
                                <div class="row">
                                   <div class="group-input col-sm-6">
                                         <label for="name">First Name:</label>
                                        <input type="text" class="form-control" name="fname" id="fname"  value="<?php echo $fname; ?>">
                                    </div>
                                   <div class="group-input col-sm-6">
                                         <label for="name">Last Name:</label>
                                         <input type="text" class="form-control" name="lname" id="lname"placeholder="Last Name" value="<?php echo $lname; ?>">
                                       
                                    </div>
                                 <div class="group-input col-sm-6">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" readonly>
                                    </div>

                                     <div class="group-input col-sm-6">
                                        <label for="mobile">Mobile:</label>
                                       <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="<?php echo $mobile; ?>">
                                    </div>
                                    <div class="group-input col-sm-6">
                                        <label for="Address">Address:</label>
                                       <input type="text" class="form-control" name="Address" id="Address"placeholder="Address" value="<?php echo $Address?>">
                                     
                                    </div>
                                    
                                    
                                </div>
                         <input type="submit" name="submit" id="submit" class="site-btn register-btn" value="Update Now">

                               
                            </form>
              
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
 <?php } ?>

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
