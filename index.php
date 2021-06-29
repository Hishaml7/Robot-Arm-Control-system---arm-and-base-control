<?php
session_start();
require_once("startConnection.php");
if (!isset($_SESSION['inst'])) {
    $_SESSION['inst'] = "";
    $_SESSION['lastinst'] = "None";
}
$query = "SELECT * FROM main LIMIT 1";
$result = @mysqli_query($conn, $query);
$status = "Run arm";
if (isset($_GET['save'])) {
    $query2 = "SELECT * FROM main";
    $result2 = @mysqli_query($conn, $query2);
    if (mysqli_num_rows($result) > 0) {
        $query3 = "UPDATE main SET Engine1 =" . $_GET['e1'] . ", Engine2 =" . $_GET['e2'] . ", Engine3 =" . $_GET['e3'] . ", Engine4 =" . $_GET['e4'] . ", Engine5 =" . $_GET['e5'] . ", Engine6 =" . $_GET['e6'];
        if (mysqli_query($conn, $query3)) {
            echo "<script> alert('Data saved successfully'); window.location.href = 'index.php'; </script>";
        } else {
            echo "<script> alert('Error:" . mysqli_error($conn) . " ') </script>";
        }
    } else if (mysqli_num_rows($result) == 0) {
        $query4 = "INSERT INTO main (Engine1, Engine2, Engine3, Engine4, Engine5, Engine6, StatusOn)
        VALUES (" . $_GET['e1'] . "," . $_GET['e2'] . "," . $_GET['e3'] . "," . $_GET['e4'] . "," . $_GET['e5'] . "," . $_GET['e6'] . "," . "false)";
        if (mysqli_query($conn, $query4)) {
            echo "<script> alert('Data saved successfully') </script>";
        } else {
            echo "<script> alert('Error:" . mysqli_error($conn) . " ') </script>";
        }
    }
}
$e1 = $e2 = $e3 = $e4 = $e5 = $e6 = 90;
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = "Run arm";
    $st = "btn-success";
    if ($row["StatusOn"] == true) {
        $status = "Stop arm";
        $st = "btn-danger";
    }
    $e1 = $row["Engine1"];
    $e2 = $row["Engine2"];
    $e3 = $row["Engine3"];
    $e4 = $row["Engine4"];
    $e5 = $row["Engine5"];
    $e6 = $row["Engine6"];
}


