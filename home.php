<?php

include "connection.php";

session_start(); 

$userid=$_SESSION["userid"];

$loadcontent='';
if(isset($_GET['content']))
{
  $loadcontent=$_GET['content'];
}

echo "<input type='hidden' id='userid' value=$userid >";



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

$companyname="হিসাব খাতা";
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


/*
$sql = "SELECT * FROM customer where userid=$userid";
$result = $conn->query($sql);
$total_customer=$result->num_rows;


// Todays Calculation . . . . .

date_default_timezone_set("Asia/dhaka");
$today=date("d-m-Y");
$month=date('m');
$year=date('Y');

$today_sales=0;
$sql = "SELECT IFNULL(sum(totalprice),0) as today_sales FROM khata_sales_master where userid=$userid and salesdate='$today'"; 
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $today_sales=$row["today_sales"];
  }
} else {
  
}

$today_due=0;
$sql = "SELECT IFNULL(sum(due),0) as today_due FROM khata_sales_master where userid=$userid and salesdate='$today'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $today_due=$row["today_due"];
  }
} else {
  
}


$month_sales=0;
$sql = "SELECT IFNULL(sum(totalprice),0) as month_sales FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 4, 2)='$month' and SUBSTR(salesdate, 7, 4)='$year'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $month_sales=$row["month_sales"];
  }
} else {
  
}

$month_due=0;
$sql = "SELECT IFNULL(sum(due),0) as month_due FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 4, 2)='$month' and SUBSTR(salesdate, 7, 4)='$year'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $month_due=$row["month_due"];
  }
} else {
  
}

$year_sales=0;
$sql = "SELECT IFNULL(sum(totalprice),0) as year_sales FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 7, 4)='$year'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $year_sales=$row["year_sales"];
  }
} else {
  
}

$year_due=0;
$sql = "SELECT IFNULL(sum(due),0) as year_due FROM khata_sales_master where userid=$userid and SUBSTR(salesdate, 7, 4)='$year'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   $year_due=$row["year_due"];
  }
} else {
  
}
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>হিসাব খাতা</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="dist/css/select2-bootstrap.css" rel="stylesheet" />


<!-- For Common Modal -->

<style>
/*body {font-family: Arial, Helvetica, sans-serif;} */

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 120px; /* Location of the box */
  left: 125px;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  padding-left:98%;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

<!-- End Style For Common Modal -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    
    
<!-- Modal -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="modal-body">Some text in the Modal..</div>
  </div>

</div>


    
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" id="menubar" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      
     <li class="nav-item">
        <a class="nav-link"  href="https://mkrow.site/HisabKhata/home.php" role="button"><i class="fas fa-home"></i> Home</a>
      </li>
     
 
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>


      </li>


      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $companyname ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $username ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
            
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="home.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p> হিসাব খাতা</p>
                </a>
              </li>
             
            </ul>
          </li>
         

              <li class="nav-item">
                <a href="#" onclick="getcontent('customer')" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>গ্রাহক যুক্ত করুন</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" onclick="getcontent('supplier')" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Supplier</p>
                </a>
              </li>
              


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <div id="content">  <!-- Content Div -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
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
   
   
   
   
  

    <style>
        /* Style for the card container */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 800px; /* Adjust as needed */
            margin: 0 auto;
        }

        /* Style for the cards */
        .card {
            width: calc(50% - 10px); /* Adjust the width as needed with spacing */
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Style for the bottom text */
        .card p {
            margin: 0;
            padding: 0;
            font-size: 18px; /* Font size */
            color: #333333; /* Text color */
        }

        /* Style for the icon (you can replace the URL with your own icon) */
        .card i {
            font-size: 48px; /* Icon size */
            color: #3498db; /* Icon color */
        }
        
        .card:hover{
            background-color: ffff88;
        }
        
        }
        
    </style>

    <div class="card-container main-card">
        <div class="card" onclick='getSubCard(1)'>
            <i class="fa fa-building"></i> <!-- Replace with your own icon -->
            <br>
            <p>উৎপাদন কেন্দ্র</p>
        </div>
        <div class="card" onclick='getSubCard(2)'>
            <i class="fa fa-phone"></i> <!-- Replace with your own icon -->
            <br>
            <p>ট্যালি</p>
        </div>
        <div class="card" onclick='getSubCard(3)'>
            <i class="fa fa-shopping-cart"></i> <!-- Replace with your own icon -->
            <br>
            <p>অর্ডার কেন্দ্র</p>
        </div>
        <div class="card" onclick='getSubCard(4)'>
            <i class="fa fa-cogs"></i> <!-- Replace with your own icon -->
            <br>
            <p>এক্সেস ম্যানেজমেন্ট</p>
        </div>
        <div class="card">
            <i class="fa fa-bullhorn"></i> <!-- Replace with your own icon -->
            <br>
            <p>এফিলিয়াতে মার্কেটিং</p>
        </div>
    </div>



