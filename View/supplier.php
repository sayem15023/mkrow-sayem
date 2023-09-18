<?php

include "../connection.php";

session_start(); 

$userid=$_SESSION["userid"];

// Content  ......................................................

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>সাপ্লায়ার</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">হোম</a></li>
              <li class="breadcrumb-item active">সাপ্লায়ার</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>







    <!-- Table -->   

    <section class="content">
      <div class="row">
        <div class="col-md-12">

    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title" >সাপ্লায়ার তালিকা </h3>
                <a href="#add"><span style="float:right; cursor:pointer;">নতুন সাপ্লায়ার </span></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered" style="width:100%">
                  <thead class="thead-light">
                  <tr>
                    <th style='text-align:center;'>#</th>
                    <th>সাপ্লায়ার নাম </th>
                    <th>মোবাইল নং </th>
                    <th>ঠিকানা </th>
                    <th>পণ্যের ক্যাটাগরি </th>
                    <th style='text-align:center;'>অ্যাকশন </th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php

$slno=0;

$sql = "SELECT * FROM supplier where userid=$userid order by id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $slno++;
    $id=$row["id"];
    $name=$row["name"];

     echo "<tr>";
     echo "<td style='text-align:center;'>".$slno."</td>";
     echo "<td class='name'>".$name."</td>"; 
     echo "<td class='mobileno'>".$row['mobileno']."</td>"; 
     echo "<td class='address'>".$row["address"]."</td>"; 
     echo "<td class='product_category_id'>".$row["product_category_id"]."</td>"; 
     
     echo "<td class='text-center py-0 align-middle' style='text-align:center;'>
                      <div class='btn-group btn-group-sm'>
                        <a onclick='updatedata($id,this)' class='btn btn-info'><i class='fas fa-edit'></i></a>
                        <a onclick=deletedata($id,this,'customer') class='btn btn-danger'><i class='fas fa-trash'></i></a>
                      </div>
                    </td>";
     echo "</tr>";
      

  }
} else {
  
}
                ?>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            </div>
        
        </div>
       
      </section>

    <!-- End Table -->




    <!-- Main content -->
<section class="content" id="add">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">সাপ্লায়ারের যোগ করার ফর্ম</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label for="category">সাপ্লায়ার নাম</label>
                <input type="text" id="name" style="width:25%" class="form-control" placeholder="সাপ্লায়ার নাম">
              </div>
 
              <div class="form-group">
                <label for="category">মোবাইল নং</label>
                <input type="text" id="mobileno" style="width:25%" class="form-control"  placeholder="মোবাইল নং">
              </div>

              <div class="form-group">
                <label for="category">ঠিকানা </label>
                <input type="text" id="address" style="width:25%" class="form-control"  placeholder="ঠিকানা ">
              </div>
              
              <div class="form-group">
                <label for="product_category_id">পণ্যের ক্যাটাগরি  </label>
                <!-- <input type="text" id="product_category_id" style="width:25%" class="form-control"  placeholder="পণ্যের ক্যাটাগরি  "> -->

                <select id="product_category_id" style="width:25%" class="form-control">
                  <option value="">Select Category</option>
                  <option value="1">Electrical</option>
                  <option value="saab">Home Appliance</option>
                  <option value="mercedes">Groceries</option>
              </select>

              </div>


              <input type="button" onclick="savedata()"  value="সংরক্ষণ করুন " class="btn btn-success float-left">
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
     
    </section>
    <!-- /.content -->




</div>
