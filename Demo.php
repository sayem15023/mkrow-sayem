<html>
<head>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

<?php

include "connection.php";

$email="aminul@mkrow.com";

$pass="1234";

session_start(); 
		 
// Check .......................................................

$sql = "SELECT id FROM user where email='$email' and password='$pass' ";
$result = $conn->query($sql);

$validatuser=0;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $_SESSION["userid"] = $row["id"];
    $validatuser=1;
  }
} else {
  
}


// Redirect .......................................................

if($validatuser==1)
{

  echo "<script>
 


window.location.href='home.php';


</script>";

}
else{

  
  echo "<script>
  swal('Login Failed !','Wrong Email or Password ! Try Again ')
    .then((willDelete) => {
if (willDelete) {

window.location.href='index.html';
  
}
});
</script>";

}




?>

</body>

</html>