<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["adminid"])==0)
    {   
header('location:login.php');
}
else{

 $uid=$_GET['id'];

$sql ="SELECT id,name,mobile,email,LicenseNo,uploadLicenseNo,UploadPhoto,Address from tbluserdrivers
where id=:uid ";

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
$Address=$result->Address;
$LicenseNo=$result->LicenseNo;
$uploadLicenseNo=$result->uploadLicenseNo;
$UploadPhoto=$result->UploadPhoto;


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

    <title>SB Admin 2 - Dashboard</title>

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
                       <form method='post' enctype='multipart/form-data'>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                         <label for="name"><strong>First Name:</strong><?php echo $name; ?></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email"><strong>Email:</strong><?php echo $email; ?></label>
                                    </div>
                                     
                                </div>

                                  <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="email"><strong>Address:</strong><?php echo $Address; ?></label>
                                    </div>
                                     <div class="col-sm-6">
                                        <label for="mobile"><strong>Mobile:</strong><?php echo $mobile; ?></label>
                                    </div>
                                   
                                </div>    
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="email"><strong>LicenseNo:</strong><?php echo $LicenseNo; ?></label>
                                    </div>
                                     <div class="col-sm-6">
                                        <label for="mobile"><strong>uploadLicenseNo:</strong><?php echo $uploadLicenseNo; ?></label>
                                    </div>
                                   
                                </div>   
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="email"><strong>UploadPhoto:</strong><img src="../admin/drivers/UploadPhoto/<?php echo htmlentities($result->UploadPhoto);?>" alt="" style="width: 200px; height: 200px;">
</label>
                                    </div>
                                     <div class="col-sm-6">
                                     <img src="drivers/UploadPhoto/<?php echo htmlentities($result->UploadPhoto);?>" alt="" style="width: 200px; height: 200px;">
                                    </div>
                                   
                                </div>    
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
<?php }?>