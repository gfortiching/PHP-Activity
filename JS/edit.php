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
    <link rel="stylesheet" href="/School_Registrar/css/styles.css">

</head>

</html>

<body>
    <div class="insert"><a href="index.php">Back to Students' Information</a></div>
    <form class="editStudent" action="" method="post">
        <h2>Update Student Details</h2>
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
</body>