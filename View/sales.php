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
            <h1>বিক্রয় </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">হোম</a></li>
              <li class="breadcrumb-item active">বিক্রয় </li>
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
                <h3 class="card-title" >বিক্রয় করুন  </h3>
                <a href="#" onclick="getcontent('sales_list')"><span style="float:right; cursor:pointer;"> বিক্রয় হিসাব দেখুন  </span></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow:auto;">


              <div class="form-group">               
             <input type="text" id="customercode" style="width:200px; "  placeholder="গ্রাহকের কোড " value="" class="form-control">
            </div>

            <div class="form-group">
                
                <?php

$sqlsem = "SELECT * FROM customer where userid=$userid";
$resultse = $conn->query($sqlsem);

echo "<select  class='form-control' style='width:200px;' id='customer' name='customer' required>";

echo "<option hidden='' value=''>--গ্রাহক--</option>";

echo "<option value='0'> নতুন গ্রাহক </option>";

if ($resultse->num_rows > 0) {

    while($rowse = $resultse->fetch_assoc()) {
       
	   $up_name=$rowse["name"];
	   $upid=$rowse["id"];
	    
	  echo  "<option value='$upid'>".$up_name."</option>";
	   
	   
    }

} else {

   echo  "<option >None</option>";

}
		
echo " </select>";

?>
<br>
            <div class="form-group">               
             <input type="text" id="customername" style="width:200px; "  placeholder="গ্রাহকের নাম " value="" class="form-control">
            </div>

            <div class="form-group">               
             <input type="text" id="customermobileno" style="width:200px; "  placeholder="গ্রাহকের মোবাইল নং  " value="" class="form-control">
            </div>

<br>

                <table id="example2" class="table table-bordered" style="width:100%">
                  <thead class="thead-light">
                  <tr>
                    <th style='text-align:center;'>#</th>
                    <th>পণ্যের নাম  </th>
                    <th style='text-align:right;'>পরিমান </th>
                    <th style='text-align:right;'>দাম  </th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php

     echo "<tr contentEditable='true'>";
     echo "<td class='slno' style='text-align:center;'>1</td>";
     echo "<td class='name'></td>"; 
     echo "<td class='quantity' style='text-align:right;'></td>"; 
     echo "<td class='price' style='text-align:right;'></td>"; 
     echo "</tr>";
      
                ?>
                  </tbody>

                 <tfoot>
                   <tr>
                    <td style='text-align:center;'><button class='btn btn-primary addrow'>যুক্ত করুন </button></td>
                    <td style='text-align:right;'>মোট </td>
                    <td id='totalqty' style='text-align:right;'></td>
                    <td id='totalprice' style='text-align:right;'></td>
                   </tr>
                
                   <tr>
                    <td></td>
                    <td></td>
                    <td style='text-align:right;'>পরিশোধ </td>
                    <td id='paid' style='text-align:right;' contentEditable='true'></td>               
                   </tr>

                   <tr>
                    <td></td>
                    <td></td>
                    <td style='text-align:right;'>বাকি </td>
                    <td id='due' style='text-align:right;'></td>
                   </tr>

                   </tfoot>

                </table>
              </div>
              <!-- /.card-body -->
            </div>

            </div>
        
        </div>
       
      </section>

    <!-- End Table -->


   <center> <input type="button" onclick="savedata()"  value="সংরক্ষণ করুন " class="btn btn-success"> </center>





</div>
