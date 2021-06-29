<?php
session_start();
if (isset($_SESSION['inst'])){
    echo"
    <html lang='en'>
  <head>
  <title>Show current flow of instructions</title>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='styles.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
  </head>
  <body>
    <div class'container pt-3'>
    <p class='font-weight-bold text-center'> Current flow of instructions:</p> <p class'text-center'>". $_SESSION['inst']."</p>
    <script>
    function update(){
      window.location.href = 'showInstructions.php';
    }
    </script>
    <button type='button' class='btn btn-primary' onclick='update()'> Update</button>  
    </div>

    </body>
  </html>
    ";
}
?>