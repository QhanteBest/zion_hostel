<?php
include "../includes/auth.php";
include "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];
    $student_fname = $_POST['student_fname'];
    $student_lname = $_POST['student_lname'];
    $student_phone_number = $_POST['student_phone_number'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_number = $_POST['emergency_contact_number'];

    $sql = "UPDATE student SET
            student_fname='$student_fname',
            student_lname='$student_lname',
            student_phone_number='$student_phone_number',
            emergency_contact_name='$emergency_contact_name',
            emergency_contact_number='$emergency_contact_number'
            WHERE student_id='$student_id'";

    if (mysqli_query($conn, $sql)) {

        header("Location: students.php");
        exit();

    } else {

        echo "Error updating student: " . mysqli_error($conn);

    }

} else {

    header("Location: students.php");
    exit();

}
?>