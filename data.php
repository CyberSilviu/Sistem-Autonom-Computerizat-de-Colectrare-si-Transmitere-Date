<!DOCTYPE html>
<html>
<head>
<?php
session_start();
require_once('config.php');
?>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="data.css">
	<title>Datele Colectate</title>
</head>
<header>
<a class="buton" href="index">Back</a>
</header>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    <script>
      var mybutton = document.getElementById("myBtn");
      window.onscroll = function() {scrollFunction()};
      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      }
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
<h1>Datele Colectate</h1>
<div class="container">
<form action="" method="GET">
<div class="col-75">
<select name="date">
    <option value="">Selectează Data</option>
    <?php 
    $query ="SELECT distinct date FROM datas";
    $result = $conn->query($query);
    if($result->num_rows> 0){
        while($optionData=$result->fetch_assoc()){
        $option =$optionData['date'];
        $id =$optionData['id'];
    ?>
    <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
    
   <?php
    }}
    ?>
</select>
</div>
<div class="row">
      <input type="submit" value="Submit">
</div>
</form>
</div>

<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
$reading_time = $_GET['date'];

$sql = "SELECT id, value1, value2, value3, date, time  FROM datas WHERE date='$reading_time'";

echo '<table class="styled-table" >
<thead>
      <tr> 
        <th>ID</th> 
        <th>Data</th>
        <th>Ora</th>
        <th>Temperatura &deg;C</th> 
        <th>Umiditatea &#37;</th>
        <th>Calitate Aer PPM;</th>    
      </tr></thead>';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $row_id = $row["id"];
        $row_date = $row["date"];
        $row_time = $row["time"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        echo '<tbody><tr> 
                <td>' . $row_id . '</td>
                <td>' . $row_date . '</td> 
                <td>' . $row_time . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_value2 . '</td>
                <td>' . $row_value3 . '</td>
                
              </tr></tbody>';
    }
    $result->free();
}


$conn->close();
?> 
</table>
<br>
<br>
</body>
</html>

</body>
<footer class="footer-distributed">

  <div class="footer-right">

    <a href="https://www.facebook.com/silviuandrei.muraru.96"><img src="fb.png" alt="facebook" style="width:35px;height:35px;"></a>
    <a href="https://www.instagram.com/silviu.andrei.muraru/"><img src="i.png" alt="instagram" style="width:35px;height:35px;"></a>

  </div>

  <div class="footer-left">

    <p>Silviu &copy; 2022</p>
  </div>

</footer>
</html>