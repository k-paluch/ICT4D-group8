<?php

$user = $_GET['ChargeCallToNum'];
$vote = $_GET['vote'];


$servername = "localhost";
$username = "id18839033_ict4d_user";
$password = "sT[d+6qEhs!A5Rh}";
$database = "id18839033_ict4d";


$link = new mysqli($servername, $username, $password, $database);
$query ="SELECT Question from current_question";


$result = mysqli_query($link, $query); 
while($selectQueryRow = $result->fetch_array()) {
  $question=$selectQueryRow['Question'];
}


    
$sql = "INSERT INTO ICT4D(number_ID, vote,Question) VALUES ('$user', $vote, '$question') ON DUPLICATE KEY UPDATE vote='$vote'";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);

?>

