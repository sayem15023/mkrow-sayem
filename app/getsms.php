<?php


$servername = "localhost";

$username = "asirisgu_user";
$password = "mksb1202011";

//$username = "root";
//$password = "";

$dbname = "asirisgu_inventory_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$count=0;


$mob="0";
$notice="No SMS";

$sql = "SELECT a.id,a.balance,b.mobileno,b.name FROM app_sms a,customer b  where a.customerid=b.id and a.status=0 order by a.id desc Limit 1";
$result = $conn->query($sql);
//echo $sql;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
	  $detailid=$row["id"];
	  $name=$row["name"];
	  $balance=$row["balance"];
	  $mob=$row["mobileno"];
	  
	  $notice="প্রিয় $name আপনার নিকট আমিনুল স্টোরে $balance টাকা বাকী রয়েছে। ";
	  echo $mob.",".$notice; 
	  

$sqlc = "update app_sms set status=1 where id=$detailid";
echo $sqlc;
$resultc = $conn->query($sqlc);

if ($resultc->num_rows > 0) {
    
} else {
    
   
}

	 
		
    }
} else {
    
      echo $mob.",".$notice; 
}




?>