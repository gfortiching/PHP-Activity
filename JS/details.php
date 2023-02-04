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
                echo "Welcome Guest";
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
    <div class="backEdit">
        <a class="buttons" href="index.php">Back</a>
        <a class="buttons" href=" edit.php?ID=<?php echo $row['ID']; ?>">Edit</a>
    </div>
    <form action="delete.php" method="post">
        <button type="submit" name="delete">Delete</button>
        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>" />
    </form>
    <br />
    <div class="studentInfo">
        <h2>Student Info</h2>
        <h3>Student ID:
            <span><br />
                <?php echo $row['ID']; ?>
            </span>
        </h3>
        <h3>Name:
            <span><br />
                <?php echo $row['First_Name']; ?>
                <?php echo $row['Last_Name']; ?>
            </span>
        </h3>
        <h3>Gender:
            <span><br />
                <?php echo $row['Gender']; ?>
            </span>
        </h3>
        <h3>Date of Birth:
            <span><br />
                <?php echo $row['Birth_Date']; ?>
            </span>
        </h3>
    </div>
</body>

</html>