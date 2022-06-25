<?php
error_reporting(0);
require_once('include/config.php');

if(isset($_POST['submit']))
{ 
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$LicenseNo=$_POST['LicenseNo'];
$uploadLicenseNo=$_POST['uploadLicenseNo'];
$UploadPhoto=$_POST['UploadPhoto'];
$Password=$_POST['Password'];
$pass=md5($Password);
$RepeatPassword = $_POST['RepeatPassword'];
$Address=$_POST['Address'];
// Email id Already Exit

$usermatch=$dbh->prepare("SELECT mobile,email FROM tbluserdrivers WHERE (email=:usreml || mobile=:mblenmbr)");
$usermatch->execute(array(':usreml'=>$email,':mblenmbr'=>$mobile)); 
while($row=$usermatch->fetch(PDO::FETCH_ASSOC))
{
$usrdbeml= $row['email'];
$usrdbmble=$row['mobile'];
}


if(empty($name))
{
  $nameerror="Please Enter Name";
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
 else if(empty($LicenseNo))
 {
 $LicenseNoerror="Please Enter LicenseNo";
 }

// /* else if(empty($uploadLicenseNo))
//  {
//  $uploadLicenseNoerror="Please Enter Upload License No";
//  }
// */
//  /*else if(empty($UploadPhoto))
//  {
//  $UploadPhotoerror="Please Enter Upload Photo";
//  }*/

//  else if($Password=="" || $RepeatPassword=="")
//  {
    
//    $error="Password And Confirm Password Not Empty!";
 
//  }
//  else if($_POST['Password'] != $_POST['RepeatPassword'])
//  {
  
//    $error="Password And Confirm Password Not Matched";
//  }

 else if(empty($Address))
 {
 $Addresserror="Please Enter Address";
 }


 else{
    $file = rand(1000,100000)."-".$_FILES['uploadLicenseNo']['name'];
    $file_loc = $_FILES['uploadLicenseNo']['tmp_name'];
    $file_size = $_FILES['uploadLicenseNo']['size'];
    $file_type = $_FILES['uploadLicenseNo']['type'];
    $folder="UploadLicense/";

    $new_size = $file_size/1024;  
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);
    if(move_uploaded_file($file_loc,$folder.$final_file))
    {

   $file = rand(1000,100000)."-".$_FILES['UploadPhoto']['name'];
    $file_loc_upload = $_FILES['UploadPhoto']['tmp_name'];
    $file_size = $_FILES['UploadPhoto']['size'];
    $file_type = $_FILES['UploadPhoto']['type'];
    $folderss="UploadPhoto/";
    $new_file_name_photo_upload = strtolower($file);
    $final_file_photo_upload=str_replace(' ','-',$new_file_name_photo_upload);
     if(move_uploaded_file($file_loc_upload,$folderss.$final_file_photo_upload))
     {

$sql="INSERT INTO tbluserdrivers (name,mobile,email,LicenseNo,uploadLicenseNo,UploadPhoto,Password, Address) Values(:names,:mobile,:emailid,:LicenseNo,:uploadLicenseNo,:UploadPhoto,:Password,:Address)";

$query = $dbh -> prepare($sql);
$query->bindParam(':names',$name,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':emailid',$email,PDO::PARAM_STR);
$query->bindParam(':LicenseNo',$LicenseNo,PDO::PARAM_STR);
$query->bindParam(':uploadLicenseNo',$final_file,PDO::PARAM_STR);
$query->bindParam(':UploadPhoto',$final_file_photo_upload,PDO::PARAM_STR);
$query->bindParam(':Password',$pass,PDO::PARAM_STR);
$query->bindParam(':Address',$Address,PDO::PARAM_STR);
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
}

}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DHMS | Driver Registration</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Oswald&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Oswald', sans-serif;
        }
        
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">DHMS | Driver Registration</h1>
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($succmsg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($succmsg); ?> </div><?php }?>
                            </div>
                           <form method='post' enctype='multipart/form-data'>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                         <label for="name"><strong>Name:</strong></label>
                                        <input type="text" class="form-control" name="name" id="name"placeholder="Name" value="<?php echo $name; ?>">
                                        <span style="color:red;"><?php echo $nameerror;?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="mobile"><strong>Mobile:</strong></label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" maxlength="10" value="<?php echo $mobile; ?>">
                                       <span style="color:red;"><?php echo $mobileerror;?></span>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="email"><strong>Email:</strong></label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
                                        <span style="color:red;"><?php echo $emailerror;?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="name"><strong>License No:</strong></label>
                                        <input type="text" class="form-control" name="LicenseNo" id="LicenseNo" placeholder="License No" value="<?php echo $LicenseNo; ?>">
                                        <span style="color:red;"><?php echo $LicenseNoerror;?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="uploadLicenseNo"><strong>Upload License No:</strong></label>
                                        <input type="file" class="form-control" name="uploadLicenseNo" id="uploadLicenseNo"placeholder="Upload License No" value="<?php echo $uploadLicenseNo;?>">
                                         <span style="color:red;"><?php echo $uploadLicenseNoerror;?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="UploadPhoto"><strong>Upload Photo:</strong></label>
                                        <input type="file" class="form-control" name="UploadPhoto" id="UploadPhoto" placeholder="Upload Photo">
                                        <span style="color:red;"><?php echo $UploadPhotoerror;?></span>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="name"><strong>Password:</strong></label>
                                        <input type="password" class="form-control" name="Password"
                                            id="Password" placeholder="Password">
                                            <span style="color:red;"><?php echo $Passworderror;?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="name"><strong>Repeat Password:</strong></label>
                                        <input type="password" class="form-control" name="RepeatPassword" id="RepeatPassword" placeholder="Repeat Password">
                                        <span style="color:red;"><?php echo $mobileerror;?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name"><strong>Address:</strong></label>
                                    <input type="text" class="form-control" name="Address" id="Address"placeholder="Address">
                                       <span style="color:red;"><?php echo $Addresserror;?></span>
                                </div>
                                
                                 <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Register Now">
                                
                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>

                             
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

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