<!-- Sub Card 1 -->

<div class="card-container sub-card-1" style="display:none;">
        <div class="card" onclick='getContent(1)'>
            <i class="fa fa-cart-plus"></i> <!-- Replace with your own icon -->
            <br>
            <p>কেনা কাঁচামাল</p>
        </div>
        <div class="card">
            <i class="fa fa-industry"></i> <!-- Replace with your own icon -->
            <br>
            <p>দৈনিক উৎপাদন</p>
        </div>
        <div class="card">
            <i class="fa fa-share"></i> <!-- Replace with your own icon -->
            <br>
            <p>পণ্য বিতরণ </p>
        </div>
        <div class="card">
            <i class="fa fa-arrow-left"></i> <!-- Replace with your own icon -->
            <br>
            <p>ফেরত পণ্য</p>
        </div>
        <div class="card">
            <i class="fa fa-fire"></i> <!-- Replace with your own icon -->
            <br>
            <p>নষ্ট/মেয়াদ উত্তীর্ণ পণ্য</p>
        </div>
    </div>


<!-- End Sub Card 1 -->


<!-- Sub Card 2 -->

<div class="card-container sub-card-2" style="display:none;">
        <div class="card" onclick='getContent(1)'>
            <i class="fa fa-book-medical"></i> <!-- Replace with your own icon -->
            <br>
            <p>বাকির খাতা </p>
        </div>
        <div class="card">
            <i class="fa fa-book-open"></i> <!-- Replace with your own icon -->
            <br>
            <p>বেচা বিক্রির খাতা </p>
        </div>
        <div class="card">
            <i class="fa fa-book"></i> <!-- Replace with your own icon -->
            <br>
            <p>খরচের খাতা </p>
        </div>
        <div class="card">
            <i class="fa fa-file"></i> <!-- Replace with your own icon -->
            <br>
            <p>বাকি আদায়ের ইনভয়েস </p>
        </div>
        <div class="card">
            <i class="fa fa-file-invoice"></i> <!-- Replace with your own icon -->
            <br>
            <p>নগদ আদায়ের খাতা</p>
        </div>
    </div>


<!-- End Sub Card 2 -->



<!-- Sub Card 3 -->

<div class="card-container sub-card-3" style="display:none;">
        <div class="card" onclick='getContent(1)'>
            <i class="fa fa-cart-plus"></i> <!-- Replace with your own icon -->
            <br>
            <p>বেচা/অর্ডার নেয়া  </p>
        </div>
        <div class="card">
            <i class="fa fa-address-book"></i> <!-- Replace with your own icon -->
            <br>
            <p>কাস্টমার যোগ করা </p>
        </div>
        <div class="card">
            <i class="fa fa-file"></i> <!-- Replace with your own icon -->
            <br>
            <p>ডেলিভারি রিপোর্ট দেয়া</p>
        </div>
        <div class="card">
            <i class="fa fa-file-invoice"></i> <!-- Replace with your own icon -->
            <br>
            <p>ভাউচার তৈরি ও প্রিন্ট করা</p>
        </div>
    </div>


<!-- End Sub Card 3 -->




<!-- Sub Card 4 -->

<div class="card-container sub-card-4" style="display:none;">
        <div class="card" onclick='getContent(1)'>
            <i class="fa fa-address-book"></i> <!-- Replace with your own icon -->
            <br>
            <p>কর্মী যোগ করা  </p>
        </div>
        <div class="card">
            <i class="fa fa-plus"></i> <!-- Replace with your own icon -->
            <br>
            <p>সাপ্লায়ার যোগ করা </p>
        </div>
        <div class="card">
            <i class="fa fa-warehouse"></i> <!-- Replace with your own icon -->
            <br>
            <p>ইনভেস্ট যোগ করা</p>
        </div>
        <div class="card">
            <i class="fa fa-file"></i> <!-- Replace with your own icon -->
            <br>
            <p>স্টোরে কিপার যোগ করা</p>
        </div>
        
        <div class="card">
            <i class="fa fa-cart-plus"></i> <!-- Replace with your own icon -->
            <br>
            <p>পণ্য যোগ করা</p>
        </div>
        
    </div>


<!-- End Sub Card 4 -->
   
   
   
   
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  </div>  <!-- Content Div -->


  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y");?> <a href="http://mkrow.site" target="_blank">Mkrow Services</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>



<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>




<script>

$(document).on('draw.dt', function () {
    
     $('.HideAfterDT').hide();
     
    
    
});

 $("#dt").DataTable({
      "responsive": true,
      "autoWidth": false,
      "bLengthChange": false,
      "paging": false
    });

