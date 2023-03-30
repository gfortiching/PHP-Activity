<?php

include_once("Connections/connection.php");

$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM student_info WHERE ID = '$id'";

$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

if (isset($_POST['submit'])) {
    echo "Submitted";
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    $sql = "UPDATE student_info SET First_Name = '$fname', Last_Name = '$lname', Gender = '$gender', Birth_Date = '$birthdate' WHERE ID = '$id'";
    $con->query($sql) or die($con->error);

    echo header("Location: details.php?ID=" . $id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

</html>

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
            <li class="logInOut">
                <?php if (isset($_SESSION['UserLogin'])) { ?>
                    <a href=" logout.php">Logout</a>
                <?php } else { ?>

                    <a href="login.php">Login</a>
                <?php } ?>
            </li>
        </ul>
    </nav>

    <main class="edit-section">
        <div class="back">
            <a href="home.php">Back to Students' Information</a>
        </div>
        <form class="edit-student" action="" method="post">
            <h3>Update Student Details</h3>
            <label>First Name</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $row['First_Name']; ?>" />
            <label>Last Name</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $row['Last_Name']; ?>" />
            <label>Gender</label>
            <select name="gender" id="gender">
                <option value="Male" <?php echo ($row['Gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($row['Gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
            </select>
            <label>Date of Birth</label>
            <input type="text" name="birthdate" id="birthdate" value="<?php echo $row['Birth_Date']; ?>" />
            <input type="submit" name="submit" value="Update">
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>