<?php


include "../connection.php";

$deletedid=$_POST["deletedid"];
$tablename=$_POST["tablename"];
$detailtablename=$_POST["detailtablename"];
$masteridname=$_POST["masteridname"];


// sql to delete a record Detail 
$sql = "DELETE FROM $detailtablename WHERE $masteridname=$deletedid";

if ($conn->query($sql) === TRUE) {
  //echo "Record deleted successfully";
} else {
  //echo "Error deleting record: " . $conn->error;
}

// sql to delete a record master
$sql = "DELETE FROM $tablename WHERE id=$deletedid";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}


?>