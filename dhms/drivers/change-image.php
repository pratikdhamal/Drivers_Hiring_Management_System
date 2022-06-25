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
$currentimage=$_POST['currentimage'];
$cimagepath="UploadPhoto"."/".$currentimage;
$imgfile=$_FILES["image"]["name"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else{
unlink($cimagepath);
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"],"UploadPhoto/".$imgnewfile);

  $sql="update tbluserdrivers set UploadPhoto=:imgnewfile where id=:uid";
$query = $dbh->prepare($sql);
$query->bindParam(':imgnewfile',$imgnewfile,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
//$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
echo "<script>alert('Profile Photo  updated.');</script>";
echo "<script> window.location.href =profile.php;</script>";
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
                            <h1 class="h4 text-gray-900 mb-4"> Update Image</h1>    
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
 $UploadPhotoss=$result->UploadPhoto;
}
}?>




                       <form method='post' enctype='multipart/form-data'>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                         <label for="name"><strong>Name:</strong></label>
                                        <input type="text" class="form-control" name="name" id="name" readonly="true" value="<?php echo $name; ?>">
                                    </div>
                                    <input type="hidden" name="currentimage" value="<?php echo $UploadPhotoss; ?>">
                      

                                   

                                    </div>
                                    <div class="col-sm-6">
                                        <label for="UploadPhoto"><strong>Uploaded Photo:</strong></label>
    
                                <?php if($UploadPhotoss != ""): ?>
                                <img src="UploadPhoto/<?php echo $UploadPhotoss; ?>" width="100px" height="100px" style="border:1px solid #333333; margin-left: 30px;">
                                <?php endif; ?>

                                    </div>
   <div class="col-sm-6">
                                         <label for="name"><strong>New Photo:</strong></label>
                                        <input type="file" class="form-control" name="image" id="image" required>
                                    </div>


</div>

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