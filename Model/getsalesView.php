<?php 

include "../connection.php";

$salesid=$_POST["salesid"];

// Get Company Data ..................................................

$companyname="Shop Name";
$logosrc="dist/img/global_logo.png";

$sql = "SELECT * FROM basic_info where userid=(select userid from sales_master where id=$salesid)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $companyname=$row["shop_name"];
    $logo=$row["logo"];
    $logosrc="imageUpload/uploads/".$logo;
 $mobilenoshop=$row["mobileno"];
 $facebook=$row["facebook"];
 $shopcategory=$row["shop_categoryid"];
 $division=$row["division_id"];
 $district=$row["district_id"];
 $upazilla=$row["upazila_id"];
  }
} else {
  
}



// Get Upazilla ......................................

$up_name="";
$sqlsem = "SELECT * FROM upazilas where id=$upazilla";
$resultse = $conn->query($sqlsem);

if ($resultse->num_rows > 0) {
   
    while($rowse = $resultse->fetch_assoc()) {
       	   
       $up_name=$rowse["name"];

    }
} 


// Get District ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,

$dis_name="";
$sqlsem = "SELECT * FROM districts where id=$district";
$resultse = $conn->query($sqlsem);

if ($resultse->num_rows > 0) {
   
    while($rowse = $resultse->fetch_assoc()) {
       	   
       $dis_name=$rowse["name"];

    }
}

$address="";
if($up_name!="" && $dis_name!="")
{
   $address=$up_name.",".$dis_name;
}




// Show Sales Master ................................................................

?>

<div id="ContentDiv">

<div class="row">
    <div class="col-sm-2">
      <?php $logosrc="imageUpload/uploads/".$logo; if($logo=="") {echo "<img src='dist/img/global_logo.png' height='100px' width='100px' >"; } else { echo "<img src=$logosrc height='100px' width='100px' style='padding:10px; border-radius:20px;'>"; } ?>
    </div>
    <div class="col-sm-8" >
       <center><h3 style="  font-family: Lucida Console, Courier, monospace;"><?php echo $companyname ?></h3></center>
       <center><?php echo $address ?></center>
       <center><?php echo "Contact No : ".$mobilenoshop ?></center>
       <center><h5 style="margin-top:5px; margin-bottom:10px;"><b><?php echo "Sales Report" ?></b><h5></span></center>
      
    </div>
    <div class="col-sm-2" >
      <?php  ?>
    </div>
  </div>

<table id="" class="table table-bordered" style="width:100%">
<thead class="thead-light">
<tr>
  <th style='text-align:center;'>#</th>
  <th style = "display:none;" class="HideAfterDT">Customerid</th>
  <th>Customer</th>
  <th>Mobile No</th>
  <th>Date</th>
  <th>Total Price</th>
  <th>Paid</th>
  <th>Due</th>
  <th>Note</th>
  
</tr>
</thead>
<tbody>

<?php

$slno=0;

$sql = "SELECT * FROM sales_master where id=$salesid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$slno++;
$id=$row["id"];
$customerid=$row["customerid"];
$customer_name="";
$mobileno="";

$sqls = "SELECT name,mobileno FROM customer where id=$customerid";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
// output data of each row
while($rows = $results->fetch_assoc()) {
$customer_name=$rows["name"];
$mobileno=$rows["mobileno"];
}
} else {
// echo "0 results";
}

$sales_date=$row["sales_date"];
$grand_total=$row["grand_total"];
$paid=$row["paid"];
$due=$row["due"];
$note=$row["note"];

echo "<tr>";
echo "<td style='text-align:center;'>".$slno."</td>";
echo "<td style='display:none;' class='customerid  HideAfterDT'>".$customerid."</td>"; 
echo "<td class='customer_name'>".$customer_name."</td>"; 
echo "<td class='mobileno'>".$mobileno."</td>"; 
echo "<td class='sales_date'>".$row["sales_date"]."</td>";
echo "<td class='total_price'>".$row["total_price"]."</td>";
echo "<td class='paid'>".$row["paid"]."</td>";
echo "<td class='due'>".$due."</td>";
echo "<td class='note'>".$note."</td>";

