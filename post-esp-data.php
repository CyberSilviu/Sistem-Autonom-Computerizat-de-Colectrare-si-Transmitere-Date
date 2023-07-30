<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $value1 = $value2 = $value3 ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $value1 = test_input($_POST["value1"]);
        $value2 = test_input($_POST["value2"]);
        $value3 = test_input($_POST["value3"]);
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        date_default_timezone_set('Europe/Bucharest');
        $date = date("Y-m-d");
  
        $time = date("H:i:s");
        $sql = "INSERT INTO datas (value1, value2, value3, time, date)
        VALUES ('" . $value1 . "', '" . $value2 . "', '" . $value3 . "', '" . $time . "', '" . $date . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 
?>