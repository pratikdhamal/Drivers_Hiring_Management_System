<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["driverid"])==0)
    {   
header('location:login.php');
}
else{

 $uid=$_SESSION['driverid'];


if(isset($_POST['submit']))
{
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$LicenseNo=$_POST['LicenseNo'];
$Address=$_POST['Address'];

  $sql="update tbluserdrivers set name=:name,mobile=:mobile,LicenseNo=:LicenseNo,Address=:Address where id=:uid";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':LicenseNo',$LicenseNo,PDO::PARAM_STR);
$query->bindParam(':Address',$Address,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
//$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
echo "<script>alert('Profile has been updated.');</script>";
echo "<script> window.location.href =profile.php;</script>";
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

    <title>DHMS | Driver Profile</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Oswald&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Oswald', sans-serif;
        }
        
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        
    <?php include 'include/sidebar.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
             <?php include 'include/header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
    <div class="col-xl-12 col-md-6 mb-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Profile Update</h1>    
                        </div>
<?php
$sql ="SELECT name, mobile, email, LicenseNo, uploadLicenseNo, UploadPhoto, Password, Address from tbluserdrivers where id=:uid ";
$query= $dbh -> prepare($sql);
$query->bindParam(':uid',$uid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
 $name=$result->name;
 $mobile=$result->mobile;
 $email=$result->email;
 $LicenseNo=$result->LicenseNo;
 $uploadLicenseNod=$result->uploadLicenseNo;
 $UploadPhotoss=$result->UploadPhoto;
 $Address=$result->Address;

}
}?>




                       <form method='post' enctype='multipart/form-data'>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                         <label for="name"><strong>Name:</strong></label>
                                        <input type="text" class="form-control" name="name" id="name"placeholder="Name" value="<?php echo $name; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="mobile"><strong>Mobile:</strong></label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="<?php echo $mobile; ?>">
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="email"><strong>Email:</strong></label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="name"><strong>License No:</strong></label>
                                        <input type="text" class="form-control" name="LicenseNo" id="LicenseNo" placeholder="License No" value="<?php echo $LicenseNo; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="uploadLicenseNo"><strong>Uploaded License:</strong></label>
                            
                                            <?php if($uploadLicenseNod != ""): ?>
                                    <a href="UploadLicense/<?php echo $uploadLicenseNod; ?>" target="_blank">  View Uploaded License</a>
                                      <?php else: ?>
                                        NA
                                    <?php endif; ?><br />
<a href="change-license.php">Change License</a>
                                   

                                    </div>
                                    <div class="col-sm-6">
                                        <label for="UploadPhoto"><strong>Uploaded Photo:</strong></label>
    
                                <?php if($UploadPhotoss != ""): ?>
                                <img src="UploadPhoto/<?php echo $UploadPhotoss; ?>" width="100px" height="100px" style="border:1px solid #333333; margin-left: 30px;">
                                <?php endif; ?>
                                <a href="change-image.php">Change Image</a>

                                    </div>
                                </div>
                               
                             
                                
                                <div class="form-group">
                                    <label for="name"><strong>Address:</strong></label>
                                    <input type="text" class="form-control" name="Address" id="Address"placeholder="Address" value="<?php echo $Address?>">
                                </div>

                                  <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary">
                                
                            </form>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
               </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          <?php include 'include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php } ?>