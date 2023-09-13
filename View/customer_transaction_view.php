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

  

    ?>

   
    <tr onclick="" style='cursor:pointer; border:none; background-color:white; color:red;'>
    <td> <span style='color:green; font-size:24px;'><?php echo "<b>$name</b></span><br>$mobile </td><td> <span style='color:green; font-size:24px;'> মোট  $today_balance &#2547; </span> " ?></td>
    </tr>

    <?php


// SHOW Transaction ...... 

$total_in=0;
$total_out=0;
$total_due=0;

$sqla = "SELECT *from  app_customer_account where userid=$userid and customerid=$id";
$resulta = $conn->query($sqla);

if ($resulta->num_rows > 0) {
  // output data of each row
  while($rowa = $resulta->fetch_assoc()) {
    $ins=$rowa["in_account"];
    $outs=$rowa["out_account"];
    $balance=$rowa["balance"];
    $transaction_date=$rowa["transaction_date"];
    $transaction_time=$rowa["transaction_time"];
    
    $total_in=$total_in+$ins;
    $total_out=$total_out+$outs;
    
    ?>
    <tr onclick="" style='cursor:pointer; border:none;'>
    <td> <?php echo  $transaction_date."&nbsp;".$transaction_time ?> <br> <span style='color:white; font-size:20px;'><?php echo "<b> পূর্বের বাকী &nbsp;= $total_due &#2547;" ?></b></span> <br>  <span style='color:white; font-size:20px; border-bottom:2px dotted white; '><?php echo "<b>দিলাম &nbsp;=&nbsp; $outs  &#2547;</b></span><br> <span style='color:white; font-size:20px; '>মোট = $balance &#2547; </span>  "?></td>
    <td> <?php echo  $transaction_date."&nbsp;".$transaction_time ?> <br> <span style='color:white; font-size:20px;'><?php echo "<b> পেলাম  $ins &#2547; </b></span><br> "?>  <span style='color:white; font-size:20px;'><?php echo "<b> জের $balance &#2547;"; ?> </b></span> </td>
    </tr>
    <?php
 
     $total_due=$balance;

  }
} else {
   $today_balance=0;
}
   


   ?>
    <tr onclick="" style='cursor:pointer; border:none; background-color:white;'>
    <td> <span style='color:red;'><?php echo "<b> মোট দিলাম $total_out &#2547; </b></span> "?></td>
    <td> <span style='color:red;'><?php echo "<b>  মোট পেলাম  $total_in &#2547;</b></span> "?></td>
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
    <button class='btn btn-warning' onclick='home()'>ফিরে যান  </button>
    </td>
    <td>
    
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
