<?php 
session_start();
error_reporting(0);
require_once('include/config.php');
 $uid=$_SESSION['uid'];
if(isset($_POST['submit']))
{ 
$useridd=$_POST['useridd'];
$driverid=$_POST['driverid'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$remark=$_POST['remark'];
$bookingno=mt_rand(100000000, 999999999);

if(empty($fromdate))
{
  $nameerror="Please Enter From Date";
}

 else if(empty($todate))
 {
 $mobileerror="Please Enter To Date";
 }
else{
$ret="SELECT id FROM tbhiredriver where (:fromdate BETWEEN date(fromdate) and date(todate) || :todate BETWEEN date(fromdate) and date(todate) || date(FromDate) BETWEEN :fromdate and :todate) and driveruserid=:driverid";
$query1 = $dbh -> prepare($ret);
$query1->bindParam(':driverid',$driverid, PDO::PARAM_STR);
$query1->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query1->bindParam(':todate',$todate,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

if($query1->rowCount()==0)
{


$sql="INSERT INTO tbhiredriver (bookingNumber,userid,driveruserid,fromdate,todate,remark)
 Values(:bookingno,:useridd,:driverid,:fromdate,:todate,:remark)";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookingno',$bookingno,PDO::PARAM_STR);
$query->bindParam(':useridd',$useridd,PDO::PARAM_STR);
$query->bindParam(':driverid',$driverid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query -> execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId>0)
{
echo "<script>alert('Driver Booked Successfully');</script>";
echo "<script type='text/javascript'> document.location = 'booking-history.php'; </script>";
}else 
{ echo "<script>alert('Something went wrong. Please try again.');</script>";
echo "<script type='text/javascript'> document.location = 'booking-history.php'; </script>";
}}  else{
 echo "<script>alert('Driver not Available for these Dates');</script>"; 
 echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}


}}
 
 
 ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <title>Driver Hiring Management System</title>

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

  <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2">
                    
                    <div class="product-list">
                        <div class="row">
                            <?php 
include 'include/config.php';
$sql ="SELECT id, name, mobile, email, LicenseNo, uploadLicenseNo, 
UploadPhoto, Password, Address, create_date from tbluserdrivers";
$query= $dbh -> prepare($sql);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
                           <div class="col-lg-3 col-sm-6">
                                <div class="product-item">
                                   
                                        <img src="drivers/UploadPhoto/<?php echo htmlentities($result->UploadPhoto);?>" alt="" style="width: 200px; height: 200px;">
                                       <?php $driveruserid=$result->id;?>
                                    <div class="pi-text">
                        <!--        <h5><?php echo htmlentities($result->name);?></h5></a> -->

                               <h5 style="cursor:pointer; font-family: 'Oswald', sans-serif;" data-toggle="modal" data-target="#myModalss<?php echo $driveruserid; ?>">
                               <?php echo htmlentities($result->name);?></h5>
                              <div class="product-price">
                                          <?php if(strlen($_SESSION['uid'])==0): ?>
       <a class="btn btn-info" href="login.php">Hire Now</a>
   <?php else :?>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $driveruserid; ?>">Hire Now</button>
                            <?php endif;?>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                                <!--   here i am creating a modal popup code......... -->

        <div id="myModalss<?php echo $driveruserid; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                    </div>
                    <div class="modal-body">
     
    <div class="row">
   <table style="width:100%">
  <tr>
    <th>Name</th>
    <td><?php echo htmlentities($result->name);?></td>
   
  </tr>
  <tr>
    <th>Mobile</th>
    <td><?php echo htmlentities($result->mobile);?></td>
    
  </tr>
  <tr>
    <th>Email</th>  
    <td><?php echo htmlentities($result->email);?></td>
   
  </tr>
   <tr>
    <th>Address</th>  
    <td><?php echo htmlentities($result->Address);?></td>
   </tr>
    <tr>
    <th>Photo</th>  
    <td><img src="drivers/UploadPhoto/<?php echo htmlentities($result->UploadPhoto);?>" alt="" style="width: 150px; height: 150px;">
</td>
   </tr>

</table>
      
  </div>
 </div>
                </div>
            </div>
        </div>

     <!--    // end modal popup code........ -->



     <!--   here i am creating a modal popup code......... -->
<div id="myModal<?php echo $driveruserid; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" required class="form-control datepicker" id="fromdate" placeholder="Enter From Date" name="fromdate" autocomplete="off" data-date-format="yyyy-mm-dd">
                            <input type="hidden" name="useridd" id="useridd" value="<?php echo $uid; ?>">
                            <input type="hidden" name="driverid" id="driverid" value="<?php echo $driveruserid;?>"> </div>
                        <div class="col-md-6">
                            <input type="text" required class="form-control datepicker" placeholder="Enter To Date" name="todate" id="todate" autocomplete="off" data-date-format="yyyy-mm-dd"> </div>
                    </div>
                    <br></br>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="remark" id="remark" class="form-control" placeholder="Message (if Any)"></textarea>
                        </div>
                    </div>
                    <input type="submit" id="submit" name="submit" value="submit" class="btn btn-primary mt-3"> </form>
            </div>
        </div>
    </div>
</div>
      
     <!--    // end modal popup code........ -->


                            <?php  $cnt=$cnt+1; } } ?>
                        
                        </div>
                    </div>
      
                </div>
            </div>
        </div>
    </section>

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


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Oswald&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Oswald', sans-serif;
        }
        
    </style>
    </head>
</body>

</html>

<style>
    .product-item .pi-text {
    text-align: center;
    padding-top: 6px!important;
}
</style>

<script type="text/javascript">

$('.datepicker').datepicker({ 
    startDate: new Date()
});

</script>