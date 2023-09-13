<?php 

include "../connection.php";

$sql=$_POST["sql"];
$returnsql=$_POST["returnsql"];


    if ($conn->query($sql) === TRUE) {
           
      $results = $conn->query($returnsql);     
      if ($results->num_rows > 0) {
        // output data of each row
        while($rows = $results->fetch_assoc()) {
         echo $rows["id"];
        }
      } else {
        echo "0 results";
      }


    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>