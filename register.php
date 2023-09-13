<?php 

include "connection.php";

$name=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];

    $sql="INSERT INTO user(name,email,password,registration_date,status)
    VALUES ('$name','$email','$password',Now(),'I')";

    if ($conn->query($sql) === TRUE) {
     
      echo "<script> alert('Registration Successful ! ! !'); window.location.href='index.html'; </script>";

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>