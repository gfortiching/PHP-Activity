<?php

include_once("Connections/connection.php");
$con = connection();

$sql = "SELECT * FROM student_info ORDER BY ID DESC";
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
    <div class="insert"><a href="insert.php">Insert New Student Info</a></div>

    <section class="tableSection">
        <form class="search" action="result.php" method="get">
            <input type="text" name="search" id="search" />
            <button type="submit">Search</button>
        </form>
        <table>
            <caption>List of Students</caption>
            <thead>
                <tr>
                    <th>View</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <!-- <th>Gender</th>
                    <th>Birth Date</th> -->
                </tr>
            </thead>
            <tbody>
                <?php do { ?>
                <tr>
                    <td class="view">
                        <a href="details.php?ID=<?php echo $row['ID']; ?>">view info</a>
                    </td>
                    <td>
                        <?php echo $row['ID']; ?>
                    </td>
                    <td>
                        <?php echo $row['First_Name']; ?>
                    </td>
                    <td>
                        <?php echo $row['Last_Name']; ?>
                    </td>
                    <!-- <td>
                        <?php echo $row['Gender']; ?>
                    </td>
                    <td>
                        <?php echo $row['Birth_Date']; ?>
                    </td> -->
                </tr>
                <?php } while ($row = $students->fetch_assoc()) ?>
            </tbody>
        </table>
    </section>
</body>

</html>