<?php

include "../connection.php";

session_start(); 

$userid=$_SESSION["userid"];

$loadcontent='';
if(isset($_GET['content']))
{
  $loadcontent=$_GET['content'];
}

echo "<input type='hidden' id='userid' value=$userid >";

$customerid=$_POST["customerid"];

// Get User Data ..................................................

$username="";

$sql = "SELECT * FROM user where id=$userid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $username=$row["name"];
  }
} else {
  
}

// Get Company Data ..................................................

$companyname=" হিসাব খাতা";
$logo="";
/*
$sql = "SELECT * FROM basic_info where userid=$userid limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $companyname=$row["shop_name"];
    $logo=$row["logo"];
  }
} else {
  
}
*/

// Get Purchase .........................



$sql = "SELECT * FROM customer where userid=$userid";
$result = $conn->query($sql);
$total_customer=$result->num_rows;


// Todays Calculation . . . . .

date_default_timezone_set("Asia/dhaka");
$today=date("d-m-Y");
$month=date('m');
$year=date('Y');

$today_sales=0;
$sql = "SELECT IFNULL(sum(totalprice),0) as today_sales FROM khata_sales_master where userid=$userid and salesdate='$today' and (customerid=$customerid or $customerid=0)"; 
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $today_sales=$row["today_sales"];
  }
} else {
  
}

$today_due=0;
$sql = "SELECT IFNULL(sum(due),0) as today_due FROM khata_sales_master where userid=$userid and salesdate='$today' and (customerid=$customerid or $customerid=0)";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $today_due=$row["today_due"];
  }
} else {
  
}


$month_sales=0;
$sql = "SELECT IFNULL(sum(totalprice),0) as month_sales FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 4, 2)='$month' and SUBSTR(salesdate, 7, 4)='$year' and (customerid=$customerid or $customerid=0)";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $month_sales=$row["month_sales"];
  }
} else {
  
}

$month_due=0;
$sql = "SELECT IFNULL(sum(due),0) as month_due FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 4, 2)='$month' and SUBSTR(salesdate, 7, 4)='$year' and (customerid=$customerid or $customerid=0)";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $month_due=$row["month_due"];
  }
} else {
  
}

$year_sales=0;
$sql = "SELECT IFNULL(sum(totalprice),0) as year_sales FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 7, 4)='$year' and (customerid=$customerid or $customerid=0)";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $year_sales=$row["year_sales"];
  }
} else {
  
}

$year_due=0;
$sql = "SELECT IFNULL(sum(due),0) as year_due FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 7, 4)='$year' and (customerid=$customerid or $customerid=0)";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $year_due=$row["year_due"];
  }
} else {
  
}


?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> হিসাব খাতা</h1>
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


<div style="margin:10px;">

           <div class="form-group">               
             <input type="text" id="customercode" style="width:200px; "  placeholder="গ্রাহকের কোড " value="" class="form-control">
            </div>

            <div class="form-group">
                
                <?php

$sqlsem = "SELECT * FROM customer where userid=$userid";
$resultse = $conn->query($sqlsem);

echo "<select  class='form-control' style='width:200px;' id='customer' name='customer' required>";

echo "<option hidden='' value=''>--গ্রাহক--</option>";

if ($resultse->num_rows > 0) {

    while($rowse = $resultse->fetch_assoc()) {
       
	   $up_name=$rowse["name"];
	   $upid=$rowse["id"];
      
    $selected=""; 
    if($customerid==$upid) 
    {
      $selected="selected";
    }
	  echo  "<option value='$upid' $selected>".$up_name."</option>";
	   
	   
    }

} else {

   echo  "<option >None</option>";

}
		
echo " </select>";

?>

<div>
<br>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h6>আজকের হিসাব</h6>

                <table class="table table-bordered">
                <tr>
                <td>ক্রয় </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বিক্রয় </td><td> <?php echo $today_sales ?> &#2547;</td>
                </tr>
                <tr>
                <td>দেনা </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বাকি </td><td> <?php echo $today_due ?> &#2547;</td>
                </tr>
               
                </table>
                
              </div>          
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h6>এই মাসের হিসাব</h6>
                <table class="table table-bordered">
                <tr>
                <td>ক্রয় </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বিক্রয় </td><td> <?php echo $month_sales ?> &#2547;</td>
                </tr>
                <tr>
                <td>দেনা </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বাকি </td><td> <?php echo $month_due ?> &#2547;</td>
                </tr>
               
                </table>
                
              </div>          
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h6>এই বছরের হিসাব </h6>

                <table class="table table-bordered">
                <tr>
                <td>ক্রয় </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বিক্রয় </td><td> <?php echo $year_sales ?> &#2547;</td>
                </tr>
                <tr>
                <td>দেনা </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বাকি </td><td> <?php echo $year_due ?> &#2547;</td>
                </tr>
               
                </table>
                
              </div>          
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h6>পূর্বের হিসাব</h6>

                <table class="table table-bordered">
                <tr>
                <td>ক্রয় </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বিক্রয় </td><td> 0 &#2547;</td>
                </tr>
                <tr>
                <td>দেনা </td><td> 0 &#2547; </td>
                </tr> 
                <tr>
                <td> বাকি </td><td> 0 &#2547;</td>
                </tr>
               
                </table>
                
              </div>          
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->