<?php

$servername = "localhost";
$username = "id18839033_ict4d_user";
$password = "sT[d+6qEhs!A5Rh}";
$database = "id18839033_ict4d";



$link = new mysqli($servername, $username, $password, $database);
    
$sql = "TRUNCATE TABLE ICT4D";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);

?>