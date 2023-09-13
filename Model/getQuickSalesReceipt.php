
<style>

#footer {
    margin-top: 50%;
}
</style>

<?php 

include "../connection.php";

$salesid=$_POST["salesid"];

// Show Sales Master ................................................................

?>

<div id="ContentDiv">



<table id="" class="table" style="width:100%; font-size:18px;">
<thead class="thead-white">

</thead>
<tbody>

<?php



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
 $custom_address=$row["address"];
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
if($custom_address!="")
{
  $address=$custom_address."<br>";
}


if($up_name!="" && $dis_name!="")
{
   $address=$address."".$up_name.",".$dis_name;
}



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

$sqls = "SELECT name,mobileno,address FROM customer where id=$customerid";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
// output data of each row
while($rows = $results->fetch_assoc()) {
$customer_name=$rows["name"];
$customer_address=$rows["address"];
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

echo "<td style='width20%;'><img src=$logosrc height='100px' width='100px' style='border-radius:5px;' ></td><td style='width:20%;'></td>
<td style='text-align:center; float:left;'colspan='4'><b><span style='font-size:24px;  font-family: Lucida Console, Courier, monospace;'>".$companyname."</b></span><br>".$address."<br>Contact : ".$mobilenoshop."</td>";

echo "</tr>";

//echo "<tr><td colspan='5' style='text-align:center;'>Recipt</td></tr>";

echo "<tr>";

echo "<td style='width:20%'><b>Customer Name</b></td>"; 
echo "<td class='customer_name'>".$customer_name."</td>"; 

echo "</tr>";

echo "<tr>";

echo "<td style='width:20%'><b>Customer Address</b></td>"; 
echo "<td class='customer_address'>".$customer_address."</td>"; 

echo "</tr>";

echo "<tr>";

echo "<td style='width:20%'><b>Mobile No</b></td>"; 
echo "<td class=''>".$mobileno."</td>"; 

echo "</tr>";


echo "<tr>";

echo "<td style='width:20%'><b>Date</b></td>"; 
echo "<td class=''>".$row["sales_date"]."</td>"; 

echo "</tr>";


}
} else {

}
?>

</tbody>
</table>


<br>

<table id="" class="table" style="width:100%; font-size:18px;" >
                  <thead class="thead-light">
                  <tr>
                    <th style='text-align:center;'>#</th>
                    <th>Code</th>
                    <th>Product</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    
                  </tr>
                  </thead>
                  <tbody>


<?php

// Show Sales Detail .....................................................................................


$sl=0;
$grand_total=0;

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
    $sqlp = "SELECT code,name,model FROM product where id=$productid";
    $resultp = $conn->query($sqlp);
    
    if ($resultp->num_rows > 0) {
      // output data of each row
      while($rowp = $resultp->fetch_assoc()) {
        $code=$rowp["code"];
        $productname=$rowp["name"];
        $model=$rowp["model"];
      }
    } else {
      //echo "0 results";
    }

    $quantity=$row["quantity"];
    $total_price=$row["total_price"];

    $grand_total=$grand_total+$total_price;

    echo "<tr>";
    echo "<td style='text-align:center; width:15%;'>".$sl."</td>";
    echo "<td>".$code."</td>";
    echo "<td>".$productname."</td>";
    echo "<td>".$model."</td>";
    echo "<td>".$quantity."</td>";
    echo "<td>".$total_price."</td>";
    echo "</tr>";

    

  }
} else {
  
}





// Payment . . . . . . . .

$sql = "SELECT * FROM sales_payment where salesid=$salesid";
$result = $conn->query($sql);

$totalpay=0;

if ($result->num_rows > 0) {
  $psl=1;
  
  while($row = $result->fetch_assoc()) {
    $id=$row["id"];
   
    $totalpay=$totalpay+$row["amount"];
  }
} else {
}

$currentdue=$due-$totalpay;

?>

              </tbody>
                  <tfoot style="background-color:white; font-weight: bold;">
                     <tr> <td style='text-align:right;' colspan="5">Grand Total : </td> <td><?php echo $grand_total ?></td> </tr>
                     <tr> <td style='text-align:right;' colspan="5">Paid : </td> <td><?php echo $paid ?></td> </tr>
                     <tr> <td style='text-align:right;' colspan="5">Due : </td> <td><?php echo $due ?></td> </tr>
                     <?php if($totalpay>0){ ?>
                     <tr> <td style='text-align:right;' colspan="5">Payment : </td> <td><?php echo $totalpay ?></td> </tr>
                     <tr> <td style='text-align:right;' colspan="5">Current Due : </td> <td><?php echo $currentdue ?></td> </tr>
                     <?php } ?>

                  </tfoot>
                  </table>


                  <div id="footer"><table  class="table" style="width:100%; font-size:18px;"><tr style='border-top:none;'><td style='text-align:center;'>Received By</td> <td style='text-align:center;'>Prepared By</td> <td style='text-align:center;'>Checked By</td> <td style='text-align:center;'>Authorized By</td> </tr>
</table></div>

</div>



<br>
                  <input type="button" style="width:20%; margin-left:0px; float:left;" onclick="printDiv('ContentDiv')" class="btn btn-success" value="Print receipt">
                  