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

    echo header("Location: home.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="user-accounts">
        <ul>
            <li>Student Database</li>
            <li>
                <a class="home" href="home.php">Home</a>
            </li>
            <li>
                <?php if (!isset($_SESSION)) {
                    session_start();
                }

                if (isset($_SESSION["UserLogin"])) {
                    echo "Welcome, " . $_SESSION['UserLogin'] . "!";
                } else {
                    echo "Welcome Guest";
                } ?>
            </li>
            <li class="login-logout">
                <?php if (isset($_SESSION['UserLogin'])) { ?>
                    <a href=" logout.php">Logout</a>
                <?php } else { ?>

                    <a href="login.php">Login</a>
                <?php } ?>
            </li>
        </ul>
    </nav>

    <main class="insert-section">
        <span class="insert">
            <a href="home.php">Back to Students' Information</a>
        </span>
        <form class="insert-form" action="#" method="post">
            <h3>Enter Student Information</h3>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>