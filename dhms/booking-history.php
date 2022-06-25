
<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["email"])==0)
    {   
header('location:login.php');
}
else{
 $uid=$_SESSION['id'];
 ?>
 <!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <title>DHMS | Booking History</title>

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
                        <span>booknow</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                      <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Booking No</th>
                                            <th>Driver Name</th>
                                            <th>Driver Email</th>
                                            <th>Driver Mobile</th>
                                            <th>Fromdate</th>
                                            <th>Todate</th>
                                            <th>Remark</th>
                                            <th>Driver Remark</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                   
                                    <?php 
                                    include 'include/config.php';
                      $uid=$_SESSION['uid'];
                      $sql ="SELECT tbhiredriver.id, name,mobile,email,fromdate,todate,remark,driverremarks,status,bookingNumber FROM tbhiredriver 
join tbluserdrivers 
on tbluserdrivers.id= tbhiredriver.driveruserid
where tbhiredriver.userid=:uid;";
                     $query= $dbh -> prepare($sql);
                   $query->bindParam(':uid',$uid, PDO::PARAM_STR);
                      $query-> execute();
                      $results = $query -> fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query -> rowCount() > 0)
                      {
                      foreach($results as $result)
                      {
                      ?>
                  <tr>
                    <td><?php echo($cnt);?></td>
                       <td><?php echo htmlentities($result->bookingNumber);?></td>
                    <td><?php echo htmlentities($result->name);?></td>
                    <td><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->mobile);?></td>
                    <td><?php echo htmlentities($result->fromdate);?></td>
                     <td><?php echo htmlentities($result->todate);?></td>
                      <td><?php echo htmlentities($result->remark);?></td>
                      <td><?php echo htmlentities($result->driverremarks);?></td>
                       <td>
                        <?php 
                        $statusd=$result->status;
                         if ($statusd=='0') {
                             echo '<span class="badge badge-primary">Pending</span>';
                         }
                         elseif ($statusd=='1') {
                            echo '<span class="badge badge-success">Approved</span>';
                         }
                         elseif ($statusd=='2') {
                             echo '<span class="badge badge-danger">Cancel</span>';
                         }
                        ?>
                            
                        </td>
                   
                  </tr>
                  <?php  $cnt=$cnt+1; } } ?>
                                </table>
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
