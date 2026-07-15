<?php
include "../includes/auth.php";
include "../includes/config.php";

if (isset($_GET['id'])) {

    $student_id = $_GET['id'];

    $sql = "DELETE FROM student WHERE student_id='$student_id'";

    if (mysqli_query($conn, $sql)) {

        header("Location: students.php");

        exit();

    } else {

        echo "Error deleting student.";

    }

} else {

    header("Location: students.php");

    exit();

}
?>