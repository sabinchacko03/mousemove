<?php

$coordinates = $_POST['mousemove'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mousemove";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "INSERT INTO coordinates (value_array) VALUES ('$coordinates')";

if ($conn->query($sql) === TRUE) {
    $message = 'Saved';
} else {
  $message = 'Failed <br/>' . mysqli_error($conn);
}
$conn->close();
echo json_encode(array('result' => $message));


?>