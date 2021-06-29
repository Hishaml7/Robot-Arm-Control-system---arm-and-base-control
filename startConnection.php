<?php
 // information
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname   = "robotarmcontrol";
 // Create connection
 $conn = new mysqli($servername, $username, $password);
 if (!$conn){
     die("Connection failed: ". mysqli_connect_error());
 }
 // Connect with database
 $selected_db = mysqli_select_db($conn, $dbname);
 // Check connection
  if (!$selected_db){
     die("Connection failed: ". mysqli_error($conn));
}
?>