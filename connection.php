
<?php

$servername = "localhost";

// $username = "mkrokwsy_user";
// $password = "mksb1202011";

$username = "root";
$password = "";

$dbname = "hisab_khata1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


?>
