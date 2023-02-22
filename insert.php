<?php

include_once("Connections/connection.php");
$con = connection();

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    $sql = "INSERT INTO `student_info`(`ID`, `First_Name`, `Last_Name`, `Gender`, `Birth_Date`) VALUES ('$id','$fname','$lname','$gender', '$birthdate')";

    $con->query($sql) or die($con->error);

    echo header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="/School_Registrar/css/styles.css">
</head>

<body>
    <div class="userAccounts">
        <h1>
            <?php if (!isset($_SESSION)) {
                session_start();
            }

            if (isset($_SESSION["UserLogin"])) {
                echo "Welcome " . $_SESSION['UserLogin'];
            } else {
                echo "Welcome Guest.";
            } ?>
        </h1>
    </div>
    <div class="logInOut">
        <?php if (isset($_SESSION['UserLogin'])) { ?>
            <a href=" logout.php">Logout</a>
        <?php } else { ?>

            <a href="login.php">Login</a>
        <?php } ?>
    </div>
    <div class="insert">
        <a href="index.php">Back to Students' Information</a>
    </div>
    <form class="insertForm" action="#" method="post">
        <h2>Enter Student Information</h2>
        <label>ID</label>
        <input type="text" name="id" id="search">
        <label>First name </label>
        <input type="text" name="firstname" id="search">
        <label>Last name </label>
        <input type="text" name="lastname" id="search">
        <label>Gender </label>
        <input type="text" name="gender" id="search">
        <label>Birth Date</label>
        <input type="date" name="birthdate" id="search">
        <input type="submit" name="submit" value="Submit Form">
    </form>

</body>

</html>