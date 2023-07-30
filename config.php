<?php
$servername = "localhost";
$username = "";
$password = "";
$db ="";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>