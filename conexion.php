  
<?php

$servername = "bfpefjoyqfutj3kawr98-mysql.services.clever-cloud.com:3306";
$database = "bfpefjoyqfutj3kawr98";
$username = "u9oqkqjvsiok9pxt";
$password = "nJ5nsu5Xt5uhDqx21wHE";
 Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);




?>
