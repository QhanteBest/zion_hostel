<?php

include "../includes/config.php";

if (isset($_POST['student_id'])) {

    $student_id = $_POST['student_id'];
    $student_fname = $_POST['student_fname'];
    $student_lname = $_POST['student_lname'];
    $student_phone_number = $_POST['student_phone_number'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_number = $_POST['emergency_contact_number'];

    $sql = "INSERT INTO student
    (student_id, student_fname, student_lname, student_phone_number, emergency_contact_name, emergency_contact_number)
    VALUES
    ('$student_id','$student_fname','$student_lname','$student_phone_number','$emergency_contact_name','$emergency_contact_number')";

    if (mysqli_query($conn, $sql)) {

        header("Location: students.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}
?>