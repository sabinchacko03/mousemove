<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mousemove";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT value_array FROM coordinates ORDER BY id DESC LIMIT 1";

$message = array();

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $message['coordinates'] = $row['value_array'];
  }
} else {
  $message['coordinates'] = '0';
}
$conn->close();
echo json_encode($message);


?>