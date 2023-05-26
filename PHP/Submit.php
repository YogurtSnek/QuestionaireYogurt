
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Boom</title>
</head>
<body>
  <table class="table table-dark table-hover">  
    <thead>
      <tr class="table-info">
        <th scope="col">UserID</th>
        <th scope="col">Name</th>
        <th scope="col">Score</th>
      </tr>
    </thead>
<?php
$servername = "localhost";
$username = "YogurtSnek";
$password = "8AxTe=)Sp4>ND+8&>/\$W";
$dbName = "questionairedb";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

/* check connection */
if ($conn->connect_errno) {
  $error = $conn->connect_error;
  console_log('"Connect failed: " {$error}');
  exit();
} else {
  console_log("Successful Connection");
}

/*--------- Generation of User ID and verification of it ---------*/
$randID = rand(100,999);
$verification = false;
$sql = "SELECT verifyID({$randID})";


do {
  if (mysqli_query($conn, $sql)) {
    $verification = true;
    console_log("Generated ID, proceeding with user creation...");
  }
}  while ($verification == false);


$name = test_input($_POST['name']);

$sql = "INSERT into users values ({$randID}, '{$name}');";
  
if ( FALSE === mysqli_query($conn, $sql)) {
  $error = mysqli_error($conn);
  console_log("Error: " . $error);
}  else {
  console_log("New user has been created");
} 




/*--------- Insertion of User Answers based on their created ID and the form answers they submitted ---------*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Q1 = test_input($_POST["stuff1"]) . test_input($_POST["stuff2"]) . test_input($_POST["stuff3"]) . test_input($_POST["stuff4"]) . test_input($_POST["stuff5"]);
  $Q2 = test_input($_POST["lol"]);
  $Q3 = test_input($_POST["Radio-Selection"]);
}

$sql = "insert into useranswers values ({$randID}, 1, '{$Q1}'), ({$randID}, 2, '{$Q2}'), ({$randID}, 3, '{$Q3}');";

if ( FALSE === mysqli_query($conn, $sql)) {
  $error = mysqli_error($conn);
  console_log("Error: " . $error);
}  else {
  console_log("Answers have been inputted.");
} 


$sql = "select UserID, Name, sum(if(Q.Answers = UserAnswers, 1, 0)) as Right_as_Number
from questionaireanswers as Q

inner join

(select U.UserID, U.Name, UA.Question, UA.UserAnswers
from  users as U inner join useranswers as UA 
where U.UserID = UA.UserID) as UA_with_name

where Q.Question = UA_with_name.Question

group by UserID, Name;";


console_log("<br>Fetching Scores...");

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  echo "<tbody>";
  while($row = $result->fetch_assoc()) {
    echo "<tr class='table-light'>
            <th scope='row'>".$row["UserID"]."</th>
            <td>".$row["Name"]."</td>
            <td>".$row["Right_as_Number"]."</td>
          </tr>";
  }
  echo "</tbody></table>";
} else {
  console_log("0 Results");
}

$result->free();

console_log("Closing Connection...");
$conn->close();


/*--------- Function for cleaning the data from any junk it might have ---------*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/*--------- Function for console logging ---------*/
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }

  echo $js_code;
}


/*--------- Code for Pinging the Server ---------*/
/* check if server is alive 
if ($conn->ping()) {
  echo "<br>Our connection is ok!\n";
} else {
  echo "<br>Error: %s\n", $conn->error;
}
*/

?>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>





