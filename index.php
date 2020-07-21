<?php

    $servername = "bfpefjoyqfutj3kawr98-mysql.services.clever-cloud.com:3306";
    $database = "bfpefjoyqfutj3kawr98";
    $username = "u9oqkqjvsiok9pxt";
    $password = "nJ5nsu5Xt5uhDqx21wHE";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    //$sql = "INSERT INTO acumulador (acum) VALUES ('1')";
    if (mysqli_query($conn)) {
      echo "conexion lograda";
   } 
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
?>
