<?php
$servername = "localhost";
$username = "YogurtSnek";
$password = "8AxTe=)Sp4>ND+8&>/\$W";
$dbName = "questionairedb";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$randID = rand(100,999);
$verification = false;

do {
  
  if (mysqli_query($conn, "SELECT verifyID({$randID});")) {
    $verification = true;
    echo "<br>Verified ID, proceeding with user creation...";
  }
}  while ($verification == false);

$sql = "insert into users values ({$randID}, \"TestUser\")";

if (mysqli_query($conn, $sql) === TRUE) {
  echo "<br>New record created successfully";
} else {
  echo "<br>Error: " . $sql . "<br>" . $conn->error;
}

echo "<br>Closing Connection...";
$conn->close();

?>