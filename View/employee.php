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
            <h1>কর্মী</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">হোম</a></li>
              <li class="breadcrumb-item active">কর্মী</li>
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
                <h3 class="card-title" >কর্মীর তালিকা</h3>
                <a href="#add"><span style="float:right; cursor:pointer;">কর্মী যোগ করার ফরম</span></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered" style="width:100%">
                  <thead class="thead-light">
                  <tr>
                    <th style='text-align:center;'>#</th>
                    <th>কর্মীর নাম</th>
                    <th>মোবাইল</th>
                    <th>স্থায়ী ঠিকানা</th>
                    <th>অস্থায়ী ঠিকানা</th>
                    <th>পিতার নাম</th>
                    <th>মাতার নাম</th>
                    <th>জাতীয়তা</th>
                    <th>ধর্ম</th>
                    <th>পূর্বের কর্মস্থল বিবরণ</th>
                    <th>জামিনদারের নাম</th>
                    <th>জামিনদারের মোবাইল</th>
                    <th>সম্পর্ক</th>
                    <th>পদবি</th>
                    <th>কাজের এলাকা</th>
                    <th>ইনভেস্টর নাম/কোড</th>
                    <th style='text-align:center;'>অ্যাকশন </th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php

$slno=0;

$sql = "SELECT id,employee_name,mobileno,permanent_address,temporary_address,father_name,mother_name,nationality,religion,previous_workspace_details,guarantor_name,guarantor_mobileno,relation,designation,working_area,investore_name FROM employee where userid=$userid order by id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $slno++;
    $id=$row["id"];

     echo "<tr>";
     echo "<td style='text-align:center;'>".$slno."</td>";
     echo "<td class='employee_name'>".$row['employee_name']."</td>"; 
     echo "<td class='mobileno'>".$row['mobileno']."</td>"; 
     echo "<td class='permanent_address'>".$row["permanent_address"]."</td>";
     echo "<td class='temporary_address'>".$row["temporary_address"]."</td>";
     echo "<td class='father_name'>".$row["father_name"]."</td>";
     echo "<td class='mother_name'>".$row["mother_name"]."</td>";
     echo "<td class='nationality'>".$row["nationality"]."</td>";
     echo "<td class='religion'>".$row["religion"]."</td>";
     echo "<td class='previous_workspace_details'>".$row["previous_workspace_details"]."</td>";
     echo "<td class='guarantor_name'>".$row["guarantor_name"]."</td>";
     echo "<td class='guarantor_mobileno'>".$row["guarantor_mobileno"]."</td>";
     echo "<td class='relation'>".$row["relation"]."</td>";
     echo "<td class='designation'>".$row["designation"]."</td>";
     echo "<td class='working_area'>".$row["working_area"]."</td>";
     echo "<td class='investore_name'>".$row["investore_name"]."</td>";
     
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
              <h3 class="card-title">কর্মী যোগ করার ফরম</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label for="category">কর্মীর নাম</label>
                <input type="text" id="employee_name" style="width:25%" class="form-control" placeholder="কর্মীর নাম">
              </div>
 
              <div class="form-group">
                <label for="category">মোবাইল</label>
                <input type="text" id="mobileno" style="width:25%" class="form-control"  placeholder="মোবাইল">
              </div>

              <div class="form-group">
                <label for="category">স্থায়ী ঠিকানা</label>
                <input type="text" id="permanent_address" style="width:25%" class="form-control"  placeholder="স্থায়ী ঠিকানা ">
              </div>
              
              <div class="form-group">
                <label for="category">অস্থায়ী ঠিকানা</label>
                <input type="text" id="temporary_address" style="width:25%" class="form-control"  placeholder="অস্থায়ী ঠিকানা">
              </div>

              <div class="form-group">
                <label for="category">পিতার নাম</label>
                <input type="text" id="father_name" style="width:25%" class="form-control" placeholder="পিতার নাম">
              </div>
 
              <div class="form-group">
                <label for="category">মাতার নাম</label>
                <input type="text" id="mother_name" style="width:25%" class="form-control"  placeholder="মাতার নাম">
              </div>

              <div class="form-group">
                <label for="category">জাতীয়তা</label>
                <input type="text" id="nationality" style="width:25%" class="form-control"  placeholder="জাতীয়তা ">
              </div>
              
              <div class="form-group">
                <label for="category">ধর্ম</label>
                <input type="text" id="religion" style="width:25%" class="form-control"  placeholder="ধর্ম">
              </div>

              <div class="form-group">
                <label for="category">পূর্বের কর্মস্থল বিবরণ</label>
                <input type="text" id="previous_workspace_details" style="width:25%" class="form-control"  placeholder="পূর্বের কর্মস্থল বিবরণ">
              </div>

              <div class="form-group">
                <label for="category">জামিনদারের নাম</label>
                <input type="text" id="guarantor_name" style="width:25%" class="form-control" placeholder="জামিনদারের নাম">
              </div>
 
              <div class="form-group">
                <label for="category">জামিনদারের মোবাইল</label>
                <input type="text" id="guarantor_mobileno" style="width:25%" class="form-control"  placeholder="জামিনদারের মোবাইল">
              </div>

              <div class="form-group">
                <label for="category">সম্পর্ক</label>
                <input type="text" id="relation" style="width:25%" class="form-control"  placeholder="সম্পর্ক ">
              </div>
              
              <div class="form-group">
                <label for="category">পদবি</label>
                <input type="text" id="designation" style="width:25%" class="form-control"  placeholder="পদবি">
              </div>

              <div class="form-group">
                <label for="category">কাজের এলাকা</label>
                <input type="text" id="working_area" style="width:25%" class="form-control"  placeholder="কাজের এলাকা">
              </div>

              <div class="form-group">
                <label for="category">ইনভেস্টর নাম/কোড</label>
                <input type="text" id="investore_name" style="width:25%" class="form-control"  placeholder="ইনভেস্টর নাম/কোড">
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
