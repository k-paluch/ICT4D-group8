<?php

$servername = "localhost";
$username = "id18839033_ict4d_user";
$password = "sT[d+6qEhs!A5Rh}";
$database = "id18839033_ict4d";

$link = new mysqli($servername, $username, $password, $database);
    

$query ="SELECT COUNT(vote) from ICT4D where vote=1";
$result = mysqli_query($link, $query); 
while($selectQueryRow = $result->fetch_array()) {
  $vote_y=$selectQueryRow['COUNT(vote)'];
}

$query ="SELECT COUNT(vote) from ICT4D where vote=0";
$result = mysqli_query($link, $query); 
while($selectQueryRow = $result->fetch_array()) {
    $vote_n=$selectQueryRow['COUNT(vote)'];
}

mysqli_close($link);


function cal_percentage($num_amount, $num_total) {
  $count1 = $num_amount / $num_total;
  $count2 = $count1 * 100;
  $count = number_format($count2, 0);
  return $count;
}


$w_y = cal_percentage($vote_y,$vote_y+$vote_n);
$w_n = cal_percentage($vote_n,$vote_y+$vote_n);

echo '<html>
<link rel="stylesheet" href="main.css">
<section>
  <h1>Voting results: </h1>
  <div class="poll-option">
    <span class="poll-option__label">Yes</span>
    <table class="poll-option__result">
      <tr>
        <td>'.$vote_y.'</td>
        <td>
          <span></span>
          <span style="width: '.$w_y.'%;"></span>
        </td>
        <td>'.$w_y.'%</td>
      </tr>
    </table>
  </div>
  
  <div class="poll-option">
    <span class="poll-option__label">No</span>
    <table class="poll-option__result">
      <tr>
        <td>'.$vote_n.'</td>
        <td>
          <span></span>
          <span style="width: '.$w_n.'%;"></span>
        </td>
        <td>'.$w_n.'%</td>
      </tr>
    </table>
  </div>
  
</section>
</html>'

?>