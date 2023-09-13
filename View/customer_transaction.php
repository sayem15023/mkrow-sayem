<?php

include "../connection.php";

session_start(); 

$userid=$_SESSION["userid"];


$customerid=$_POST["customerid"];

// Content  ......................................................



?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><a href="home.php">আমিনুল ষ্টোর </a></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">হোম</a></li>
              <li class="breadcrumb-item active"> হিসাব খাতা</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                
                <h6>কাস্টমার লেন / দেন </h6>
                <table class="table table-bordered">
                


                <?php 

                  // Load Customer . . . .
//echo $customerid;
$sql = "SELECT id,name,mobileno,address,reference FROM customer where userid=$userid and id=$customerid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    $id=$row["id"];
    $name=$row["name"];
    $mobile=$row["mobileno"];


    // get balance ...... 

$sqla = "SELECT *from  app_customer_account where userid=$userid and customerid=$id";
$resulta = $conn->query($sqla);

if ($resulta->num_rows > 0) {
  // output data of each row
  while($rowa = $resulta->fetch_assoc()) {
    $today_balance=$rowa["balance"];
  }
} else {
   $today_balance=0;
}

   $view="custmer_transaction";

    ?>
  <tr onclick="" style='cursor:pointer; border:none;'>
    <td> <span style='color:white; font-size:24px;'><?php echo "<b id='cname'>$name</b></span><br><span id='cmob'>$mobile</span></td><td> <span style='color:white; font-size:24px;'> মোট  $today_balance &#2547; </span>" ?></td>
    </tr>

    <?php
                    
  }
                  
} else {
                    
  echo "No Data";
                  
}


                ?>

         <input type='hidden' id='cid' value='<?php echo $customerid ?>'  >
         <input type='hidden' id='tb' value='<?php echo $today_balance ?>'  >
         
<tr>
    <td> 
     <input type="number" id='out' class="form-control" placeholder="দিলাম ">
    </td>
    <td>
    <input type="number" id='in' class="form-control" placeholder="পেলাম ">
    </td>
</tr>

<tr>
    <td> 
      <button class='btn btn-warning' onclick='savedata()'>নিশ্চিত </button>
    </td>
    <td>
    <button class='btn btn-warning' onclick='home()'> ফিরে যান  </button
    </td>
</tr>
                
               
                </table>

             
                
                <a href="#" style='color:white;' onclick="getcontent('customer')" class="small-box-footer">কাস্টমার যুক্ত করুন <i class="fas fa-arrow-circle-right"></i></a>

              </div>          
            </div>
          </div>
         
        </div>
        <!-- /.row -->


      




</div>
