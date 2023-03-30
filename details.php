<?php

include_once("Connections/connection.php");

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM student_info WHERE ID ='$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

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

    <main class="details-section">
        <span class="back">
            <a class="back" href="home.php">Back to List of Students</a>
        </span>

        <section class="student-info">
            <h3>Student Info</h3>
            <p>Student ID:
                <span class="info">
                    <?php echo $row['ID']; ?>
                </span>
            </p>
            <p>Name:
                <span class="info">
                    <?php echo $row['First_Name']; ?>
                    <?php echo $row['Last_Name']; ?>
                </span>
            </p>
            <p>Gender:
                <span class="info">
                    <?php echo $row['Gender']; ?>
                </span>
            </p>
            <p>Date of Birth:
                <span class="info">
                    <?php echo $row['Birth_Date']; ?>
                </span>
            </p>
            <div class="d-flex flex-row justify-content-center mt-5">
                <a class="edit-info" href="edit.php?ID=<?php echo $row['ID']; ?>">Edit Info</a>
                <form action="delete.php" method="post">
                    <button class="delete edit-info" type="submit" name="delete">Delete</button>
                    <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>" />
                </form>
                <div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>