echo "</tr>";

}
} else {

}
?>

</table>


<br>

<table id="" class="table table-bordered" style="width:100%">
                  <thead class="thead-light">
                  <tr>
                    <th style='text-align:center;'>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                    <th>Discount</th>
                    <th>Total</th>
                    
                  </tr>
                  </thead>
                  <tbody>


<?php

// Show Sales Detail .....................................................................................


$sl=0;

$sql = "SELECT * FROM sales_detail where salesid=$salesid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    $sl++;
    $detailid=$row["id"];
    $productid=$row["productid"];
    
    // Get Product Name ........................................
    $productname="";
    $sqlp = "SELECT name FROM product where id=$productid";
    $resultp = $conn->query($sqlp);
    
    if ($resultp->num_rows > 0) {
      // output data of each row
      while($rowp = $resultp->fetch_assoc()) {
        $productname=$rowp["name"];
      }
    } else {
      //echo "0 results";
    }

    $quantity=$row["quantity"];
    $unitprice=$row["unitprice"];
    $amount=$quantity*$unitprice;
    $discountdetail=$row["discount"];
    $total_price=$row["total_price"];


    $tabledata="<tr><td style='text-align:center;' class='slno'>".$sl."</td><td>".$productname."</td><td class='qty'>".$quantity."</td><td class='unitprice'>".$unitprice."</td><td class='amount'>".$amount."</td><td class='discountdetail'>".$discountdetail."</td><td class='totaldetail'>".$total_price."</td>"
    .""
    ."</tr>";

    echo $tabledata;

  }
} else {
  
}

?>

              </tbody>
                  <tfoot style="background-color:white; font-weight: bold;">
                   
                  </tfoot>
                  </table>



<?php

// Payment . . . . . . . .

$sql = "SELECT * FROM sales_payment where salesid=$salesid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  

  ?>

<br>

<table id="example1" class="table table-bordered" style="width:100%">
<thead class="thead-light">
<tr>
  <th style='text-align:center;'>#</th>
  <th>Payment Date</th>
  <th>Pay Amount</th>
  <th>Action</th>
  
</tr>
</thead>
<tbody>


  <?php

  $psl=1;
  $totalpay=0;

  while($row = $result->fetch_assoc()) {

    $id=$row["id"];
    
    echo "<tr>";

    echo "<td>".$psl."</td>";

    $psl++;

    echo "<td>".$row["payment_date"]."</td>";
    echo "<td>".$row["amount"]."</td>";

    $totalpay=$totalpay+$row["amount"];

    echo "<td class='text-center py-0 align-middle' style='text-align:center;'>
    <div class='btn-group btn-group-sm'>
      <a onclick=deletedata($id,this,'sales_payment') class='btn btn-danger'><i class='fas fa-trash'></i></a>
    </div>
  </td>";

    echo "</tr>";

  }

  ?>

</tbody>
 <tfoot style="background-color:white; font-weight: bold;">
                   
</tfoot>
</table>

  <?php

} else {
  


}


echo "</div>";

if($due>0)
{

  $currentdue=$due-$totalpay;

    ?>


     
<div class="form-group">               
  <input type="date" id="payment_date" style="width:20%; margin-left:20px; float:left;"  placeholder="" value="<?php echo date('Y-m-d'); ?>" class="form-control">
</div>
  <div class="form-group">
  <input type="number" style="width:20%; margin-left:20px; float:left;" class="form-control" id="pay_amount" placeholder="Amount">
</div>

<input type="button" style="width:20%; margin-left:20px; float:left;" onclick="addPayment(<?php echo $salesid ?>)" class="btn btn-success" value="Add New Payment">

<input type="button" style="width:20%; margin-left:30px; float:right;" class="btn btn-success" value="Current Due <?php echo $currentdue  ?> /=">



    </div>
    
  </div>
  
</div>

    <?php
}




?>

<br/>

<input type="button" onclick="printDiv('ContentDiv')" style="width:20%; margin-left:20px; float:left; margin-top:20px;" class="btn btn-primary" value="Print">
