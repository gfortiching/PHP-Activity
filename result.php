<?php

include_once("Connections/connection.php");
$con = connection();
$search = $_GET['search'];

// if ($search == null) {
//     return "None";
// }
// ;

$sql = "SELECT * FROM student_info WHERE FName LIKE '%$search%' || LName LIKE '%$search%'
ORDER BY id DESC";
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
    <div class="insert">
        <a href="index.php">List of Students' Information</a>
    </div>
    <section class="tableSection">
        <form class="search" action="result.php" method="get">
            <input type="text" name="search" id="search" />
            <button type="submit">Search</button>
        </form>
        <table>
            <caption>List of Students</caption>
            <thead>
                <tr>
                    <th>More</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <?php do { ?>
                <?php if ($row == null) { ?>
                <h2 style="color: red;">Student Information Not Found</h2>
                <?php } else { ?>
                <tr>
                    <td class="view">
                        <a href="details.php?ID=<?php echo $row['ID']; ?>">view info</a>
                    </td>
                    <td>
                        <?php echo $row['ID']; ?>
                    </td>
                    <td>
                        <?php echo $row['FName']; ?>
                    </td>
                    <td>
                        <?php echo $row['LName']; ?>
                    </td>
                </tr>
                <?php } ?>

                <?php } while ($row = $students->fetch_assoc()) ?>
            </tbody>
        </table>
    </section>
</body>

</html>