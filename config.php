<?php
$servername = "localhost";
$username = "u161922539_silviu";
$password = "Rusu931806809";
$db ="u161922539_silviu";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>