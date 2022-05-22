<?php



$add_question = $_GET['add_question'];

$servername = "localhost";
$username = "id18839033_ict4d_user";
$password = "sT[d+6qEhs!A5Rh}";
$database = "id18839033_ict4d";

$link = new mysqli($servername, $username, $password, $database);
$sql = "INSERT into questions(Question) values('$add_question')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$query ="SELECT Question from current_question";

$result = mysqli_query($link, $query); 
while($selectQueryRow = $result->fetch_array()) {
  $question=$selectQueryRow['Question'];
}


$query ="SELECT COUNT(vote) from ICT4D where vote=1 AND Question= '$question'";
$result = mysqli_query($link, $query); 
while($selectQueryRow = $result->fetch_array()) {
  $vote_y=$selectQueryRow['COUNT(vote)'];
}

$query ="SELECT COUNT(vote) from ICT4D where vote=0 AND Question= '$question'";
$result = mysqli_query($link, $query); 
while($selectQueryRow = $result->fetch_array()) {
    $vote_n=$selectQueryRow['COUNT(vote)'];
}




   
function getoptions($link, $query) {
    $query ="SELECT Question from questions";

$result = mysqli_query($link, $query); 
    $opt ="<select name='question_change'>";
    foreach( $result as $row ){
    $opt .= "<option>" . $row['Question'] . "</option>";
   };
    $opt .="</select>";
  return $opt;
}

$opt = getoptions($link, $query);


mysqli_close($link);


function cal_percentage($num_amount, $num_total) {
    if ($num_total == 0) {
  return 0;
}
  $count1 = $num_amount / $num_total;
  $count2 = $count1 * 100;
  $count = number_format($count2, 0);
  return $count;
}


$w_y = cal_percentage($vote_y,$vote_y+$vote_n);
$w_n = cal_percentage($vote_n,$vote_y+$vote_n);

echo '<html>
<link rel="stylesheet" href="main.css">
<h1>Add new question into the database:</h1>
<form action ="add_question.php">
    <input name="add_question" type="text"/>
    <input type="submit" name ="submit" value="submit"/>
</form>
<h1>Change question to vote on (the results for the chosen question will then be shown):</h1>
<form action ="change_question.php">

    '.$opt.'
    <input type="submit" name ="submit" value="submit"/>
</form>
<section>
  <h1>'.$question.' </h1>
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