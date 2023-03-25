<!DOCTYPE html>
<html>
<head>
<?php
session_start();
require_once('config.php');
?>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="humidity.css">
	<title>Humidity Chart</title>

</head>
<header>
<a class="buton" href="charts">Back</a>
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
<h1>Umiditatea în funcție de timp</h1>
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

$sql = "SELECT id, value2, time, date FROM datas WHERE date='$reading_time'";
 
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
       $time = $row["time"];
       $humidity = $row["value2"];    
    }
}

    $time = array();
    $humidity = array();
    foreach ($result as $row) 
    {
        $humidity[] = [
            'x' => $row["time"],
            'y' => $row["value2"]
        ];
    }
?>
<?php
  $reading_time = $_GET['date'];
  $query = "SELECT MAX(value2) AS max_hum FROM datas  WHERE date='$reading_time'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  echo "<div style='text-align:center; font-size:22px; color:white;'>"; 
  echo "Umiditatea maximă este: ";echo $row['max_hum'];
  echo "</div>";
?>
<?php
  $reading_time = $_GET['date'];
  $query = "SELECT MIN(value2) AS min_hum FROM datas  WHERE date='$reading_time'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  echo "<div style='text-align:center; font-size:22px; color:white;'>"; 
  echo "Umiditatea minimă este: ";echo $row['min_hum'];
  echo "</div>";
?>
<?php
  $reading_time = $_GET['date'];
  $query = "SELECT ROUND(AVG(value2),2) AS average_hum FROM datas  WHERE date='$reading_time'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  echo "<div style='text-align:center; font-size:22px; color:white;'>"; 
  echo "Media umidităților este: ";echo $row['average_hum'];
  echo "</div>";
?>
<br>
<table>
<tr><th>
<div class="diagram_div">
<canvas id="Humid_Chart"></canvas>
</div>
<script>
    const data = 
    {
        datasets: [
        {
            label: 'Umiditatea:',
            backgroundColor: '#a320e07a',
            borderColor: '#7604aa',
            data: <?= json_encode($humidity) ?>,
            borderWidth: 1,
        }]
    };
    var chartEl = document.getElementById("Humid_Chart");
    chartEl.height = 250;
    const config = 
    {
        type: 'line',
        data: data,
        options: 
        {
            plugins: 
            {
               
                legend: 
                {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    };
</script>
<script>
    const myChart = new Chart
    (
        document.getElementById('Humid_Chart'),
        config
    );
</script>
</th> 
</tr>
</table>
<br>
<br>
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