$(document).ready(function(){
  
  var loadcontent="<?php echo $loadcontent ?>";

  if(loadcontent!='')
  {
    getcontent(loadcontent);
  }

  loadcalc();


});

var id=0;

// Change Input Size if Android . . . .

function ChangeSize()
{
var ua = navigator.userAgent.toLowerCase();
var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");

if(isAndroid) {

  $('inoput').css('width','100%');
  
}

//$('inoput').css('width','100%');

}


 


// Common DataTable Function .........................................................

function AddDataTable()
{

  if($(window).width()>768){  // Dont Add DT in Android . . .

  $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    
    });

  }
  else{
    $('.form-control').css('width','100%');
  }

  $('.HideAfterDT').hide();

}


function AddSelect2()
{
  $("select").not(".notSelect").select2({
        theme: "bootstrap"
  });


}

// Get Content Start ..........................................................................

var viewcontent="";

function getcontent(viewname)
{

id=0;

viewcontent=viewname;
document.getElementById("content").innerHTML="<center><img style='opacity:0.4;'   src='dist/img/loader.gif' /><center>";

if($(window).width()<=768)
{
   //$("#menubar").trigger("click");
}


$.ajax({
type: "POST",
url: "View/"+viewname+".php",
data: "",
cache: false,
success: function(html) {

 document.getElementById("content").innerHTML = html;

 var scripturl="Script/"+viewname+".js";

 $.getScript( scripturl, function( data, textStatus, jqxhr ) {
        // do some stuff after script is loaded
    } );

 //ChangeSize();
 AddDataTable();
 AddSelect2();

 
}
});


}

// End Content ...... ..........................................................................

// Get View With Parameter  . . . . . 

function getViewWithParam(viewname,param)
{

id=0;

viewcontent=viewname;
document.getElementById("content").innerHTML="<center><img style='opacity:0.4;'   src='dist/img/loader.gif' /><center>";

if($(window).width()<=768)
{
   //$("#menubar").trigger("click");
}


$.ajax({
type: "POST",
url: "View/"+viewname+".php",
data: param,
cache: false,
success: function(html) {

 document.getElementById("content").innerHTML = html;

 var scripturl="Script/"+viewname+".js";

 $.getScript( scripturl, function( data, textStatus, jqxhr ) {
        // do some stuff after script is loaded
    } );

 //ChangeSize();
 AddDataTable();
 AddSelect2();

 
}
});


}


// Common Function .............................................................................


function save(sql)
{

var dataString="sql="+sql;

//alert(dataString);
      
$.ajax({
type: "POST",
url: "Model/save.php",
data: dataString,
cache: false,
success: function(html) {

 alert(html);
 getcontent(viewcontent);
 id=0;
 //document.getElementById("content").innerHTML = html;

}
});


}



function saveWithoutMessage(sql)
{

var dataString="sql="+sql;

//alert(dataString);
      
$.ajax({
type: "POST",
url: "Model/save.php",
data: dataString,
cache: false,
success: function(html) {

 //alert(html);
 //getcontent(viewcontent);
 id=0;
 //document.getElementById("content").innerHTML = html;

}
});


}


function deletedata(id,e,tablename)
{
   if(confirm('আপনি  কি নিশ্চিত ?'))
   {

    var dataString="deletedid="+id+"&tablename="+tablename;

$.ajax({
type: "POST",
url: "Model/delete.php",
data: dataString,
cache: false,
success: function(html) {

 alert(html);
 $(e).closest('tr').remove();
 //getcategory();
 //document.getElementById("content").innerHTML = html;
 
}
});

   }

}


function ScrollToBottom()
{
  window.scrollTo(0, document.body.scrollHeight);
}  

function ScrollToTop()
{
  document.documentElement.scrollTop = 0;
}  



function loadcalc(){
  document.getElementById("calculator").innerHTML='<object type="text/html" style="height:450px;" data="Calculator/index.html" ></object>';
}




function showModal(content){

// Modal Open Content Report Close ..............

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


$('#modal-body').html(content);

// When the user clicks the button, open the modal 
//btn.onclick = function() {
  modal.style.display = "block";
//}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


}



function printDiv(div) { 

   document.getElementById('content').innerHTML = document.getElementById(div).innerHTML;
   document.getElementById("myModal").style.display = "none";
   $("#print,#pdf,#excel,.main-footer").hide();
      window.print();
   $("#print,#pdf,#excel,.main-footer").show();
   window.location.href="home.php?content="+viewcontent;

        } 
        
        
        function home()
        {
            location.reload();
        }
        
        
        function getSubCard(subCardNo)
        {
            $(".main-card").hide(300);
            $(".sub-card-"+subCardNo).show(300);
        }
        

</script>



