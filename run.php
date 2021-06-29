<?php
require_once("startConnection.php");
// check if run was clicked
$title = "Show current values";
if (isset($_GET['run'])) {
  $title = "Update status";
  if ($_GET['run'] == "Run arm") {
    $query = "UPDATE main SET StatusOn = true";
  } else {
    $query = "UPDATE main SET StatusOn = false";
  }
  if (mysqli_query($conn, $query)) {
    echo "<script> alert('Status updated successfully') </script>";
  } else {
    echo "<script> alert('Error:" . mysqli_error($conn) . " ') </script>";
  }
}

$query2 = "SELECT * FROM main LIMIT 1";
$result2 = @mysqli_query($conn, $query2);
if (mysqli_num_rows($result2) > 0) {
  $row = mysqli_fetch_assoc($result2);
  $e1 = $row["Engine1"];
  $e2 = $row["Engine2"];
  $e3 = $row["Engine3"];
  $e4 = $row["Engine4"];
  $e5 = $row["Engine5"];
  $e6 = $row["Engine6"];
  if ($row["StatusOn"] == true) {
    $status = "On";
  } else {
    $status = "Off";
  }
  echo "
  <html lang='en'>
  <head>
  <title>$title</title>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='styles.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
  </head>
  <body class='table-responsive'>
  <table class='table table-bordered '>
  <thead>
      <tr>
        <th>Engine 1</th>
        <th>Engine 2</th>
        <th>Engine 3</th>
        <th>Engine 4</th>
        <th>Engine 5</th>
        <th>Engine 6</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td> $e1</td>
      <td> $e2</td>
      <td> $e3</td>
      <td> $e4</td>
      <td> $e5</td>
      <td> $e6</td>
      <td> $status</td>
      </tr>
    </tbody>
  </table>
  <script>
  function back(){
    window.location.href = 'index.php';
  }
  </script>
  <button type='button' class='btn btn-primary' onclick='back()'> Go back</button>
  </body>
  </html>
  ";
}
