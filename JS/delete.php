<?php
include_once("Connections/connection.php");
$con = connection();

if (isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $sql = "DELETE FROM student_info WHERE ID = '$id'";
    $con->query($sql) or die($con->error);
    echo header("Location: index.php");
}