if (isset($_POST['forward']) || isset($_POST['backward']) || isset($_POST['left']) || isset($_POST['right']) || isset($_POST['stop'])) {
    $actionType = "";
    if (isset($_POST['forward'])) {
        $actionType = "f";
        $_SESSION['inst'] .= " Forward ->";
        $_SESSION['lastinst'] = "Forward";
    }
    if (isset($_POST['backward'])) {
        $actionType = "b";
        $_SESSION['inst'] .= " Backward ->";
        $_SESSION['lastinst'] = "Backward";
    }
    if (isset($_POST['left'])) {
        $actionType = "l";
        $_SESSION['inst'] .= " Left ->";
        $_SESSION['lastinst'] = "Left";
    }
    if (isset($_POST['right'])) {
        $actionType = "r";
        $_SESSION['inst'] .= " Right ->";
        $_SESSION['lastinst'] = "Right";
    }
    if (isset($_POST['stop'])) {
        $actionType = "s";
        $_SESSION['inst'] .= " Stop ->";
        $_SESSION['lastinst'] = "Stop";
    }
    $query5 = "INSERT INTO base (actionType) VALUES ('$actionType')";
    mysqli_query($conn, $query5);
    echo "<script> window.location.href = 'index.php'; </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Robot Control System</title>
    <meta charset="UTF-8">
    <meta name="description" content="Robot control system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- linking bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="sliderValue.js"></script>
</head>

<body>
    <form action="index.php" method="POST" class="container pt-3">
        <h2 class="font-weight-bold"> Base control:</h2>
        <div class="row text-center form-group">
            <div class="col-12">
                <input type="submit" name="forward" id="forward" class="btn btn-primary btn-lg" value='Forward' role="button">
            </div>
        </div>
        <div class="row text-center form-group">
            <div class="col-12">
                <input type="submit" name="left" id="left" class="btn btn-primary btn-lg" value='Left' role="button">
                <input type="submit" name="stop" id="stop" class='btn btn-danger btn-lg' value='Stop' role="button">
                <input type="submit" name="right" id="right" class="btn btn-primary btn-lg" value='Right' role="button">
            </div>
        </div>
        <div class="row text-center form-group">
            <div class="col-12">
                <input type="submit" name="backward" id="backward" class="btn btn-primary btn-lg m" value='Backward' role="button">
            </div>
        </div>
    </form>
    <form action="showInstructions.php" method="POST" class="container pt-3" target="_blank">
        <div class="row text-center form-group">
            <div class="col-12">
                <input type="submit" name="showi" id="showi" class="btn btn-primary btn-lg" value='Show current flow of instructions' role="button">
            </div>
        </div>
    </form>
    <div class="container pt-3 text-center">
        <p class="font-weight-bold"> Last instruction: <?php echo "" . $_SESSION['lastinst']; ?></p>
    </div>
    <hr>
    <div class="container pt-3">
        <h2 class="font-weight-bold"> Arm control:</h2>
        <form action="index.php" method="GET" class="row">
            <div class="col-12 border border-dark main">
                <label for="e1" class="form-label col-12">Engine 1</label>
                <input type="range" class="custom-range" min="0" max="180" step="1" id="e1" name="e1" onchange="engine1()" value='<?php echo "$e1"; ?>'>
                <label for="e1" class="form-label col-12" id="t1">Value: <?php echo "$e1"; ?></label>
            </div>
            <div class="col-12 border border-dark main">
                <label for="e2" class="form-label col-12" col-12>Engine 2</label>
                <input type="range" class="custom-range" min="0" max="180" step="1" id="e2" name="e2" onchange="engine2()" value='<?php echo "$e2"; ?>'>
                <label for="e2" class="form-label col-12" id="t2">Value: <?php echo "$e2"; ?></label>
            </div>
            <div class="col-12 border border-dark main">
                <label for="e3" class="form-label col-12">Engine 3</label>
                <input type="range" class="custom-range" min="0" max="180" step="1" id="e3" name="e3" onchange="engine3()" value='<?php echo "$e3"; ?>'>
                <label for="e3" class="form-label col-12" id="t3">Value: <?php echo "$e3"; ?></label>
            </div>
            <div class="col-12 border border-dark main">
                <label for="e4" class="form-label col-12">Engine 4</label>
                <input type="range" class="custom-range" min="0" max="180" step="1" id="e4" name="e4" onchange="engine4()" value='<?php echo "$e4"; ?>'>
                <label for="e4" class="form-label col-12" id="t4">Value: <?php echo "$e4"; ?></label>
            </div>
            <div class="col-12 border border-dark main">
                <label for="e5" class="form-label col-12">Engine 5</label>
                <input type="range" class="custom-range" min="0" max="180" step="1" id="e5" name="e5" onchange="engine5()" value='<?php echo "$e5"; ?>'>
                <label for="e5" class="form-label col-12" id="t5">Value: <?php echo "$e5"; ?></label>
            </div>
            <div class="col-12 border border-dark main">
                <label for="e6" class="form-label col-12">Engine 6</label>
                <input type="range" class="custom-range" min="0" max="180" step="1" id="e6" name="e6" onchange="engine6()" value='<?php echo "$e6"; ?>'>
                <label for="e6" class="form-label col-12" id="t6">Value: <?php echo "$e6"; ?></label>
            </div>
            <div class="container pt-3">
                <input type="submit" name="save" id="save" class="btn btn-primary btn-lg" value="Save" role="button">
            </div>
        </form>
        <form action="run.php" method="GET" class="pt-3">
            <input type="submit" name="run" id="run" class='btn <?php echo "$st"; ?> btn-lg' value='<?php echo "$status"; ?>' role="button">
            <input type="submit" name="show" id="show" class="btn btn-primary btn-lg" value='Show current values' role="button">
        </form>
    </div>

</body>

</html>